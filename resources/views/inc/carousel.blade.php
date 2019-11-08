
<div style="margin-top: -50px;" class="featured-section" id="projects">
	<div class="container">
		<!-- tittle heading -->
		<h3 class="tittle-w3l">Lists
			{{-- <span class="heading-style">
				<i></i>
				<i></i>
				<i></i>
			</span> --}}
		</h3>
		<!-- //tittle heading -->
		<div style="margin-top: -60px;" class="content-bottom-in">
			<ul class="all_lists" style="height: 00px;" id="flexiselDemo1">
				@foreach($user_lists as $user_list)
				<li>
					<div style="height: 200px; border-radius:10px;" class="w3l-specilamk">
						<div class="speioffer-agile">
							<a href="#">
								<img style="height:100px;" src="uploads/images/default-product.jpg" alt="">
							</a>
						</div>
						<div class="product-name-w3l">
							<h4>
								<a href="#">{{$user_list->list_name}}</a>
							</h4>
							<div class="w3l-pricehkj">
								<h6>$220.00</h6>
							</div>
							<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">	
								<input type="submit" name="submit" value="List Items" class="button" />
							</div>
						</div>
					</div>
				</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
{{-- <script src="https://code.jquery.com/jquery-3.1.0.js"></script> --}}

<!-- toaster notification -->
<script type="text/javascript" src="/js/import/toastr.min.js"></script>
<!-- toaster notification -->
<link rel="stylesheet" type="text/css" href="/js/import/toastr.min.css"/>

<script>
	$('document').ready(function(){
		$.ajaxSetup({
        headers: {
            	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		
		// $.ajax({
		// 	url: '/carousel_user_lists/load_lists',
		// 	type: 'GET',
		// 	dataType: 'html',
		// 	success:function(data){
		// 		$data = $(data);
		// 		$('.all_lists').html($data).fadeIn();
		// 	} 
		// });
	});
</script>