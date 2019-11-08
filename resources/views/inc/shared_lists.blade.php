{{-- <div style="margin-top: -1%;" class="viewed_slider_container">				
    <!-- Recently Viewed Slider -->
    <div class="best_sellers">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div style="margin-top: -3.5%;" class="tabbed_container">
                        <div class="tabs clearfix tabs-right">
                            <div class="new_arrivals_title">Shared Lists</div>
                            <ul class="clearfix">
                                <li class="active"></li>
                            </ul>
                            <div class="tabs_line"><span></span></div>
                        </div>
                        <div style="margin-top: 0.5%;"  class="owl-carousel owl-theme viewed_slider">
                            @foreach($user_lists as $user_list)
                                <div style="display:none;">
                                    {!!
                                        $details = App\ListDetails::where('user_list_id', $user_list->id)->get();
                                        $countProducts = count($details);
                                        $names = App\User::where('id', $user_list->user_id)->get();
                                    !!}
                                </div>
                                <div class="owl-item">
                                    <div class="viewed_item d-flex flex-column align-items-center justify-content-center text-center">
                                        <div class="viewed_image">
                                            <a href="/view_list/{{$user_list->id}}/view">
                                                <img style="image-rendering: auto;
                                                        image-rendering: crisp-edges;
                                                        image-rendering: unset;" 
                                                src="/storage/product_images/default-product.jpg" alt="" class="expand">
                                            </a>
                                        </div>
                                        <div style="margin-top: -8%;" class="viewed_content text-center">
                                            <div class="viewed_price">
                                                <a href="/view_list/{{$user_list->id}}/view">{{ strtoupper($user_list->list_name) }}</a>
                                                <br><small>({{ $countProducts }} products)</small>
                                            </div>
                                            <small>by {{ ucwords($names[0]['name']) }}</small>
                                            <div class="viewed_name"></div>
                                        </div>
                                        <ul class="item_marks">
                                            <li class="item_mark item_discount">-25%</li>
                                            <li class="item_mark item_new">new</li> 
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="viewed">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="viewed_title_container">
                    <h3 class="viewed_title">Shared Lists</h3>
                    <div class="viewed_nav_container">
                        <div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
                        <div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
                    </div>
                </div>

                <div class="viewed_slider_container">
                    
                    <!-- Recently Viewed Slider -->

                    <div class="owl-carousel owl-theme viewed_slider">

                        @foreach($user_lists as $user_list)
                        <!-- Recently Viewed Item -->
                        <div class="owl-item">
                            <div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                <div class="viewed_image">
                                    <a href="/view_list/{{$user_list->id}}/view">
                                        <img src="/storage/product_images/default-list-icon.png" alt="">
                                    </a>
                                </div>
                                <div class="viewed_content text-center">
                                    <div class="viewed_name">
                                        <a style="font-family: verdana; color: rgb(255,127,39);" href="/view_list/{{$user_list->id}}/view">{{ strtoupper($user_list->list_name) }}</a>
                                        <div style="display:none;">
                                            {!!
                                                $details = App\ListDetails::where('user_list_id', $user_list->id)->get();
                                                $countProducts = count($details);
                                                $names = App\User::where('id', $user_list->user_id)->get();
                                            !!}
                                        </div>
                                        <a href="/view_list/{{$user_list->id}}/view">
                                        <br><small>( {{ $countProducts }} products)</small>
                                        <br><small>by {{ ucwords($names[0]['name']) }}</small>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>