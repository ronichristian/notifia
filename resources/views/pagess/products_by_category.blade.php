@extends('layouts.products_in_store_layout')

@section('content')
	{{-- <div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="/css/wsis/images/shop_background.jpg"></div>
		<div class="home_overlay"></div>
		<div class="home_content d-flex flex-column align-items-center justify-content-center">
			<h2 class="home_title">Smartphones & Tablets</h2>
		</div>
	</div> --}}
	@include('modals.add-prod-modal')
	<!-- Shop -->
	
	<div class="shop">
		<div class="container">
			<div class="row">
				<div class="col-lg-3">

					<!-- Shop Sidebar -->
					<div class="shop_sidebar">
						<div class="sidebar_section">
							<div class="sidebar_title">Categories</div>
							<ul class="sidebar_categories">
								@foreach($categories as $category)
									<li><a href="/products_by_category/{{$category->id}}/products_by_category">{{ucwords($category->category_name)}}</a></li>
								@endforeach
							</ul>
						</div>
						{{-- <div class="sidebar_section filter_by_section">
							<div class="sidebar_title">Filter By</div>
							<div class="sidebar_subtitle">Price</div>
							<div class="filter_price">
								<div id="slider-range" class="slider_range"></div>
								<p>Range: </p>
								<p><input type="text" id="amount" class="amount" readonly style="border:0; font-weight:bold;"></p>
							</div>
						</div> --}}
						<div class="sidebar_section">
							<div class="sidebar_subtitle brands_subtitle">Stores</div>
							<ul class="brands_list">
								@foreach($stores as $store)
									<li class="brand">
										<a href="/products_in_store_guest/{{$store->id}}/products_in_store_guest">{{ucwords($store->store_name)}}</a>
									</li>
								@endforeach
							</ul>
						</div>
					</div>

				</div>

				<div class="col-lg-9">
					
					<!-- Shop Content -->

					<div class="shop_content">
						<div class="shop_bar clearfix">
							<div class="shop_product_count"><span>{{$result}}</span> products found</div>
							<div class="shop_sorting">
								{{-- <span>Sort by:</span>
								<ul>
									<li>
										<span class="sorting_text">highest rated<i class="fas fa-chevron-down"></span></i>
										<ul>
											<li class="shop_sorting_button" data-isotope-option='{ "sortBy": "original-order" }'>highest rated</li>
											<li class="shop_sorting_button" data-isotope-option='{ "sortBy": "name" }'>name</li>
											<li class="shop_sorting_button"data-isotope-option='{ "sortBy": "price" }'>price</li>
										</ul>
									</li>
								</ul> --}}
							</div>
						</div>

						<div class="product_grid">
							<div class="product_grid_border"></div>
							@foreach($products as $product)
								<!-- Product Item -->
								<div class="product_item is_new">
									<div class="product_border"></div>
									<div class="product_image d-flex flex-column align-items-center justify-content-center">
										@guest
										<a href="/view_product_guest/{{$product->id}}/info">
											<img src="{{$product->getPicture($product->id)}}" alt="" >
										</a>
										@else
										<a href="/view_product/{{$product->id}}/info">
											<img src="{{$product->getPicture($product->id)}}" alt="">
										</a>
										@endguest
									</div>
									<div class="product_content">
										<div style="color:red;" class="product_price">
											<div style="display:none;">
												{!!
													$latestprice = App\PostDetails::where('product_id', $product->id)
																	->orderBy('created_at', 'desc')->limit(1)->get();
													$minprice = App\PostDetails::where('product_id', $product->id)->min('product_price');       
													$maxprice = App\PostDetails::where('product_id', $product->id)->max('product_price');
												!!}
											</div>
											P{{number_format($latestprice[0]['product_price'],2)}}
											{{-- @if($minprice == $maxprice)
												P{{number_format($minprice,2)}}
											@else
												P{{number_format($minprice,2)}} ~ P{{number_format($maxprice,2)}}
											@endguest  --}}
										</div>
										<div class="product_name">
											<div style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
												@guest
													<a href="/view_product_guest/{{$product->id}}/info" tabindex="0">
														{{ucwords($product->product_name)}}
													</a>
												@else
													<a href="/view_product/{{$product->id}}/info" tabindex="0">
														{{ucwords($product->product_name)}}
													</a>
												@endguest
											</div>
										</div>
									</div>
									<div style="background-color: rgb(255,127,39);" class="product_fav">
										<i class="fa fa-hear"></i>
										@guest
											<a href="/view_product_guest/{{$product->id}}/info">
												<p style="margin-top: 8px; color:white; font-size: 12px;">view</p>
											</a>
										@else
											<a href="/view_product/{{$product->id}}/info">
												<p style="margin-top: 8px; color:white; font-size: 12px;">view</p>
											</a>
										@endguest
									</div>
									<ul class="product_marks">
											
									</ul>
								</div>
							@endforeach

						</div>

						<!-- Shop Page Navigation -->

						<div class="shop_page_nav d-flex flex-row">
							{{-- <div class="page_prev d-flex flex-column align-items-center justify-content-center"><i class="fas fa-chevron-left"></i></div> --}}
							@if($result > 10)
								{{ $products->links() }}
							@else
								
							@endif
							{{-- <div class="page_next d-flex flex-column align-items-center justify-content-center"><i class="fas fa-chevron-right"></i></div> --}}
						</div>

					</div>

				</div>
			</div>
		</div>
	</div>

	<!-- Recently Viewed -->

	<div class="viewed">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="viewed_title_container">
						<h3 class="viewed_title">Related Products</h3>
						<div class="viewed_nav_container">
							<div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
							<div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
						</div>
					</div>

					<div class="viewed_slider_container">
						
						<!-- Recently Viewed Slider -->

						<div class="owl-carousel owl-theme viewed_slider">
							@foreach($categories as $category)
							<div style="display: none">
								{!!
								$related = App\PostDetails::distinct()
									->join('products', 'products.id', '=', 'post_details.product_id')
									->select('avatar', 'product_name', 'product_id')
									->where('category_id', $category->id)
									->distinct()
									->get();
								
								!!}
							</div>	
								@foreach($related as $rel)
									<div class="owl-item">
										<div class="viewed_item d-flex flex-column align-items-center justify-content-center text-center">
											<div class="viewed_image">
												@guest
													<a href="/view_product_guest/{{$rel->product_id}}/info">
														<img src="{{$rel->getPicture($rel->product_id)}}" alt="" class="expand">
													</a>
												@else
													<a href="/view_product/{{$rel->product_id}}/info">
														<img src="{{$rel->getPicture($rel->product_id)}}" alt="" class="expand">
													</a>
												@endguest
											</div>
											<div class="viewed_content text-center">
												<div style="display: none">
													{!!
													$latestprice = App\PostDetails::where('product_id', $rel->product_id)
														->orderBy('created_at', 'desc')->limit(1)->get();	
													!!}
												</div>
												<div style="color:red;" class="viewed_price">P {{ number_format($latestprice[0]['product_price'], 2) }}</div>
												@guest
													<div class="viewed_name">
														<a href="/view_product_guest/{{$rel->product_id}}/info">{{ ucwords($rel->product_name) }}</a>
														
													</div>
												@else
													<div class="viewed_name">
														<a href="/view_product/{{$rel->product_id}}/info">{{ ucwords($rel->product_name) }}</a>
														
													</div>
												@endguest
											</div>
											<ul class="item_marks">
												{{-- <li class="item_mark item_discount">-25%</li>
												<li class="item_mark item_new">new</li> --}}
											</ul>
										</div>
									</div>
								@endforeach	
							@endforeach

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    
<script src="/js/import/jquery-library.js"></script>
<script src="/css/wsis/js/jquery-3.3.1.min.js"></script>
<script src="/js/import/sweetalert.min.js"></script>

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}

<!-- toaster notification -->
{{-- <script type="text/javascript" src="/js/import/toastr.min.js"></script> --}}
<!-- toaster notification -->
{{-- <link rel="stylesheet" type="text/css" href="/js/import/toastr.min.css"/> --}}

@if(Session::has('success')) 
<script> 
	toastr.success("Product Shared!");
</script>

@endif
<script>
	$('#q').val($('#query').val());
</script>

@endsection