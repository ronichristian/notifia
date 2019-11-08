@extends('layouts.appss')

@section('content')
<!-- Header -->
@include('modals.login-modal')
@include('modals.add-prod-modal')
<!-- Banner -->
{{-- <a href="/submit_ads_form">Ads Form</a> --}}
<div  class="banner_2">
    <div class="banner_2_background" ></div>
    <div class="banner_2_container">
        {{-- <div class="menu_side">asdasdas</div> --}}
        <div class="banner_2_dots"></div>
        <!-- Banner 2 Slider -->

        <div class="owl-carousel owl-theme banner_2_slider">
            <!-- Banner 2 Slider Item -->
            <div class="banner">
                <div class="banner_background" ></div>
                <div class="container fill_height">
                    <div class="row fill_height">
                        <div class="banner_product_image">
                            {{-- <img src="/css/wsis/images/banner_product.png" alt=""> --}}
                        </div>
                        <div class="col-lg-5 offset-lg-4 fill_height">
                            <div class="banner_content">
                                @guest
                    
                                @else
                                    <div style="margin-top: -3px;" class="button banner_button"><a href="#" data-toggle="modal" data-target="#addproductmodal">Share Product Now</a></div>
                                @endguest
                                <h1 class="banner_text">new era of smartphones</h1>
                                <div class="banner_price"><span>$530</span>$460</div>
                                <div class="banner_product_name">Apple Iphone 6s</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Banner 2 Slider Item -->
            <div class="banner">
                <div class="banner_background" ></div>
                <div class="container fill_height">
                    <div class="row fill_height">
                        <div class="banner_product_image">
                            {{-- <img  src="/css/wsis/images/banner_product.png" alt=""> --}}
                        </div>
                        <div class="col-lg-5 offset-lg-4 fill_height">
                            @guest
                
                            @else
                            <div style="margin-top: -3px;" class="button banner_button"><a href="#" data-toggle="modal" data-target="#addproductmodal">Add Product Now</a></div>
                            @endguest 
                            <div class="banner_content">
                                <h1 class="banner_text">new era of smartphones</h1>
                                <div class="banner_price"><span>$530</span>$460</div>
                                <div class="banner_product_name">Apple Iphone 6s</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Banner 2 Slider Item -->
            <div class="banner">
                <div class="banner_background" ></div>
                <div class="container fill_height">
                    <div class="row fill_height">
                        <div class="banner_product_image">
                            {{-- <img src="/css/wsis/images/banner_product.png" alt=""> --}}
                        </div>
                        <div class="col-lg-5 offset-lg-4 fill_height">
                            @guest
                
                            @else
                            <div style="margin-top: -3px;" class="button banner_button"><a href="#" data-toggle="modal" data-target="#addproductmodal">Add Product Now</a></div>
                            @endguest
                            <div class="banner_content">
                                <h1 class="banner_text">new era of smartphones</h1>
                                <div class="banner_price"><span>$530</span>$460</div>
                                <div class="banner_product_name">Apple Iphone 6s</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Characteristics -->
