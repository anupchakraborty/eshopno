@extends('frontend.layouts.master')

@section('title')
    Eshop | Cart page
@endsection

    <!-- Header -->
    <header class="header shop">
		<!-- Topbar -->
        @include('frontend.partials.topbar')
		<!-- End Topbar -->

        <!-- middle-inner -->
        @include('frontend.partials.middle-inner')
        <!-- middle-inner -->

        <!-- Header Inner -->
        <div class="header-inner">
            <div class="container">
                <div class="cat-nav-head">
                    <div class="row">
                        <!-- header-inner -->
                        @include('frontend.partials.header-inner')
                        <!-- header-inner -->
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Header Inner -->
    </header>
    <!--/ End Header -->
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="/">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="blog-single.html">Cart</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
    @if(App\Models\Cart::totalItems() > 0)
        <!-- Shopping Cart -->
        <div class="shopping-cart section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Shopping Summery -->
                        <table class="table shopping-summery">
                            <thead>
                                <tr class="main-hading">
                                    <th>PRODUCT</th>
                                    <th>NAME</th>
                                    <th class="text-center">UNIT PRICE</th>
                                    <th class="text-center">QUANTITY</th>
                                    <th class="text-center">TOTAL</th>
                                    <th class="text-center"><i class="ti-trash remove-icon"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total_price = 0;
                                @endphp
                                @foreach (App\Models\Cart::totalcarts() as $cart)
                                <tr>
                                    <td class="image" data-title="No">
                                        @php
                                            $product_image = App\Models\ProductImage::where('product_id', $cart->product->id)->first();
                                        @endphp
                                        @if($product_image->image > 0)
                                            <img src="{{asset('backend/img/products/'. $product_image->image)}}" alt="#">
                                        @endif
                                    </td>
                                    <td class="product-des" data-title="Description">
                                        <p class="product-name"><a href="{{ route('products.show', $cart->product->product_slug) }}">{{ $cart->product->product_title }}</a></p>
                                        <p class="product-des">{{ $cart->product->product_description }}</p>
                                    </td>
                                    <td class="price" data-title="Price"><span>{{ $cart->product->buy_price }} Tk</span></td>
                                    <td>

                                        <form action="{{ route('carts.update', $cart->id) }}" method="POST">
                                            @csrf
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="product_quantity" value="{{ $cart->product_quantity }}">
                                                <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="submit"><i class="ti-check"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                        <!--/ End Input Order -->
                                    </td>
                                    <td class="total-amount" data-title="Total">
                                        <span>
                                            @php
                                                $total_price += $cart->product_quantity * $cart->product->buy_price;
                                            @endphp
                                            {{ $cart->product_quantity * $cart->product->buy_price }} TK
                                        </span>
                                    </td>
                                    <td class="action" data-title="Remove">
                                        <form action="{{ route('carts.delete', $cart->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="cart_id" value="">
                                            <button type="submit"><i class="ti-trash remove-icon"></i></button>
                                        </form>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!--/ End Shopping Summery -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <!-- Total Amount -->
                        <div class="total-amount">
                            <div class="row">
                                <div class="col-lg-8 col-md-5 col-12">
                                    <div class="left">
                                        <div class="coupon">
                                            <form action="#" target="_blank">
                                                <input name="Coupon" placeholder="Enter Your Coupon">
                                                <button class="btn">Apply</button>
                                            </form>
                                        </div>
                                        <div class="checkbox">
                                                @php
                                                    $shipping_cost = App\Models\Setting::first()->shipping_cost;
                                                @endphp
                                            <label class="checkbox-inline" for="2"><input name="news" id="2" type="checkbox"> Shipping ({{ $shipping_cost }} Tk)</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-7 col-12">
                                    <div class="right">
                                        <ul>
                                            <li>Cart Subtotal
                                                <span>{{ $total_price }}  TK </span>
                                            </li>
                                            <li>Shipping<span>{{ $shipping_cost }} Tk</span>
                                            </li>
                                            <li>You Save<span>00.00 TK</span></li>
                                            <li class="last">You Pay<span>{{ $total_price + $shipping_cost }}  TK </span></li>
                                        </ul>
                                        <div class="button5">
                                            <a href="{{ route('checkouts') }}" class="btn">Checkout</a>
                                            <a href="{{ route('products') }}" class="btn">Continue shopping</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ End Total Amount -->
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Shopping Cart -->
    @else
        <div class="container">
            <div class="alert alert-warning">
                <strong> <p class="text-danger"> There is no Item in Your Cart.</p></strong>
            </div>
        </div>
    @endif

    <!-- Start Shop Services Area  -->
    <section class="shop-services section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-rocket"></i>
                        <h4>Free shiping</h4>
                        <p>Orders over $100</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-reload"></i>
                        <h4>Free Return</h4>
                        <p>Within 30 days returns</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-lock"></i>
                        <h4>Sucure Payment</h4>
                        <p>100% secure payment</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-tag"></i>
                        <h4>Best Peice</h4>
                        <p>Guaranteed price</p>
                    </div>
                    <!-- End Single Service -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Shop Newsletter -->

    <!-- Start Shop Newsletter  -->
    <section class="shop-newsletter section">
        <div class="container">
            <div class="inner-top">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 col-12">
                        <!-- Start Newsletter Inner -->
                        <div class="inner">
                            <h4>Newsletter</h4>
                            <p> Subscribe to our newsletter and get <span>10%</span> off your first purchase</p>
                            <form action="mail/mail.php" method="get" target="_blank" class="newsletter-inner">
                                <input name="EMAIL" placeholder="Your email address" required="" type="email">
                                <button class="btn">Subscribe</button>
                            </form>
                        </div>
                        <!-- End Newsletter Inner -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Shop Newsletter -->

