<table style="white-space:nowrap;" class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr>
            <td>Check</td>
            {{-- <td></td> --}}
            <td>Product Name</td>
            <td class="col-sm-3 center-image hidden-xs">
                <img style="height: 20px;" src="/css/wsis/images/grocery-store5.jpg" alt="">
                Store
            </td>
            <td>Price</td>
            <td class="">Quantity</td>
            <td>Subtotal</td>
            <td style="width: 10px;">Action</td>
        </tr>
    </thead>
    <tbody id="table_body">
        @for($i=0; $i < count($list_details); $i++)
            <tr class="toggle_checked " id="table_row">
                <td align="left">
                    <label style="float:left;" class="switch ">
                        <input type="checkbox" {{ $list_details[$i]->is_checked == 1 ? "checked" : '' }}  id="{{$list_details[$i]->id}}" value="{{$list_details[$i]->id}}" name="choice2" class="success checker" />
                        <div class="slider round">
                            <!--ADDED HTML -->
                            <span class="on">Bought</span>
                            <span style="left: 67%;" class="off">To Buy</span><!--END-->
                        </div>
                    </label>
                </td>

                <td style="width:60%;" id="product_name">
                    @if($list_details[$i]->is_checked == 1)
                        <a style="font-weight: 600; text-decoration:line-through;" class="prod_name" href="#">{{ ucwords($list_details[$i]->product_name) }}</a>
                    @else
                        <a style="font-weight: 600; "class="prod_name" href="#">{{ ucwords($list_details[$i]->product_name) }}</a>
                    @endguest
                </td>

                <td class="col-sm-3 center-image hidden-xs" style="color: rgb(255,127,39);">{{ strtoupper($list_details[$i]->store_name) }}</td>
                
                <td  align="right" id="product_price">
                    <img style="height: 13px;" src="/css/wsis/images/peso1.png" alt="">
                    {{ number_format($list_details[$i]->product_price,2) }}
                </td>
                
                <td class="" align="right" style="color:green; font-weight:800; width:8%;" id="qty">{{ $list_details[$i]->quantity }}</td>

                <td align="right" id="subtotal" >
                    <img style="height: 13px;" src="/css/wsis/images/peso1.png" alt="">
                    {{ ( number_format($list_details[$i]->subtotal,2) ) }}
                </td>

                <td>
                    <button style=" cursor:pointer;" id="{{ $list_details[$i]->id }}" type="button" class="btn btn-danger btn-sm delete_item">
                        <i class="fa fa-trash"></i>
                    </button>
                    <button style=" cursor:pointer;" id="{{ $list_details[$i]->id }}" type="button" class="btn btn-info btn-sm update_item" data-toggle="modal" data-target="#update-item-modal">
                        <i class="fa fa-edit"></i>
                    </button>
                    @include('modals.update-item-modal')
                </td>

                <div style="display:none;">
                    {!! 
                        $current = $list_details[$i]->store_name;
                        $count = count($list_details);
                        $total_qty = App\ListDetails::where('user_list_id', $user_list[0]['id'] )->where('store_name', $list_details[$i]->store_name)->sum('quantity');
                        $total = App\ListDetails::where('user_list_id', $list_details[$i]->user_list_id )->where('store_name', $list_details[$i]->store_name)->sum('subtotal');
                        $total_checked = App\ListDetails::where('user_list_id', $list_details[$i]->user_list_id )->where('store_name', $list_details[$i]->store_name)->where('is_checked', 1)->sum('subtotal');
                    !!}
                </div>
                
            </tr>

            @if($i >= $count-1)
                <tr style="background-color: #efe9e5; " id="subtotal_by_store_row">
                    <td></td>
                    <td style="color: rgb(255,127,39);">{{ strtoupper($list_details[$i]->store_name) }}</td>
                    <td class="col-sm-3 center-image hidden-xs"></td>
                    <td align="right" style="border-top:1px solid black; "id="subtotal_by_store" class="subtotal_by_store">
                        <span style="font-size:10px; font-weight: 600;">Subtotal </span>
                        <span style="border: 1px solid grey; border-radius: 5px; padding: 5px; font-weight:600; color:red;">
                            <img style="height: 13px;" src="/css/wsis/images/peso1.png" alt="">    
                            {{ number_format($total,2) }} 
                        </span> 
                    </td>
                    <td align="right" style="width: 8%" class=""> 
                        <span style="font-size:10px; font-weight: 600;"> Total Qty</span>
                        <span style="border: 1px solid grey; border-radius: 5px; padding: 5px; font-weight:600; color:green;">{{ $total_qty }}</span>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
            @else
                @if($current == $list_details[$i + 1]->store_name)
                    @if($i > $count-1)
                        
                    @else
                        
                    @endif
                @else
                    <tr style="background-color: #efe9e5; " id="subtotal_by_store_row">
                        <td></td>
                        <td style="color: rgb(255,127,39);">{{ strtoupper($list_details[$i]->store_name) }}</td>
                        <td class="col-sm-3 center-image hidden-xs"></td>
                        <td align="right" id="subtotal_by_store" class="subtotal_by_store">
                            <span style="font-size:10px; font-weight: 600;">Subtotal </span>
                            <span style="border: 1px solid grey; border-radius: 5px; padding: 5px; font-weight:600; color:red;">
                                <img style="height: 13px;" src="/css/wsis/images/peso1.png" alt="">    
                                {{ number_format($total,2) }} 
                            </span> 
                        </td>
                        <td align="right"  class=""> 
                            <span style="font-size:10px; font-weight: 600;"> Total Qty</span>
                            <span style="border: 1px solid grey; border-radius: 5px; padding: 5px; font-weight:600; color:green;">{{ $total_qty }}</span>
                        </td>
                        <td></td>
                        <td class=""></td>
                    </tr>
                    <tr style="background: lightgray;">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class=""></td>
                        <td class="col-sm-3 center-image hidden-xs"></td>
                    </tr>
                @endif
            @endif

        @endfor
    </tbody>
