@extends('layouts.view_prod_layout')
    
@section('content')
	<!-- Single Product -->
	@guest
		@include('modals.login-modal')
	@else
		@include('modals.add-prod-modal')
		@include('modals.lists-modal')
	@endguest
	
	@include('modals.graph-modal')
	<div style="background-color: #FFFCF7; margin-top: -5%;" class="single_product">
		<div class="container">
			<div class="row">

				<!-- Images -->
				<div class="col-lg-2 order-lg-1 order-2">
					{{-- <ul class="image_list">
						<li data-image="/storage/product_images/{{$product->avatar}}"><img src="/storage/product_images/{{$product->avatar}}" alt=""></li>
						<li data-image="/storage/product_images/{{$product->avatar}}"><img src="/storage/product_images/{{$product->avatar}}" alt=""></li>
						<li data-image="/storage/product_images/{{$product->avatar}}"><img src="/storage/product_images/{{$product->avatar}}" alt=""></li>
					</ul> --}}
				</div>

				<!-- Selected Image -->
				<div class="col-lg-5 order-lg-2 order-1">
					<div class="image_selected">
						{{-- <img src="/avatar/{{$product->id}}" alt=""> --}}
						<img src="{{$product->getPicture($product->id)}}" alt="">
					</div>
				</div>

				<!-- Description -->
				<div class="col-lg-5 order-3">
					<div class="product_description">
						<div style="color: rgb(255,127,39);" class="product_category">{{ucwords($category[0]['category_name'])}}</div>
						<div class="product_name">{{ ucfirst($product->product_name)}}</div>
						<div class="product_text">
							<p>
								@foreach($stores as $store)
									<div style="display:none;">
									{!!
										$price = App\PostDetails::select('product_price', 'created_at', 'id')
											->where('store_id', $store->store_id)
											->where('product_id', $store->product_id)
											->orderBy('id', 'DESC')
											->get();
									!!}
									</div>
									{{-- <a class="store" id="{{ $store->store_id }}" href="#" data="modal" data-toggle="modal" data-target="#graph-modal" style="font-size: 20px; ">
										{{ ucfirst($store->store_name) }}
									</a> --}}
									<a class="store" id="{{ $store->store_id }}" href="#" style="font-size: 20px; ">
										{{ ucfirst($store->store_name) }}
									</a>
									(<span style="color:red;">P{{ number_format($price[0]['product_price'],2) }}</span>)
									<span style="font-size:10px">( {{ ucwords($store->location) }} )</span>
									<span>
										<small style="font-size: 10px; color: rgb(255,127,39);">
											({{ $price[0]['created_at']->format('d-m-Y') }})
										</small><br>
										@guest
											<button style="cursor:pointer; width: 20%; height:20px; font-size:8px; " data-toggle="modal" data-target="#login-modal" id="add_to_list" type="button" class="btn btn-primary btn-sm add_to_list">Add to List</button>
										@else
											<button style="cursor:pointer; width: 20%; height:20px; font-size:8px; " data-toggle="modal" data-target="#lists-modal" id="{{ $price[0]['id'] }}" type="button" class="btn btn-primary btn-sm add_to_list">Add to List</button>
										@endguest
									</span><br>

									<input class="product_price" value="{{ $price[0]['product_price'] }}" type="hidden">
									<input class="product_id" value="{{$store->product_id}}" type="hidden">
									{{-- <input class="post_details_id" value="{{ $price[0]['id'] }}" type="text"> --}}
									
								@endforeach
							</p>
						</div>
						{{-- <div class="order_info d-flex flex-row">
							<form action="#">
								<div class="button_container">
									@guest
										<button data-toggle="modal" data-target="#login-modal" id="add_to_list" type="button" class="button cart_button">Add to List</button>
									@else
										<button data-toggle="modal" data-target="#lists-modal" id="add_to_list" type="button" class="button cart_button">Add to List</button>
									@endguest
								</div>
							</form>
						</div> --}}
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
							@foreach($category as $cat)
								<div style="display: none">
									{!!
									$related = App\PostDetails::distinct()
										->join('products', 'products.id', '=', 'post_details.product_id')
										->select('product_id', 'category_id', 'products.product_name')
										->where('category_id', $cat->id)
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
														{{-- <img src="/avatar/{{$rel->product_id}}" alt="" class="expand"> --}}
														<img src="{{$rel->getPicture($rel->product_id)}}" alt="">
													</a>
												@else
													<a href="/view_product/{{$rel->product_id}}/info">
														{{-- <img src="/avatar/{{$rel->product_id}}" alt="" class="expand"> --}}
														<img src="{{$rel->getPicture($rel->product_id)}}" alt="">
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
												
											</ul>
										</div>
									</div>
								@endforeach	
							@endforeach

						</div>
						<input id="prod_id" value="{{$product->id}}" type="hidden">
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
<script type="text/javascript" src="/js/import/toastr.min.js"></script>
<!-- toaster notification -->
<link rel="stylesheet" type="text/css" href="/js/import/toastr.min.css"/>

<script src="/js/import/search.js"></script>

@if(Session::has('success')) 
<script> 
	toastr.success("Product Shared!");
</script>
@endif

<script>
	$('document').ready(function(){
		$.ajaxSetup({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.add_to_list').on('click', function(){
			var post_details_id = $(this).attr("id");
			var product_price = $('.product_price').val();
			var product_id = $('.product_id').val();
			
            $('#post_details_id').val(post_details_id);
			$('#product_price_holder').val(product_price);
			$('#product_id_holder').val(product_id);

           
			
        })

		
	});
</script>
@endsection