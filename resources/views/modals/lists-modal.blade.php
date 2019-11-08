<div class="modal fade in" id="lists-modal" tabindex="-1" role="dialog" style="display: none; padding-right: 17px;">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="agileinfo_sign" style="color:deepskyblue;">Add It To Your List!</h3>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body modal-body-sub_agile">
                <div class="main-mailposi">
                    <span class="fa fa-envelope-o" aria-hidden="true"></span>
                </div>
                <div class="modal_body_left modal_body_left1">
                    {{-- <input type="hidden" id="product_id_holder" value="{{$store->product_id}}"> --}}
                    {{-- <input type="text" id="store_id_holder" value=""> 
                    <input type="text" id="product_price_holder" value="">  --}}
                    <input type="hidden" id="post_details_id" value=""> 
                    
                    {{-- <input id="store_name_holder" value="{{$store->store_name}}" type="hidden"> --}}
                    
                    <div class="snipcart-details top_brand_home_details item_add single-item ">
                        <div style="display:inline-block;" class="special-sec1">
                            @if(count($user_lists) > 0)
                                @foreach($user_lists as $user_list)
                                    <div class="col-xs-4 img-deals">
                                        <img style="width:50px; height:50px;" src="/uploads/images/default-product.jpg" alt="">
                                    </div>
                                    <div class="col-xs-8 img-deal1">
                                        <h3 style="color: rgb(255,127,39);">{{ strtoupper($user_list->list_name) }}</h3>
                                        <div class="info-product-price">
                                            <button style="cursor:pointer; " type="button" id="{{$user_list->id}}" class="btn btn-info btn-sm list" data-dismiss="modal">
                                                Add To List <i class="fa fa-share"></i>
                                            </button>
                                            {{-- <input type="button" id="{{$user_list->id}}" value="Add To This List<i></>" class="btn btn-success btn-sm list" data-dismiss="modal"> --}}
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                @endforeach
                            @else
                                <p>You Have No List yet</p>return $output;
                            @endif 
                        </div>
                    </div>
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
{{-- <script type="text/javascript" src="/js/import/toastr.min.js"></script> --}}
<!-- toaster notification -->
{{-- <link rel="stylesheet" type="text/css" href="/js/import/toastr.min.css"/> --}}
<script>
    $(document).ready(function(){
        $.ajaxSetup({
        headers: {
            	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

        $btn = $('.list');
        $btn.on('click', function(){
            var product_name = $('.product_name').text();
            var store_id = $('#store_name_holder').val();
        
			var store_id_holder = $('#store_id_holder').val();
			var product_id_holder = $('#product_id_holder').val();
			var product_price_holder = $('#product_price_holder').val();
            var list_id = $(this).attr("id");

            var post_details_id = $('#post_details_id').val();


            swal({
            title: "Are you sure?",
            text: "Confirm to Add Product to the List",
            icon: "info",
            buttons: true,
            })
            .then((willUpdate) => 
            {
                if (willUpdate) 
                {
                    $.ajax({
                        url: '/get_details',
                        method: "GET",
                        data: {id :post_details_id},
                        success:function(response)
                        {
                            item = {
                                'list_id': list_id,
                                'product_name': response[0]['product_name'],
                                'store_name': response[0]['store_name'],
                                'product_price': response[0]['product_price'],
                                'product_id': response[0]['product_id'],
                                'is_checked': 0
                            }   

                            $.ajax({
                                url: '/add_to_list',
                                method: "POST",
                                dataType: 'json',
                                data: {data: item},
                                success:function(data)
                                {
                                    swal("Done!", "Product Successfully Added to List", "success");
                                }
                            });
                            
                        }
                    });
               
                }
                else
                {
                   
                }
            });

        })

    });
</script>