<div style="margin-top: -4%;" class="new_arrivals">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="cart_section">
                    <div class="container">
                        <div class="row">

                            <div class="col-lg-12 ">
                                <div class="cart_container">
                                    <div class="panel panel-default">
                                    <div class="panel-heading">
                                            
                                    </div>

                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table style="" class="table table-striped table-bordered table-hover" id="example">
                                                    <thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Image</th>
                                                            @foreach($store_names as $store_name)
                                                                <th>
                                                                    <img style="height: 20px;" src="/css/wsis/images/grocery-store5.jpg" alt="">
                                                                    {{ ucwords($store_name->store_name) }}
                                                                </th>
                                                            @endforeach
                                                            <th><img style="height: 10px;" src="/css/wsis/images/peso1.png" alt="">Lowest Price</th>
                                                            <th><img style="height: 10px;" src="/css/wsis/images/peso1.png" alt="">Highest Price</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($products_compare as $product_compare)
                                                        <tr>
                                                            <td>
                                                                @guest
                                                                <a href="/view_product_guest/{{$product_compare->id}}/info">
                                                                    {{ ucwords($product_compare->product_name) }}
                                                                </a>
                                                                @else
                                                                <a href="/view_product/{{$product_compare->id}}/info">
                                                                    {{ ucwords($product_compare->product_name) }}
                                                                </a>
                                                                @endguest
                                                            </td>
                                                            <td align="center">
                                                                <img id="thumbnail" class="thumbnail" style="height: 20px;" id="tr_show_hover" src="storage/product_images/{{$product_compare->avatar}}" alt="{{$product_compare->avatar}}">
                                                                
                                                            </td>
                                                            @for($i=0; $i < count($store_names); $i++)
                                                                <div style="display:none;">
                                                                    {!!
                                                                        $store_id = App\PostDetails::select('store_id')
                                                                                    ->where('store_id', $store_names[$i]->id)
                                                                                    ->get();
                                                                        $price = App\PostDetails::select('product_price')
                                                                                    ->where('product_id', $product_compare->id)
                                                                                    ->where('store_id', $store_id[0]['store_id'])
                                                                                    ->orderBy('created_at', 'desc')
                                                                                    ->get();

                                                                        $second_last_price = App\PostDetails::select('product_price')->where('product_id', $product_compare->id)->orderBy('created_at', 'desc')->skip(1)->take(1)->get();
                                                                    !!}
                                                                </div>
                                                                
                                                                @if(count($price) == 0)
                                                                    <td></td>
                                                                @else
                                                                    
                                                                    @if(count($second_last_price) != 0)
                                                                        @if($second_last_price[0]['product_price'] < $price[0]['product_price'])
                                                                            <td style="color:red;" align="right">
                                                                                <img style="height: 10px; margin-top: -1%;" src="/css/wsis/images/red-arrow.png">
                                                                                {{ number_format($price[0]['product_price'],2)  }}
                                                                            </td>
                                                                        @elseif($second_last_price[0]['product_price'] > $price[0]['product_price'])
                                                                            <td style="color:green;" align="right">
                                                                                <img style="height: 10px; margin-top: -1%;" src="/css/wsis/images/green-arrow.png">
                                                                                {{ number_format($price[0]['product_price'],2)  }}
                                                                            </td>
                                                                        @elseif($second_last_price[0]['product_price'] == $price[0]['product_price'])
                                                                            <td align="right">{{ number_format($price[0]['product_price'],2)  }}</td>
                                                                        @endif
                                                                    @else
                                                                        <td align="right">{{ number_format($price[0]['product_price'],2)  }}</td>
                                                                    @endif
                                                                @endif
                                                            @endfor

                                                            <td style="color:green;" align="right">
                                                                {!! 
                                                                number_format($minprice = App\PostDetails::where('product_id', $product_compare->id)->min('product_price'),2); 
                                                                !!}
                                                            </td>
                                                            <td style="color:red;" align="right">
                                                                {!! 
                                                                number_format($maxprice = App\PostDetails::where('product_id', $product_compare->id)->max('product_price'),2); 
                                                                !!}
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>   
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Deals of the week -->
<div style="margin-top: -8%;" class="new_arrivals">
    <div class="container">
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
                                    
                                    <!-- Slider Item -->
                                    @if(count($latest_prods) > 0)
                                        @foreach($latest_prods as $latest_prod)
                                        {!!
                                            $latestprice = App\PostDetails::where('product_id', $latest_prod->id)
                                                            ->orderBy('created_at', 'desc')->limit(1)->get();
                                            $minprice = App\PostDetails::where('product_id', $latest_prod->id)->min('product_price');       
                                            $maxprice = App\PostDetails::where('product_id', $latest_prod->id)->max('product_price'); 
                                            $index =    $loop->index;
                                        !!}
                                        @if($index == 0)
                                            @foreach($commercial_products as $commercial_product)
                                                <div class="arrivals_slider_item commercial_product">
                                                    <div class="border_active"></div>
                                                    <div style="background-color: #F2E3BA; border-radius: 5px;" class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                                                        <div class="product_image d-flex flex-column align-items-center justify-content-center">
                                                            <a href="/commercial_product/{{$commercial_product->id}}/commercial_product">
                                                                <img style="" src="storage/product_images/{{$commercial_product->avatar}}" alt="">
                                                            </a>
                                                        </div>
                                                        <div style="overflow:hidden; background-color: #F2E3BA; " class="product_content">
                                                            <div class="product_price">

                                                            </div>
                                                            <div style="margin-top: -2.5%;" class="product_name">
                                                                <div>
                                                                    <a style="color: #A33A47; font-weight: 500; font-size: 15px; text-overflow: ellipsis; white-space: nowrap;" href="/commercial_product/{{$commercial_product->id}}/commercial_product">
                                                                        {{ucwords($commercial_product->product_name)}}
                                                                    </a><br>
                                                                    <small style="color:rgb(255,127,39); margin-top:-60px; font-size:15px; font-style:minion; font-wieght: 300;">
                                                                        Check Out this Item!
                                                                    </small> 
                                                                </div>
                                                            </div>
                                                            <div style="background-color: #F2E3BA;" class="product_extras">
                                                                <button style="background-color: #A33A47;" class="product_cart_button">
                                                                    <a style="color:white;" href="/commercial_product/{{$commercial_product->id}}/commercial_product">
                                                                        Quick View
                                                                    </a>
                                                                </button>
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
                                         
                                        <div  class="arrivals_slider_item">
                                            <div class="border_active"></div>
                                            <div style="background-color: #FFFCF7; " class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center">
                                                    @guest
                                                        <a href="/view_product_guest/{{$latest_prod->id}}/info">
                                                            <img style="" src="storage/product_images/{{$latest_prod->avatar}}" alt="">
                                                        </a>
                                                    @else
                                                        <a href="/view_product/{{$latest_prod->id}}/info">
                                                            <img src="storage/product_images/{{$latest_prod->avatar}}" alt="">
                                                        </a>
                                                    @endguest
                                                </div>
                                                <div style="overflow:hidden;" class="product_content">
                                                    <div class="product_price">
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
                                                        <div>
                                                            @guest
                                                                <a style="font-size: 14px;" href="/view_product_guest/{{$latest_prod->id}}/info">{{ucwords($latest_prod->product_name)}}</a><br>
                                                                @else
                                                                <a style="font-size: 14px;" href="/view_product/{{$latest_prod->id}}/info">{{ucwords($latest_prod->product_name)}}</a><br>
                                                            @endguest
                                                        </div>
                                                    </div>
                                                    <div style="background-color: #FFFCF7;" class="product_extras">
                                                        <button class="product_cart_button">
                                                            @guest
                                                                <a style="color:white;" href="/view_product_guest/{{$latest_prod->id}}/info">
                                                                    Quick View
                                                                </a>
                                                            @else
                                                                <a style="color:white;" href="/view_product/{{$latest_prod->id}}/info">
                                                                    Quick View
                                                                </a>
                                                            @endguest
                                                        </button>
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

                        {{-- @foreach($latest_product as $latest_prod) --}}
                        @if(count($latest_product) != 0)
                            <div style="display: none;">
                            {!!
                                $latestprice = App\PostDetails::where('product_id', $latest_product[0]['id'] )
                                                ->orderBy('created_at', 'desc')->limit(1)->get();
                                $cat_name = App\Category::select('category_name')
                                                ->where('id', $latest_product[0]['id'] )
                                                ->get();
                            !!}
                            </div>
                            <div class="col-lg-3">
                                <div class="arrivals_single clearfix">
                                    <div class="d-flex flex-column align-items-center justify-content-center">
                                        <div class="arrivals_single_image">
                                            @guest
                                                <a style="color:white;" href="/view_product_guest/{{ $latest_product[0]['id'] }}/info">
                                                    <img style="height: 200px" src="storage/product_images/{{ $latest_product[0]['avatar'] }}" alt="">
                                                </a>
                                            @else
                                                <a style="color:white;" href="/view_product/{{ $latest_product[0]['id'] }}/info">
                                                    <img style="height: 200px" src="storage/product_images/{{ $latest_product[0]['avatar'] }}" alt="">
                                                </a>
                                            @endguest
                                        </div>
                                        <div class="arrivals_single_content">
                                            {{-- <div class="arrivals_single_category"><a href="#">{{ ucwords($cat_name[0]['category_name']) }}</a></div> --}}
                                            <div class="arrivals_single_name_container clearfix">
                                                <div class="arrivals_single_name"><a href="#">{{ ucwords( $latest_product[0]['product_name'] ) }}</a></div>
                                                <div style="color:red; float:right;" class="arrivals_single_price text-right">P{{number_format($latestprice[0]['product_price'],2)}}</div>
                                            </div>
                                            <button class="arrivals_single_button">
                                                @guest
                                                    <a style="color:white;" href="/view_product_guest/{{ $latest_product[0]['id'] }}/info">
                                                        Quick View
                                                    </a>
                                                @else 
                                                    <a style="color:white;" href="/view_product/{{ $latest_product[0]['id'] }}/info">
                                                        Quick View
                                                    </a>
                                                @endguest
                                            </button>
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
                        {{-- @endforeach --}}
                    </div>   
                </div>
            </div>
        </div>
    </div>		