</table>

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

    //INPUT PRODUCT NAME
    if( $('#add_product_name').val("") )
    {
        $('#add_store_name').prop('disabled', true);
    }
    else
    {
        $('#add_store_name').prop('disabled', false);
    }

    $('#add_product_name').change(function(e){
        if( $('#add_product_name').val() == "")
        {
            $('#add_store_name').prop('disabled', true);
            $('#add_store_name').val("");
            $('#add_product_price').val(0);
        }
        else
        {
            $('#add_store_name').prop('disabled', false);
            $('#add_store_name').val("");
            $('#add_product_price').val(0);
            var query = $('#add_product_name').val();
            console.log(query);
            $.ajax({
                url: "/store_name/fetch_store",
                method: "POST",
                data: {query:query},
                success:function(data)
                { 
                    $('#product_id').val(data[0].product_id);
                    $('#add_store_name').prop('disabled', false);
                    // $('#select_store_name').append(data.store_name);  
                }
            });
        }

    });

    //SEARCH FOR EXISTING STORE NAME
    $('#add_store_name').keyup(function(e){
        e.preventDefault();
        var query = $(this).val();
        var query1 = $('#product_id').val();
        var prod_id = $('#product_id');
        console.log(prod_id);
        if(query != ''){
            $.ajax({
                url: "/product_price/fetch_prod_price",
                method: "POST",
                data: {query:query, query1:query1},
                success:function(data)
                {
                    $('#store_id').val(data.store_id)
                    if(data.price != ''){
                        $('#add_product_price').val(data.price);
                        console.log(data.price);
                    }else{
                        data.price = '0';
                        $('#add_product_price').val(data.price);
                        console.log("None");
                    }
                    
                }
            });
        }else{
            $('#store_list').html("").fadeOut();
        }
    });
    
    var product_name = $('#product_name');

    var table = document.getElementById("dataTables-example");
    var sumVal = 0;

    var price_array = [];
    var total_checked = $('#total_of_checked_prods').text().replace(",", "");
    price_array.push( parseFloat(total_checked) );

    $('.checker').change(function(e){
        var date_array = [];
            var e_id = $(this).attr("id");
            $.ajax({
                type: 'POST',
                url: '/get_product_details_in_list',
                data:{data: e_id},
                success:function(response)
                {
                    // swal({
                    //     title: "Product Bought",
                    //     icon: "success",
                    // });
                }
            });
            alert();
    });

    //TOGGLE OF PRODUCT TO BUY
    $('.checker').change(function(e){ 
        var products = document.querySelector('tbody');
        
        if($(this).prop("checked") == true)
        { 
            
            var product_price = parseFloat($(this).closest("tr").find("#subtotal").text().replace(",", ""));
            var store_name = $(this).closest("tr").find("#store_name").text();
            var user_list_id = $('#list_id_holder').val();

            $.ajax({
                type: 'GET',
                url: '/get_sum_of_subtotal',
                data:{store_name: store_name.toLowerCase(), id: user_list_id, product_price: product_price },
                success:function(response)
                {   
                    sumVal = parseFloat(response);
                    if(sumVal == 0 || sumVal == sumVal)
                    {
                        $.ajax({
                            type: 'GET',
                            url: '/get_sum_of_subtotal',
                            data:{store_name: store_name.toLowerCase(), id: user_list_id, product_price: product_price },
                            success:function(response)
                            {   
                                document.getElementById("total_of_checked_prods").innerHTML = parseFloat(response).toLocaleString(2); 
                                document.getElementById("total_of_checked_prods").style.color = 'green';
                                document.getElementById("total_of_checked_prods").style.fontWeight = '600';
                            }
                        });
                    }
                    else
                    {
                        $.ajax({
                            type: 'GET',
                            url: '/get_sum_of_subtotal',
                            data:{store_name: store_name.toLowerCase(), id: user_list_id, product_price: product_price },
                            success:function(response)
                            {   
                                document.getElementById("total_of_checked_prods").innerHTML = parseFloat(response).toLocaleString(2); 
                                document.getElementById("total_of_checked_prods").style.color = 'green';
                                document.getElementById("total_of_checked_prods").style.fontWeight = '600';
                            }
                        });
                    }
                }
            });

            $prod_name = $(this).closest("tr").find(".prod_name").css("text-decoration", "line-through");
            var id = $(this).attr("id");
            $.ajax({
                type: 'POST',
                url: '/check_product',
                data:{data: id},
                success:function(response)
                {
                    // swal({
                    //     title: "Product Bought",
                    //     icon: "success",
                    // });
                    
                }
            });

        }
        else
        {
            var product_price = parseFloat($(this).closest("tr").find("#subtotal").text().replace(",", ""));
            var store_name = $(this).closest("tr").find("#store_name").text();
            var user_list_id = $('#list_id_holder').val();

            $.ajax({
                type: 'GET',
                url: '/get_sum_of_unchecked',
                data:{store_name: store_name.toLowerCase(), id: user_list_id, product_price: product_price },
                success:function(response)
                {
                    sumVal = parseFloat(response);
                    if(sumVal == 0 || sumVal == sumVal)
                    {
                        $.ajax({
                            type: 'GET',
                            url: '/get_sum_of_subtotal',
                            data:{store_name: store_name.toLowerCase(), id: user_list_id, product_price: product_price },
                            success:function(response)
                            {   
                                var last_value = parseFloat(response);
                                document.getElementById("total_of_checked_prods").innerHTML = last_value.toFixed(2); 
                                document.getElementById("total_of_checked_prods").style.color = 'green';
                                document.getElementById("total_of_checked_prods").style.fontWeight = '600';
                            }
                        });
                    }
                    else
                    {
                        $.ajax({
                            type: 'GET',
                            url: '/get_sum_of_subtotal',
                            data:{store_name: store_name.toLowerCase(), id: user_list_id, product_price: product_price },
                            success:function(response)
                            {   
                                var last_value = parseFloat(response);
                                document.getElementById("total_of_checked_prods").innerHTML = last_value.toFixed(2); 
                                document.getElementById("total_of_checked_prods").style.color = 'green';
                                document.getElementById("total_of_checked_prods").style.fontWeight = '600';
                            }
                        });
                    }
                }
            });

            $prod_name = $(this).closest("tr").find(".prod_name").css("text-decoration", "none");
            var id = $(this).attr("id");
            $.ajax({
                type: 'POST',
                url: '/uncheck_product',
                data:{data: id},
                success:function(response)
                {
                    
                }
            });

        }

    });

 
    var array = Array();
    //SHARE LIST
    $('.share_list').on('click', function(){
      
        var id = $(this).attr("id");
        $.ajax({
            type: 'POST',
            url: '/get_list_details',
            data:{data: id},
            success:function(response)
            {
                var list_id_holder = $('#list_id_holder').val();
                $.ajax({
                    type: 'POST',
                    url: '/share_list',
                    data:{data: list_id_holder},
                    success:function(response)
                    {
                        swal("Done!", "List Successfully Shared", "success");
                        setTimeout(location.reload());
                    }
                });
            }
        });
        // swal({
            // title: "Are you sure?",
            // text: "Confirm to Share List",
            // icon: "info",
            // buttons: true,
            // })
            // .then((willDelete) => {
            //     if (willDelete) {
                    
                // }else{
                    
                // } 
            // });
       
    });

    //UNSHARE LIST
    $('.unshare_list').on('click', function(){
        var id = $(this).attr("id");
        var list_id_holder = $('#list_id_holder').val();
        $.ajax({
            type: 'POST',
            url: '/unshare_list',
            data:{data: list_id_holder},
            success:function(response)
            {
                swal("Done!", "List Successfully Unshared", "warning");
                setTimeout(location.reload(), 8000);
            }
        });
        // swal({
        //     title: "Are you sure?",
        //     text: "Confirm to Un-Share List",
        //     icon: "warning",
        //     buttons: true,
        //     })
        //     .then((willDelete) => {
        //         if (willDelete) {
                    
        //         }else{
                    
        //         } 
        //     });
       
    });

    //DELETE LIST
    $('.delete_list').on('click', function(){
        var id = $(this).attr("id");
        swal({
            title: "Are you sure?",
            text: "Confirm to Delete List",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: 'POST',
                        url: '/delete_list',
                        data:{data: id},
                        success:function(response){
                            
                        }
                    });
                    swal("Done!", "List Successfully Deleted", "success");
                }else{
                    
                }
            location.href= "/profile"; 
            });
    });

    //DELETE ITEM
    $('.delete_item').on('click', function(){
        var id = $(this).attr("id");
        swal({
            title: "Are you sure?",
            text: "Confirm to Delete the Product",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $(this).parent().parent().remove();
                    $.ajax({
                        type: 'POST',
                        url: '/delete_item',
                        data:{data: id},
                        success:function(response){
                            swal("Done!", "It was succesfully Deleted!", "success");
                            setTimeout(location.reload(), 10);
                        }
                    });
                }else{
                    
                }
            });
    });

    //SHOW THE ITEM IN MODAL TO UPDATE
    $('.update_item').on('click', function(){
        var id = $(this).attr("id");
        $('#list_detail_id_holder').val(id);
        $.ajax({
            type: 'POST',
            url: '/show_item',
            data:{data: id},
            success:function(response){
                $.ajax({
                    type: 'POST',
                    url: '/show_item',
                    data:{data: id},
                    success:function(response){
                        $('#update_product_name').val(response[0]['product_name']);
                        $('#update_store_name').val(response[0]['store_name'].toUpperCase());
                        $('#update_qty').val(response[0]['quantity']);
                        $('#update_product_price').val(response[0]['product_price'].toLocaleString(2));
                        
                        $('#old_price_holder').val(response[0]['product_price'].toLocaleString(2));
                        $('#old_store_name_holder').val(response[0]['store_name'].toUpperCase());

                        var query = $('#update_product_name').val();
                        $.ajax({
                            url: "/store_name/fetch_store",
                            method: "POST",
                            data: {query:query},
                            success:function(data)
                            { 
                                console.log(data[0].product_id);
                                $('#update_product_id_holder').val(data[0].product_id);  
                            }
                        });
                        
                    }
                });
            }
        });

        
    });

    //SHOW LIST NAME TO UPDATE
    $('.update_list_name_btn').on('click', function(){
        var id = $(this).attr("id");
        $.ajax({
            type: 'POST',
            url: '/show_list_name',
            data:{data: id},
            success:function(response){
                $('#update_list_name').val(response['list_name']);
                $('#update_remarks').val(response['remarks']);
            }
        });
    });

    //ADD ITEM
    $('#add_row').on('click', function(){
        var product_name = $('#add_product_name').val();
        var store_name = $('#add_store_name').val();
        var product_price = $('#add_product_price').val();
        var qty = $('#add_qty').val();
        var user_list_id = $('#list_id_holder').val();
        var product_id = $('#product_id').val();
        var products_to_add = Array();

        var product = {
            'product_name': product_name,
            'store_name': store_name,
            'qty': qty,
            'product_price': product_price,
            'subtotal': (qty * product_price),
            'user_list_id': user_list_id,
            'product_id': product_id
        }
        $.ajax({
            type: 'POST',
            url: '/add_product_to_list',
            data:{data: product},
            success:function(response){
                setTimeout(location.reload(), 4000);
            }    
        });
        $('#add_product_name').val("");
        $('#add_product_price').val("");
        $('#add_store_name').val("");
    })
});
 
</script>
