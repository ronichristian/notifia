<div style="margin-top: -7%;" class="best_sellers">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="tabbed_container">
                    <div class="tabs clearfix tabs-right">
                        <div class="new_arrivals_title">Just For You</div>
                        <ul class="clearfix">
                            <li class="active"></li>
                        </ul>
                        <div class="tabs_line"><span></span></div>
                    </div>

                    <div class="bestsellers_panel panel active">
                        <!-- Best Sellers Slider -->
                        <div class="bestsellers_slider slider">

                            <!-- Best Sellers Item -->
                            @guest
                                @foreach($products as $product)
                                {{!!
                                    $latestprice = App\PostDetails::where('product_id', $product->id)->orderBy('created_at', 'desc')->limit(1)->get();
                                    $minprice = App\PostDetails::where('product_id', $product->id)->min('product_price');       
                                    $maxprice = App\PostDetails::where('product_id', $product->id)->max('product_price');    
                                !!}}
                                <div class="bestsellers_item">
                                    <div class="bestsellers_item_container d-flex flex-row align-items-center justify-content-start">
                                        <div class="bestsellers_image">
                                            @guest
                                            <a href="view_product_guest/{{$product->id}}/info">
                                                {{-- <img src="/avatar/{{$product->id }}" alt=""> --}}
                                                <img src="{{$product->getPicture($product->id)}}" alt="">
                                            </a>
                                            @else
                                            <a href="view_product/{{$product->id}}/info">
                                                {{-- <img src="/avatar/{{$product->id }}" alt=""> --}}
                                                <img src="{{$product->getPicture($product->id)}}" alt="">
                                            </a>
                                            @endguest
                                        </div>
                                        <div class="bestsellers_content">
                                            <div class="bestsellers_category"><a href="#"></a></div>
                                            <div class="bestsellers_name">
                                                @guest
                                                    <a href="view_product_guest/{{$product->id}}/info">{{ ucwords($product->product_name) }}</a>
                                                @else
                                                    <a href="view_product/{{$product->id}}/info">{{ ucwords($product->product_name) }}</a>
                                                @endguest
                                            </div>
                                            <div style="margin-top: -2%; color:red;" class="bestsellers_price discount">
                                                @if($minprice >= $maxprice)
                                                    @guest
                                                        <a style="color:red;" href="view_product_guest/{{$product->id}}/info"> 
                                                            P{{number_format($latestprice[0]['product_price'],2)}}
                                                        </a>
                                                    @else
                                                        <a style="color:red;" href="view_product/{{$product->id}}/info"> 
                                                            P{{number_format($latestprice[0]['product_price'],2)}}
                                                        </a>
                                                    @endguest
                                                @else
                                                    @if($latestprice[0]['product_price'] >= $maxprice)
                                                        @guest
                                                            <a style="color:red;" href="view_product_guest/{{$product->id}}/info"> 
                                                                P{{number_format($latestprice[0]['product_price'],2)}}
                                                            </a>
                                                        @else
                                                            <a style="color:red;" href="view_product/{{$product->id}}/info"> 
                                                                P{{number_format($latestprice[0]['product_price'],2)}}
                                                            </a>
                                                        @endguest
                                                    @else
                                                        @guest
                                                            <a style="color:red;" href="view_product_guest/{{$product->id}}/info"> 
                                                                P{{number_format($latestprice[0]['product_price'],2)}}
                                                            </a>
                                                        @else
                                                            <a style="color:red;" href="view_product/{{$product->id}}/info"> 
                                                                P{{number_format($latestprice[0]['product_price'],2)}}
                                                            </a>
                                                        @endguest
                                                        <span><del>
                                                            P{{number_format($maxprice,2)}}
                                                        </del></span>
                                                    @endif
                                                @endif
                                            </div>
                                            Available in!!
                                            @foreach($stores as $store)
                                                @if($latestprice[0]['store_id'] == $store->id)
                                                <span>
                                                    <a href="/products_in_store_guest/{{$store->id}}/products_in_store_guest" style="font-family: verdana; color: rgb(255,127,39);">
                                                        {{strtoupper($store->store_name) }}
                                                        <br>
                                                        <small style="font-size:10px;">and other stores</small>
                                                    </a>
                                                    
                                                </span>
                                                    
                                                @else
                                                        
                                                @endif
                                            @endforeach
                                            
                                        </div>
                                    </div>
                                    <div class="bestsellers_fav active"><i class="fa fa-hear"></i></div>
                                    <ul class="bestsellers_marks">
                                    </ul>
                                </div>
                                @endforeach
                            <!-- WHEN LOGGED IN -->
                            @else
                            {{!!                    
                                $user_id = auth()->user()->id;
                                $linked_products = App\ListDetails::join('user_lists', 'user_lists.id', '=', 'list_details.user_list_id')
                                        ->join('products','products.id','=','list_details.product_id')
                                        ->join('post_details', 'post_details.product_id', '=', 'products.id')
                                        ->select('list_details.product_name', 'products.avatar', 'products.id', 'category_id')
                                        ->where('user_lists.user_id', $user_id)
                                        ->distinct()
                                        ->get();
                            !!}}
                            @if(count($linked_products) > 0 )
                                @foreach($linked_products as $linked_product)
                                    {{!!
                                        $latestprice    = App\PostDetails::where('product_id', $linked_product->id)->orderBy('created_at', 'desc')->limit(1)->get();
                                        $minprice       = App\PostDetails::where('product_id', $linked_product->id)->min('product_price');       
                                        $maxprice       = App\PostDetails::where('product_id', $linked_product->id)->max('product_price');    
                                    !!}}
                                    <div style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" class="bestsellers_item">
                                        <div class="bestsellers_item_container d-flex flex-row align-items-center justify-content-start">
                                            <div class="bestsellers_image">
                                                @guest
                                                    <a href="/view_product_guest/{{$linked_product->id}}/info">
                                                        <img src="{{$linked_product->getPicture($linked_product->id)}}" alt="">
                                                    </a>
                                                @else
                                                    <a href="/view_product/{{$linked_product->id}}/info">
                                                        <img src="{{$linked_product->getPicture($linked_product->id)}}" alt="">
                                                    </a>
                                                @endguest
                                            </div>
                                            <div class="bestsellers_content">
                                                <div class="bestsellers_category"><a href="#"></a></div>
                                                <div class="bestsellers_name">
                                                    @guest
                                                        <a style="" href="view_product_guest/{{$linked_product->id}}/info">{{ ucwords($linked_product->product_name) }}</a>
                                                    @else
                                                        <a style="" href="view_product/{{$linked_product->id}}/info">{{ ucwords($linked_product->product_name) }}</a>
                                                    @endguest
                                                </div>
                                                <div style="margin-top: -2%; color:red;" class="bestsellers_price discount">
                                                    @if($minprice >= $maxprice)
                                                        @guest
                                                            <a style="color:red; margin-top: -1%;" href="/view_product_guest/{{$linked_product->id}}/info">
                                                                P{{number_format($latestprice[0]['product_price'],2)}}
                                                            </a>
                                                        @else
                                                            <a style="color:red; margin-top: -1%;" href="/view_product/{{$linked_product->id}}/info">
                                                                P{{number_format($latestprice[0]['product_price'],2)}}
                                                            </a>
                                                        @endguest
                                                    @else
                                                        @if($latestprice[0]['product_price'] >= $maxprice)
                                                            @guest
                                                                <a style="color:red; margin-top: -1%;" href="/view_product_guest/{{$linked_product->id}}/info">    
                                                                    P{{number_format($latestprice[0]['product_price'],2)}}
                                                                </a>
                                                            @else
                                                                <a style="color:red; margin-top: -1%;" href="/view_product/{{$linked_product->id}}/info">    
                                                                    P{{number_format($latestprice[0]['product_price'],2)}}
                                                                </a>
                                                            @endif
                                                        @else
                                                            @guest
                                                                <a style="color:red; margin-top: -1%;" href="/view_product_guest/{{$linked_product->id}}/info">
                                                                    P{{number_format($latestprice[0]['product_price'],2)}}
                                                                </a>
                                                            @else
                                                                <a style="color:red; margin-top: -1%;" href="/view_product/{{$linked_product->id}}/info">
                                                                    P{{number_format($latestprice[0]['product_price'],2)}}
                                                                </a>
                                                            @endguest
                                                            <span><del>
                                                                P{{number_format($maxprice,2)}}
                                                            </del></span>
                                                        @endif
                                                    @endif
                                                </div>
                                                Available in!!
                                                @foreach($stores as $store)
                                                    @if($latestprice[0]['store_id'] == $store->id)
                                                    <span>
                                                        <h6 style="font-family: verdana; color: rgb(255,127,39);">
                                                            {{strtoupper($store->store_name) }}<br>
                                                            <small style="font-size:10px;">and other stores</small>
                                                        </h6>
                                                    </span>
                                                    @else
                                                            
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="bestsellers_fav active"><i class="fa fa-hear"></i></div>
                                        <ul class="bestsellers_marks">
                                        </ul>
                                    </div>
                                @endforeach
                            @else 
                                @foreach($products as $product)
                                {{!!
                                    $latestprice = App\PostDetails::where('product_id', $product->id)
                                                            ->orderBy('created_at', 'desc')->limit(1)->get();
                                    $minprice = App\PostDetails::where('product_id', $product->id)->min('product_price');       
                                    $maxprice = App\PostDetails::where('product_id', $product->id)->max('product_price');    
                                !!}}
                                <div style="width:20px;" class="bestsellers_item">
                                    <div class="bestsellers_item_container d-flex flex-row align-items-center justify-content-start">
                                        <div class="bestsellers_image">
                                            @guest
                                            <a href="view_product_guest/{{$product->id}}/info">
                                                {{-- <img src="/avatar/{{$product->id }}" alt=""> --}}
                                                <img src="{{$product->getPicture($product->id)}}" alt="">
                                            </a>
                                            @else
                                            <a href="view_product/{{$product->id}}/info">
                                                {{-- <img src="/avatar/{{$product->id }}" alt=""> --}}
                                                <img src="{{$product->getPicture($product->id)}}" alt="">
                                            </a>
                                            @endguest
                                        </div>
                                        <div class="bestsellers_content">
                                            <div class="bestsellers_category"><a href="#"></a></div>
                                            <div class="bestsellers_name">
                                                @guest
                                                <a href="view_product_guest/{{$product->id}}/info">{{ ucwords($product->product_name) }}</a>
                                                @else
                                                <a href="view_product/{{$product->id}}/info">{{ ucwords($product->product_name) }}</a>
                                                @endguest
                                            </div>
                                            <div style="margin-top: -2%; color:red;" class="bestsellers_price discount">
                                                @if($minprice >= $maxprice)
                                                    @guest
                                                        <a style="color:red;" href="view_product_guest/{{$product->id}}/info">
                                                            P{{number_format($latestprice[0]['product_price'],2)}}
                                                        </a>
                                                    @else
                                                        <a style="color:red;" href="view_product/{{$product->id}}/info">
                                                            P{{number_format($latestprice[0]['product_price'],2)}}
                                                        </a>
                                                    @endguest
                                                @else
                                                    @if($latestprice[0]['product_price'] >= $maxprice) 
                                                        @guest
                                                            <a style="color:red;" href="view_product_guest/{{$product->id}}/info">
                                                                P{{number_format($latestprice[0]['product_price'],2)}}
                                                            </a>
                                                        @else
                                                            <a style="color:red;" href="view_product/{{$product->id}}/info">
                                                                P{{number_format($latestprice[0]['product_price'],2)}}
                                                            </a>
                                                        @endguest
                                                    @else
                                                        @guest
                                                            <a style="color:red;" href="view_product_guest/{{$product->id}}/info">
                                                                P{{number_format($latestprice[0]['product_price'],2)}}
                                                            </a>
                                                        @else
                                                            <a style="color:red;" href="view_product/{{$product->id}}/info">
                                                                P{{number_format($latestprice[0]['product_price'],2)}}
                                                            </a>
                                                        @endguest
                                                        <span><del>
                                                            P{{number_format($maxprice,2)}}
                                                        </del></span>
                                                    @endif
                                                @endif
                                            </div>
                                            Available in!!
                                            @foreach($stores as $store)
                                                @if($latestprice[0]['store_id'] == $store->id)
                                                <span>
                                                    <h6 style="font-family: verdana; color: rgb(255,127,39);">
                                                        {{strtoupper($store->store_name) }}<br>
                                                        <small style="font-size:10px;">and other stores</small>
                                                    </h6>
                                                </span>
                                                @else
                                                        
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="bestsellers_fav active"><i class="fa fa-hear"></i></div>
                                </div>
                                @endforeach
                            @endif
                            
                            @endguest
                        </div>
                    </div>
                </div>
                    
            </div>
        </div>
    </div>
</div>
