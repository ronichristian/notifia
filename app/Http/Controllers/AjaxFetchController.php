<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PostDetails;
use App\ListDetails;
use Carbon\Carbon;
use App\Products;
use App\Stores;
use DB;

class AjaxFetchController extends Controller
{
    public function fetch_product_name (Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            
            $data = Products::where('product_name', 'LIKE', "%{$query}%")->get();
            // $output = '<ul style="margin-left: 15px; display:block;" id="searched_prod_name" class="dropdown-menu" >';
            $item_list = '';
            $output = '<datalist id="searched_prod_name" >';
            foreach($data as $row)
            {
                // $output .= '<li style="background: white; border: none; display:block;" id="li_searched_item">
                //                 <a id="li_prod_name" href="#">'.$row->product_name.'</a>
                //             </li>';
                $output .= '<option>'.$row->product_name.'</option>';
            }
            $output .= '</datalist>';
            // $output .= '</ul>';
            $array = array('output' => $output, 'item_list' => $item_list);
            return array('output' => $output, 'item_list' => $item_list);
        }
    }

    public function fetch_store_name (Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            
            $data = Stores::where('store_name', 'LIKE', "{$query}%")->get();
            // $output = '<ul id="searched_store_item" class="dropdown-menu" style="margin-left: 15px; color: rgb(255,127,39); display:block; ">';
            $item_list = '';
            $output = '<datalist id="searched_store_name" >';
            foreach($data as $row)
            {
                // $output .= '<li style="background: white; border: none; display:block;" id="li_searched_item"><a href="#">'.$row->store_name.'</a></li>';
                $output .= '<option>'.$row->store_name.'</option>';
            }
            $output .= '</datalist>';
            // $output .= '</ul>';
            $array = array('output' => $output, 'item_list' => $item_list);
            return array('output' => $output, 'item_list' => $item_list);
        }
    }

    public function search_product_store(Request $request)
    {
        if($request->get('query'))
        {
            
            $query = $request->get('query');
            
            $data = Products::where('product_name', 'LIKE', "%{$query}%")
            ->distinct()
            ->get();
            $stores = Products::join('post_details','post_details.product_id','=','products.id')
            ->join('stores','store_id','=','post_details.store_id')
            ->where('store_name', 'LIKE', "%{$query}%")
            ->distinct()
            ->get();
            $post_details = PostDetails::all();
            $current = Carbon::now();
            $stores = Stores::all();
            $output = '';

            $output = '<ul style="z-index:10; font-size:16px; display:block;" id="searched_product" class="dropdown-menu">';
            $item_list = '';
            foreach($data as $row)
            {
                $output .= '<li id="li_searched_item">
                                <a  href="#">'.ucfirst($row->product_name).'</a>
                            </li>';
            }
            
            $output .= '</ul>';
            $array = array('output' => $output);
            if(empty($array)){
                return '<div></div>';
            }else{
                return array('output' => $output);
            }
        }
    }

    public function search_product(Request $request)
    {
        if($request->get('query'))
        {
            
            $query = $request->get('query');
            
            $data = Products::where('product_name', 'LIKE', "%{$query}%")->get();
            $post_details = PostDetails::all();
            $current = Carbon::now();
            $stores = Stores::all();
            $output = '';

            $output .= '<ul style="z-index:10; display:block; position: fixed;" id="searched_product" class="page_menu_nav ">';
            $item_list = '';
            foreach($data as $row)
            {
                $output .= '<li class="page_menu_item" id="li_searched_item">
                                <a  href="#">'.ucfirst($row->product_name).'</a>
                            </li>';
            }
            $output .= '</ul>';
            $array = array('output' => $output);
            if(empty($array)){
                return '<div></div>';
            }else{
                return array('output' => $output);
            }
        }
    }

    public function fetch_store_by_prod_name(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            
            $data = Stores::join('post_details','post_details.store_id','=','stores.id')
            ->join('products','products.id','=','post_details.product_id')
            ->select('store_name')
            ->where('product_name', 'LIKE', "%{$query}%")
            ->distinct()
            ->get();
            
            $prod_id = Stores::join('post_details','post_details.store_id','=','stores.id')
            ->join('products','products.id','=','post_details.product_id')
            ->select('product_id')
            ->where('product_name', 'LIKE', "%{$query}%")
            ->distinct()
            ->get();
            return $prod_id;
            $store_name = '';
            $product_id = '';

            // foreach($data as $row)
            // {
            //     $store_name .= '<option id="result" value="'.$row['store_name'].'">'.$row['store_name'].'</option>';
            // }
            foreach($prod_id as $row)
            {
                $product_id .= $row['product_id'];
                $post_details_id = $row['id'];
            } 
            return array('store_name' => $store_name, 'product_id' => $product_id);
        }
    }

    public function fetch_prod_price_by_store_name(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            $query1 = $request->get('query1');
            
            $data = PostDetails::join('stores','stores.id','=','post_details.store_id')
            ->distinct()
            ->select('post_details.store_id','post_details.product_price','post_details.created_at', 'post_details.id')
            ->where('store_name', '=', $query)
            ->where('product_id', '=', $query1)
            ->limit(1)
            ->orderBy('post_details.id', 'DESC')
            ->get();
            
            $price = '';
            $store_id = '';
            foreach($data as $row)
            {
                $store_id = $row['store_id'];
                if(is_numeric($row['product_price'])){
                    $price .= $row['product_price'];
                }else{
                    $price .= "ASD";
                }
            }
            
            return array('price' => $price, 'store_id' => $store_id);
        }
    }

    public function get_sum_of_subtotal(Request $request)
    {
        $product_price = $request->get('product_price');
        $store_name = $request->get('store_name');
        $user_list_id = $request->get('id');

        $total_checked = ListDetails::where('user_list_id', $user_list_id )
            ->where('is_checked', 1)
            ->sum('subtotal');

        return $total_checked;
    }

    public function get_sum_of_unchecked(Request $request)
    {
        $product_price = $request->get('product_price');
        $store_name = $request->get('store_name');
        $user_list_id = $request->get('id');

        $total_checked = ListDetails::where('user_list_id', $user_list_id )
            ->where('is_checked', 1)
            ->sum('subtotal');

        return $total_checked;
    }
}

            
