<div style="margin-top: -6%;" class="new_arrivals">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="cart_section">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 ">
                                <div class="cart_container">
                                    <div class="panel panel-default">
                                    <div class="panel-heading">
                                            
                                    </div>

                                        <div style="margin-left: -5%; width: 110%;" class="panel-body">
                                            <div class="table-responsive">
                                                <table style="white-space:nowrap;" class="table table-striped table-bordered" id="example">
                                                    <thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Image</th>
                                                            @foreach($store_names_for_add_product as $store_name)
                                                                <th>
                                                                    <img style="height: 20px;" src="/css/wsis/images/grocery-store5.jpg" alt="">
                                                                    {{ ucwords($store_name->store_name) }}
                                                                </th>
                                                            @endforeach
                                                            <th>Lowest Price</th>
                                                            <th>Highest Price</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($products_compare as $product_compare)
                                                        <tr>
                                                            <td>
                                                                @guest
                                                                <a style="font-weight:600;" href="/view_product_guest/{{$product_compare->id}}/info">
                                                                    {{ ucwords($product_compare->product_name) }}
                                                                </a>
                                                                @else
                                                                <a style="font-weight:600;" href="/view_product/{{$product_compare->id}}/info">
                                                                    {{ ucwords($product_compare->product_name) }}
                                                                </a>
                                                                @endguest
                                                            </td>
                                                            <td align="center">
                                                                <span style="border: 1px solid gray; border-radius: 5px; padding: 4%;">                                                              
                                                                    {{-- <img id="thumbnail" class="thumbnail" style="height: 20px;" id="tr_show_hover" src="/storage/product_images/{{$product_compare->avatar}}" alt="{{$product_compare->avatar}}"> --}}
                                                                    {{-- <img id="thumbnail" class="thumbnail" style="height: 20px;" id="tr_show_hover" src="data:{{$product_compare->avatar}};base64,{{$product_compare->avatar}}  " alt="{{$product_compare->avatar}}"> --}}
                                                                    {{-- <img id="thumbnail" class="thumbnail" style="height: 20px;" src="avatar/{{ $product_compare->id }}" alt=""> --}}
                                                                    <img id="thumbnail" class="thumbnail" style="height: 20px;" src="{{$product_compare->getPicture($product_compare->id)}}" alt="">
                                                                </span>
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

                                                                        $second_last_price = App\PostDetails::select('product_price')->where('product_id', $product_compare->id)->orderBy('created_at', 'desc')->skip(1)->take(1)->get();
                                                                    !!}
                                                                </div>
                                                                
                                                                @if(count($price) == 0)
                                                                    <td></td>
                                                                @else
                                                                    
                                                                    @if(count($second_last_price) != 0)
                                                                        @if($second_last_price[0]['product_price'] < $price[0]['product_price'])
                                                                            <td style="color:red;" align="right">
                                                                                <img style="height: 10px; margin-top: -1%;" src="/css/wsis/images/red-arrow.png">
                                                                                {{ number_format($price[0]['product_price'],2)  }}
                                                                            </td>
                                                                        @elseif($second_last_price[0]['product_price'] > $price[0]['product_price'])
                                                                            <td style="color:green;" align="right">
                                                                                <img style="height: 10px; margin-top: -1%;" src="/css/wsis/images/green-arrow.png">
                                                                                {{ number_format($price[0]['product_price'],2)  }}
                                                                            </td>
                                                                        @elseif($second_last_price[0]['product_price'] == $price[0]['product_price'])
                                                                            <td align="right">{{ number_format($price[0]['product_price'],2)  }}</td>
                                                                        @endif
                                                                    @else
                                                                        <td align="right">{{ number_format($price[0]['product_price'],2)  }}</td>
                                                                    @endif
                                                                @endif
                                                            @endfor

                                                            <td style="color:green;" align="right">
                                                                <img style="height: 10px;" src="/css/wsis/images/peso1.png" alt="">
                                                                {!! 
                                                                number_format($minprice = App\PostDetails::where('product_id', $product_compare->id)->min('product_price'),2); 
                                                                !!}
                                                            </td>
                                                            <td style="color:red;" align="right">
                                                                <img style="height: 10px;" src="/css/wsis/images/peso1.png" alt="">
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
