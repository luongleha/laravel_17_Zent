@extends('frontend.layouts.master')

@section('title')
Shop
@endsection

@section('link-css')
<link rel="stylesheet" type="text/css" href="/frontend/styles/bootstrap4/bootstrap.min.css">
<link href="/frontend/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="/frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="/frontend/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="/frontend/plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="/frontend/styles/product_styles.css">
<link rel="stylesheet" type="text/css" href="/frontend/styles/product_responsive.css">
@endsection

@section('content')
<!-- Single Product -->

<div class="single_product">
    <div class="container">
        <div class="row">

            <!-- Images -->
            <div class="col-lg-2 order-lg-1 order-2">
                <ul class="image_list">
                    <li data-image="/frontend/images/single_4.jpg">
                        @foreach($path as $key => $image)
                        @if($key == 1)
                            <img src="/{{$image->path}}" alt="">
                        @endif
                        @endforeach
                    </li>
                    <li data-image="/frontend/images/single_2.jpg">
                        @foreach($path as $key => $image)
                        @if($key == 2)
                            <img src="/{{$image->path}}" alt="">
                        @endif
                        @endforeach
                    </li>
                    <li data-image="/frontend/images/single_3.jpg">
                        @foreach($path as $key => $image)
                        @if($key == 3)
                            <img src="/{{$image->path}}" alt="">
                        @endif
                    @endforeach</li>
                </ul>
            </div>

            <!-- Selected Image -->
            <div class="col-lg-5 order-lg-2 order-1">
                <div class="image_selected">
                    @foreach($path as $key => $image)
                    @if($key == 0)
                        <img src="/{{$image->path}}" alt="">
                    @endif
                    @endforeach
                </div>
            </div>

            <!-- Description -->
            <div class="col-lg-5 order-3">
                <div class="product_description">
                    <div class="product_category">{{$products->category->name}}</div>
                    <div class="product_name">{{$products->name}}</div>
                    <div class="rating_r rating_r_4 product_rating"><i></i><i></i><i></i><i></i><i></i></div>
                    <div class="product_text"><p>{!! $products->content !!}</p></div>
                    <div class="order_info d-flex flex-row">
                        <form action="#">
                            <div class="clearfix" style="z-index: 1000;">

                                <!-- Product Quantity -->
                                <div class="product_quantity clearfix">
                                    <span>Quantity: </span>
                                    <input id="quantity_input" type="text" pattern="[0-9]*" value="1">
                                    <div class="quantity_buttons">
                                        <div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fas fa-chevron-up"></i></div>
                                        <div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fas fa-chevron-down"></i></div>
                                    </div>
                                </div>

                                <!-- Product Color -->
                                <ul class="product_color">
                                    <li>
                                        <span>Color: </span>
                                        <div class="color_mark_container"><div id="selected_color" class="color_mark"></div></div>
                                        <div class="color_dropdown_button"><i class="fas fa-chevron-down"></i></div>

                                        <ul class="color_list">
                                            <li><div class="color_mark" style="background: #999999;"></div></li>
                                            <li><div class="color_mark" style="background: #b19c83;"></div></li>
                                            <li><div class="color_mark" style="background: #000000;"></div></li>
                                        </ul>
                                    </li>
                                </ul>

                            </div>

                            <div class="product_price">{{number_format($products->sale_price) . ' VND'}}</div>
                            <div class="button_container">
                                <a href="/online/cart/add/{{$products->id}}" class="product_cart_button btn btn-success">Add to Cart</a>
                                <div class="product_fav"><i class="fas fa-heart"></i></div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Recently Viewed -->

    <div class="viewed">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="viewed_title_container">
                        <h3 class="viewed_title">Recently Viewed</h3>
                        <div class="viewed_nav_container">
                            <div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
                            <div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
                        </div>
                    </div>

                    <div class="viewed_slider_container">

                        <!-- Recently Viewed Slider -->

                        <div class="owl-carousel owl-theme viewed_slider">

                            <!-- Recently Viewed Item -->
                            @foreach($product2 as $product)
                            <div class="owl-item">
                                <div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                    <div class="viewed_image">
                                        @foreach($product->images as $key => $image)
                                            @if($key == 0)
                                        <img style="max-width: 75%" src="{{$image['path']}}" alt="">
                                            @endif
                                            @endforeach
                                    </div>
                                    <div class="viewed_content text-center">
                                        <div class="viewed_price">{{number_format($product->origin_price)}} VND</div>
                                        <div class="viewed_name"><a href="#">{{ $product->name }}</a></div>
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

    <!-- Brands -->

    <div class="brands">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="brands_slider_container">

                        <!-- Brands Slider -->

                        <div class="owl-carousel owl-theme brands_slider">

                            <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="/frontend/images/brands_1.jpg" alt=""></div></div>
                            <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="/frontend/images/brands_2.jpg" alt=""></div></div>
                            <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="/frontend/images/brands_3.jpg" alt=""></div></div>
                            <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="/frontend/images/brands_4.jpg" alt=""></div></div>
                            <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="/frontend/images/brands_5.jpg" alt=""></div></div>
                            <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="/frontend/images/brands_6.jpg" alt=""></div></div>
                            <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="/frontend/images/brands_7.jpg" alt=""></div></div>
                            <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="/frontend/images/brands_8.jpg" alt=""></div></div>

                        </div>

                        <!-- Brands Slider Navigation -->
                        <div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i></div>
                        <div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i></div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Newsletter -->

    <div class="newsletter">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
                        <div class="newsletter_title_container">
                            <div class="newsletter_icon"><img src="/frontend/images/send.png" alt=""></div>
                            <div class="newsletter_title">Sign up for Newsletter</div>
                            <div class="newsletter_text"><p>...and receive %20 coupon for first shopping.</p></div>
                        </div>
                        <div class="newsletter_content clearfix">
                            <form action="#" class="newsletter_form">
                                <input type="email" class="newsletter_input" required="required" placeholder="Enter your email address">
                                <button class="newsletter_button">Subscribe</button>
                            </form>
                            <div class="newsletter_unsubscribe_link"><a href="#">unsubscribe</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('link-js')
    <script src="/frontend/js/jquery-3.3.1.min.js"></script>
    <script src="/frontend/styles/bootstrap4/popper.js"></script>
    <script src="/frontend/styles/bootstrap4/bootstrap.min.js"></script>
    <script src="/frontend/plugins/greensock/TweenMax.min.js"></script>
    <script src="/frontend/plugins/greensock/TimelineMax.min.js"></script>
    <script src="/frontend/plugins/scrollmagic/ScrollMagic.min.js"></script>
    <script src="/frontend/plugins/greensock/animation.gsap.min.js"></script>
    <script src="/frontend/plugins/greensock/ScrollToPlugin.min.js"></script>
    <script src="/frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
    <script src="/frontend/plugins/easing/easing.js"></script>
    <script src="/frontend/js/product_custom.js"></script>
    @endsection
