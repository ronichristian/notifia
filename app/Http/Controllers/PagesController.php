<?php

namespace App\Http\Controllers;

use App\Picture;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

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
use App\Predictions;
use App\User;
use Image;
use Auth;
use DB;
use Charts;
use Alert;

class PagesController extends Controller
{
    public function index()
    {
        $current = Carbon::now();
        $products = Products::all();  
        $categories = Category::all();
        $post_details = PostDetails::all(); 
        $user_lists = UserLists::where('is_shared', '=', 1)->get();     
        $stores = Stores::where('location', '=', 'valencia city')->get();
        $locations = Stores::select('location', 'id')->distinct()->get();
        $location_names = Stores::select('location')->distinct()->get();
        
        $store_names_for_add_product = Stores::select('store_name')->distinct()->get();
        $products_for_add_product = Products::all();

        $stores_for_header_page = Stores::select('store_name', 'id', 'location')->get();
        $store_names_for_add_product = Stores::select('store_name')->distinct()->get();
        $store_names = Stores::select('store_name', 'id', 'location')->where('location', '=', 'valencia city')->get();
        $commercial_products = CommercialProducts::where('created_at', '>', $current->subDays(14))->limit(2)->get();
        $store_id = PostDetails::select('store_id', 'created_at')->orderBy('created_at', 'desc')->distinct()->get();

        $result = count($products);
       
        $products_compare = Products::join('post_details', 'post_details.product_id', '=', 'products.id')
                ->join('stores', 'stores.id', '=', 'post_details.store_id')
                ->select('products.avatar', 'products.product_name', 'products.id')
                ->where('location', '=', 'valencia city') //condition for location
                ->distinct()
                ->get();
        $latest_prods = Products::join('post_details', 'post_details.product_id', '=', 'products.id')
                ->join('stores', 'stores.id', '=', 'post_details.store_id')
                ->select('products.id', 'products.product_name', 'products.avatar')
                ->where('post_details.created_at', '>', $current->subDays(7))
                ->where('location', '=', 'valencia city') //condition for location
                ->orderBy('products.id', 'desc')
                ->distinct()
                ->get();
        $latest_product = Products::join('post_details', 'post_details.product_id', '=', 'products.id')
                ->join('stores', 'stores.id', '=', 'post_details.store_id')
                ->select('post_details.category_id', 'products.id', 'products.product_name', 'products.avatar', 'post_details.created_at')
                ->orderBy('post_details.created_at', 'desc')
                ->where('location', '=', 'valencia city') //condition for location
                ->distinct()
                ->limit(1)
                ->get();   
        $mosts =  Products::join('post_details', 'post_details.product_id', '=', 'products.id')
                ->join('categories','categories.id', '=', 'post_details.category_id')
                ->join('stores', 'stores.id', '=', 'post_details.store_id')
                ->select('products.id','product_name', 'category_name', 'category_id')
                ->groupBy('products.id', 'product_name', 'category_name', 'category_id')
                ->where('location', '=', 'valencia city') //condition for location
                ->orderBy(\DB::raw('count(post_details.product_id)'), 'DESC')
                ->limit(3)
                ->get();  

        return view('pagess.index',
                    ['store_names_for_add_product' => $store_names_for_add_product,
                    'products_for_add_product' => $products_for_add_product,
                    'stores_for_header_page' => $stores_for_header_page,
                    'commercial_products' => $commercial_products,
                    'products_compare' => $products_compare,
                    'location_names' => $location_names,
                    'latest_product' => $latest_product, 
                    'latest_prods' => $latest_prods,
                    'post_details' => $post_details,
                    'store_names' => $store_names,
                    'categories' => $categories,
                    'user_lists' => $user_lists,
                    'locations' => $locations,
                    'products' => $products,
                    'store_id' => $store_id,
                    'result' => $result,
                    'stores' => $stores,
                    'mosts' => $mosts,
                    ]);
    }
    