</div>

<!-- Popular Categories -->

<!-- Banner -->

<div style="border-radius: 5px; height: 200px; border: 1px solid grey; margin-top: -7%;" class="banner">
    <div class="banner_background" style="background-image:url(/css/wsis/images/banner_background.jpg)"></div>
    <div class="container fill_height">
        <div class="row fill_height">
            <div class="banner_product_image"><img style="height: 250px;" src="/css/wsis/images/banner_product.png" alt=""></div>
            <div class="col-lg-5 offset-lg-4 fill_height">
                <div class="banner_content">
                    <h1 class="banner_text">new era of smartphones</h1>
                    <div class="banner_price"><span>$530</span>$460</div>
                    <div class="banner_product_name">Apple Iphone 6s</div>
                    {{-- <div class="button banner_button"><a href="#" data-toggle="modal" data-target="#addproductmodal">Shop Now</a></div> --}}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hot New Arrivals -->
@include('inc.mostly_shared_products')

<br><Br><br><Br>
    
<!-- Best Sellers -->
@include('inc.just_for_you_products')

@include('inc.shared_lists')
    
<script src="/css/wsis/js/jquery-3.3.1.min.js"></script>
<script src="/js/import/jquery-library.js"></script>
<script src="/js/import/sweetalert.min.js"></script>

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>   --}}

