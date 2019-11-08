<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\CommercialProducts;
use App\SharedListsDetails;
use App\SharedLists;
use App\PostDetails;
use App\ListDetails;
use App\UserLists;
use App\Category;
use App\Products;
use App\Stores;
use Carbon\Carbon;
use App\User;
use Image;
use Auth;
use DB;
use Charts;

class AjaxController extends Controller
{
   
    public function latest_prods()
    {
     
        $current = Carbon::now();
        
        $commercial_products = CommercialProducts::where('created_at', '>', $current->subDays(14))->limit(2)->get();
      
                
        $latest_prods = Products::join('post_details', 'post_details.product_id', '=', 'products.id')
                ->join('stores', 'stores.id', '=', 'post_details.store_id')
                ->select('products.id', 'products.product_name', 'products.avatar')
                ->orderBy('post_details.created_at', 'desc')
                ->where('post_details.created_at', '>', $current->subDays(7))
                ->where('location', '=', 'valencia city') //condition for location
                ->distinct()
                ->get();

        $latest_product = Products::join('post_details', 'post_details.product_id', '=', 'products.id')
                ->join('stores', 'stores.id', '=', 'post_details.store_id')
                ->select('category_id', 'products.id', 'products.product_name', 'products.avatar', 'post_details.created_at')->distinct()
                ->orderBy('post_details.created_at', 'desc')
                ->where('location', '=', 'valencia city') //condition for location
                ->limit(1)
                ->get();
    
        return view('inc.products_of_the_week',
                ['commercial_products' => $commercial_products, 
                'latest_product' => $latest_product,
                'latest_prods' => $latest_prods,
                ]);
    }

    public function list_table($id)
    {
        $list_details = DB::table('list_details')
        ->select('list_details.product_name', 'list_details.is_checked','list_details.user_list_id','list_details.id','list_details.product_price','list_details.store_name','list_details.quantity')
        ->where('user_list_id', $id)
        ->orderBy('store_name', 'asc')
        ->get();
        $stores = Stores::all();
        
        return view('inc.list_details_table')
                    ->with('list_details', $list_details)
                    ->with('stores', $stores);
    }

    public function products_by_category($id)
    {
        $all_products = PostDetails::join('products', 'products.id', '=', 'post_details.product_id')
        ->select('products.id','products.product_name','products.avatar')
        ->where('category_id', $id)
        ->distinct()
        ->get();

        return view('inc.products_by_clicked_category',['all_products' => $all_products]);
    }

}
