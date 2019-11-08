<div  class="new_arrivals">
    <div style="margin-top: -10%;" class="container">
        <div class="row">
            <div class="col">
                <div class="tabbed_container">
                    <div class="tabs clearfix tabs-right">
                        <div class="new_arrivals_title">Shared Products of the Week</div>
                        <ul class="clearfix">
                            <li class="active">Featured</li>
                        </ul>
                        <div class="tabs_line"><span></span></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-9" style="z-index:1;">
                            <!-- Product Panel -->
                            <div class="product_panel panel active">
                                <div class="arrivals_slider slider">
                                        @if(count($latest_prods) > 0)
                                            @foreach($latest_prods as $latest_prod)
                                            {!!
                                                $index =    $loop->index;
                                            !!}
                                            @if($index == 0)
                                                @foreach($commercial_products as $commercial_product)
                                                    <div class="arrivals_slider_item commercial_product">
                                                        <div class="border_active"></div>
                                                        <div style="background-color: #F2E3BA; border-radius: 5px;" class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                                                            <div class="product_image d-flex flex-column align-items-center justify-content-center">
                                                                <a href="/commercial_product/{{$commercial_product->id}}/commercial_product">
                                                                    {{-- <img style="" src="data:{{$commercial_product->avatar}};base64,{{$commercial_product->avatar}}" alt=""> --}}
                                                                </a>
                                                            </div>
                                                            <div style="overflow:hidden; background-color: #F2E3BA; " class="product_content">
                                                                <div class="product_price">

                                                                </div>
                                                                <div style="margin-top: -2.5%;" class="product_name">
                                                                    <div style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                                        <a style="color: #A33A47; font-weight: 600;  text-overflow: ellipsis; white-space: nowrap;" href="/commercial_product/{{$commercial_product->id}}/commercial_product">
                                                                            {{ucwords($commercial_product->product_name)}}
                                                                        </a><br>
                                                                        <small style="color:rgb(255,127,39); margin-top:-60px; font-weight: 600;">
                                                                            Check Out this Item!
                                                                        </small> 
                                                                    </div>
                                                                </div>
                                                                <div style="background-color: #F2E3BA;" class="product_extras">
                                                                    <a style="color:white;" href="/commercial_product/{{$commercial_product->id}}/commercial_product">
                                                                        <button style="background-color: #A33A47;" class="product_cart_button">
                                                                                Quick View
                                                                        </button>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div style="background: #A33A47;" class="product_fav">
                                                                <i class="fa fa-hear"></i>
                                                                <a href="/commercial_product/{{$commercial_product->id}}/commercial_product">
                                                                    <p style="margin-top: 8px; color:white; font-size: 12px;">view</p>
                                                                </a>
                                                            </div>
                                                            <ul class="product_marks">
                                                                <li style="background-color: #F4DB78; color:#A33A47;" class="product_mark product_new">Check!</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                            
                                            <div class="arrivals_slider_item">
                                                <div class="border_active"></div>
                                                <div style=" " class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                                                    <div class="product_image d-flex flex-column align-items-center justify-content-center">
                                                        @guest
                                                            <a href="/view_product_guest/{{$latest_prod->id}}/info">
                                                                {{-- <img src="data:{{$latest_prod->avatar}};base64,{{$latest_prod->avatar}}" alt=""> --}}
                                                                <img src="{{$latest_prod->getPicture($latest_prod->id)}}" alt="">
                                                            </a>
                                                        @else
                                                            <a href="/view_product/{{$latest_prod->id}}/info">
                                                                {{-- <img src="/avatar/{{$latest_prod->id}}" alt=""> --}}
                                                                <img src="{{$latest_prod->getPicture($latest_prod->id)}}" alt="">
                                                            </a>
                                                        @endguest
                                                    </div>
                                                    <div style="overflow:hidden;" class="product_content">
                                                        <div class="product_price">
                                                            <div style="display:none;">
                                                                {!!
                                                                    $latestprice = App\PostDetails::where('product_id', $latest_prod->id)
                                                                        ->orderBy('created_at', 'desc')->limit(1)->get();
                                                                    $minprice = App\PostDetails::where('product_id', $latest_prod->id)->min('product_price');       
                                                                    $maxprice = App\PostDetails::where('product_id', $latest_prod->id)->max('product_price');
                                                                !!}
                                                            </div>
                                                            @guest
                                                                <a style="color:red; margin-top: -1%;" href="/view_product_guest/{{$latest_prod->id}}/info">
                                                                    @if($minprice == $maxprice)
                                                                        P{{number_format($minprice,2)}} 
                                                                    @else
                                                                        P{{number_format($minprice,2)}} ~ P{{number_format($maxprice,2)}}
                                                                    @endif
                                                                </a>
                                                            @else
                                                                <a style="color:red; margin-top: -1%;" href="/view_product/{{$latest_prod->id}}/info">
                                                                    @if($minprice == $maxprice)
                                                                        P{{number_format($minprice,2)}} 
                                                                    @else
                                                                        P{{number_format($minprice,2)}} ~ P{{number_format($maxprice,2)}}
                                                                    @endif
                                                                </a>
                                                            @endguest
                                                        </div>
                                                        <div style="margin-top: -2.5%;" class="product_name">
                                                            <div style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                                @guest
                                                                    <a style="font-weight: 600; font-size: 14px;" href="/view_product_guest/{{$latest_prod->id}}/info">{{ucwords($latest_prod->product_name)}}</a><br>
                                                                @else
                                                                    <a style="font-weight: 600; font-size: 14px;" href="/view_product/{{$latest_prod->id}}/info">{{ucwords($latest_prod->product_name)}}</a><br>
                                                                @endguest
                                                            </div>
                                                        </div>
                                                        <div style="background-color: #FFFCF7;" class="product_extras">
                                                            @guest
                                                                <a style="color:white;" href="/view_product_guest/{{$latest_prod->id}}/info"> 
                                                                    <button class="product_cart_button">
                                                                        Quick View
                                                                    </button>
                                                                </a>
                                                            @else
                                                                <a style="color:white;" href="/view_product/{{$latest_prod->id}}/info">
                                                                    <button class="product_cart_button">
                                                                        Quick View
                                                                    </button>
                                                                </a>
                                                            @endguest
                                                        </div>
                                                    </div>
                                                    <div style="background: rgb(255,127,39);" class="product_fav">
                                                        <i class="fa fa-hear"></i>
                                                        @guest
                                                            <a href="/view_product_guest/{{$latest_prod->id}}/info">
                                                                <p style="margin-top: 8px; color:white; font-size: 12px;">view</p>
                                                            </a>
                                                        @else
                                                            <a href="/view_product/{{$latest_prod->id}}/info">
                                                                <p style="margin-top: 8px; color:white; font-size: 12px;">view</p>
                                                            </a>
                                                        @endguest
                                                    </div>
                                                    <ul class="product_marks">
                                                        <li class="product_mark product_new">new</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            @endforeach
                                        @endif
                                    </div>
                                <div class="arrivals_slider_dots_cover"></div>
                            </div>
                        </div>

                        @if(count($latest_product) != 0)
                            <div class="col-lg-3">
                                <div class="arrivals_single clearfix">
                                    <div class="d-flex flex-column align-items-center justify-content-center">
                                        <div class="arrivals_single_image">
                                            @guest
                                                <a style="color:white;" href="/view_product_guest/{{ $latest_product[0]['id'] }}/info">
                                                    {{-- <img style="height: 200px" src="/avatar/{{ $latest_prod->id }}" alt=""> --}}
                                                    <img style="height: 200px" src="{{$latest_prod->getPicture($latest_product[0]['id'])}}" alt="">
                                                </a>
                                            @else
                                                <a style="color:white;" href="/view_product/{{ $latest_product[0]['id'] }}/info">
                                                    {{-- <img style="height: 200px" src="/avatar/{{ $latest_prod->id }}" alt=""> --}}
                                                    <img style="height: 200px" src="{{$latest_prod->getPicture($latest_product[0]['id'])}}" alt="">
                                                </a>
                                            @endguest
                                        </div>
                                        <div class="arrivals_single_content">
                                            <div class="arrivals_single_name_container clearfix">
                                                <div class="arrivals_single_name"><a href="#">{{ ucwords( $latest_product[0]['product_name'] ) }}</a></div><br>
                                                <div style="display: none;">
                                                    {!!
                                                        $latestprice = App\PostDetails::where('product_id', $latest_product[0]['id'] )
                                                                        ->orderBy('created_at', 'desc')->limit(1)->get();
                                                        $cat_name = App\Category::select('category_name')
                                                                        ->where('id', $latest_product[0]['id'] )
                                                                        ->get();
                                                    !!}
                                                </div>
                                                <div style="color:red;" class="arrivals_single_price ">P{{number_format($latestprice[0]['product_price'],2)}}</div>
                                            </div>
                                            @guest
                                                <a style="color:white;" href="/view_product_guest/{{ $latest_product[0]['id'] }}/info">
                                                    <button class="arrivals_single_button">Quick View</button>
                                                </a>
                                            @else 
                                                <a style="color:white;" href="/view_product/{{ $latest_product[0]['id'] }}/info">
                                                    <button class="arrivals_single_button">Quick View</button>
                                                </a>
                                            @endguest
                                        </div>
                                        <div style="text-algin:center; background: rgb(255,127,39);" class="arrivals_single_fav product_fav active">
                                            @guest
                                                <a href="/view_product_guest/{{ $latest_product[0]['id'] }}/info">
                                                    <p style="margin-top: 8px; margin-left: 5px; color:white; font-size: 12px;">view</p>
                                                </a>
                                            @else
                                                <a href="/view_product/{{ $latest_product[0]['id'] }}/info">
                                                    <p style="margin-top: 8px; margin-left: 5px; color:white; font-size: 12px;">view</p>
                                                </a>
                                            @endguest
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                        
                        @endif
                    </div>   
                </div>
            </div>
        </div>
    </div>
</div>