    public function by_location(Request $request)
    {
        $this->validate($request, [
            'select_location' => 'required'
        ]);
        $select_location = $request['select_location'];

        $post_details = PostDetails::all(); 
        $user_lists = UserLists::where('location', '=', $select_location)->where('is_shared', '=', 1)->get();       
        $categories = Category::all();
        $products = Products::join('post_details', 'post_details.product_id', '=', 'products.id')
                    ->join('stores', 'stores.id', '=', 'post_details.store_id')
                    ->where('location', '=', $select_location)
                    ->distinct()->get();
        $lists = UserLists::all();
        $current = Carbon::now();
        $stores = Stores::where('location', '=', $select_location)->get();
        $locations = Stores::select('location', 'id')->distinct()->get();
        $location_names = Stores::select('location')->distinct()->get();

        $result = count($products);
        $commercial_products = CommercialProducts::where('created_at', '>', $current->subDays(7))
        ->limit(2)
        ->get();

        $store_names = Stores::select('store_name', 'id', 'location')->where('location', '=', $select_location)->get();
        $stores_for_header_page = Stores::select('store_name', 'id', 'location')->get();

        $products_compare = Products::join('post_details', 'post_details.product_id', '=', 'products.id')
                ->join('stores', 'stores.id', '=', 'post_details.store_id')
                ->select('products.avatar', 'products.product_name', 'products.id')
                ->where('location', '=', $select_location) //condition for location
                ->distinct()
                ->get();

        $store_id = PostDetails::select('store_id')
                ->orderBy('created_at', 'desc')
                ->distinct()
                ->get(); 


        $latest_prods = Products::join('post_details', 'post_details.product_id', '=', 'products.id')
                ->join('stores', 'stores.id', '=', 'post_details.store_id')
                ->select('products.id', 'products.product_name', 'products.avatar')
                ->orderBy('post_details.created_at', 'desc')
                ->where('post_details.created_at', '>', $current->subDays(7))
                ->where('location', '=', $select_location) //condition for location
                ->distinct()
                ->get();
        
        $latest_product = Products::join('post_details', 'post_details.product_id', '=', 'products.id')
                ->join('stores', 'stores.id', '=', 'post_details.store_id')
                ->select('category_id','products.id', 'products.product_name', 'products.avatar')->distinct()
                ->orderBy('post_details.created_at', 'desc')
                ->where('post_details.created_at', '>', 3)
                ->where('location', '=', $select_location) //condition for location
                ->limit(1)
                ->get();
        
        $mosts =  DB::table('post_details')
                ->join('products','products.id', '=', 'post_details.product_id')
                ->join('categories','categories.id', '=', 'post_details.category_id')
                ->join('stores', 'stores.id', '=', 'post_details.store_id')
                ->select('post_details.product_id','product_name', 'product_id', 'products.avatar', 'category_name', 'category_id')
                ->groupBy('post_details.product_id', 'product_name', 'product_id', 'products.avatar', 'category_name', 'category_id')
                ->where('location', '=', $select_location) //condition for location
                ->orderByRaw('COUNT(*) DESC')
                ->limit(2)
                ->distinct()
                ->get(); 

        $store_names_for_add_product = Stores::select('store_name')->distinct()->get();
        $products_for_add_product = Products::all();

        return view('pagess.products_by_location',['store_names_for_add_product' => $store_names_for_add_product,
                                    'stores_for_header_page' => $stores_for_header_page,
                                    'commercial_products' => $commercial_products,
                                    'location_names' => $location_names,
                                    'products_compare' => $products_compare,
                                    'latest_product' => $latest_product, 
                                    'latest_prods' => $latest_prods,
                                    'post_details' => $post_details,
                                    'store_names' => $store_names,
                                    'categories' => $categories,
                                    'user_lists' => $user_lists,
                                    'locations' => $locations,
                                    'products' => $products,
                                    'store_id' => $store_id,
                                    'result' => $result,
                                    'stores' => $stores,
                                    'mosts' => $mosts,
                                    'lists' => $lists,  
                                    'select_location' => $select_location,
                                    'products_for_add_product' => $products_for_add_product
                                    ]);
    }

