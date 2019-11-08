@extends('layouts.create_list_layout')

@section('content')
@include('modals.add-prod-modal')
<div style="" class="cart_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form method="POST" id="create_list_form" style="margin-top: -9%;">
                    <div class="cart_container">
                        <div class="cart_title" style="border-radius:5px; background:paleturquoise; color:black; font-family: Impact">
                            <span style="margin-left: 1%; font-weight: 100;"> Create Your List Now </span>
                        </div>
                        <div style="margin-top: -0%;" class="cart_items">
                            <ul class="cart_list">
                                <li class="cart_item clearfix">
                                    <input style="color: #3e64ff; height: 40px; font-size:20px;" id="list_name" name="list_name" type="text" class="form-control " placeholder="Enter Your List Name..." required/><br>
                                    <div style="display:none">
                                        {!!
                                            $location = App\User::select('location')->where('id', auth()->user()->id)->get();
                                        !!}
                                    </div>
                                    <input style="color: #3e64ff;" value="{{ strtoupper($location[0]['location']) }}" list="location_names" id="location" name="location" type="text" class="form-control " placeholder="Location" required/><br>
                                    <datalist id="location_names">
                                        @foreach($location_names as $location_name)
                                            <option>{{ $location_name->location }}</option>
                                        @endforeach
                                    </datalist>
                                    <textarea id="remarks" class="form-control" placeholder="Remarks (Optional)"></textarea>
                                    <hr>
                                    <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                        <div id="list_prod" class="cart_item_quantity cart_info_col">
                                            <div class="form-group has-success">Product Name</div>    
                                            <input style="color: #3e64ff; width: 118%; white-space:nowrap;" id="p_name" name="p_name" type="text" class="form-control" list="searched_prod_name" />
                                            <datalist id="searched_prod_name">
                                                @foreach($products as $product)
                                                <option value="{{ucwords($product->product_name)}}"></option>
                                                @endforeach
                                            </datalist>
                                            {{-- <div style="margin-top: -20xp;" id="p_list"></div> --}}
                                            <input id="product_id" type="hidden" value="">
                                        </div>
                                        
                                        <div style="" id="list_store" class="cart_item_quantity cart_info_col">
                                            <div class="form-group has-success">Store</div>
                                            <input style="color: #3e64ff;" class="form-control select_store_name" id="select_store_name" list="stores" name="select_store_name">
                                                <datalist id="stores" id="s_name">
                                                    <option value="" disabled selected>Choose your option</option>
                                                    @foreach($store_names_for_add_product as $store_name)
                                                        <option value="{{ $store_name->store_name }}"> </option>
                                                    @endforeach
                                                </datalist>
                                            <input id="store_id" type="hidden" value="">
                                            <input id="post_detail_id" type="hidden" value="">
                                        </div>

                                        <div id="quantity" class="cart_item_quantity cart_info_col">
                                            <div class="form-group has-success">Quantity</div>    
                                            <input style="color: #3e64ff; width:60px;" value="1" id="qty" name="qty" type="number" class="form-control"/>
                                        </div>
                                        <div id="list_price" class="cart_item_quantity cart_info_col">
                                                <div class="form-group has-success">Price</div>    
                                                <input style="color: red; width:150px;" id="p_price" value="0" name="p_price" type="text" class="form-control" placeholder="Price"/>
                                            </div>
        
                                        <button style="margin-top: 42px; height: 30px; color:white; cursor:pointer;" id="display" type="button" class="btn btn-primary btn-sm">Display</button> 

                                        <div id="list_action" class="cart_item_price cart_info_col">
                                        
                                            <input style="display:none;" id="list_name" name="list_name" type="text" class="form-control " placeholder="Enter Your List Name..."/>
                                        
                                        </div>
                                    </div>
                                </li>
                                <div style="white-space:nowrap;" class="table-responsive">
                                    <table style="" class="table table-striped table-bordered table-hover" id="table">
                                        <thead>
                                            <tr>
                                                <td>Product Name</td>
                                                <td>Store</td>
                                                <td>Quantity</td>
                                                <td>Product Price</td>
                                                <td>Subtotal</td>
                                                <td>Action</td>
                                            </tr>
                                        </thead>
                                        <tbody id="table_list">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </ul>
                        </div>
                        
                        <!-- Order Total -->
                        <div style="margin-top: -0%;" class="order_total">
                            <div class="order_total_content text-md-left">
                                <div style="float: right;" class="order_total_title">
                                    Total:
                                    <span style="color:red; ">
                                        <img style="height: 13px;" src="/css/wsis/images/peso1.png" alt="">
                                        <span id="total">0.00</span>
                                    </span>
                                </div>
                                {{-- <div style="color:red; margin-left: 2%;" id="total" class="order_total_amount"></div> --}}
                            </div>
                        </div>

                        <div style="margin-top: -0.0%;" class="cart_buttons">
                            <button style="color:white; cursor:pointer;" id="save" type="submit" class="btn btn-primary btn-sm">Save List</button>
                            <button style="color:white; cursor:pointer;" id="reset" type="reset" class="btn btn-success btn-sm">Clear List</button>
                        </div>
                    
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div style="margin-top: -5.5%; " class="new_arrivals">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="cart_section">
                    <div style="margin-top: -17%;" class="container">
                        <div class="row">

                            <div class="col-lg-12 ">
                                <div class="cart_container">
                                    <div class="panel panel-default">
                                    <div class="panel-heading">
                                            
                                    </div>
                                        <div class="panel-body">
                                            <div style="white-space:nowrap;" class="table-responsive">
                                                <table style="" class="table table-striped table-bordered table-hover" id="example">
                                                    <thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            @foreach($store_names_for_add_product as $store_name)
                                                                <th>
                                                                    <img style="height: 20px;" src="/css/wsis/images/grocery-store5.jpg" alt="">
                                                                    {{ ucwords($store_name->store_name) }}
                                                                </th>
                                                            @endforeach
                                                            <th>Image</th>
                                                            <th><img style="height: 10px;" src="/css/wsis/images/peso1.png" alt="">Lowest Price</th>
                                                            <th><img style="height: 10px;" src="/css/wsis/images/peso1.png" alt="">Highest Price</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($products_compare as $product_compare)
                                                        <tr>
                                                            <td>
                                                                @guest
                                                                <a href="#">
                                                                    {{ ucwords($product_compare->product_name) }}
                                                                </a>
                                                                @else
                                                                <a href="#">
                                                                    {{ ucwords($product_compare->product_name) }}
                                                                </a>
                                                                @endguest
                                                            </td>
                                                           
                                                            @for($i=0; $i < count($store_names); $i++)
                                                                <div style="display:none;">
                                                                    {!!
                                                                        $store_id = App\PostDetails::select('store_id')
                                                                                    ->where('store_id', $store_names[$i]->id)
                                                                                    ->get();
                                                                        $price = App\PostDetails::select('product_price')
                                                                                    ->where('product_id', $product_compare->id)
                                                                                    ->where('store_id', $store_id[0]['store_id'])
                                                                                    ->orderBy('created_at', 'desc')
                                                                                    ->get();
                                                                        $store_name = App\PostDetails::join('stores', 'stores.id', '=', 'post_details.store_id')
                                                                                    ->select('store_name')
                                                                                    ->where('store_id', $store_id[0]['store_id'])
                                                                                    ->get();
                                                                        $second_last_price = App\PostDetails::select('product_price')->where('product_id', $product_compare->id)->orderBy('created_at', 'desc')->skip(1)->take(1)->get();
                                                                    !!}
                                                                
                                                                @if(count($price) == 0)
                                                                    <td></td>
                                                                @else
                                                                    
                                                                    @if(count($second_last_price) != 0)
                                                                        @if($second_last_price[0]['product_price'] < $price[0]['product_price'])
                                                                            <td class="pin_price" style="color:red; margin-top: -1%;" align="right">
                                                                                <a><img style="height: 10px;" src="/css/wsis/images/red-arrow.png">
                                                                                {{ number_format($price[0]['product_price'],2)  }}</a>
                                                                                <input type="hidden" class="store_name_holder" value="{{ $store_name[0]['store_name'] }}">
                                                                            </td>
                                                                        @elseif($second_last_price[0]['product_price'] > $price[0]['product_price'])
                                                                            <td class="pin_price" style="color:green;" align="right">
                                                                                <a><img style="height: 10px; margin-top: -1%;" src="/css/wsis/images/green-arrow.png">
                                                                                {{ number_format($price[0]['product_price'],2)  }}</a>
                                                                                <input type="hidden" class="store_name_holder" value="{{ $store_name[0]['store_name'] }}">
                                                                            </td>
                                                                        @elseif($second_last_price[0]['product_price'] == $price[0]['product_price'])
                                                                            <td class="pin_price" align="right">
                                                                                <a>{{ number_format($price[0]['product_price'],2)  }}</a>
                                                                                <input type="hidden" class="store_name_holder" value="{{ $store_name[0]['store_name'] }}">
                                                                            </td>
                                                                        @endif
                                                                    @else
                                                                        <td class="pin_price" align="right">
                                                                            <a>{{ number_format($price[0]['product_price'],2)  }}</a>
                                                                            <input type="hidden" class="store_name_holder" value="{{ $store_name[0]['store_name'] }}">
                                                                        </td>
                                                                    @endif
                                                                @endif
                                                            @endfor
                                                            
                                                            <td align="center"><img class="thumbnail" style="height: 20px;" id="tr_show_hover" src="data:{{$product_compare->avatar}};base64,{{$product_compare->avatar}}"></td>
                                                            <td style="color:green;" align="right">
                                                                {!! 
                                                                number_format($minprice = App\PostDetails::where('product_id', $product_compare->id)->min('product_price'),2); 
                                                                !!}
                                                            </td>
                                                            <td style="color:red;" align="right">
                                                                {!! 
                                                                number_format($maxprice = App\PostDetails::where('product_id', $product_compare->id)->max('product_price'),2); 
                                                                !!}
                                                            </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
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

