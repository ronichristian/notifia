<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootsrtap Free Admin Template - SIMINTA | Admin Dashboad Template</title>
    <!-- Core CSS - Include with every page -->
    <link href="/js/assets/plugins/bootstrap1/bootstrap.css" rel="stylesheet" />
    <link href="/js/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="/js/assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="/js/assets/css/style.css" rel="stylesheet" />
    <link href="/js/assets/css/main-style.css" rel="stylesheet" />

</head>

<body class="body-Login-back">
{{-- <header class="header">

        <!-- Top Bar -->
    
        <div class="top_bar">
            <div class="container">
                <div class="row">
                    <div class="col d-flex flex-row">
                        <div class="top_bar_contact_item"><div class="top_bar_icon"><img src="/css/wsis/images/phone.png" alt=""></div>+38 068 005 3570</div>
                        <div class="top_bar_contact_item"><div class="top_bar_icon"><img src="/css/wsis/images/mail.png" alt=""></div><a href="mailto:fastsales@gmail.com">fastsales@gmail.com</a></div>
                        <div class="top_bar_content ml-auto">
                            
                            <div class="top_bar_user">
                                @guest
                                    <div class="user_icon"><img src="/css/wsis/images/user.svg" alt=""></div>
                                    <div><a href="/register">Register</a></div>
                                    <div><a href="/login">Sign in</a></div>
                                @else
                                    <div class="user_icon"><img src="/css/wsis/images/user.svg" alt=""></div>
                                    <div><a href="#"> {{ ucfirst(Auth::user()->name) }}</a></div>
                                    <div>
                                        <a class="play-icon popup-with-zoom-anim" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                        <span class="fa fa-map-marker" aria-hidden="true"></span>
                                        {{ __('Logout') }}
                                        </a>
            
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </div>		
        </div>
    
        
        <!-- Menu -->
    </header> --}}
       
    @yield('content')
</div>

     <!-- Core Scripts - Include with every page -->
     <script src="/js/assets/plugins/jquery-1.10.2.js"></script>
     <script src="/js/assets/plugins/bootstrap/bootstrap.min.js"></script>
     <script src="/js/assets/plugins/metisMenu/jquery.metisMenu.js"></script>
 
 </body>
 
 </html>
 