    //Create List
    public function create_list()
    {
        $categories = Category::all();
        $stores = Stores::all();
        $products = Products::all();
        $locations = Stores::select('location', 'id')->get();
        $location_names = Stores::select('location')->distinct()->get();

        $store_names_for_add_product = Stores::select('store_name')->distinct()->get();
        $products_for_add_product = Products::all();

        $store_names = Stores::select('store_name', 'id', 'location')->where('location', '=', 'valencia city')->get();
        $products_compare = Products::join('post_details', 'post_details.product_id', '=', 'products.id')
        ->join('stores', 'stores.id', '=', 'post_details.store_id')
        ->select('products.avatar', 'products.product_name', 'products.id')
        ->where('location', '=', 'valencia city') //condition for location
        ->distinct()
        ->get();
        
        $stores_for_header_page = Stores::select('store_name', 'id', 'location')->get();

        return view('pagess.create_list',['categories' => $categories,
                                           'stores_for_header_page' => $stores_for_header_page,
                                           'stores' => $stores,
                                           'products' => $products,
                                           'locations' => $locations,
                                           'store_names' => $store_names,
                                           'location_names' => $location_names,
                                           'products_compare' => $products_compare,
                                           'products_for_add_product' => $products_for_add_product,
                                           'store_names_for_add_product' => $store_names_for_add_product
                                           ]);
    }

    //View Profile With Lists
    public function profile()
    {
        $user_id = auth()->user()->id;
        $stores = Stores::all();
        $categories = Category::all();
        $user_lists = UserLists::where('user_id', $user_id)->get();
        $list_details = ListDetails::where('user_list_id', $user_id)->get();
        $store_names = Stores::select('store_name', 'id', 'location')->get();
        $locations = Stores::select('location', 'id')->get();
        $location_names = Stores::select('location')->distinct()->get();
        $stores_for_header_page = Stores::select('store_name', 'id', 'location')->get();

        $store_names_for_add_product = Stores::select('store_name')->distinct()->get();
        $products_for_add_product = Products::all();

        return view('pagess.profile', array('user' => Auth::user()))
                        ->with('stores', $stores)
                        ->with('user_lists', $user_lists)
                        ->with('store_names', $store_names)
                        ->with('list_details',$list_details)
                        ->with('categories', $categories)
                        ->with('locations', $locations)
                        ->with('location_names', $location_names)
                        ->with('store_names_for_add_product', $store_names_for_add_product)
                        ->with('products_for_add_product', $products_for_add_product)
                        ->with('stores_for_header_page', $stores_for_header_page);
    }
    
