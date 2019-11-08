@extends('layouts.profile_layout')

@section('content')
@include('modals.add-prod-modal')
	<!-- Home -->
	<div style="height: 280px; margin-left: 8%; margin-top: 1%; text-algin: center;" class="home">
        <section id="new">
            <div class="thumb-info mb-md">
                <img src="/uploads/images/{{ Auth::user()->avatar }}" style="width:150px; height:150px; border-radius: 50%;" class="rounded img-responsive" alt="John Doe">         
                <div class="thumb-info-title">
                    <span style="color:#ff6d00; font-weight:600;" class="thumb-info-inner">
                        {{ ucwords(Auth::user()->name) }}
                    </span>
                    <span class="thumb-info-type"></span>
                </div>
            </div>
            <form enctype="multipart/form-data" action="/upload/photo" method="POST">
                @csrf
                <label></label><br>
                <input type="file" class="btn btn-success" name="avatar">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"><br>
                <input type="submit" class="btn btn-success btn_scroll">
            </form> 
        </section>
	</div><hr>

	<!-- Blog -->

	<div class="blog">
            <h2 class="list_header" style="font-family: verdana; margin-top: -5%; text-align: center;">Your Lists</h2>
		<div style="margin-top:2%;" class="container">
			<div class="row">
				<div class="col">
					<div class="blog_posts d-flex flex-row align-items-start justify-content-between">
						
						<!-- Blog post -->
						@if(count($user_lists) > 0)
							@foreach($user_lists as $user_list)
								<div style="display:none;">
								{!!
									$count = App\ListDetails::where('user_list_id', $user_list->id)->get()->count();
								!!}
								</div>
								@if($user_list->is_shared == 1)
								<a href="list_details/{{$user_list->id}}/view">
									<div style="height: 235px; background-color:deepskyblue;" class="blog_post">
										<div class="blog_image" style="background-size: auto; background-image:url(/storage/product_images/default-product.jpg)"></div>
										<div class="blog_text" style="color: rgb(255,127,39);">{{ strtoupper($user_list->list_name)}}, <span style="color:white;">with {{$count}} item(s) </span> </div> 
										<div class="blog_button">
										<a href="list_details/{{$user_list->id}}/view">View List <span>(Shared)</span></a>
										</div>
									</div>
								</a>
								@else
								<a href="list_details/{{$user_list->id}}/view">
									<div style="height: 235px;" class="blog_post">
										<div class="blog_image" style="background-size: auto; background-image:url(/storage/product_images/default-product.jpg)"></div>
										<div class="blog_text" style="color: rgb(255,127,39);">{{ strtoupper($user_list->list_name)}}, <span style="color:deepskyblue;">with {{$count}} item(s) </span> </div> 
										<div class="blog_button">
										<a href="list_details/{{$user_list->id}}/view">View List</a>
										</div>
									</div>
								</a>
								@endguest
							@endforeach
						@else
							<p style="margin-left:45%;">You have no lists yet</p>
						@endif

					</div>
				</div>
					
			</div>
		</div>
	</div>
	<!-- Footer -->


<script src="/js/import/jquery-library.js"></script>
<script src="/css/wsis/js/jquery-3.3.1.min.js"></script>
<script src="/js/import/sweetalert.min.js"></script>

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}

<script src="/js/import/search.js"></script>
<script>
 	$(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
		});
		$('html,body').animate({
			scrollTop: $(".list_header").offset().top},
		'slow');
	});
</script>

@include('sweet::alert')
@endsection