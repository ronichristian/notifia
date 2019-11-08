@foreach($all_products as $product)
    <div style="display: inline-block;" class="product_item is_new">
        <div class="product_border"></div>
        <div class="product_image d-flex flex-column align-items-center justify-content-center">
            @guest
            <a href="/view_product_guest/{{$product->id}}/info">
                <img src="/storage/product_images/{{$product->avatar}}" alt="">
            </a>
            @else
            <a href="/view_product/{{$product->id}}/info">
                <img src="/storage/product_images/{{$product->avatar}}" alt="">
            </a>
            @endguest
        </div>
        <div class="product_content">
            <div style="color:red;" class="product_price">
                <div style="display:none;">
                    {!!
                        $latestprice = App\PostDetails::where('product_id', $product->id)
                                        ->orderBy('created_at', 'desc')->limit(1)->get();
                        $minprice = App\PostDetails::where('product_id', $product->id)->min('product_price');       
                        $maxprice = App\PostDetails::where('product_id', $product->id)->max('product_price');
                    !!}
                </div>
                @if($minprice == $maxprice)
                    P{{number_format($minprice,2)}}
                @else
                    P{{number_format($minprice,2)}} ~ P{{number_format($maxprice,2)}}
                @endguest 
            </div>
            <div class="product_name">
                <div>
                    @guest
                        <a href="/view_product_guest/{{$product->id}}/info" tabindex="0">
                            {{ucwords($product->product_name)}}
                        </a>
                    @else
                        <a href="/view_product/{{$product->id}}/info" tabindex="0">
                            {{ucwords($product->product_name)}}
                        </a>
                    @endguest
                </div>
            </div>
        </div>
        <div style="background-color: rgb(255,127,39);" class="product_fav">
            <i class="fa fa-hear"></i>
            @guest
                <a href="/view_product_guest/{{$product->id}}/info">
                    <p style="margin-top: 8px; color:white; font-size: 12px;">view</p>
                </a>
            @else
                <a href="/view_product/{{$product->id}}/info">
                    <p style="margin-top: 8px; color:white; font-size: 12px;">view</p>
                </a>
            @endguest
        </div>
        <ul class="product_marks">
                
        </ul>
    </div>
@endforeach