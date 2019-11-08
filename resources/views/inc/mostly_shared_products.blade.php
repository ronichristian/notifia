
<div class="deals_featured">
    <div class="container">
        <div class="row">
            <div class="col d-flex flex-lg-row flex-column align-items-center justify-content-start">
                
                <!-- Deals -->

                <div class="deals">
                    <div class="deals_title">Top Trend Product</div>
                    <div class="deals_slider_container">
                        <!-- Deals Slider -->
                        <div class="owl-carousel owl-theme deals_slider">
                            <!-- Deals Item -->
                            @foreach($mosts as $most)
                            <div style="background-color: #FFFCF7;" class="owl-item deals_item">
                                <div class="deals_image">
                                    @guest
                                        <a href="/view_product_guest/{{$most->id}}/info">
                                            {{-- <img src="/avatar/{{$most->product_id }}" alt=""> --}}
                                            <img src="{{$most->getPicture($most->id)}}" alt="">
                                        </a>
                                    @else
                                        <a href="/view_product/{{$most->id}}/info">
                                            <img src="{{$most->getPicture($most->id)}}" alt="">
                                            {{-- <img src="/avatar/{{$most->id}}" alt=""> --}}
                                        </a>
                                    @endguest
                                </div>
                                <div class="deals_content">
                                    <div class="deals_info_line d-flex flex-row justify-content-start">
                                        <div class="deals_item_category">
                                            <a href="/products_by_category/{{$most->category_id}}/products_by_category">
                                                {{ucwords($most->category_name)}}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="deals_info_line d-flex flex-row justify-content-start">
                                        <div class="deals_item_name">
                                            @guest
                                                <a style="font-weight: 600; " href="/view_product_guest/{{$most->id}}/info">
                                                    {{ucwords($most->product_name)}}
                                                </a>
                                            @else
                                                <a style="font-weight: 600; " href="/view_product/{{$most->id}}/info">
                                                    {{ucwords($most->product_name)}}
                                                </a>
                                            @endguest
                                        </div>
                                        <div class="deals_item_price ml-auto">
                                            <div style="display: none;">
                                            {!!
                                                // number_format($maxprice = App\PostDetails::where('product_id', $most->product_id)->max('product_price'),2);
                                                $latestprice = App\PostDetails::select('product_price', 'store_id')
                                                            ->where('product_id', $most->id)
                                                            ->orderBy('created_at', 'desc')->limit(1)->get();    
                                            !!}
                                            </div>
                                            {{ number_format($latestprice[0]['product_price'],2) }}
                                        </div>
                                    </div>
                                    <div class="available">
                                        <div class="available_line d-flex flex-row justify-content-start">
                                            <div class="available_title">Available in
                                                <span>
                                                    @foreach($stores as $store)
                                                        @if($latestprice[0]['store_id'] == $store->id)
                                                            <span><a href="/products_in_store_guest/{{$store->id}}/products_in_store_guest" style="font-family: verdana; color: rgb(255,127,39);">
                                                                {{strtoupper($store->store_name) }}
                                                            </a></span>
                                                            <small style="margin-top: -60px; font-size:10px;">and other stores</small>
                                                        @else
                                                                
                                                        @endif
                                                    @endforeach
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="deals_slider_nav_container">
                        <div class="deals_slider_prev deals_slider_nav"><i class="fas fa-chevron-left ml-auto"></i></div>
                        <div class="deals_slider_next deals_slider_nav"><i class="fas fa-chevron-right ml-auto"></i></div>
                    </div>
                </div>
                
                <!-- Featured -->
                <div class="featured">
                    <div class="tabbed_container">
                        <div class="tabs">
                            <ul class="clearfix">
                                <li class="active">Mostly Shared Products</li>
                                {{-- <li>On Sale</li>
                                <li>Best Rated</li> --}}
                            </ul><hr>
                            {{-- <div class="tabs_line"><span></span></div> --}}
                        </div>
                        <!-- Product Panel -->
                        <div class="product_panel panel active">
                            <div class="featured_slider slider">
                                <!-- Slider Item -->
                                @if(count($products) > 0)
                                    @foreach($products as $product)
                                    {!!
                                        $latestprice = App\PostDetails::where('product_id', $product->id)
                                            ->orderBy('created_at', 'desc')->limit(1)->get();
                                        $minprice = App\PostDetails::where('product_id', $product->id)->min('product_price');       
                                        $maxprice = App\PostDetails::where('product_id', $product->id)->max('product_price'); 
                                        $count_shared_products = App\PostDetails::where('product_id', $product->id)->get();
                                        $index =    $loop->index;
                                    !!}
                                        @if(count($count_shared_products) >= 3)
                                            @if($index == 0)
                                                @foreach($commercial_products as $commercial_product)
                                                    <div class="featured_slider_item">
                                                        <div class="border_active"></div>
                                                            <div style="background-color: #F2E3BA;" class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                                                <div class="product_image d-flex flex-column align-items-center justify-content-center">
                                                                    <a href="/commercial_product/{{$commercial_product->id}}/commercial_product">
                                                                        <img src="/avatar/{{$commercial_product->id}}" alt="">
                                                                    </a>
                                                                </div>
                                                                <div style="margin-top: -26px; background-color: #F2E3BA;" class="product_content">
                                                                    <div class="product_price discount">
                                                                        
                                                                    </div>
                                                                    <div style="margin-top: -1px;" class="product_name">
                                                                        <div>
                                                                            <a style="color:#A33A47; font-size: 14px; font-weight: 500;" href="/commercial_product/{{$commercial_product->id}}/commercial_product">
                                                                                {{ucwords($commercial_product->product_name)}}
                                                                            </a><br>
                                                                            <small style="color:rgb(255,127,39); margin-top:-60px; font-size:15px; font-style:minion; font-wieght: 600;">
                                                                                Check Out this Item!
                                                                            </small> 
                                                                        </div>
                                                                    </div>
                                                                    <div style="background-color: #F2E3BA;" class="product_extras">
                                                                        <button style="background-color: #A33A47;" class="product_cart_button">
                                                                            <a style=" color:white;" href="/commercial_product/{{$commercial_product->id}}/commercial_product">Quick View</a>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <div style="text-algin:center; background:#A33A47;" class="arrivals_single_fav product_fav active">
                                                                    <i class="fa fa-hear"></i>
                                                                    <a href="/commercial_product/{{$commercial_product->id}}/commercial_product">
                                                                        <p style="margin-top: 8px; color:white; font-size: 12px;">view</p>
                                                                    </a>
                                                                </div>
                                                                <ul class="product_marks">
                                                            </ul>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif

                                            <div class="featured_slider_item">
                                                <div class="border_active"></div>
                                                <div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                                    <div class="product_image d-flex flex-column align-items-center justify-content-center">
                                                        @guest
                                                            <a href="/view_product_guest/{{$product->id}}/info">
                                                                {{-- <img src="/avatar/{{$product->id}}" alt=""> --}}
                                                                <img src="{{$product->getPicture($product->id)}}" alt="">
                                                            </a>
                                                        @else
                                                            <a href="/view_product/{{$product->id}}/info">
                                                                {{-- <img src="/avatar/{{$product->id}}" alt=""> --}}
                                                                <img src="{{$product->getPicture($product->id)}}" alt="">
                                                            </a>
                                                        @endguest
                                                    </div>
                                                    <div class="product_content">
                                                        <div class="product_price discount">
                                                            @if($minprice == $maxprice)
                                                                P{{number_format($minprice,2)}}
                                                            @else
                                                                P{{number_format($minprice,2)}} ~ P{{number_format($maxprice,2)}}
                                                            @endguest
                                                        </div>
                                                        <div style="margin-top: -2%;" class="product_name">
                                                            <div>
                                                                @guest
                                                                    <a style="font-weight: 600; " href="/view_product_guest/{{$product->id}}/info">
                                                                        {{ucwords($product->product_name)}}
                                                                    </a>
                                                                @else
                                                                    <a style="font-weight: 600; " href="/view_product/{{$product->id}}/info">
                                                                        {{ucwords($product->product_name)}}
                                                                    </a>
                                                                @endguest
                                                            </div>
                                                        </div>
                                                        <div class="product_extras">
                                                            @guest
                                                                <a href="/view_product_guest/{{$product->id}}/info">
                                                                    <button class="product_cart_button">Quick View</button>
                                                                </a>
                                                            @else
                                                                <a href="/view_product/{{$product->id}}/info">
                                                                    <button class="product_cart_button">Quick View</button>
                                                                </a>
                                                            @endguest
                                                        </div>
                                                    </div>
                                                    <div style="text-algin:center; background: rgb(255,127,39);" class="arrivals_single_fav product_fav active">
                                                        <i class="fa fa-hear"></i>
                                                        @guest
                                                        <a href="/view_product_guest/{{$product->id}}/info">
                                                            <p style="margin-top: 8px; color:white; font-size: 12px;">view</p>
                                                        </a>
                                                        @else
                                                        <a href="/view_product/{{$product->id}}/info">
                                                            <p style="margin-top: 8px; color:white; font-size: 12px;">view</p>
                                                        </a>
                                                        @endguest
                                                    </div>
                                                </div>
                                            </div>
                                        @else

                                        @endif
                                    @endforeach
                                @endif
                            </div>
                            <div class="featured_slider_dots_cover"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="popular_categories">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="popular_categories_content">
                    <div class="popular_categories_title">All Stores</div>
                    <div class="popular_categories_slider_nav">
                        <div class="popular_categories_prev popular_categories_nav"><i class="fas fa-angle-left ml-auto"></i></div>
                        <div class="popular_categories_next popular_categories_nav"><i class="fas fa-angle-right ml-auto"></i></div>
                    </div>
                </div>
            </div>
            
            <!-- Popular Categories Slider -->

            <div class="col-lg-9">
                <div class="popular_categories_slider_container">
                    <div class="owl-carousel owl-theme popular_categories_slider">
                        
                        @foreach($stores as $store)
                        <!-- Popular Categories Item -->
                        <div class="owl-item">
                            <div class="popular_category d-flex flex-column align-items-center justify-content-center">
                                <div class="popular_category_image">
                                    <a href="/products_in_store_guest/{{$store->id}}/products_in_store_guest">
                                        <center><img style="margin-top: 5%;" src="/css/wsis/images/grocery-store4.png" alt=""></center>
                                    </a>
                                </div>
                                <div class="popular_category_text">
                                    <div style="display:none;">
                                        {!!
                                            $products = App\PostDetails::join('products', 'products.id', '=', 'post_details.product_id')
                                                ->select('post_details.store_id','products.id')                        
                                                ->where('store_id', $store->id)
                                                ->distinct()
                                                ->get();
                                            $count_prods_in_store = count($products);
                                        !!}
                                    </div>
                                    <a href="/products_in_store_guest/{{$store->id}}/products_in_store_guest">
                                        {{ucwords($store->store_name)}}  {{$count_prods_in_store}} Products
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>