    //Update Profile Picture
    public function update_avatar(Request $request)
    {
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300,300)->save( public_path('/uploads/images/' . $filename));

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }else{

        }

        return redirect()->back();
    }

    //VIEW PRODUCT AS GUEST
    public function view_product_guest($id)
    {   
        $current = Carbon::now();
        $categories = Category::all();
        $product = Products::find($id);
        $post_details = PostDetails::all();
        $store_names = Stores::select('store_name', 'id', 'location')->get();
        $locations = Stores::select('location', 'id')->get();
        $location_names = Stores::select('location')->distinct()->get();
        $stores_for_header_page = Stores::select('store_name', 'id', 'location')->get();    
        
        // $store_names_for_add_product = Stores::select('store_name')->distinct()->get();
        $products_for_add_product = Products::all();

        $category = PostDetails::distinct()
            ->join('categories','categories.id', '=', 'post_details.category_id')
            ->select('category_name', 'categories.id','post_details.product_id','post_details.product_price')
            ->where('product_id', $id)
            ->get();

        $stores = DB::table('post_details')
            ->distinct()
            ->join('stores','stores.id','=','post_details.store_id')
            ->select('store_name', 'location', 'store_id', 'product_id')
            ->groupBy('store_name', 'store_id', 'product_id', 'location')
            ->where('product_id', $id)
            ->orderBy('post_details.id', 'DESC')
            ->get(); 

        $data = DB::table('post_details')->distinct()
            ->select([DB::raw('created_at as date'), DB::raw('product_price as price')])
            ->where('product_id', $id)
            ->get(); 
      
        return view('pagess.view_product',['categories' => $categories, 
                                            'category' => $category, 
                                            'post_details' => $post_details, 
                                            'stores' => $stores, 
                                            'product' => $product,
                                            'store_names' => $store_names,
                                            'locations' => $locations,
                                            'location_names' => $location_names,
                                            'products_for_add_product' => $products_for_add_product,
                                            'stores_for_header_page' => $stores_for_header_page
                                          ]);
    }
    //VIEW PRODUCT WHEN LOGGED IN
    public function view_product($id)
    {   
        $user_id = auth()->user()->id;
        $user_lists = UserLists::where('user_id', $user_id)->get();
        $current = Carbon::now();
        $categories = Category::all();
        $product = Products::find($id);
        $post_details = PostDetails::all();
        $store_names = Stores::select('store_name', 'id', 'location')->get();
        $locations = Stores::select('location', 'id')->get();
        $location_names = Stores::select('location')->distinct()->get();

        $store_names_for_add_product = Stores::select('store_name')->distinct()->get();
        $products_for_add_product = Products::all();

        $category = PostDetails::distinct()
            ->join('categories','categories.id', '=', 'post_details.category_id')
            ->select('category_name', 'categories.id','post_details.product_id','post_details.product_price')
            ->where('product_id', $id)
            ->get();

        $stores = PostDetails::select('store_id','store_name','product_id','location')
            ->join('stores', 'stores.id', '=', 'post_details.store_id')
            ->where('product_id', $id)
            ->orderBy('post_details.id', 'DESC')
            ->distinct()
            ->get(); 
        
        $data = DB::table('post_details')->distinct()
            ->select([DB::raw('created_at as date'), DB::raw('product_price as price')])
            ->where('product_id', $id)
            ->get(); 

        $stores_for_header_page = Stores::select('store_name', 'id', 'location')->get();


        return view('pagess.view_product',['store_names_for_add_product' => $store_names_for_add_product,
                                            'products_for_add_product' => $products_for_add_product,
                                            'categories' => $categories, 
                                            'category' => $category, 
                                            'post_details' => $post_details, 
                                            'stores' => $stores, 
                                            'product' => $product, 
                                            'user_lists' => $user_lists,
                                            'store_names' => $store_names,
                                            'locations' => $locations,
                                            'location_names' => $location_names,
                                            'stores_for_header_page' => $stores_for_header_page,
                                            'id', $id,
                                        ]);
    }
    //GRAPH
    public function graph($id, $store_id)
    {
        $data = DB::table('post_details')->distinct()
        ->select([DB::raw('created_at as date'), DB::raw('product_price as price')])
        ->where('product_id', $id)
        ->get(); 

        $chart = Charts::create('line', 'chartjs')
            ->title('Price Changes of ')
            ->responsive(false)
            ->width(300)
            ->height(300)
            ->labels($data->pluck('date'))
            ->values($data->pluck('price'))
            ->elementLabel("Price Changes")
            ->responsive(false); 
        return view('pagess.view_product')->with('chart', $chart)->render();
    }
    //SEARCH PRODUCT WHEN LOGGED IN
    public function search_product(Request $request)
    {   
        $this->validate($request, [
            'q' => 'required'
        ]);

        $query = $request['q'];
        $products_id = Products::select('id')->where('product_name', 'LIKE', "%{$query}%")->get();
        $post_details = PostDetails::all();
        $categories = Category::all();
        $current = Carbon::now();
        $stores = Stores::all();
        $store_names = Stores::select('store_name', 'id', 'location')->get();    
        $locations = Stores::select('location', 'id')->get();
        $location_names = Stores::select('location')->distinct()->get();
        $stores_for_header_page = Stores::select('store_name', 'id', 'location')->get();

        $store_names_for_add_product = Stores::select('store_name')->distinct()->get();
        $products_for_add_product = Products::all();

        if(count($products_id) == 0)
        {
            $result = count($products_id);
            $products = [];

            $related_products = Products::select('products.product_name', 'products.id', 'products.avatar', 'categories.category_name')
                    ->distinct()
                    ->join('post_details', 'post_details.product_id', '=', 'products.id')
                    ->join('categories', 'categories.id', '=', 'post_details.category_id')
                    ->orWhere('product_name', 'LIKE', "%{$query}%")
                    ->paginate(10);

            return view('pagess.search_product')
                    ->with('related_products', $related_products)
                    ->with('products', $products)
                    ->with('query', $query)
                    ->with('result', $result)
                    ->with('stores', $stores)
                    ->with('current', $current)
                    ->with('categories', $categories)
                    ->with('post_details', $post_details)
                    ->with('store_names', $store_names)
                    ->with('locations', $locations)
                    ->with('location_names', $location_names)
                    ->with('store_names_for_add_product', $store_names_for_add_product)
                    ->with('products_for_add_product', $products_for_add_product)
                    ->with('stores_for_header_page', $stores_for_header_page);
        }
        else 
        {
            $prod_id = $products_id[0]['id'];
            $category_id = PostDetails::select('category_id')->where('product_id', $prod_id)->get();
            $cat_id = $category_id[0]['category_id'];
            $products = Products::select('products.product_name', 'products.id', 'products.avatar', 'categories.category_name')
                                ->distinct()
                                ->join('post_details', 'post_details.product_id', '=', 'products.id')
                                ->join('categories', 'categories.id', '=', 'post_details.category_id')
                                // ->orWhere('categories.id', $cat_id)
                                ->Where('product_name', 'LIKE', "%{$query}%")
                                ->paginate(10);
            $related_products = Products::select('products.product_name', 'products.id', 'products.avatar', 'categories.category_name')
                                ->distinct()
                                ->join('post_details', 'post_details.product_id', '=', 'products.id')
                                ->join('categories', 'categories.id', '=', 'post_details.category_id')
                                ->orWhere('categories.id', $cat_id)
                                ->orWhere('product_name', 'LIKE', "%{$query}%")
                                ->paginate(10);

            $result = count($products);
        
            return view('pagess.search_product')
                    ->with('products', $products)
                    ->with('related_products', $related_products)
                    ->with('stores', $stores)
                    ->with('query', $query)
                    ->with('result', $result)
                    ->with('current', $current)
                    ->with('categories', $categories)
                    ->with('post_details', $post_details)
                    ->with('store_names', $store_names)
                    ->with('locations', $locations)
                    ->with('location_names', $location_names)
                    ->with('store_names_for_add_product', $store_names_for_add_product)
                    ->with('products_for_add_product', $products_for_add_product)
                    ->with('stores_for_header_page', $stores_for_header_page);
        }
    }
    //SEARCH PRODUCT AS GUEST
    public function search_product_guest(Request $request)
    {
        $this->validate($request, [
            'q' => 'required'
        ]);

        $query = $request['q'];
        $products_id = Products::select('id')->where('product_name', 'LIKE', "%{$query}%")->paginate(10);
        $post_details = PostDetails::all();
        $categories = Category::all();
        $current = Carbon::now();
        $stores = Stores::all();
        $store_names = Stores::select('store_name', 'id', 'location')->get();
        $locations = Stores::select('location', 'id')->get();
        $location_names = Stores::select('location')->distinct()->get();
        $stores_for_header_page = Stores::select('store_name', 'id', 'location')->get();

        $store_names_for_add_product = Stores::select('store_name')->distinct()->get();
        $products_for_add_product = Products::all();

        $all_products = PostDetails::join('products', 'products.id', '=', 'post_details.product_id')
        ->select('products.id','products.product_name','products.avatar')
        ->where('category_id',2)
        ->distinct()
        ->get();

        if(count($products_id) == 0)
        {
            $result = count($products_id);
            $products = [];

            $related_products = Products::select('products.product_name', 'products.id', 'products.avatar', 'categories.category_name')
                    ->distinct()
                    ->join('post_details', 'post_details.product_id', '=', 'products.id')
                    ->join('categories', 'categories.id', '=', 'post_details.category_id')
                    ->orWhere('product_name', 'LIKE', "%{$query}%")
                    ->paginate(10);

            return view('pagess.search_product')
                    ->with('related_products', $related_products)
                    ->with('products', $products)
                    ->with('query', $query)
                    ->with('result', $result)
                    ->with('stores', $stores)
                    ->with('current', $current)
                    ->with('categories', $categories)
                    ->with('post_details', $post_details)
                    ->with('store_names', $store_names)
                    ->with('locations', $locations)
                    ->with('all_products', $all_products)
                    ->with('location_names', $location_names)
                    ->with('store_names_for_add_product', $store_names_for_add_product)
                    ->with('products_for_add_product', $products_for_add_product)
                    ->with('stores_for_header_page', $stores_for_header_page);
        }
        else 
        {
            $prod_id = $products_id[0]['id'];
            $category_id = PostDetails::select('category_id')->where('product_id', $prod_id)->get();
            $cat_id = $category_id[0]['category_id'];
            $products = Products::select('products.product_name', 'products.id', 'products.avatar', 'categories.category_name')
                                ->join('post_details', 'post_details.product_id', '=', 'products.id')
                                ->join('categories', 'categories.id', '=', 'post_details.category_id')
                                ->orWhere('product_name', 'LIKE', "%{$query}%")
                                ->orWhere('category_name', 'LIKE', "%{$query}%")
                                ->distinct()
                                ->paginate(10);
            
            $related_products = Products::select('products.product_name', 'products.id', 'products.avatar', 'categories.category_name')
                                ->distinct()
                                ->join('post_details', 'post_details.product_id', '=', 'products.id')
                                ->join('categories', 'categories.id', '=', 'post_details.category_id')
                                ->orWhere('categories.id', $cat_id)
                                ->orWhere('product_name', 'LIKE', "%{$query}%")
                                ->paginate(10);
                                
            $result = count($products);
            
            return view('pagess.search_product')
                    ->with('products', $products)
                    ->with('related_products', $related_products)
                    ->with('stores', $stores)
                    ->with('query', $query)
                    ->with('result', $result)
                    ->with('current', $current)
                    ->with('categories', $categories)
                    ->with('post_details', $post_details)
                    ->with('store_names', $store_names)
                    ->with('locations', $locations)
                    ->with('all_products', $all_products)
                    ->with('location_names', $location_names)
                    ->with('store_names_for_add_product', $store_names_for_add_product)
                    ->with('products_for_add_product', $products_for_add_product)
                    ->with('stores_for_header_page', $stores_for_header_page);
        }
    }
    //VIEW LIST DETAILS WHEN LOGGED IN
    public function list_details($id) 
    {
        $current = Carbon::now();
        $to_end = Carbon::now()->addDays(2);
        $user_id = auth()->user()->id;
        $categories = Category::all();
        $user_list = UserLists::where('id', $id)->get();
        $store_names = Stores::select('store_name', 'id', 'location')->get();

        $list_details = DB::table('list_details')
        ->select('prediction','list_details.product_id', 'list_details.product_name', 'list_details.is_checked','list_details.user_list_id','list_details.id','list_details.product_price','list_details.subtotal','list_details.store_name','list_details.quantity')
        ->where('user_list_id', $id)
        ->orderBy('store_name', 'asc')
        ->orderBy('list_details.id', 'asc')
        ->get();

        $products = Products::all();
        $stores = Stores::all();
        $locations = Stores::select('location', 'id')->get();
        $location_names = Stores::select('location')->distinct()->get();
        $stores_for_header_page = Stores::select('store_name', 'id', 'location')->get();

        $store_names_for_add_product = Stores::select('store_name')->distinct()->get();
        $products_for_add_product = Products::all();

        return view('pagess.list_details')
                    ->with('current', $current)
                    ->with('user_list', $user_list)
                    ->with('list_details', $list_details)
                    ->with('id', $id)
                    ->with('categories', $categories)
                    ->with('stores', $stores)
                    ->with('store_names', $store_names)
                    ->with('stores', $stores)
                    ->with('products', $products)
                    ->with('locations', $locations)
                    ->with('location_names', $location_names)
                    ->with('store_names_for_add_product', $store_names_for_add_product)
                    ->with('products_for_add_product', $products_for_add_product)
                    ->with('stores_for_header_page', $stores_for_header_page);
    }
    //VIEW LIST
    public function view_list($id)
    {
        $shared_lists = UserLists::where('id', $id)->get();
        $categories = Category::all();
        $store_names = Stores::select('store_name', 'id', 'location')->get();
        $list_details = ListDetails::select('user_list_id','id','store_name','product_name','quantity','product_price','subtotal')
        ->where('user_list_id', $id)
        ->orderBy('store_name', 'asc')
        ->get();
        
        $user_lists = UserLists::all();
        $current = Carbon::now();
        $product = Products::find($id);
        $post_details = PostDetails::all();
        $location_names = Stores::select('location')->distinct()->get();
        $stores = DB::table('post_details')
            ->distinct()
            ->join('stores','stores.id','=','post_details.store_id')
            ->select('store_name', 'store_id', 'product_id')
            ->groupBy('store_name', 'store_id', 'product_id')
            ->where('product_id', $id)
            ->orderBy('store_id', 'DESC')
            ->get();
        $stores_for_header_page = Stores::select('store_name', 'id', 'location')->get();

        $store_names_for_add_product = Stores::select('store_name')->distinct()->get();
        $products_for_add_product = Products::all();

        $user_id_of_the_list = UserLists::select('user_id')->where('id', $id)->get();
        
        return view('pagess.view_list')
                    ->with('id', $id)
                    ->with('stores', $stores)
                    ->with('user_lists', $user_lists)
                    ->with('categories', $categories)
                    ->with('store_names', $store_names)
                    ->with('list_details', $list_details)
                    ->with('shared_lists', $shared_lists)
                    ->with('location_names', $location_names)
                    ->with('user_id_of_the_list', $user_id_of_the_list)
                    ->with('store_names_for_add_product', $store_names_for_add_product)
                    ->with('products_for_add_product', $products_for_add_product)
                    ->with('stores_for_header_page', $stores_for_header_page);
    }
    //VIEW PRODUCTS IN STORE AS GUEST
    public function products_in_store_guest($id)
    {
        $all_products = PostDetails::join('products', 'products.id', '=', 'post_details.product_id')->select('products.id')->where('store_id', $id)->distinct()->get();
        $result = count($all_products);

        $stores = Stores::all();
        $categories = Category::all();
        $store_names = Stores::select('store_name', 'id', 'location')->get();
        $s_name = Stores::select('stores.store_name')->where('id', $id)->get();
        $products = PostDetails::join('products', 'products.id', '=', 'post_details.product_id')
            ->select('products.product_name', 'products.avatar', 'products.id')                        
            ->where('post_details.store_id', $id)
            ->distinct()
            ->paginate(20);
        
        $locations = Stores::select('location', 'id')->get();
        $location_names = Stores::select('location')->distinct()->get();
        $stores_for_header_page = Stores::select('store_name', 'id', 'location')->get();

        $store_names_for_add_product = Stores::select('store_name')->distinct()->get();
        $products_for_add_product = Products::all();

        $selected_store = Stores::select('store_name')->where('id', '=', $id)->get();

        return view('pagess.products_in_store',[
                    'selected_store' => $selected_store,
                    'categories' => $categories,
                    'products' => $products,
                    'result' => $result,
                    'stores' => $stores,
                    's_name' => $s_name,
                    'store_names' => $store_names,
                    'locations' => $locations,
                    'location_names' => $location_names,
                    'store_names_for_add_product' => $store_names_for_add_product,
                    'products_for_add_product' => $products_for_add_product,
                    'stores_for_header_page' => $stores_for_header_page
                ]);
    }

    public function products_by_category($id)
    {
        $all_products = PostDetails::join('products', 'products.id', '=', 'post_details.product_id')->select('products.id')->where('category_id', $id)->distinct()->get();
        $result = count($all_products);

        $stores = Stores::all();
        $s_name = Stores::select('stores.store_name')->where('id', $id)->get();
        $store_names = Stores::select('store_name', 'id', 'location')->get();
        $categories = Category::all();
        $products = PostDetails::join('products', 'products.id', '=', 'post_details.product_id')
            ->select('products.product_name', 'products.avatar', 'products.id', 'category_id')                        
            ->where('category_id', $id)
            ->distinct()
            ->paginate(10);
        $locations = Stores::select('location', 'id')->get();
        $location_names = Stores::select('location')->distinct()->get();
        $stores_for_header_page = Stores::select('store_name', 'id', 'location')->get();
        
        $store_names_for_add_product = Stores::select('store_name')->distinct()->get();
        $products_for_add_product = Products::all();

        return view('pagess.products_by_category',[
            'categories' => $categories,
            'products' => $products,
            'result' => $result,
            'stores' => $stores,
            's_name' => $s_name,
            'store_names' => $store_names,
            'locations' => $locations,
            'location_names' => $location_names,
            'store_names_for_add_product' => $store_names_for_add_product,
            'products_for_add_product' => $products_for_add_product,
            'stores_for_header_page' => $stores_for_header_page
        ]);
    }

}
