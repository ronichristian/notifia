@extends('layouts.view_prod_layout')

@section('content')
	<!-- Single Product -->
	@include('modals.add-prod-modal')
	<div style="background-color: #FFFCF7; margin-top: -5%;" class="single_product">
		<div  class="container">
			<div class="row">
				<!-- Images -->
				<div class="col-lg-2 order-lg-1 order-2"></div>

				<!-- Selected Image -->
				<div class="col-lg-5 order-lg-2 order-1">
					<div style="background-color: #F2E3BA;" class="image_selected">
						{{-- <img src="/storage/product_images/{{$commercial_products->avatar}}" alt=""> --}}
						<img src="{{$commercial_products->get_commercial_product_picture($commercial_products->id)}}" alt="">
					</div>
				</div>

				<!-- Description -->
				<div style="margin-left:-5%;" class="col-lg-5 order-3">
					<div class="product_description">
						<div class="product_category" style="color: rgb(255,127,39);">Sponsored by <br>{{ucwords($commercial_products->sponsor)}}</div>
						<div style="color:  #f4db78;" class="product_name">{{ucwords($commercial_products->product_name)}}</div>
						<div class="product_text">
                            <p>
                                {{ ucwords($commercial_products->description) }}
                            </p>
                        </div>
						<div style="margin-top: -17%;" class="order_info d-flex flex-row">

                            <div style="color:red;" class="product_price">P{{number_format($commercial_products->product_price,2)}}</div>
                            <div class="button_container">

                            </div>
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
						<h3 class="viewed_title">Other Products</h3>
						<div class="viewed_nav_container">
							<div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
							<div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
						</div>
					</div>

					<div class="viewed_slider_container">
						
						<!-- Recently Viewed Slider -->

						<div class="owl-carousel owl-theme viewed_slider">
							<!-- Recently Viewed Item -->
							@foreach($products as $product)
								<div class="owl-item">
									<div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
										<div class="viewed_image">
											@guest
												<a href="/view_product_guest/{{$product->id}}/info">
													<img src="{{$product->getPicture($product->id)}}" alt="">
												</a>
											@else
												<a href="/view_product/{{$product->id}}/info">
													<img src="{{$product->getPicture($product->id)}}" alt="">
												</a>
											@endguest
										</div>
										<div class="viewed_content text-center">
											<div style="display: none">
												{!!
												$latestprice = App\PostDetails::where('product_id', $product->id)
													->orderBy('created_at', 'desc')->limit(1)->get();	
												!!}
											</div>
											<div class="viewed_price">P{{ number_format($latestprice[0]['product_price'],2) }}</div>
											<div class="viewed_name">
												@guest
													<a href="/view_product_guest/{{$product->id}}/info">{{ ucwords($product->product_name) }}</a>
												@else
													<a href="/view_product/{{$product->id}}/info">{{ ucwords($product->product_name) }}</a>
												@endguest
											</div>
										</div>
										<ul class="item_marks">
											{{-- <li class="item_mark item_discount">-25%</li>
											<li class="item_mark item_new">new</li> --}}
										</ul>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Brands -->






@endsection