{{-- <script src="/js/import/search.js"></script> --}}

<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        // SELECT PRICE FROM STORE IN THE TABLE
        $('.pin_price').on( 'click', function () {
            $('html,body').animate({
                scrollTop: $("#list_name").offset().top},
            'slow');
            var get_product_name = $(this).closest('tr').children('td:first').text().trim();
            var get_store_name = $(this).find('input').val();
            var get_product_price = $(this).text().trim();
            var query = get_product_name;
            $.ajax({
                url: "/store_name/fetch_store",
                method: "POST",
                data: {query:query},
                success:function(data)
                { 
                    $('#product_id').val(data[0].product_id);
                }
            });
            $('#select_store_name').css('background-color', 'white');
            $('#p_name').val(get_product_name);
            $('#select_store_name').val(get_store_name);
            $('#p_price').val(get_product_price);
            $('#display').prop('disabled', false);
            
        });

        // DISABLE VALIDATION FOR DISPLAY BUTTON
        $('#display').attr("disabled", "false");
        $('#p_name').change(function(){
            if($(this).val().length != 0)
            {
                $('#select_store_name').change(function(){
                    if($(this).val().length != 0)
                    {
                        $('#display').attr('disabled', false);
                    }         
                    else
                    {
                        $('#display').attr('disabled',true);
                    }
                });
            }
        });
        
        // INPUT PRODUCT NAME
        if($('#p_name').val() == "")
        {
            $('#select_store_name').prop('disabled', true);
        }
        else
        {
            $('#select_store_name').prop('disabled', false);
        }
        
        $('#p_name').change(function(e){
            if($('#p_name').val() == "")
            {
                $('#select_store_name').prop('disabled', true);
                $('#select_store_name').val("");
            }
            else
            {
                $('#select_store_name').prop('disabled', false);
                $('#select_store_name').val("");
                var query = $('#p_name').val();
                console.log(query);
                $.ajax({
                    url: "/store_name/fetch_store",
                    method: "POST",
                    data: {query:query},
                    success:function(data)
                    { 
                        console.log(data[0].product_id);
                        $('#product_id').val(data[0].product_id);
                        $('#select_store_name').css('background-color', 'white');  
                    }
                });
            }
          
        });
            
        // SEARCH FOR EXISTING STORE NAME
        $('#select_store_name').keyup(function(e){
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
                            $('#p_price').val(parseFloat(data.price).toFixed(2));
                            console.log(data.price);
                        }else{
                            data.price = '0';
                            $('#p_price').val(parseFloat(data.price).toFixed(2));
                            console.log("None");
                        }
                        
                    }
                });
            }else{
                $('#store_list').html("").fadeOut();
            }
        });

        // SUM UP TOTAL COST
        function sum_up(){
            var table = document.getElementById("table_list"); 
            var sumVal = 0;
            for(var i=0; i < table.rows.length; i++)
            {
                if(table.rows.length < 1)
                {
                    document.getElementById("total").innerHTML = "."+00;
                }else
                {
                    $next = parseFloat(table.rows[i].cells[4].innerHTML);
                    sumVal += $next ;
                    document.getElementById("total").innerHTML = "" + sumVal.toFixed(2);
                }
            }
        }

        var $screen = $('#screen');
        var array = Array();
        var jsonString = JSON.stringify(array);
        var saveBtn = $('#save');
        var displayBtn = $('#display');
        
        // RESET BUTTON
        $('#reset').on('click', function(){
            $('#table_list > tr > td').remove();
            document.getElementById("total").innerHTML = "" ;
            window.location.reload(10);
        });
        
        // REMOVE BTN
        $(document).on('click', '#remove_btn' ,function () {
            $index = $(this).index('.remove_btn');
            console.log($index);
            array.splice($index,1);
            $(this).parent().parent().remove();
            sum_up();
            
            if(array.length != 0){
                sum_up();
                saveBtn.attr("disabled", false);
            }else{
                document.getElementById("total").innerHTML = "" + parseFloat(0).toFixed(2);
                saveBtn.attr("disabled", true);
            }
        });
    
        // TRAP FOR NUMERIC IN PRICE INPUT
        $('#p_price').on('keyup', function(){
            $prod_price = $('#p_price').val();
            if(isNaN($prod_price)){
                $('#p_price').val("");
            }else{
                $prod_price = $('#p_price').val();
            }
        });
    

        //DISABLE SAVE LIST BUTTON
        $('#list_name').change(function(){
            if( ((array.length != 0) && ($('#list_name').val().length != 0) && $('#location').val().length) ){
                console.log("not empty");
                saveBtn.attr("disabled", false);
            }else{
                console.log("empty");
                saveBtn.attr("disabled", true);
            }
        });
        $('#location').change(function(){
            if( ((array.length != 0) && ($('#list_name').val().length != 0) && $('#location').val().length) ){
                console.log("not empty");
                saveBtn.attr("disabled", false);
            }else{
                console.log("empty");
                saveBtn.attr("disabled", true);
            }
        });


    
        saveBtn.attr("disabled", true);
        sum_up();

        // DISPLAY BUTTON FOR ENTRIES
        $('#display').on('click',function(e){
            e.preventDefault();
            $('#select_store_name').css('background-color', '#e9ecef');

            var list = $('#list');
            var p_name = $('#p_name').val();
            var s_name = $('#select_store_name').val();

            var list = $('#list');
            var p_price = $('#p_price').val();
            var store_id = $('#store_id').val();
            var product_id = $('#product_id').val();
            
            var p_name = $('#p_name').val();
            var select_store_name = $('#select_store_name').val();
            var qty = $('#qty').val();
            var p_price = $('#p_price').val();

            //object
            CSRF = $("meta[name='csrf-token']").attr('content');
    
            items = {
                _token: CSRF,
                'p_name': p_name,
                'select_store_name': select_store_name.toLowerCase(),
                'qty': qty,
                'p_price': p_price,
                'subtotal': (qty * p_price),
                'product_id': product_id,
            }
            //push object to array
            array.push(
                items
            )
            
            //display entry
            $('#table_list').append(
                '<tr style="margin: 20%;"> id="table_row"' + 
                '<td><a href="#">'+ p_name +'</a></td>' +
                '<td style="color: rgb(255,127,39);">'+ select_store_name.toUpperCase() +'</td>' +
                '<td align="right" style="width: 8%; ">'+ qty +'</td>' +
                '<td align="right" style="width: 8%; color: red;">'+ p_price +'</td>' +
                '<td align="right" style="width: 8%; color: red;">'+ (qty * p_price).toFixed(2) +'</td>' +
                '<td style="width: 8%;"><button style="cursor:pointer;" id="remove_btn" type="button" class="btn btn-danger btn-sm remove_btn"><i class="fa fa-trash"></i></button></td>' +
                '</tr>'
            );

            if( ((array.length != 0) && ($('#list_name').val().length != 0) && $('#location').val().length) ){
                console.log("not empty");
                saveBtn.attr("disabled", false);
            }else{
                console.log("empty");
                saveBtn.attr("disabled", true);
            }

            sum_up();

            //clear
            $('#list_name_input').text(list_name);
            $('#p_name').val("");
            $('#p_price').val("");
            $('#select_store_name').val("");
            $('#select_store_name').prop('disabled', true);
            $('#select_store_name > #result').remove();
            $('#store_id').val("");
            $('#qty').val(1);
            $('#product_id').val("");
            $('#display').prop('disabled', true);
        });

        // SAVE LIST BUTTON
        $('#save').on('click',function(e){    
            document.getElementById("total").innerHTML = "";
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });
            var list_name = $('#list_name').val();
            var location = $('#location').val();
            var remarks = $('#remarks').val();
            list_label = {
                'list_name': list_name,
                'location': location.toLowerCase(),
                'remarks': remarks,
            }
            swal({
            title: "Are you sure?",
            text: "Confirm to Save Your List",
            icon: "info",
            buttons: true,
            })
            .then((willSave) => {
                if (willSave) {
                    $.ajax({
                        type: 'POST',
                        url: '/create_list/list',
                        cache: false,
                        data: {
                            arr: array,
                            arr1: list_label
                        },
                        dataType: 'json',
                        success:function(response)
                        {
                            swal("Done!", "List Successfully Saved!", "success");
                            window.location.reload(2000);
                            saveBtn.attr("disabled", true);
                            $('#list').html("");
                            $('#list_name').val("");
                            $('#list_prod').val("");
                            $('#list_price').val("");
                            $('#list_store').val("");
                            $('#location').val("");
                            $('#remarks').val("");
                            $('#p_name').val("");
                            $('#p_price').val("");
                            $('#select_store_name').val("");
                            $('#table_list > tr > td').remove();
                            array = Array();
                            list_label = {};
                            items = {};
                        },
                    });
                }else{
                    swal("", "Take time to make your list", "info");
                    
                }
            });
        });
    });
</script>
@endsection