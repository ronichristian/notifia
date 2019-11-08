@extends('layouts.list_details_layout')

@section('content')
@include('modals.add-prod-modal')
<div class="cart_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <form id="create_list_form" style="margin-top: -9%;">
                    <div class="cart_container">
                        <div style="width: 110%; margin-top: -0%; margin-left:-5%;" class="cart_items">
                            <div style="margin-top: -0%;" class="cart_items">
                               
                            </div>
                        </div>

                        <div style="height: 20%; margin-top:%; padding: 10px;" class="order_total">
                            <div style="float:left; postion:absolute; margin-top: -1.5%; margin-left: -2%;" class="viewed_image">
                                <img src="/storage/product_images/default-list-icon.png" alt="">
                            </div>
                            <div class="cart_title">
                                <h6><span style="color: rgb(255,127,39); font-size: 30px;"> {{strtoupper($shared_lists[0]['list_name'])}}</span></h6>
                            </div>
                            <div style="margin-top: 2%;" class="cart_title">
                                <h5>Location: <span style="color: rgb(255,127,39);"> {{strtoupper($shared_lists[0]['location'])}}</span></h5>
                            </div>
                            <div style="margin-top: -2%;" class="cart_title">
                                <div style="display:none;">
                                    {!!
                                        $list_owner = App\User::select('name')->where('id', $user_id_of_the_list[0]['user_id'])->get();
                                    !!}
                                </div>
                                <br><p>by: <span style="color: rgb(255,127,39);">{{ucwords($list_owner['0']['name'])}}</span></p>
                                <p style="margin-top: -1%;">Remarks: <span style="color: rgb(255,127,39);">{{ucfirst($shared_lists[0]['remarks'])}}</span></p>
                            </div>
                        </div>
                        
                        <div style="margin-top: 1%;" class="cart_items">
                            <div class="table-responsive">
                                <table style="white-space:nowrap;" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <td>Product Name</td>
                                            {{-- <td></td> --}}
                                            <td>
                                                <img style="height: 20px;" src="/css/wsis/images/grocery-store5.jpg" alt="">
                                                Store
                                            </td>
                                            <td>Quantity</td>
                                            <td>
                                                <img style="height: 13px;" src="/css/wsis/images/peso1.png" alt="">rice
                                            </td>
                                            <td>Subtotal</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($list_details as $list_detail)
                                        <tr class="strikeout{{$list_detail->id}}" id="table_row">
                                            {{-- <td for="checker" id="image">
                                                <img style="height: 50px;" src="/uploads/images/{{$list_detail->avatar}}">
                                            </td> --}}
                                            @guest
                                            <td id="product_name">
                                                <a href="/view_product_guest/{{$list_detail->id}}/info">
                                                    {{ strtoupper($list_detail->product_name) }}
                                                </a>
                                            </td>
                                            @else
                                            <td id="product_name">
                                                <a style="font-weight: 600; " href="/view_product/{{$list_detail->id}}/info">
                                                    {{ strtoupper($list_detail->product_name) }}
                                                </a>
                                            </td>
                                            @endguest
                                            <td id="store_name" style="color: rgb(255,127,39);">{{ strtoupper($list_detail->store_name) }}</td>
                                            <td align="right" style="color:green; font-weight:800; width:8%;" id="qty">{{ $list_detail->quantity }}</td>
                                            <td align="right" id="product_price" style="color: red; width:8%;">{{ number_format($list_detail->product_price,2) }}</td>
                                            <td align="right" id="subtotal" style="color: red; width:8%;">
                                                {{ number_format($list_detail->subtotal,2) }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                            <!-- Order Total -->
                        <div style="margin-top: -0%;" class="order_total">
                            <div class="order_total_content text-md-left">
                                <div style="float: right; background: #0e8ce4; color: white; height: 55px;" class="order_total_title btn">
                                    <div style="display:none;">
                                        {!! 
                                            $total = App\ListDetails::where('user_list_id', $list_detail->user_list_id)->sum('subtotal');
                                        !!}
                                    </div>
                                    Total:<span style="color:red; font-weight:600;" id="total" class="order_total_amount">{{ number_format($total, 2)}}</span>
                                </div>
                                {{-- <div style="margin-left: 64%;" class="order_total_title">Total:</div>
                                <div style="color:red; margin-left: 2%;" id="total" class="order_total_amount"></div> --}}
                            </div>
                        </div>
                       
                        <div style="margin-top: -0.0%;" class="cart_buttons">
                            
                            <input type="hidden" id="list_id_holder" value="{{ $id }}">
                            <input type="hidden" id="list_name_holder" value="{{ $shared_lists[0]['list_name'] }}">
                            <input type="hidden" id="list_location_holder" value="{{ $shared_lists[0]['location'] }}">
                            @guest
                                @include('modals.login-modal')
                                <button data-toggle="modal" data-target="#login-modal" style="cursor:pointer;" type="button" id="" class="btn btn-success">Save List</button>
                            @else
                            <div style="display:none;">
                            {!!
                                $user_id = auth()->user()->id;
                            !!}
                            </div>
                                @if(auth()->user()->id === $user_id_of_the_list[0]['user_id'])
                                    
                                @else
                                    <button style="cursor:pointer;" type="button" id="make_it_your_list" class="btn btn-success">Save List</button>
                                @endguest
                            @endguest
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


@if(Session::has('success')) 
<script> 
    toastr.success("Product Shared!");
</script>
@endif

<script>
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    // var table = document.getElementById("dataTables-example");
    // var sumVal = 0;
    // for(var i=1; i < table.rows.length; i++)
    // {
    //     sumVal = sumVal + parseFloat(table.rows[i].cells[4].innerHTML);
    // }
    // document.getElementById("total").innerHTML = sumVal.toLocaleString(2);

    var array = [];
    $('.share_list').on('click', function(){
        console.log(array.push(table.rows[i].cells[3].innerHTML));
    });

    $('#make_it_your_list').click(function(){
        var id = $('#list_id_holder').val();
        swal({
            title: "Are you sure?",
            text: "Confirm to Save List",
            icon: "info",
            buttons: true,
            })
            .then((willSave) => {
                if (willSave) {
                    $.ajax({
                        url: '/get_list_details',
                        type: 'POST',
                        data:{data: id},
                        success:function(response){
                            var list_to_save = Array();
                            var list_name = $('#list_name_holder').val();
                            var list_location = $('#list_location_holder').val();
                            for(var i = 0; i < response.length; i++)
                            {
                                var product_name    = response[i]['product_name'];
                                var product_price   = response[i]['product_price'];
                                var store_name      = response[i]['store_name'];
                                var is_checked      = response[i]['is_checked'];
                                var product_id      = response[i]['product_id'];
                                var user_list_id    = response[i]['user_list_id'];
                                var list = {
                                    'product_name': product_name ,
                                    'store_name': store_name ,
                                    'product_price': product_price ,
                                    'is_checked': is_checked ,
                                    'product_id': product_id ,
                                    'user_list_id': user_list_id,
                                    'list_name': list_name,
                                    'list_location': list_location,
                                }
                                list_to_save.push(list);
                            }
                            swal("Done!", "List Successfully Saved As Your List!", "success");
                            $.ajax({
                                type: 'POST',
                                url: '/save_list',
                                data:{data: list_to_save},
                                success:function(response)
                                {
                                    list = {};
                                    list_to_save = Array();
                                }
                            });
                        } 
                    });
                }else{
                    
                } 
            });
        
    });

});
 
</script>

@endsection
