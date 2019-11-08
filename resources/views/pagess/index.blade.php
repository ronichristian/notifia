@extends('layouts.appss')

@section('content')
<!-- Header -->
@include('modals.login-modal')
@include('modals.add-prod-modal')
<!-- Banner -->
{{-- <a href="/submit_ads_form">Ads Form</a> --}}

<a onclick="scrollWin()" href="#" id="myBtn" title="Go to top">Top</a>

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
                            <img src="/css/wsis/images/grocery_banner.jpg" alt="">
                        </div>
                        <div class="col-lg-5 offset-lg-4 fill_height">
                            <div class="banner_content">
                                @guest
                                    <h1 style="font-size: 32px;" class="banner_text">LOGIN NOW! TO CREATE YOUR SHOPPING LIST</h1>
                                @else
                                    <div style="margin-top: -3px;" class="button banner_button"><a href="#" data-toggle="modal" data-target="#addproductmodal">Share Product Now</a></div>
                                    <h1 style="font-size: 32px;" class="banner_text">CREATE YOUR SHOPPING LIST NOW!!</h1>
                                @endguest
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="banner">
                <div class="banner_background" ></div>
                <div class="container fill_height">
                    <div class="row fill_height">
                        <div class="banner_product_image">
                            <img src="/css/wsis/images/grocery_banner.jpg" alt="">
                        </div>
                        <div class="col-lg-5 offset-lg-4 fill_height">
                            <div class="banner_content">
                                @guest
                    
                                @else
                                    <div style="margin-top: -3px;" class="button banner_button"><a href="#" data-toggle="modal" data-target="#addproductmodal">Share Product Now</a></div>
                                @endguest
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="banner">
                <div class="banner_background" ></div>
                <div class="container fill_height">
                    <div class="row fill_height">
                        <div class="banner_product_image">
                            <img src="/css/wsis/images/grocery_banner.jpg" alt="">
                        </div>
                        <div class="col-lg-5 offset-lg-4 fill_height">
                            <div class="banner_content">
                                @guest
                    
                                @else
                                    <div style="margin-top: -3px;" class="button banner_button"><a href="#" data-toggle="modal" data-target="#addproductmodal">Share Product Now</a></div>
                                @endguest
                                <h1 style="font-size: 32px;" class="banner_text">LOGIN NOW! TO CREATE YOUR SHOPPING LIST</h1>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<hr>
<!-- Table of Products -->
    {{-- @include('inc.products_table')` --}}
<!-- Characteristics -->


<!-- Products of the week -->
<div id="latest_products">
    @include('inc.products_of_the_week')
</div>


<!-- Popular Categories -->
<!-- Banner -->
<div style="border-radius: 5px; height: 200px; margin-top: -10%;" class="banner">
    <div class="banner_background" style="height: 250px; background-image:url(/css/wsis/images/grocery_banner.jpg)"></div>
    <div class="container fill_height">
        <div class="row fill_height">
            <div class="banner_product_image">
                <img style="height: 250px;" src="/css/wsis/images/grocery_banner.png" alt="">
            </div>
            <div class="col-lg-5 offset-lg-4 fill_height">
                <div class="banner_content">
                    {{-- <h1 class="banner_text">new era of smartphones</h1>
                    <div class="banner_price"><span>$530</span>$460</div>
                    <div class="banner_product_name">Apple Iphone 6s</div> --}}
                    {{-- <div class="button banner_button"><a href="#" data-toggle="modal" data-target="#addproductmodal">Shop Now</a></div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Mostly shared products -->
<div id="most_shared_products">
    {{-- @include('inc.mostly_shared_products') --}}
</div>

<br><Br><br>
    
<!-- Just for you products -->
<div id="recommended_products">
    {{-- @include('inc.just_for_you_products') --}}
</div>

<!--Shared Listst-->
<div id="shared_lists">
    {{-- @include('inc.shared_lists') --}}
</div>



<button id="myBtn" title="Go to top">Top</button>
<script src="/css/wsis/js/jquery-3.3.1.min.js"></script>
<script src="/js/import/jquery-library.js"></script>
<script src="/js/import/sweetalert.min.js"></script>

<script src="{{ asset('js/vue-js/axios.js') }}"></script>
<script src="{{ asset('js/vue-js/vue2.1.3.js') }}"></script>
<script src="{{ asset('js/vue-js/product.js') }}"></script>

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>   --}}

@include('sweet::alert')
<?php 
    Session::get('variableName');
    Event::listen('auth.login', function()
    {
        Session::set('variableName', $value);
    });
    Session::forget('sweet_alert'); 
?>


<script>
    $('document').ready(function(e){
        $.ajaxSetup({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $('#myBtn').click(function(){
            $('html,body').animate({
                scrollTop: $(".header").offset().top},
            'slow');
        })

        // $.ajax({
        //     type: 'GET',
        //     url: '{{url('latest_prods/load_latest_prods')}}',
        //     dataType: 'html',
        //     success:function(data)
        //     {
        //         $data = $(data);
        //         $('#latest_products').append($data);
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
        //     type: 'GET',
        //     url: '/products_table/load_products_table',
        //     dataType: 'html',
        //     success:function(data){
        //         $('#products_table').html(data).fadeIn();
        //     } 
        // });

        //Get the button
        var mybutton = document.getElementById("myBtn");

        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {scrollFunction()};

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }
        
        
    });
</script>

@endsection
