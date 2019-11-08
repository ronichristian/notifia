<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="OneTech shop project">
<meta name="viewport" content="width=device-width, initial-scale=1"><title>wSIS Shoppy</title>
<link rel="stylesheet" type="text/css" href="/css/wsis/styles/bootstrap4/bootstrap.min.css">
<link href="/css/wsis/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="/css/wsis/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="/css/wsis/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="/css/wsis/plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="/css/wsis/plugins/slick-1.8.0/slick.css">
<link rel="stylesheet" type="text/css" href="/css/wsis/styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="/css/wsis/styles/responsive.css">
<link rel="shortcut icon" href="/css/img/grocery.jpg" />
<link href="/css/wsis/css/img/grocery.jpg" rel="icon">
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />

</head>

<body>

<div class="super_container">
    <h3 class="agileinfo_sign">Share Product</h3>
    <p>
        Come join the Grocery Shoppy! Add a Product Now.
    </p>
    <form action="add_commercial_product" method="post" enctype="multipart/form-data">
        @csrf
        <div class="styled-input agile-styled-input-top">
            <input list="searched_prod_name" type="text" class="newsletter_input" placeholder="Product Name" name="ads_product_name" id="ads_product_name" required="">
            {{-- <datalist id="searched_prod_name">
                @foreach($products as $product)
                    <option value="{{ucwords($product->product_name)}}"></option>
                @endforeach
            </datalist> --}}
        </div><br>

        <div class="styled-input">
            <input list="searched_store_name" type="text" class="newsletter_input" placeholder="Sponsor" name="ads_sponsor" id="ads_sponsor">
        </div><br>
    
        <div class="styled-input">
            <textarea list="searched_store_name" type="text" class="newsletter_input" placeholder="Description" name="ads_description" id="ads_description" >
            </textarea>
        </div><br>

        <div class="styled-input">
            <input list="searched_store_name" type="text" class="newsletter_input" placeholder="Store" name="ads_store_name" id="ads_store_name" >
            <datalist id="searched_store_name">
                @foreach($stores as $store)
                    <option value="{{ucwords($store->store_name)}}"></option>
                @endforeach
            </datalist>
        </div><br>

        <div class="styled-input">
            <input type="text" class="newsletter_input" placeholder="Product Price" name="ads_product_price" id="ads_product_price" >
        </div><br>

        <div class="styled-input" >
            <label >Select image to Upload</label>
            <input class="newsletter_input pull-right" type="file" name="image" id="image">
        </div><br>
    
        {{-- <div class="styled-input">
            <select id="ads_category" name="ads_category" class="newsletter_input" style="margin-left: -0px; color:black;" required>
                <option value="" disabled selected>Choose Category</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}" style="color:black;">{{ucwords($category->category_name)}}</option>
                @endforeach
            </select>
            <div style="margin-top: -20xp;" id="store_list"></div>
        </div><br> --}}


        <button class="btn btn-info" type="submit">Submit </button>
        <input type="hidden" value="{{ csrf_token() }}" name="_token">
    </form>
</div>

@include('sweet::alert')
<?php Session::forget('sweet_alert'); ?>

<script src="/js/import/sweetalert.min.js"></script>
<script src="/css/wsis/js/jquery-3.3.1.min.js"></script>
<script src="/css/wsis/styles/bootstrap4/popper.js"></script>
<script src="/css/wsis/styles/bootstrap4/bootstrap.min.js"></script>
<script src="/css/wsis/plugins/greensock/TweenMax.min.js"></script>
<script src="/css/wsis/plugins/greensock/TimelineMax.min.js"></script>
<script src="/css/wsis/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="/css/wsis/plugins/greensock/animation.gsap.min.js"></script>
<script src="/css/wsis/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="/css/wsis/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="/css/wsis/plugins/slick-1.8.0/slick.js"></script>
<script src="/css/wsis/plugins/easing/easing.js"></script>
<script src="/css/wsis/js/custom.js"></script>
</body>

</html>