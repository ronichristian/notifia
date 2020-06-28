<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Console\Scheduling\Schedule;
use App\SharedListsDetails;
use App\SharedLists;
use App\PostDetails;
use App\ListDetails;
use App\UserLists;
use App\Products;
use Carbon\Carbon;
use App\Predictions;
use Alert;
use DB;

class PredictionController extends Controller
{
    public function add_date_start_to_predict(Request $request)
    {
        $user_list_id = $request->get('data');
        $qty = ListDetails::select('quantity')->where('id', $user_list_id)->get();

        $get_date_start = ListDetails::select('updated_at')->where('id',$user_list_id)->get();

        $list = ListDetails::select('updated_at','quantity')->where('id',$user_list_id)->get();
        $date_start = Carbon::now();

        
        $x = Predictions::select('quantity')->where('list_details_id',$user_list_id)->get();
        $y = Predictions::select('days')->where('list_details_id',$user_list_id)->get();


        if(count($x) > 0)
        {
            $x_sum = DB::table('predictions')->sum('quantity');
            $y_sum = DB::table('predictions')->sum('days');

            $summation_x = 0;
            $summation_y = 0;

            for($i=0; $i < count($x); $i++)
            {
                $summation_x = $x[$i]['quantity'] - ($x_sum / count($x));
            }
        
            for($i=0; $i < count($y); $i++)
            {
                $summation_y = $y[$i]['days'] - ($y_sum / count($y));
            }
        

            $up = $summation_x * $summation_y;

            $down = $summation_x * $summation_x;

            if( ($up == 0 && $down == 0)  || ($up == 0 || $down == 0))
            {
                $m = 0;
            }
            else
            {
                $m = $up / $down;
            }

            if( count($y) == 0 || count($x) == 0 )
            {
                $b = 0;
            }
            else
            {
                $b = $y_sum / count($y) - ($m * ($x_sum / count($x)) );
            }
            

            $x_last = ListDetails::select('quantity')->where('id',$user_list_id)->orderBy('created_at', 'desc')->get();
            $x_last_index = $x_last[0]['quantity'];

            $y = ($m * $x_last_index) + $b;

            $quantity = $x[0]['quantity'];

            // DILI NA SIGURU MAG ADD ???????
            $prediction = new Predictions;
            $prediction->quantity = $quantity;
            $prediction->list_details_id = $user_list_id;
            $prediction->save();
            
            $list_details = ListDetails::find($user_list_id);
            $list_details->prediction = $y;
            $list_details->date_start = $date_start;
            $list_details->save();

            return $y;
        }
        else
        {
            $y = 0;

            $prediction = new Predictions;
            $prediction->quantity = $qty[0]['quantity'];
            $prediction->list_details_id = $user_list_id;
            $prediction->save();

            $list_details = ListDetails::find($user_list_id);
            $list_details->prediction = $y;
            $list_details->date_start = $date_start;
            $list_details->save();

            return 'asd';
            
        }

        
    }

    public function add_date_end_to_predict(Request $request)
    {
        $id = $request->get('data');

        $get_date_start = ListDetails::select('date_start')->where('id',$id)->get();
        $get_date_end = ListDetails::select('updated_at')->where('id',$id)->get();

        $date_start = $get_date_start[0]['date_start'];
        $date_end = Carbon::now();

        $diff_days = Carbon::parse($date_end)->diffInDays($date_start);

        $x = Predictions::select('quantity')->where('list_details_id',$id)->get();
        $y = Predictions::select('days')->where('list_details_id',$id)->get();
        
        $x_sum = DB::table('predictions')->sum('quantity');
        $y_sum = DB::table('predictions')->sum('days');

        $summation_x = 0;
        $summation_y = 0;

        for($i=0; $i < count($x); $i++)
        {
            $summation_x = $x[$i]['quantity'] - ($x_sum / count($x));
        }
    
        for($i=0; $i < count($y); $i++)
        {
            $summation_y = $y[$i]['days'] - ($y_sum / count($y));
        }

        $up = $summation_x * $summation_y;

        $down = $summation_x * $summation_x;

        if( ($up == 0 && $down == 0)  || ($up == 0 || $down == 0))
        {
            $m = 0;
        }
        else
        {
            $m = $up / $down;
        }

        if( count($y) == 0 || count($x) == 0 )
        {
            $b = 0;
        }
        else
        {
            $b = $y_sum / count($y) - ($m * ($x_sum / count($x)) );
        }

        $x_last = ListDetails::select('quantity')->where('id',$id)->orderBy('created_at', 'desc')->get();
        $x_last_index = $x_last[0]['quantity'];

        $y = ($m * $x_last_index) + $b;

        // return $y;

        DB::table('predictions')
        ->where('list_details_id', $id)
        ->limit(1)
        ->orderBy('id', 'desc')
        ->update(['days' => $diff_days ]);

        DB::table('list_details')
        ->where('id', $id)
        ->limit(1)
        ->update(['date_start' => $date_end ]);

        DB::table('list_details')
        ->where('id', $id)
        ->limit(1)
        ->update(['prediction' => $y ]);

        return 'y is - ' . $y;

        
    }

    public function days(Schedule $schedule)
    {
        // $days = $request->get('days');

        // ListDetails::where('prediction', '!=', null)->where('prediction', '!=', 0)->decrement('prediction', 1);        
            

    }
}
