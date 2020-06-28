<header class="header">
	<!-- Top Bar -->
	<div class="top_bar">
		<div class="container">
			<div class="row">
				<div class="col d-flex flex-row">
					<div class="top_bar_content ml-auto">
						<div class="top_bar_user">
							@guest
								<div class="user_icon"><img src="/css/wsis/images/user.svg" alt=""></div>
								<div><a href="/register">Register</a></div>
								<div><a href="/login"><i class="fa fa-sign in"></i> Sign in</a></div>
							@else
								<div class="user_icon"><img src="/css/wsis/images/user.svg" alt=""></div>
								<div><a style="color:#ff6d00; font-weight:600;" href="/profile"> {{  ucwords(Auth::user()->name) }} </a></div>
								<div>
									<i class="fa fa-sign out"></i>
									<a style="font-weight:200;"class="play-icon popup-with-zoom-anim" href="{{ route('logout') }}"
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

	<!-- Header Main -->

	<div class="header_main">
		<div class="container">
			<div class="row">

				<!-- Logo -->
				<div class="col-lg-2 col-sm-2 col-2 order-1">
					<div class="logo_container">
						<div class="logo" style="">
							<img style="" src="/css/wsis/images/made-icon1.png"><a style="" href="#">NOTIFIA</a>
						</div>
					</div>
				</div>

				<!-- Search -->
				<div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
					<div class="header_search">
						<div class="header_search_content">
							<div class="header_search_form_container">
								@guest
									<form action="/search_product_guest" method="POST" class="header_search_form clearfix">
										@csrf
										<input list="product_name_to_search" style="width: 90%;" name="q" id="query_search" type="search" required="required" class="header_search_input query_search" placeholder="Search for products...">
										<datalist id="product_name_to_search">
											@foreach($products_for_add_product as $product)
												<option value="{{ucwords($product->product_name)}}"></option>
											@endforeach
										</datalist>
										<div style="display:none;" class="custom_dropdown">
											<div class="custom_dropdown_list">
												<span class="custom_dropdown_placeholder clc"></span>
												<i class="fas fa-chevron-down"></i>
												<ul class="custom_list clc">
													
												</ul>
											</div>
										</div>
										<button type="submit" class="header_search_button trans_300" value="Submit"><img src="/css/wsis/images/search.png" alt=""></button>
									</form>
									{{-- <div style="color:red;  background:whitesmoke; border:none;" id="search_product_list"></div> --}}
								@else
									<form action="/search_product" method="POST" class="header_search_form clearfix">
										@csrf
										<input list="product_name_to_search" style="width: 90%;" name="q" id="q" type="search" required="required" class="header_search_input query_search" placeholder="Search for products...">
										<datalist id="product_name_to_search">
											@foreach($products_for_add_product as $product)
												<option value="{{ucwords($product->product_name)}}"></option>
											@endforeach
										</datalist>
										<div style="display:none;" class="custom_dropdown">
											<div class="custom_dropdown_list">
												<span class="custom_dropdown_placeholder clc"></span>
												<i class="fas fa-chevron-down"></i>
												<ul class="custom_list clc">
													
												</ul>
											</div>
										</div>
										<button type="submit" class="header_search_button trans_300" value="Submit"><img src="/css/wsis/images/search.png" alt=""></button>
									</form>
									{{-- <div style="color:red; background:whitesmoke; border:none;" id="search_product_list"></div> --}}
								@endguest
							</div>
						</div>
					</div>
				</div>

				<!-- Wishlist -->
				<div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
					<div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
						<div class="wishlist d-flex flex-row align-items-center justify-content-end">
							<div class="wishlist_icon"><img src="images/heart.png" alt=""></div>
							<div class="wishlist_content">
								<div class="wishlist_text">
									{{-- <a href="#">Wishlist</a> --}}
								</div>
								<div class="wishlist_count">
									@csrf
									<select style="height:30px; margin-left:-50%; width: 120%;" name="select_location" class="newsletter_input location" required>
										<option disabled selected>Select Location</option>
										@foreach($location_names as $location_name)
											<option>{{ ucwords($location_name->location) }}</option>
										@endforeach
									</select>
									<button type="button" class="header_search_button trans_300" value="Submit"><img src="/css/wsis/images/search.png" alt=""></button>
								</div>
							</div>
						</div>

						<!-- Cart -->
						<div class="cart">
							<div class="cart_container d-flex flex-row align-items-center justify-content-end">
							
								@guest

								@else
									<li style="list-style-type: none;" class="nav-item dropdown">
										<button type="button" class="btn btn-primary" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="fa fa-bell fa-1x"></i> <span class="badge badge-light">4</span>
										</button>
										<ul class="dropdown-menu">
											<li class="head bg-dark">
												<div class="row">
													<div class="col-lg-9 col-sm-9 col-9">
														<a href="" class="float-right text-light">Mark all as read</a>
													</div>
												</div>
											</li>
											<li class="notification-box">
												<div class="row">
													<div class="col-lg-1 col-sm-1 col-1 text-center">
															
													</div> 
													<div class="col-lg-8 col-sm-8 col-8">
														<strong class="text-info">David John</strong>
														<div>
														Lorem ipsum dolor sit amet, consectetur
														</div>
														<small class="text-warning">27.11.2015, 15:00</small>
													</div>  
												</div>
											</li>
											<li class="notification-box bg-gray">
												<div class="row">
													<div class="col-lg-1 col-sm-1 col-1 text-center">
															
													</div>   
													<div class="col-lg-8 col-sm-8 col-8">
														<strong class="text-info">David John</strong>
														<div>
														Lorem ipsum dolor sit amet, consectetur
														</div>
														<small class="text-warning">27.11.2015, 15:00</small>
													</div>    
												</div>
											</li>
											<li class="footer bg-dark text-center">
												<a href="" class="text-light">View All</a>
											</li>
										</ul>
									</li>
									@endguest
									
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Main Navigation -->
	<nav class="main_nav">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="main_nav_content d-flex flex-row">
						<!-- Categories Menu -->
						<div class="cat_menu_container">
							<div class="cat_menu_title d-flex flex-row align-items-center justify-content-start">
								<div class="cat_burger"><span></span><span></span><span></span></div>
								<div class="cat_menu_text">categories</div>
							</div>

							<ul class="cat_menu">
								@foreach($categories as $category)
								<li>
									<a style="font-weight: 600;" href="/products_by_category/{{$category->id}}/products_by_category">
										{{ ucwords($category->category_name)}}
										<i class="fas fa-chevron-right ml-auto"></i>
									</a>
								</li>
								@endforeach
							</ul>
						</div>

						<!-- Main Nav Menu -->

						<div class="main_nav_menu ml-auto">
							@guest
								<ul style="margin-top: 1.5%; margin-left: -65%;" class="standard_dropdown main_nav_dropdown">
									<li class="hassubs">
										<a style="height: 30px;" href="#">All Stores<i class="fas fa-chevron-down"></i></a>
										<ul>
											@foreach($stores_for_header_page as $store)
												<li>
													<a href="/products_in_store_guest/{{$store->id}}/products_in_store_guest">{{ ucwords($store->store_name) }}
													<span style="font-size: 12px">{{ ucwords($store->location) }}</span>
														<i class="fas fa-chevron-down"></i>
													</a>
												</li>
											@endforeach
										</ul>
									</li>
									<li><a href="/home"><i class="fa fa-home"></i>Home</a></li>
									<li><a href="" data-toggle="modal" data-target="#login-modal">Create Your Shopping List<i class="fas fa-chevron-down"></i></a></li>
								</ul>
							@else
								<ul style="margin-top: 1.5%; margin-left: -50%;" class="standard_dropdown main_nav_dropdown">
									<li class="hassubs">
										<a style="height: 30px;" href="#">All Stores<i class="fas fa-chevron-down"></i></a>
										<ul>
											@foreach($stores_for_header_page as $store)
												<li>
													<a href="/products_in_store_guest/{{$store->id}}/products_in_store_guest">{{ ucwords($store->store_name) }}
													<span style="font-size: 12px">{{ ucwords($store->location) }}</span>
														<i class="fas fa-chevron-down"></i>
													</a>
												</li>
											@endforeach
										</ul>
									</li>
									<li><a href="/home"><i class="fa fa-home"></i>Home</a></li>
									<li><a href="" data-toggle="modal" data-target="#addproductmodal">Share Product<i class="fas fa-chevron-down"></i></a></li>
									<li><a href="/create_list">Create Your Shopping List<i class="fas fa-chevron-down"></i></a></li>
								</ul>
							@endguest
						</div>

						<!-- Menu Trigger -->

						<div class="menu_trigger_container ml-auto">
							<div class="menu_trigger d-flex flex-row align-items-center justify-content-end">
								<div class="menu_burger">
									<div class="menu_trigger_text">menu</div>
									<div class="cat_burger menu_burger_inner"><span></span><span></span><span></span></div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</nav>
	
	<!-- Menu -->

	<div class="page_menu">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="page_menu_content">
						
						<div class="page_menu_search">
							@guest
								<form action="/search_product_guest" method="POST" class="header_search_form clearfix">
									@csrf
									<input list="menu_product_name_to_search" style="width: 90%;" name="q" id="menu_query_search" type="search" required="required" class="page_menu_search_input menu_query_search" placeholder="Search for products...">
									<datalist id="menu_product_name_to_search">
										@foreach($products_for_add_product as $product)
											<option value="{{ucwords($product->product_name)}}"></option>
										@endforeach
									</datalist>
									{{-- <button type="submit" class="header_search_button trans_300" value="Submit"><img src="/css/wsis/images/search.png" alt=""></button> --}}
								</form>
							@else
								<form action="/search_product" method="POST" class="header_search_form clearfix">
									@csrf
									<input list="menu_product_name_to_search" style="width: 90%;" name="q" id="menu_query_search" type="search" required="required" class="page_menu_search_input menu_query_search" placeholder="Search for products...">
									<datalist id="menu_product_name_to_search">
										@foreach($products_for_add_product as $product)
											<option value="{{ucwords($product->product_name)}}"></option>
										@endforeach
									</datalist>
									{{-- <button type="submit" class="header_search_button trans_300" value="Submit"><img src="/css/wsis/images/search.png" alt=""></button> --}}
								</form>
							@endguest
						</div>

						@guest
							<ul class="page_menu_nav">
								<li class="page_menu_item">
									<a href="/home">Home<i class="fa fa-angle-down"></i></a>
								</li>
								<li class="page_menu_item">
									<a href="/login">Login<i class="fa fa-angle-down"></i></a>
								</li>
								<li class="page_menu_item">
									<a href="/register">Register<i class="fa fa-angle-down"></i></a>
								</li>
								<li class="page_menu_item">
									@include('modals.sign-in-modal')
									<a href="#" data-toggle="modal" data-target="#sign-up-modal">
										Create Your List<i class="fa fa-angle-down"></i>
									</a>
								</li>

								<li class="page_menu_item has-children">
									<a href="#">ALl Stores <i class="fa fa-angle-down"></i></a>
									{{-- <ul class="page_menu_selection" style="position: static;">
										@foreach($stores_for_header_page as $store)
											<li class="page_menu_item">
												<a href="/products_in_store_guest/{{$store->id}}/products_in_store_guest">{{ ucwords($store->store_name) }}
												<span style="font-size: 12px">{{ ucwords($store->location) }}</span>
													<i class="fas fa-chevron-down"></i>
												</a>
											</li>
										@endforeach
									</ul> --}}
								</li>
								@foreach($stores_for_header_page as $store)
									<li class="page_menu_item">
										<a href="/products_in_store_guest/{{$store->id}}/products_in_store_guest">{{ ucwords($store->store_name) }}
										<span style="text-decoration: none;" style="font-size: 12px">{{ ucwords($store->location) }}</span>
											<i class="fas fa-chevron-down"></i>
										</a>
									</li>
								@endforeach
							</ul>
						@else
							<ul class="page_menu_nav">

								<li class="page_menu_item">
									<a href="/home">Home<i class="fas fa-chevron-down"></i></a>
								</li>
								<li class="page_menu_item">
									<a href="" data-toggle="modal" data-target="#addproductmodal">Share Product<i class="fas fa-chevron-down"></i></a>
								</li>
								<li class="page_menu_item">
									<a href="/create_list">Create Your Shopping List<i class="fas fa-chevron-down"></i></a>
								</li>
								<li class="page_menu_item">
									<a style="color: #fb8c00  ;" href="/profile"><i class="fa fa-home"></i>{{  ucwords(Auth::user()->name) }} (My Lists)</a>
								</li>
								<li class="page_menu_item">
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

								<li class="page_menu_item has-children">
									<a href="#">ALl Stores <i class="fa fa-angle-down"></i></a>
									{{-- <ul class="page_menu_selection" style="position: static;">
										@foreach($stores_for_header_page as $store)
											<li class="page_menu_item">
												<a href="/products_in_store_guest/{{$store->id}}/products_in_store_guest">{{ ucwords($store->store_name) }}
												<span style="font-size: 12px">{{ ucwords($store->location) }}</span>
													<i class="fas fa-chevron-down"></i>
												</a>
											</li>
										@endforeach
									</ul> --}}
								</li>
								@foreach($stores_for_header_page as $store)
									<li class="page_menu_item">
										<a href="/products_in_store_guest/{{$store->id}}/products_in_store_guest">{{ ucwords($store->store_name) }}
										<span style="font-size: 12px">{{ ucwords($store->location) }}</span>
											<i class="fas fa-chevron-down"></i>
										</a>
									</li>
								@endforeach
							</ul>
						@endguest						
						<div class="menu_contact">
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</header>

