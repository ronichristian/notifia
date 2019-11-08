<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'PagesController@index');

Route::get('/profile', 'PagesController@profile');
Route::get('/register', function(){
    return view('auth.register');
});
Route::get('/login', function(){
    return view('auth.login');
});

Auth::routes();

//PAGES
Route::get('/home', 'PagesController@index')->name('home');
Route::get('/profile', 'PagesController@profile');
Route::get('/list_details/{id}/view', 'PagesController@list_details');
Route::get('/view_list/{id}/view', 'PagesController@view_list');
Route::get('/create_list', 'PagesController@create_list');
Route::post('/search_product', 'PagesController@search_product');
Route::post('/search_product_guest', 'PagesController@search_product_guest');
Route::get('/products_by_category/{id}/products_by_category', 'PagesController@products_by_category');
Route::get('/products_in_store_guest/{id}/products_in_store_guest', 'PagesController@products_in_store_guest');
Route::post('/graph/load/{id}/{store_id}', 'PagesController@graph');
Route::get('/view_product/{id}/info', 'PagesController@view_product');
Route::get('/view_product_guest/{id}/info', 'PagesController@view_product_guest');

Route::post('/upload/photo', 'PagesController@update_avatar');
Route::post('/create_list/list', 'ListController@create_list');

//AJAX
Route::get('/list_table/load_list_table/{id}', 'AjaxController@list_table');
Route::get('/products_table/load_products_table', 'AjaxController@products_table');
Route::get('/latest_prods/load_latest_prods', 'AjaxController@latest_prods');
Route::get('/most_shared_products/load_most_shared_prods', 'AjaxController@most_shared_products');
Route::get('/for_you/load_for_you', 'AjaxController@for_you');
Route::get('/user_lists/lists', 'ListController@user_lists');
Route::get('/carousel_user_lists/load_lists', 'AjaxController@carousel_user_lists');
Route::get('/all_products/load_all_products', 'AjaxController@all_products');
Route::get('/ajax/products', function(){
    $products = Product::paginate(4);
    return view::make('products')->with('products', $products); 
});
Route::get('/products/category/{id}', 'AjaxController@products_by_category');
Route::get('/get_sum_of_subtotal', 'AjaxFetchController@get_sum_of_subtotal');
Route::get('/get_sum_of_unchecked', 'AjaxFetchController@get_sum_of_unchecked');



// Route::post('/shareproduct/share', 'ProductController@share_product');
Route::post('/addproduct', 'ProductController@addproduct');

Route::post('/product_name/fetch', 'AjaxFetchController@fetch_product_name');
Route::post('/store_name/fetch', 'AjaxFetchController@fetch_store_name');
Route::post('/search_product/name', 'AjaxFetchController@search_product');
Route::post('/search_product_store/product_and_store', 'AjaxFetchController@search_product_store');

Route::post('/store_name/fetch_store', 'AjaxFetchController@fetch_store_by_prod_name');
Route::post('/product_price/fetch_prod_price', 'AjaxFetchController@fetch_prod_price_by_store_name');

Route::get('/get_details', 'ListController@get_details');
Route::post('/add_to_list', 'ListController@add_to_list');
Route::post('/add_product_to_list', 'ListController@add_product_to_list');

Route::post('/delete_item', 'ListController@delete_item');
Route::post('/delete_list', 'ListController@delete_list');
Route::post('/show_item', 'ListController@show_item');
Route::post('/show_list_name', 'ListController@show_list_name');
Route::post('/update_item/{id}', 'ListController@update_item_in_list');
Route::post('/update_list_name/{id}', 'ListController@update_list_name');

Route::post('/check_product', 'ListController@check_product');
Route::post('/uncheck_product', 'ListController@uncheck_product');

Route::get('/graph_data/graph/{id}/{store_id}', 'AjaxController@graph');

Route::get('/submit_ads_form', 'CommercialProductController@submit_ads_form');

Route::get('/commercial_product/{id}/commercial_product', 'CommercialProductController@commercial_product');

Route::post('/add_commercial_product', 'CommercialProductController@add_commercial_product');

Route::post('/get_post_detail', 'ProductController@get_post_detail');
Route::post('/add_post_details', 'ProductController@add_post_details');

Route::post('/get_list_details', 'ListController@get_list_details');
Route::post('/save_list', 'ListController@save_list');
Route::post('/share_list', 'ListController@share_list');
Route::post('/unshare_list', 'ListController@unshare_list');

Route::post('/by_location', 'PagesController@by_location');

Route::get('/avatar/{id}', 'ProductController@getPicture');


Route::get('/get_products', 'ProductController@getProducts');