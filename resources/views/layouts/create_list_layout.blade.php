<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Notifia</title>
<link href="/css/wsis/images/made-icon3.png" rel="icon">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="OneTech shop project">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="/js/assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />

<link rel="stylesheet" type="text/css" href="/css/wsis/styles/bootstrap4/bootstrap.min.css">
<link href="/css/wsis/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="/css/wsis/styles/cart_styles.css">
<link rel="stylesheet" type="text/css" href="/css/wsis/plugins/jquery-ui-1.12.1.custom/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="/css/wsis/styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="/css/wsis/styles/responsive.css">
{{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> --}}
<link href="/css/wsis/styles/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<style>
        table{
            width:210%;
        }
        #example_filter{
            float:right;
        }
        #example_paginate{
            float:right;
        }
        label {
            display: inline-flex;
            margin-bottom: .5rem;
            margin-top: .5rem;
        }
        .pin_price a{
            text-decoration: none;
            padding: 5px;
            border-radius: 5px;
            border: none;
            transition: all 0.4s ease 0s;
            cursor: pointer;
        }
        .pin_price:hover a{
            color: #fff !important;
            background: #ed3330;
            letter-spacing: 1px;
            -webkit-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.57);
            -moz-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.57);
            box-shadow: 5px 40px -10px rgba(0,0,0,0.57);
            transition: all 0.4s ease 0s;
        }
        .thumbnail {
            transition: transform .2s; /* Animation */
            margin: 0 auto;
        }

        .thumbnail:hover {
            -ms-transform: scale(10); /* IE 9 */
            -webkit-transform: scale(10); /* Safari 3-8 */
            transform: scale(10); 
        }
        .logo{
            border: 1px solid none; width:120%; 
        }
        .logo img{
            margin-left:-1%; height: 85px;
        }
        .logo a{
            margin-left:-15%;
            font-size: 20px;
            font-weight: 500;
            color: #0e8ce4;
        }

                
        /************/

        .nav-pills .nav-link.active, .nav-pills .show > .nav-link{
            background-color: #17A2B8;
        }
        .head{
            padding:5px 15px;
            border-radius: 3px 3px 0px 0px;
        }
        .dropdown-menu{
            top: 60px;
            right: 0px;
            left: unset;
            width: 290px;
            box-shadow: 0px 5px 7px -1px #c1c1c1;
            padding-bottom: 0px;
            padding: 0px;
        }
        .dropdown-menu:before{
            content: "";
            position: absolute;
            top: -20px;
            right: 12px;
            border:10px solid #343A40;
            border-color: transparent transparent #343A40 transparent;
        }
        .notification-box{
            padding: 10px 0px; 
        }
        .bg-gray{
            background-color: #eee;
        }
        @media (max-width: 640px) {
            .dropdown-menu{
                top: 50px;
                left: -16px;  
                width: 290px;
            } 
            .nav{
                display: block;
            }
            .nav .nav-item,.nav .nav-item a{
                padding-left: 0px;
            }
            .message{
                font-size: 13px;
            }

        }
        .footer{
            padding:5px 15px;
            border-radius: 0px 0px 3px 3px; 
        }
</style>
</head>
<body>

<div class="super_container">
    @include('inc.navbar')
    @yield('content')
    @include('inc.footerr')
</div>

<script src="/css/wsis/js/jquery-3.3.1.min.js"></script>
<script src="/css/wsis/styles/bootstrap4/popper.js"></script>
<script src="/css/wsis/styles/bootstrap4/bootstrap.min.js"></script>
<script src="/css/wsis/plugins/greensock/TweenMax.min.js"></script>
<script src="/css/wsis/plugins/greensock/TimelineMax.min.js"></script>
<script src="/css/wsis/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="/css/wsis/plugins/greensock/animation.gsap.min.js"></script>
<script src="/css/wsis/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="/css/wsis/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="/css/wsis/plugins/easing/easing.js"></script>
<script src="/css/wsis/js/product_custom.js"></script>

<!-- Page-Level Plugin Scripts-->
{{-- <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script> --}}

<script src="/css/wsis/js/jquery.dataTables.min.js"></script>
<script src="/css/wsis/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable(
            
            {     

        "aLengthMenu": [[10, 25, -1], [10, 25, "All"]],
            "iDisplayLength": 10
        } 
            );
    } );

</script>
</body>

</html>