<!-- toaster notification -->
{{-- <script type="text/javascript" src="/js/import/toastr.min.js"></script> --}}
<!-- toaster notification -->
{{-- <link rel="stylesheet" type="text/css" href="/js/import/toastr.min.css"/> --}}

@include('sweet::alert')
<?php Session::forget('sweet_alert'); ?>

{{-- <script src="/js/import/search.js"></script> --}}
<script>
    $('document').ready(function(e){
        $.ajaxSetup({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        // $('#product_price').on('keyup', function(){
        //     $prod_price = $('#product_price').val();
        //     if(isNaN($prod_price)){
        //         $('#product_price').val("");
        //     }else{
        //         $prod_price = $('#product_price').val();
        //     }
        // });
        
        // $.ajax({
        //     url: '/latest_prods/load_latest_prods',
        //     type: 'GET',
        //     dataType: 'html',
        //     success:function(data){
        //         $data = $(data);
        //         $('#latest').html(data).fadeIn();
        //     } 
        // });

        // $.ajax({
        //     url: '/most_shared_products/load_most_shared_prods',
        //     type: 'GET',
        //     dataType: 'html',
        //     success:function(data){
        //         $data = $(data);
        //         $('#most_shared_prods').html($data).fadeIn();
        //     } 
        // });

        // $.ajax({
        //     url: '/for_you/load_for_you',
        //     type: 'GET',
        //     dataType: 'html',
        //     success:function(data){
        //         $data = $(data);
        //         $('#for_you').html($data).fadeIn();
        //     } 
        // });

        // $.ajax({
        //     url: '/all_products/load_all_products',
        //     type: 'GET',
        //     dataType: 'html',
        //     success:function(data){
        //         $data = $(data);
        //         $('#all_products').html($data).fadeIn();
        //     } 
        // });

        
    });
</script>
@endsection
