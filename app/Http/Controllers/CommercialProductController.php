<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\CommercialProducts;
use App\ListDetails;
use App\PostDetails;
use App\UserLists;
use Carbon\Carbon;
use App\Category;
use App\Products;
use App\Stores;
use App\Users;
use Session;
use Charts;
use Alert;
use Image;
use Auth;
use DB;

class CommercialProductController extends Controller
{
    public function commercial_product($id)
    {
        $stores = Stores::all();
        $current = Carbon::now();
        $categories = Category::all();
        $post_details = PostDetails::all();
        $store_names = Stores::select('store_name', 'id')->get();
        $commercial_products = CommercialProducts::find($id);
        $location_names = Stores::select('location')->distinct()->get();
        $stores_for_header_page = Stores::select('store_name', 'id', 'location')->get();

        $store_names_for_add_product = Stores::select('store_name')->distinct()->get();
        $products_for_add_product = Products::all();
        
        return view('pagess.commercial_product',[
            'stores' => $stores,
            'store_names' => $store_names,
            'categories' => $categories,
            'commercial_products' => $commercial_products,
            'location_names' => $location_names,
            'stores_for_header_page' => $stores_for_header_page,
            'store_names_for_add_product' => $store_names_for_add_product,
            'products_for_add_product' => $products_for_add_product
        ]);
    }

    public function submit_ads_form() 
    {
        $post_details = PostDetails::all(); 
        $user_lists = UserLists::all();       
        $categories = Category::all();
        $products = Products::all();
        $lists = UserLists::all();
        $current = Carbon::now();
        $stores = Stores::all();
        $store_names = Stores::select('store_name', 'id')->get();
        return view('pagess.submit_ads_form',[
            'post_details' => $post_details,
            'user_lists' => $user_lists,
            'categories' => $categories,
            'products' => $products,
            'lists' => $lists,
            'stores' => $stores,
            'store_names' => $store_names
        ]);
    }

    public function add_commercial_product(Request $request)
    {
         $this->validate($request, [
            'ads_product_name' => 'required',
            'ads_description' => 'required',
            'ads_sponsor' => 'required',
            'ads_store_name' => 'required',
            'ads_product_price' => 'required',
            'image' => 'image|nullable|max:1999'
        ]);

        $post_details = PostDetails::all(); 
        $user_lists = UserLists::all();       
        $categories = Category::all();
        $products = Products::all();
        $lists = UserLists::all();
        $current = Carbon::now();
        $stores = Stores::all();
        $store_names = Stores::select('store_name', 'id')->get();

        // if(Input::hasFile('image')){
        //     echo "Uploaded<br>";
        //     $file = Input::file('image');
        //     $filename = $file->getClientOriginalName();
        //     Image::make($file)->resize(115,115)->save( public_path('/uploads/images/' . $filename));
        // }else{
        //     $filename = "default-product.jpg";
        // }

        if($request->hasFile('image'))
        {
            $path = $request->file('image')->getRealPath();
            $logo = file_get_contents($path);
            $fileNameToStore = base64_encode($logo);
        }
        else
        {
            
        }

        $commercial_products = new CommercialProducts;
        $commercial_products->product_name = $request->input('ads_product_name');
        $commercial_products->sponsor = $request->input('ads_sponsor');
        $commercial_products->description = $request->input('ads_description');
        $commercial_products->store_name = $request->input('ads_store_name');
        $commercial_products->product_price = $request->input('ads_product_price');
        $commercial_products->avatar = $fileNameToStore;
        $commercial_products->save();

        Alert::success("Succces", "Insert Successfully", "success");

        return view('pagess.submit_ads_form',[
            'post_details' => $post_details,
            'user_lists' => $user_lists,
            'categories' => $categories,
            'products' => $products,
            'lists' => $lists,
            'stores' => $stores,
            'store_names' => $store_names
        ]);
    }

}
