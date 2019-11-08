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
<link rel="stylesheet" type="text/css" href="/css/wsis/styles/bootstrap4/bootstrap.min.css">
<link href="/css/wsis/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="/css/wsis/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="/css/wsis/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="/css/wsis/plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="/css/wsis/styles/blog_styles.css">
<link rel="stylesheet" type="text/css" href="/css/wsis/styles/blog_responsive.css">

</head>
<style>
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
</style>
<body>

<div class="super_container">
    @include('inc.header')
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
<script src="/css/wsis/plugins/parallax-js-master/parallax.min.js"></script>
<script src="/css/wsis/plugins/easing/easing.js"></script>
<script src="/css/wsis/js/blog_custom.js"></script>
</body>

</html>