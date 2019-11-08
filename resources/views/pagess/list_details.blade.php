@extends('layouts.list_details_layout')

@section('content')
@guest

@else
    @include('modals.add-prod-modal')
@endguest
<div class="cart_section">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1">
                    <form id="create_list_form" style="margin-top: -9%;">
                        <div class="cart_container">
                            <div style="border-radius: 5px;" class="cart_title">
                                <h3 style="font-family:Impact; margin-left: 5px;">List Name : 
                                    <span style="color: rgb(255,127,39);">
                                    {{strtoupper($user_list[0]['list_name'])}}
                                        <input type="hidden" value="{{ $user_list[0]['list_name'] }}" id="list_name_holder">
                                        <button style="cursor:pointer;" id="{{ $user_list[0]['id'] }}" type="button" class="btn btn-info btn-sm update_list_name_btn" data-toggle="modal" data-target="#update-list_name-modal">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        @include('modals.update-list_name-modal')
                                    </span>
                                </h3>
                                <h3 class="status" style="margin-top: -4%; float: right;">
                                <span style="color: rgb(255,127,39);">

                                </span>
                                </h3>
                            </div>
                            
                            <div style="width: 110%; margin-top: -0%; margin-left:-5%;" class="cart_items">
                                <div style="margin-top: -0%;" class="cart_items">
                                    <ul class="cart_list">
                                        <li class="cart_item clearfix">
                                            <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">

                                                <div id="list_prod" class="cart_item_quantity cart_info_col">
                                                    <div class="cart_item_title">Product Name</div>    
                                                    <input id="add_product_name" name="add_product_name" type="text" class="form-control" list="searched_prod_name_to_add" />
                                                    <datalist id="searched_prod_name_to_add">
                                                        @foreach($products as $product)
                                                            <option value="{{ucwords($product->product_name)}}"></option>
                                                        @endforeach
                                                    </datalist>
                                                    <input id="product_id" type="hidden" value="">
                                                </div>       
                                                
                                                <div id="list_store" class="cart_item_total cart_info_col">
                                                    <div style="float:left;" class="cart_item_title">Store</div>
                                                    <input style="" class="form-control select_store_name" id="add_store_name" list="categories" name="add_store_name">
                                                        <datalist id="categories" id="s_name">
                                                            <option value="" disabled selected>Choose your option</option>
                                                            @foreach($stores as $store)
                                                                <option value="{{ucwords($store->store_name)}}"></option>
                                                            @endforeach
                                                        </datalist>
                                                        <input type="hidden" id="store_id" value="">
                                                </div>

                                                <div id="list_price" class="cart_item_total cart_info_col">
                                                    <div style="float:left;" class="cart_item_title">Quantity</div><br>
                                                    <input style="width: 75px;" id="add_qty" value="1" name="add_qty" type="text" class="form-control" placeholder="Quantity"/>
                                                </div> 

                                                <div id="list_price" class="cart_item_total cart_info_col">
                                                    <div style="float:left;" class="cart_item_title">Price</div>
                                                    <input style="" id="add_product_price" value="0" name="add_product_price" type="text" class="form-control" placeholder="Price"/>
                                                </div>  

                                                <div id="list_price" class="cart_item_total cart_info_col">
                                                    <button style="margin-top:20%; color:white; cursor:pointer;" id="add_row" type="button" class="form-control btn btn-primary btn-sm">
                                                        <i class="fa fa-plus"></i> Add To List
                                                    </button>
                                                </div>  
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div style="margin-top: 1%;" class="table-responsive">
                                @include('inc.list_details_table')
                                {{-- <div id="list_table"></div> --}}
                            </div>
                            <!-- Order Total -->
                            <div style="width: 110%; margin-top: -0%; margin-left: -5%; " class="order_total">
                                <div class="order_total_content text-md-left">
                                    <div style="color:red; float:right;" id="total" class="order_total_amount"></div>

                                    <div style="display:none;">
                                        {!! 
                                            $total_checked = App\ListDetails::where('user_list_id', $user_list[0]['id'] )->where('is_checked', 1)->sum('subtotal');
                                            $total_qty = App\ListDetails::where('user_list_id', $user_list[0]['id'] )->where('is_checked', 1)->sum('quantity');
                                            $total = App\ListDetails::where('user_list_id', $user_list[0]['id'])->sum('subtotal');
                                        !!}
                                    </div>

                                    <div style="font-weight:600; position:relative; float:right;" class="order_total_title">
                                        {{-- <span style="font-size:10px;"> Total Qty of Products:  </span>
                                        <span id="total_of_qty" style="border: 1px solid grey; border-radius: 5px; padding: 2px; color:green; font-weight:600;">{{ $total_qty }}</span> --}}

                                        <span style="font-size:10px;"> 
                                            Bought Products:  
                                        </span>
                                        <span style="border: 1px solid grey; border-radius: 5px; padding: 2px; color:green; font-weight:600;">
                                            <img style="height: 13px;" src="/css/wsis/images/peso1.png" alt="">
                                            <span id="total_of_checked_prods">
                                                {{ number_format($total_checked,2) }}
                                            </span>
                                        </span>

                                        <span style="font-size:10px;"> 
                                            Total Cost: 
                                        </span>
                                        <span style="border: 1px solid grey; border-radius: 5px; padding: 2px; color:red; font-weight:600;">
                                            <img style="height: 13px;" src="/css/wsis/images/peso1.png" alt="">
                                            {{ number_format($total,2) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div style="float:right; width:100%;">
                                <h6 style="margin-left: -1%;">Share / Unshare List</h6>
                                @if($user_list[0]['is_shared'] == 1)
                                    <label style=" float:left;" class="switch">
                                        <input type="checkbox" checked id="{{ $id }}" value="Share" placeholder="" name="choice2" class="success unshare_list">
                                        <div class="slider round">
                                            <!--ADDED HTML -->
                                            <span class="on">Shared</span>
                                            <span style="left: 70%; font-size: 7.5px;" class="off">Unshared</span><!--END-->
                                        </div>
                                    </label>
                                    {{-- <button style="font-size: 15px; padding: 10px; cursor:pointer; float:right;" id="{{ $id }}" type="button" class="btn btn-primary btn-sm unshare_list">
                                        Unshare List<i class="fa fa-share"></i>
                                    </button>  --}}
                                @else
                                    <label style=" float:left;" class="switch">
                                        <input type="checkbox" id="{{ $id }}" value="Share" placeholder="" name="choice2" class="success share_list" >
                                        <div class="slider round">
                                            <!--ADDED HTML -->
                                            <span class="on">Shared</span>
                                            <span style="left: 70%; font-size: 7.5px;" class="off">Unshared</span><!--END-->
                                        </div>
                                    </label>
                                    {{-- <label style="float:left;" class="switch ">
                                        <input type="checkbox"   id="{{ $id }}" value="Share" placeholder="" name="choice2" class="success share_list" />
                                        <span class="slider round"></span>
                                    </label> --}}
                                    {{-- <button style="font-size: 15px; padding: 10px; cursor:pointer; float:right;" id="{{ $id }}" type="button" class="btn btn-success btn-sm share_list">
                                        Share List <i class="fa fa-share"></i>
                                    </button>  --}}
                                @endif
                                <button style="font-size: 12px; padding: 10px; cursor:pointer; float:right;" id="{{ $id }}" type="button" class="btn btn-danger btn-sm delete_list">
                                    <i class="fa fa-trash"></i> Delete List
                                </button> 
                                <input id="list_id_holder" type="hidden" value="{{$id}}">
                            </div>
                        <div style="margin-top: -0.0%;" class="cart_buttons">
                
                        </div>     
                    </div>
                </form>
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


<script>
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var list_id_holder = $('#list_id_holder').val();

    
    
    $.ajax({
        type: 'GET',
        url: '/list_table/load_list_table/' + list_id_holder,
        dataType: 'html',
        cache: false,
        async:false,
        success:function(data){
            $('#list_table').html(data).fadeIn();
        } 
    });


  
});
 
</script>

@endsection
