<?php

namespace App\Http\Controllers;

use Image;
use App\Picture;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

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
use Auth;
use DB;

class ProductController extends Controller
{
    public function addproduct(Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required',
            'product_price' => 'required',
            'store_name' => 'required',
            'location' => 'required',
            'category' => 'required',
            'image' => 'nullable|mimes:jpeg,png',
        ]);

        // if($request->hasFile('image')){
        //     $filenameWithExt = $request->file('image')->getClientOriginalName();

        //     $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

        //     $extension = $request->file('image')->getClientOriginalExtension();

        //     $fileNameToStore = $filename.'_'.time().'.'.$extension;

        //     $path = $request->file('image')->storeAs('public/product_images', $fileNameToStore);
        //     Alert::success("Succces", "Product Shared!", "success");
        // }else{
            
        //     $fileNameToStore = "default-product.jpg";
        //     Alert::success("Succces", "Product Shared!", "error");
        // }

        if($request->hasFile('image'))
        {
            // $file = Input::file('image');
            // $extension = $request->file('image')->getClientOriginalExtension();
            // $fileNameToStore = Image::make($file);
            // Response::make($fileNameToStore->encode('png'));
            
            $file = $request->file('image');
            $fileNameToStore = base64_encode(file_get_contents($file->getRealPath()));
        }
        else
        {
            $fileNameToStore = "/storage/product_images/default-product.jpg";
        }
        

        $products = new Products();
        $post_details = new PostDetails();
        $stores = new Stores();
       
        $prod = Products::where('product_name',Input::get('product_name'))->first();
        $store = Stores::where('store_name',Input::get('store_name'))->first();
        $cnt_prod = Products::count();

        //If DB is not empty
        if($cnt_prod > 0)
        {   
            //If product exist
            if(!is_null($prod))
            {
                //If store exist
                if(!is_null($store))
                {
                    $input_location = strtolower($request->input('location'));
                    if (Stores::where('location', '=', Input::get('location'))->exists()) {
                        
                    }
                    else
                    {
                        $stores->store_name = strtolower($request->input('store_name'));
                        $stores->location = strtolower($request->input('location'));
                        $stores->save();
                        
                    }
                    $input_prod_name = strtolower($request->input('product_name'));
                    $product_id = Products::where('product_name', 'LIKE', "%{$input_prod_name}%")->get();
                    
                    $input_store_name = strtolower($request->input('store_name'));

                    DB::table('list_details')
                    ->where('product_id', $product_id[0]['id'])->where('store_name', $input_store_name)
                    ->update(['product_price' => $request->input('product_price')]);

                    DB::table('list_details')
                    ->where('product_id', $product_id[0]['id'])->where('store_name', $input_store_name)
                    ->update(['subtotal' => $request->input('product_price') * 1 ]);
                    
                }
                //If store does not exist
                else
                {
                    $stores->store_name = strtolower($request->input('store_name'));
                    $stores->location = strtolower($request->input('location'));
                    $stores->save();
                }

                $input_prod_name = strtolower($request->input('product_name'));
                $input_store_name = strtolower($request->input('store_name'));
                $product_id = Products::where('product_name', 'LIKE', "%{$input_prod_name}%")->get();
                $store_name = Stores::where('store_name', 'LIKE', "%{$input_store_name}%")->get();
                $store_id =  DB::table('stores')->orderBy('id',"DESC")->take(1)->value('id');

                $input_location = strtolower($request->input('location'));
                $s_id = Stores::where('location', 'LIKE', "%{$input_location}%")->where('store_name', 'LIKE', "%{$input_store_name}%")->get();

                $post_details->product_price = $request->input('product_price');
                $post_details->category_id = $request->input('category');
                $post_details->product_id = $product_id[0]['id'];
                $post_details->user_id = auth()->user()->id;
                $post_details->store_id = $s_id[0]['id'];
                $post_details->save();
                
            }
            //If product does not exist
            else
            {
                $products->product_name = strtolower($request->input('product_name'));
                $products->avatar = $fileNameToStore;
                $products->save();


                //If store exist
                if(!is_null($store))
                {
                    $input_location = strtolower($request->input('location'));
                    if (Stores::where('location', '=', Input::get('location'))->exists()) {
                        
                    }
                    else
                    {
                        $stores->store_name = strtolower($request->input('store_name'));
                        $stores->location = strtolower($request->input('location'));
                        $stores->save();
                    }
                }
                //If store does not exist
                else
                {   
                    $stores->store_name = strtolower($request->input('store_name'));
                    $stores->location   = strtolower($request->input('location'));
                    $stores->save();
                }
                $input_store_name = strtolower($request->input('store_name'));
                $store_name = Stores::where('store_name', 'LIKE', "%{$input_store_name}%")->get();
                $store_id =  $store_name[0]['id'];
                
                $input_location = strtolower($request->input('location'));
                $s_id = Stores::where('location', 'LIKE', "%{$input_location}%")->where('store_name', 'LIKE', "%{$input_store_name}%")->get();

                $post_details->product_price = $request->input('product_price');
                $post_details->category_id = $request->input('category');
                $post_details->user_id = auth()->user()->id;
                $post_details->product_id = $products->id;
                $post_details->store_id = $store_id;
                $post_details->save();

            }
        }
        //If DB is not empty
        else
        {
            $products->product_name = strtolower($request->input('product_name'));
            $products->avatar = $fileNameToStore;
            $products->save();

            $stores->store_name = strtolower($request->input('store_name'));
            $stores->location   = strtolower($request->input('location'));
            $stores->save();
            $store_id =  DB::table('stores')->orderBy('id',"DESC")->take(1)->value('id');
            
            $input_location = strtolower($request->input('location'));
            $s_id = Stores::where('location', 'LIKE', "%{$input_location}%")->get();

            // $product_id =  DB::table('stores')->orderBy('id',"DESC")->take(1)->value('id');
            $post_details->product_price = $request->input('product_price');
            $post_details->category_id = $request->input('category');
            $post_details->user_id = auth()->user()->id;
            $post_details->product_id = $products->id;
            $post_details->store_id = $store_id;
            $post_details->save();
        }
        
       
        Alert::success("Succces", "Product Shared!", "success");

        return redirect(route('home'));        

    }

    public function get_post_detail(Request $request)
    {
        $product_name = $request->get('query1');
        $store_name = $request->get('query2');
        
        $post_details = DB::table('post_details')
        ->join('products', 'products.id', '=', 'post_details.product_id')
        ->join('stores', 'stores.id', '=', 'post_details.store_id')
        ->select('product_id','store_id','category_id')
        ->where('product_name', $product_name)
        ->where('store_name', $store_name)
        ->orderBy('post_details.id',"DESC")->take(1)
        ->get();

        return $post_details;
    }

    public function add_post_details(Request $request)
    {
        $p_details = $request->get('data');
        $post_details = new PostDetails;
        $post_details->product_id       = $p_details['product_id'];
        $post_details->store_id         = $p_details['store_id'];
        $post_details->user_id          = auth()->user()->id;
        $post_details->product_price    = $p_details['product_price'];
        $post_details->category_id      = $p_details['category_id'];
        $post_details->save();

        return $p_details;
    }

    public function get_picture($id)
    {
        $picture = Products::find($id);
        $avatar = Image::make($picture->avatar);
        $response = Response::make($avatar->encode('png'));

        //setting content-type
        $response->header('Content-Type', 'image/png');

        return $response;
    }

    public function get_products()
    {
        $current = Carbon::now();
        $latest_prods = Products::join('post_details', 'post_details.product_id', '=', 'products.id')
                ->join('stores', 'stores.id', '=', 'post_details.store_id')
                ->select('products.id', 'products.product_name', 'products.avatar')
                ->where('post_details.created_at', '>', $current->subDays(7))
                ->where('location', '=', 'valencia city') //condition for location
                ->orderBy('products.id', 'desc')
                ->distinct()
                ->get();
        return $latest_prods;
    }

    public function get_latest_product()
    {
        $latest_product = Products::join('post_details', 'post_details.product_id', '=', 'products.id')
                ->join('stores', 'stores.id', '=', 'post_details.store_id')
                ->select('post_details.category_id', 'products.id', 'products.product_name', 'products.avatar', 'post_details.created_at')
                ->orderBy('post_details.created_at', 'desc')
                ->where('location', '=', 'valencia city') //condition for location
                ->distinct()
                ->limit(1)
                ->get(); 
        return $latest_product;
    }
}
