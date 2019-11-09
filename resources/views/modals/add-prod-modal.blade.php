<div style="" class="modal fade in" id="addproductmodal" tabindex="-1" role="dialog" style="display: none; padding-right: 17px;">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body modal-body-sub_agile">
                <div class="modal_body_left modal_body_left1">
                    <h3 class="agileinfo_sign">Share Product Now</h3>
                    {{-- <p>
                        Come join the Grocery Shoppy! Add a Product Now.
                    </p> --}}
                    <form action="/addproduct" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="styled-input agile-styled-input-top">
                            <input list="searched_prod_name" type="text" class="newsletter_input" placeholder="Product Name" name="product_name" id="product_name" required="">
                            {{-- <input onfocusout="myFunction()" type="text" placeholder="Product Name" name="product_name" id="product_name" required=""> --}}
                            <datalist id="searched_prod_name">
                                @foreach($products_for_add_product as $product)
                                    <option value="{{ucwords($product->product_name)}}"></option>
                                @endforeach
                            </datalist>
                            {{-- <div style="margin-top: -20xp;" id="product_list"></div> --}}
                        </div>
                        <br>

                        <div class="styled-input">
                            <input type="text" class="newsletter_input" placeholder="Product Price" name="product_price" id="product_price" required="">
                            {{-- <input type="text" placeholder="Product Price" name="product_price" id="product_price" required=""> --}}
                        </div><br>
                        <div class="styled-input">
                            <input list="searched_store_name" style="text-overflow: ellipsis; " type="text" class="newsletter_input" placeholder="Store(Please Enter the location or desription of the store" name="store_name" id="store_name" required="">
                            {{-- <input type="text" placeholder="Store" name="store_name" id="store_name" required=""> --}}
                            <datalist id="searched_store_name">
                                @foreach($store_names_for_add_product as $store_name)
                                    <option value="{{ ucwords($store_name->store_name) }}"> </option>
                                @endforeach
                            </datalist>
                            {{-- <div style="margin-top: -20xp;" id="store_list"></div> --}}
                        </div>
                        <br>
                        
                        <div class="styled-input">
                            @guest

                            @else
                                <div style="display:none">
                                    {!!
                                        $location = App\User::select('location')->where('id', auth()->user()->id)->get();
                                    !!}
                                </div>
                                <input list="locations" type="text" class="newsletter_input" placeholder="Location of Store" name="location" id="location" value="{{ ucwords($location[0]['location']) }}" required="">
                                {{-- <input type="text" placeholder="Store" name="store_name" id="store_name" required=""> --}}
                                <datalist id="locations">
                                    @foreach($location_names as $location_name)
                                        <option value="{{ ucwords($location_name->location) }}"></option>
                                    @endforeach
                                </datalist>
                            @endguest
                        </div>
                        <br>

                        <div class="styled-input">
                            {{-- <input type="text" class="newsletter_input" placeholder="Category" name="category" id="category" required=""> --}}
                            {{-- <input type="text" placeholder="Store" name="store_name" id="store_name" required=""> --}}
                            <select id="category" name="category" class="newsletter_input" style="margin-left: -0px; color:black;" required>
                                <option value="" disabled selected>Choose Category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" style="color:black;">{{ucwords($category->category_name)}}</option>
                                @endforeach
                            </select>
                            <div style="margin-top: -20xp;" id="store_list"></div>
                        </div>
                        <br>

                        <div class="styled-input" >
                            <label >Select image to Upload</label>
                            <input class="newsletter_input pull-right" type="file" value="/storage/public_images/default-product.jpg" name="image" id="image"><span>(Optional)</span>
                        </div><br>
                        
                        <button class="btn btn-info" type="submit">Submit </button>
                        <input type="hidden" value="{{ csrf_token() }}" name="_token">
                    </form>
                </div>
            </div>
        </div>
        <!-- //Modal content-->
    </div>
</div>

<script>
//Trap for number entry
$('#product_price').on('keyup', function(){
        $prod_price = $('#product_price').val();
        if(isNaN($prod_price)){
            $('#product_price').val("");
        }else{
            $prod_price = $('#product_price').val();
        }
    });
</script>