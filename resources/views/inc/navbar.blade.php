
<div id="main-navbar" style="">
        <!-- //top-header -->
        <!-- header-bot-->
        <div class="header-bot">
            <div class="header-bot_inner_wthreeinfo_header_mid">
                <!-- header-bot-->
                <div class="col-md-4 logo_agile">
                    <h1>
                        <a href="index.html">
                            <span>w</span>SIS
                            <span>S</span>hoppy
                            {{-- <img src="/css/sis/images/logo2.png" alt=" "> --}}
                        </a>
                    </h1>
                </div>
                <!-- header-bot -->
                <div  class="col-md-8 header">
                    <!-- header lists -->
                    <ul>
                        <!-- Authentication Links -->
                    @guest
                        <li>
                            <a href="" data-toggle="modal" data-target="#sign-in-modal">
                                <span class="fa fa-unlock-alt" aria-hidden="true"></span> Sign In </a>
                        </li>
                        @if (Route::has('register'))
                        <li>
                            <a href="" data-toggle="modal" data-target="#sign-up-modal">
                                <span class="fa fa-pencil-square-o" aria-hidden="true"></span> Sign Up </a>
                        </li>
                        @endif

                        @else
                        <li>
                            <a href="/home">
                                <span class="fa fa-home"></span>Home
                            </a>
                        </li>
                        <li>
                            <a href="/profile">
                                <span class="fa fa-unlock-alt" aria-hidden="true"></span>{{ Auth::user()->name }}<br>
                                {{-- <small>My Profile</small>  --}}
                            </a>
                        </li>
                        <li>
                            <a href="/create_list">
                                <span class="fa fa-home"></span>Create List
                            </a>
                        </li>
                        <li>
                            <a class="play-icon popup-with-zoom-anim" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            <span class="fa fa-map-marker" aria-hidden="true"></span>
                            {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                      @endguest
                        
                    </ul>
                    <!-- //header lists -->
                    <!-- search -->
                    
                    <div  class="agileits_search">
                        <form action="/search_product" method="post">
                            @csrf
                            <input id="q" name="q" type="search" placeholder="Search Product Here.." required="">
                            <button id="search_product_btn" type="submit" class="btn btn-default" aria-label="Left Align">
                                <span class="fa fa-search" aria-hidden="true"> </span>
                            </button>
                            <div style="background:white;" id="search_product_list"></div>
                        </form>
                    </div>
                    <!-- //search -->
                    <!-- cart details -->
                    <div  class="top_nav_right">
                        <div class="wthreecartaits wthreecartaits2 cart cart box_1">
                            @guest

                            @else
                            <form action="#" method="post" class="last">
                                <input type="hidden" name="cmd" value="_cart">
                                <input type="hidden" name="display" value="1">
                                <button class="w3view-cart" type="submit" name="submit" value="">
                                    <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                                </button>
                            </form>
                            @endguest
                        </div>
                    </div>
                    <!-- //cart details -->
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        @include('modals.sign-in-modal')
        <!-- //Modal1 -->
        <!-- //signin Model -->
        <!-- signup Model -->
        <!-- Modal2 -->
        @include('modals.sign-up-modal')
        <!-- //Modal2 -->
        <!-- //signup Model -->
        <!-- //header-bot -->
        <!-- navigation -->
        <div  style="background:  #20639B;" class="ban-top">
            <div class="container">
                <div class="agileits-navi_search">
                    <form action="#" method="post">
                        <select id="agileinfo-nav_search" name="agileinfo_search" required="">
                            <option value="">All Categories</option>
                            <option value="Kitchen">Kitchen</option>
                        </select>
                    </form>
                </div>
                <div class="top_nav_left">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
                                    aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse menu--shylock" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav menu__list">
                                    <li class="">
                                        <a class="nav-stylehead " href="/home">
                                            <span class="fa fa-home"></span>Home
                                            <span class="sr-only">(current)</span>
                                        </a>
                                    </li>
                                    <li class="dropdown">
                                        <a class="nav-stylehead dropdown-toggle" href="#" data-toggle="dropdown">Pages
                                            <b class="caret"></b>
                                        </a>
                                        <ul class="dropdown-menu agile_short_dropdown">
                                            <li>
                                                <a href="icons.html">Web Icons</a>
                                            </li>
                                            <li>
                                                <a href="typography.html">Typography</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <!-- //navigation -->
        <!-- banner -->
</div>

<script src="/js/import/jquery-library.js"></script>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
{{-- <script src="https://code.jquery.com/jquery-3.1.0.js"></script> --}}

<!-- toaster notification -->
<script type="text/javascript" src="/js/import/toastr.min.js"></script>
<!-- toaster notification -->
<link rel="stylesheet" type="text/css" href="/js/import/toastr.min.css"/>

{{-- <script src="/js/import/search.js"></script> --}}

<script>

    $(document).ready(function(){
        $.ajaxSetup({
        headers: {
            	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
        });
        
        $('#q').keyup( function(){
            var query = $(this).val();
            if(query != ''){
                $.ajax({
                    url: "/search_product/name",
                    method: "POST",
                    data: {query:query},
                    success:function(data)
                    {
                        $('#search_product_list').fadeIn().html(data.output);
                        $(document).on('click', '#searched_product li a', function(){
                            
                            $string = $(this).text();
                            $('#q').val($string.toLowerCase());
                            $('#search_product_list').fadeOut();
                        });
                    }
                });
            }else{
                $('#search_product_list').html("").fadeOut();
            }
        });
        
       
    });


</script>