<script src="/css/wsis/js/jquery-3.3.1.min.js"></script>
<script src="/js/import/jquery-library.js"></script>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
{{-- <script src="https://code.jquery.com/jquery-3.1.0.js"></script> --}}

<script>

    $(document).ready(function(){
        $.ajaxSetup({
        headers: {
            	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
        });
        
        $('.query_search').keyup( function(){
            var query = $(this).val();
            if(query != ''){
                $.ajax({
                    url: "/search_product_store/product_and_store",
                    method: "POST",
                    data: {query:query},
                    success:function(data)
                    {
                        $('#search_product_list').fadeIn().html(data.output);
                        $(document).on('click', '#searched_product li a', function(){
                            $string = $(this).text();
                            $('.query_search').val($string.toLowerCase());
                            $('#search_product_list').fadeOut();
							$('#search_product_list').css({"color": "red"});
							$('#search_product_list').css({"font-size": "25px"});
                        });
                    }
                });
            }else{
                $('#search_product_list').html("").fadeOut();
            }
		});

		$('.menu_query_search').keyup( function(){
            var query = $(this).val();
            if(query != ''){
                $.ajax({
                    url: "/search_product_store/product_and_store",
                    method: "POST",
                    data: {query:query},
                    success:function(data)
                    {
                        $('#menu_search_product_list').fadeIn().html(data.output);
                        $(document).on('click', '#searched_product li a', function(){
                            $string = $(this).text();
                            $('#menu_query_search').val($string.toLowerCase());
                            $('#menu_search_product_list').fadeOut();
							$('#menu_search_product_list').css({"color": "red"});
							$('#menu_search_product_list').css({"font-size": "25px"});
                        });
                    }
                });
            }else{
                $('#menu_search_product_list').html("").fadeOut();
            }
		});
		

		// $('.location').change(function(){
		// 	var data = $(this).val();
			
		// 	if(data == 'valencia city'){
		// 		window.location.href = "/home"; 
		// 	}else{
		// 		$.ajax({
		// 			url: "/by_location",
		// 			method: "get",
		// 			data: {data:data},
		// 			success:function(response)
		// 			{
		// 				window.location.href = "/by_location"
		// 			}
		// 		});
		// 	}
		// })
    });


</script>