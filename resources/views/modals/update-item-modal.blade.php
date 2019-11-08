<div class="modal fade in" id="update-item-modal" tabindex="-1" role="dialog" style="display: none; padding-right: 17px;">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="agileinfo_sign">Update Item</h3>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body modal-body-sub_agile">
                <div class="main-mailposi">
                    <span class="fa fa-envelope-o" aria-hidden="true"></span>
                </div>
                <div class="modal_body_left modal_body_left1">
                    <form action="" method="post" enctype="">
                        @csrf
                        <div class="styled-input agile-styled-input-top">
                                <p>Product Name</p>
                            <input disabled type="text" class="newsletter_input" placeholder="Product Name" name="product_name" id="update_product_name" >
                            {{-- <input onfocusout="myFunction()" type="text" placeholder="Product Name" name="product_name" id="product_name" required=""> --}}
                            <div style="margin-top: -20xp;" id="product_list"></div>
                        </div><br>
                        <div class="styled-input">
                                <p>Store</p>
                            <input list="store_names" type="text" class="newsletter_input" placeholder="Store" name="store_name" id="update_store_name" >
                            {{-- <input type="text" placeholder="Store" name="store_name" id="store_name" required=""> --}}
                            <datalist id="store_names">
                                @foreach($stores as $store)
                                    <option value="{{ strtoupper($store->store_name) }}"></option>
                                @endforeach
                            </datalist>
                            {{-- <div style="margin-top: -20xp;" id="store_list"></div> --}}
                        </div><br>
                        <div class="styled-input">
                                <p>Quantity</p>
                            <input type="text" class="newsletter_input" placeholder="Quantity" name="qty" id="update_qty" >
                            {{-- <input type="text" placeholder="Product Price" name="product_price" id="product_price" required=""> --}}
                        </div><br>
                        <div class="styled-input">
                                <p>Price</p>
                            <input type="text" class="newsletter_input" placeholder="Product Price" name="product_price" id="update_product_price" >
                            {{-- <input type="text" placeholder="Product Price" name="product_price" id="product_price" required=""> --}}
                        </div><br>
                        <div class="styled-input">
                            <div style="margin-top: -20xp;" id="store_list"></div>
                        </div><br>
                        <input type="hidden" value="" id="list_detail_id_holder">
                        <input type="hidden" value="" id="old_price_holder">
                        <input type="hidden" value="" id="old_store_name_holder">

                        <input type="hidden" value="" id="update_product_id_holder">

                        <button data-dismiss="modal" id="update_item_btn" class="btn btn-info" type="button">Submit </button>
                        <input type="hidden" value="{{ csrf_token() }}" name="_token">
                    </form>
                </div>
            </div>
        </div>
        <!-- //Modal content-->
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

<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        

        //SEARCH FOR EXISTING STORE NAME
        $('#update_store_name').keyup(function(e){
            e.preventDefault();
            var query = $(this).val();
            var query1 = $('#update_product_id_holder').val();
            var prod_id = $('#update_product_id_holder');
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
                            $('#update_product_price').val(data.price);
                            $('#old_store_name_holder').val(query);
                            $('#old_price_holder').val($('#update_product_price').val())
                            console.log(data.price);
                        }else{
                            data.price = '0';
                            $('#update_product_price').val(data.price);
                            $('#old_store_name_holder').val(query);
                            $('#old_price_holder').val($('#update_product_price').val())
                            console.log("None");
                        }
                        
                    }
                });
            }else{
                $('#store_list').html("").fadeOut();
            }
        });


        //Update Product
        $('#update_item_btn').unbind().click(function(){
            var list_details_id = $('#list_detail_id_holder').val();
            var product_name = $('#update_product_name').val();
            var store_name = $('#update_store_name').val();
            var qty = $('#update_qty').val();
            var product_price = $('#update_product_price').val();

            update_item = {
                'product_name': product_name,
                'store_name': store_name.toLowerCase(),
                'qty': qty,
                'product_price': product_price,
                'subtotal': qty * product_price
            }

            swal({
            title: "Are you sure?",
            text: "Confirm to Update the Product",
            icon: "info",
            buttons: true,
            })
            .then((willUpdate) => 
            {
                if (willUpdate) 
                {
                    // $(this).parent().parent().remove();
                    $.ajax({
                        type: 'POST',
                        url: '/update_item/'+ list_details_id,
                        data:{data: update_item},
                        success:function(response)
                        {

                            if( $('#old_price_holder').val() !=  $('#update_product_price').val() && $('#old_store_name_holder').val() == $('#update_store_name').val() )
                            {
                                $.ajax({
                                    type: 'POST',
                                    url: '/get_post_detail',
                                    data:{query1: product_name, query2: store_name},
                                    success:function(response){
                                        var share_post_details = {
                                            product_id: response[0]['product_id'],
                                            store_id: response[0]['store_id'],
                                            product_price: product_price,
                                            category_id: response[0]['category_id']
                                        }

                                        $.ajax({
                                            type: 'POST',
                                            url: '/add_post_details',
                                            data:{data: share_post_details},
                                            success:function(response){
                                                console.log(response)
                                                swal("Done!", "It was succesfully Updated!", "success");
                                                setTimeout(location.reload(), 4000);
                                            }
                                        });

                                    }
                                });
                            }
                            else
                            {
                                swal("Done!", "It was succesfully Updated!", "success");
                                setTimeout(location.reload(), 4000);
                            }
                            setTimeout(location.reload(), 4000);
                        }
                    });
                    swal("Done!", "It was succesfully Updated!", "success");
                    // setTimeout(location.reload(), 4000);
                }
                else
                {
                   
                }
            });
        });
    });
    
</script>