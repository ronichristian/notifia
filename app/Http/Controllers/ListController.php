<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\SharedListsDetails;
use App\SharedLists;
use App\PostDetails;
use App\ListDetails;
use App\UserLists;
use App\Products;
use Alert;
use DB;

class ListController extends Controller
{
    public function create_list(Request $request)
    {
        // Alert::success('Success Title', 'Success Message');
        $items = $request->get('arr');
        $list_label = $request->get('arr1');
        
        $user_lists = new UserLists();
        $user_lists->list_name  = $list_label['list_name'];
        $user_lists->location   = $list_label['location'];
        $user_lists->remarks    = $list_label['remarks'];
        $user_lists->is_shared  = 0;
        $user_lists->user_id    = auth()->user()->id;
        $user_lists->save();
        // $select_details = PostDetails::join('products','products.id','=','post_details.product_id')
        // ->join('stores','stores.id','=','post_details.store_id')
        // ->select('post_details.product_id','post_details.product_price','post_details.store_id')
        // ->where('product_name', $product_name)
        // ->get();

        for($i=0; $i < count($items); $i++){
            $list                   = new ListDetails();
            $product_names          = $items[$i]['p_name'];
            $product_prices         = $items[$i]['p_price'];
            $store_names            = $items[$i]['select_store_name'];
            $product_ids            = $items[$i]['product_id'];
            $qtys                   = $items[$i]['qty'];
            $subtotal               = $items[$i]['subtotal'];
            
            $list->product_name     = $product_names;
            $list->store_name       = $store_names;
            $list->quantity         = $qtys;
            $list->product_price    = $product_prices;
            $list->subtotal         = $subtotal;
            $list->is_checked       = 0;
            $list->product_id       = $product_ids;
            $list->user_list_id     = DB::table('user_lists')->orderBy('id',"DESC")->take(1)->value('id');
            $list->save();
        }
        return $product_ids;
    }
    
    public function get_details(Request $request)
    {
        $id = $request->get('id');
        $post_details = PostDetails::join('stores', 'stores.id', '=', 'post_details.store_id')
        ->join('products', 'products.id', '=', 'post_details.product_id')
        ->where('post_details.id', $id)
        ->orderBy('post_details.created_at', 'DESC')
        ->get();

        return $post_details;
    }

    public function add_to_list(Request $request)
    {
        $item = $request->get('data');

        $list                   = new ListDetails();
        $list->product_name     = $item['product_name'];
        $list->store_name       = $item['store_name'];
        $list->quantity         = 1;
        $list->product_price    = $item['product_price'];
        $list->subtotal         = ($item['product_price'] * 1);
        $list->is_checked       = 0;
        $list->product_id       = $item['product_id'];
        $list->user_list_id     = $item['list_id'];
        $list->save();

        return $list;
    }

    public function add_product_to_list(Request $request)
    {
        $product = $request->get('data');
        
        $list_details           = new ListDetails();
        $list_details->product_name     = $product['product_name'];
        $list_details->store_name       = strtolower($product['store_name']);
        $list_details->quantity         = $product['qty'];
        $list_details->product_price    = $product['product_price'];
        $list_details->subtotal         = $product['subtotal'];
        $list_details->product_id       = $product['product_id'];
        $list_details->user_list_id     = $product['user_list_id'];
        $list_details->is_checked       = 0;
        $list_details->save();

        return $product;
        
    }
    
    public function delete_item(Request $request)
    {
        $id = $request->get('data');

        $list = ListDetails::find($id);
        $list->delete();
       
        return redirect()->back();
    }

    public function delete_list(Request $request)
    {
        $id = $request->get('data');
        
        $list = UserLists::find($id);
        $list->delete();

        $list_details = ListDetails::where('user_list_id',$id);
        $list_details->delete();

        return view('pagess.profile');
    }

    public function show_item(Request $request)
    {
        $id = $request->get('data');

        $list = ListDetails::find($id);
        $prod_id = $list['product_id'];
        
        $product = ListDetails::distinct()
                ->select('product_name', 'store_name', 'quantity', 'product_price')
                ->where('id', $id)
                ->get();
        $post_details = PostDetails::where('product_id', $id)->get();
        return $product;
    }

    public function show_list_name(Request $request)
    {
        $id = $request->get('data');

        $list = UserLists::find($id);
        $list_name = $list['list_name'];
        
        $product = ListDetails::distinct()
                ->select('product_name', 'store_name', 'product_price')
                ->where('id', $id)
                ->get();
        $post_details = PostDetails::where('product_id', $id)->get();
        return $list;
    }

    public function update_list_name(Request $request, $id)
    {
        $list_name = $request->get('data');
        $remarks = $request->get('data1');
        
        $list = UserLists::find($id);
        $list->list_name = $list_name;
        $list->remarks = $remarks;
        $list->save();

        return $list;
    }

    public function check_product(Request $request)
    {
        $id = $request->get('data');

        $list_details = ListDetails::find($id);
        $list_details->is_checked = 1;
        $list_details->save();
        
        return $list_details;
    }

    public function uncheck_product(Request $request)
    {
        $id = $request->get('data');

        $list_details = ListDetails::find($id);
        $list_details->is_checked = 0;
        $list_details->save();
        
        return $list_details;
    }

    public function update_item_in_list(Request $request, $id)
    {
        $items = $request->get('data');
        $list_details                   = ListDetails::find($id);
        $list_details->product_name     = $items['product_name'];
        $list_details->store_name       = $items['store_name'];
        $list_details->quantity         = $items['qty'];
        $list_details->product_price    = $items['product_price'];
        $list_details->subtotal         = $items['subtotal'];
        $list_details->save();

        Alert::message("Update Successful");

        return redirect()->back();
    }

    public function get_list_details(Request $request)
    {
        $id = $request->get('data');
        $list = UserLists::join('list_details', 'list_details.user_list_id', '=', 'user_lists.id')
            ->select('product_name','product_price','store_name','is_checked','product_id','user_list_id')
            ->where('user_lists.id',$id)
            ->get();
        return $list;
    }

    public function save_list(Request $request)
    {   
        $list_with_details = $request->get('data');
        $user_lists = new UserLists;
        $user_lists->list_name = $list_with_details[0]['list_name'];
        $user_lists->location = $list_with_details[0]['list_location'];
        $user_lists->is_shared = 0;
        $user_lists->user_id =  auth()->user()->id;
        $user_lists->save();
        
        $user_list_id =  DB::table('user_lists')->orderBy('id',"DESC")->take(1)->value('id');

        for($i=0; $i <= count($list_with_details)+1; $i++)
        {
            $list_details = new ListDetails;
            $list_details->product_name         = $list_with_details[$i]['product_name'];
            $list_details->store_name           = $list_with_details[$i]['store_name'];
            $list_details->quantity             = 1;
            $list_details->product_price        = $list_with_details[$i]['product_price'];
            $list_details->subtotal             = ($list_with_details[$i]['product_price'] * 1);
            $list_details->is_checked           = 0;
            $list_details->product_id           = $list_with_details[$i]['product_id'];
            $list_details->user_list_id         = $user_list_id;
            $list_details->save();
        }

        return $list_details;
    }

    public function share_list(Request $request)
    {
        $list_id = $request->get('data');
        $list = UserLists::find($list_id);
        $list->is_shared = 1;
        $list->save();
        return $list_id;
    }

    public function unshare_list(Request $request)
    {
        $list_id = $request->get('data');
        $list = UserLists::find($list_id);
        $list->is_shared = 0;
        $list->save();
        return $list_id;
    }
}
