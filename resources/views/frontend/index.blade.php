@extends('frontend.layouts.master')
@section('title')
    EShop | Home
@endsection
@section('content')
    <!-- Preloader -->
	<div class="preloader">
		<div class="preloader-inner">
			<div class="preloader-icon">
				<span></span>
				<span></span>
			</div>
		</div>
	</div>
	<!-- End Preloader2 -->

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
						<div class="col-lg-3">
							<div class="all-category">
								<h3 class="cat-heading"><i class="fa fa-bars" aria-hidden="true"></i>CATEGORIES</h3>
								<ul class="main-category">

									@foreach (App\Models\Category::orderBy('cat_name','asc')->where('parent_id', NULL)->get() as $parent)

										<li><a href="{{ Route('categories.show', $parent->id) }}">{{ $parent->cat_name }}</a>
											<ul class="sub-category">
											@foreach (App\Models\Category::orderBy('cat_name','asc')->where('parent_id', $parent->id)->get() as $child)

												<li><a href="{{ Route('categories.show', $child->id) }}">{{ $child->cat_name }}</a></li>
											@endforeach
											</ul>
										</li>

									@endforeach

								</ul>
							</div>
						</div>

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

    <!-- Slider Area -->
	<section class="hero-slider">
		<!-- Single Slider -->
		<div class="single-slider">
			<div class="container">
				<div class="row no-gutters">
					<div class="col-lg-9 offset-lg-3 col-12">
						<div class="text-inner">
							<div class="row">
								<div class="col-lg-7 col-12">
									<div class="hero-text">
                                        {{-- <img src="{{asset('frontend/images/slider-image2.jpg')}}" alt="#"> --}}
										<h1><span>UP TO 50% OFF </span>Shirt For Man</h1>
										<p>Maboriosam in a nesciung eget magnae <br> dapibus disting tloctio in the find it pereri <br> odiy maboriosm.</p>
										<div class="button">
											<a href="#" class="btn">Shop Now!</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/ End Single Slider -->
	</section>
	<!--/ End Slider Area -->

	<!-- Start Small Banner  -->
	<section class="small-banner section">
		<div class="container-fluid">
			<div class="row">
				<!-- Single Banner  -->
				<div class="col-lg-4 col-md-6 col-12">
					<div class="single-banner">
						<img src="{{URL::TO('public/frontend/images/mini-banner1.jpg')}}" alt="#">
						<div class="content">
							<p>Man's Collectons</p>
							<h3>Summer travel <br> collection</h3>
							<a href="#">Discover Now</a>
						</div>
					</div>
				</div>
				<!-- /End Single Banner  -->
				<!-- Single Banner  -->
				<div class="col-lg-4 col-md-6 col-12">
					<div class="single-banner">
						<img src="{{URL::TO('public/frontend/images/mini-banner2.jpg')}}" alt="#">
						<div class="content">
							<p>Bag Collectons</p>
							<h3>Awesome Bag <br> 2020</h3>
							<a href="#">Shop Now</a>
						</div>
					</div>
				</div>
				<!-- /End Single Banner  -->
				<!-- Single Banner  -->
				<div class="col-lg-4 col-12">
					<div class="single-banner tab-height">
						<img src="{{URL::TO('public/frontend/images/mini-banner3.jpg')}}" alt="#">
						<div class="content">
							<p>Flash Sale</p>
							<h3>Mid Season <br> Up to <span>40%</span> Off</h3>
							<a href="#">Discover Now</a>
						</div>
					</div>
				</div>
				<!-- /End Single Banner  -->
			</div>
		</div>
	</section>
	<!-- End Small Banner -->

	<!-- Start Product Area -->
    <div class="product-area section">

           <div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section-title">
							<h2>Trending Item</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="product-info">
							<div class="nav-main">
								<!-- Tab Nav -->
								<ul class="nav nav-tabs" id="myTab" role="tablist">
									@php  $i = 1;  @endphp
									<?php
										foreach ($brands as $brand){
									 ?>
									<li class="nav-item"><a class="nav-link {{ $i == 1 ? 'active': ''}}" data-toggle="tab" href="#{{ $brand->brand_slug }}" role="tab">{{ $brand->brand_name }}</a></li>
									@php  $i++;  @endphp
									<?php
									}
									?>
								</ul>
								<!--/ End Tab Nav -->
							</div>
							<div class="tab-content" id="myTabContent">
								<!-- Start Single Tab -->
                                @php  $i = 1;  @endphp
								@foreach ($brands as $brand)
                                    <div class="tab-pane fade show {{ $i == 1 ? 'active': ''}}" id="{{ $brand->brand_slug }}" role="tabpanel">
                                        @php
                                            $brand_id = $brand->id;
                                            $products = App\Models\Product::where('brand_id', $brand_id)->get();
                                        @endphp
                                        <div class="tab-single">
                                            <div class="row">
                                                @foreach($products as $product)
                                                <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                                                    <div class="single-product">
                                                        <div class="product-img">
                                                            @foreach($product->images as $image)
                                                            <a href="{{ route('products.show', $product->product_slug) }}">
                                                                <img class="default-img" style="width:550px; height:350px;" src="{{asset('public/backend/img/products/'. $image->image)}}" alt="{{ $product->product_slug }}">
                                                                {{-- <img class="hover-img" src="{{URL::TO('frontend/images/products/p2.jpg')}}" alt="{{ $product->product_slug }}"> --}}
                                                            </a>
                                                            @endforeach
                                                            <div class="button-head">
                                                                <div class="product-action">
                                                                    <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
                                                                    <a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
                                                                    <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
                                                                </div>
                                                                <div class="product-action-2">
                                                                    <form class="form-inline" action="{{ route('carts.store') }}" method="POST">
                                                                        @csrf

                                                                        @if(!empty(Auth::guard('web')->user()->id))
                                                                            <input type="hidden" name="user_id" value="(){{ Auth::guard('web')->user()->id }}">

                                                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                                            <a type="button" title="Add to cart" onclick="addTocart({{ $product->id }},{{ Auth::user()->id }})">Add to cart</a>
                                                                        @else
                                                                            <a type="button" title="Add to cart" onclick="addTocart({{ $product->id }})">Add to cart</a>
                                                                        @endif

                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-content">
                                                            <h3><a href="{{ route('products.show', $product->product_slug) }}">{{ $product->product_title }}</a></h3>
                                                            <div class="product-price">
                                                                <span>{{ $product->sell_price }}TK</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>

                                    </div>
                                    @php  $i++;  @endphp
                                @endforeach
								<!--/ End Single Tab -->
							</div>
						</div>
					</div>
				</div>
            </div>

    </div>
	<!-- End Product Area -->

	<!-- Start Midium Banner  -->
	<section class="midium-banner">
		<div class="container">
			<div class="row">
				<!-- Single Banner  -->
				<div class="col-lg-6 col-md-6 col-12">
					<div class="single-banner">
						<img src="{{URL::TO('public/frontend/images/mini-banner1.jpg')}}" alt="#">
						<div class="content">
							<p>Man's Collectons</p>
							<h3>Man's items <br>Up to<span> 50%</span></h3>
							<a href="#">Shop Now</a>
						</div>
					</div>
				</div>
				<!-- /End Single Banner  -->
				<!-- Single Banner  -->
				<div class="col-lg-6 col-md-6 col-12">
					<div class="single-banner">
						<img src="{{URL::TO('public/frontend/images/mini-banner2.jpg')}}" alt="#">
						<div class="content">
							<p>shoes women</p>
							<h3>mid season <br> up to <span>70%</span></h3>
							<a href="#" class="btn">Shop Now</a>
						</div>
					</div>
				</div>
				<!-- /End Single Banner  -->
			</div>
		</div>
	</section>
	<!-- End Midium Banner -->

	<!-- Start Most Popular -->
	<div class="product-area most-popular section">
        <div class="container">
            <div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2>Hot Item</h2>
					</div>
				</div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="owl-carousel popular-slider">
                        @php
                            $hot_products = DB::table('products')
                                    ->join('categories','products.category_id','=','categories.id')
                                    ->select('products.*','categories.parent_id')
                                    ->get();
                            $i=1;
                        @endphp
                        @foreach ($hot_products as $hot_product)
                            <!-- Start Single Product -->
                            <div class="single-product">
                                <div class="product-img">
                                    @php
                                        $hot_product_images = DB::table('product_images')
                                                ->where('product_id', $hot_product->id)
                                                ->join('products','product_images.product_id','=','products.id')
                                                ->select('products.product_slug','product_images.*')
                                                ->get();
                                        $i=1;
                                    @endphp
                                    @foreach($hot_product_images as $hot_product_image)
                                        <a href="{{ route('products.show', $hot_product_image->product_slug) }}">
                                            <img class="default-img" style="width:400px; height:300px;" src="{{asset('public/backend/img/products/'. $hot_product_image->image)}}" alt="{{ $hot_product->product_slug }}">
                                            {{-- <img class="hover-img" src="{{URL::TO('frontend/images/products/p2.jpg')}}" alt="#"> --}}
                                            <span class="out-of-stock">Hot</span>
                                        </a>
                                    @endforeach
                                    <div class="button-head">
                                        <div class="product-action">
                                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
                                            <a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
                                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
                                        </div>
                                        <div class="product-action-2">
                                            <form class="form-inline" action="{{ route('carts.store') }}" method="POST">
                                                @csrf
                                                @if(!empty(Auth::guard('web')->user()->id))
                                                <input type="hidden" name="user_id" value="{{ Auth::guard('web')->user()->id }}">

                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <a type="button" title="Add to cart" onclick="addTocart({{ $product->id }},{{ Auth::user()->id }})">Add to cart</a>
                                                @else
                                                <a type="button" title="Add to cart" onclick="addTocart({{ $product->id }})">Add to cart</a>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3><a href="{{ route('products.show', $hot_product_image->product_slug) }}">{{ $hot_product->product_title }}</a></h3>
                                    <div class="product-price">
                                        <span class="old">{{ $hot_product->buy_price }}</span>
                                        <span>{{ $hot_product->buy_price }}</span>
                                    </div>
                                </div>
                            </div>
						    <!-- End Single Product -->
                            @php $i++;      @endphp
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- End Most Popular Area -->

	<section class="section free-version-banner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8 offset-md-2 col-xs-12">
                    <div class="section-title mb-60">
                        <span class="text-white wow fadeInDown" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInDown;">Eshop Free Lite version</span>
                        <h2 class="text-white wow fadeInUp" data-wow-delay=".4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">Currently You are using free<br> lite Version of Eshop.</h2>
                        <p class="text-white wow fadeInUp" data-wow-delay=".6s" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp;">Please, purchase full version of the template to get all pages,<br> features and commercial license.</p>

                        <div class="button">
                            <a href="https://wpthemesgrid.com/downloads/eshop-ecommerce-html5-template/" target="_blank" rel="nofollow" class="btn wow fadeInUp" data-wow-delay=".8s">Purchase Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

	<!-- Start Shop Home List  -->
	<section class="shop-home-list section">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-6 col-12">
					<div class="row">
						<div class="col-12">
							<div class="shop-section-title">
								<h1>On sale</h1>
							</div>
						</div>
					</div>
                    @php
                        $category_id = 8;
                        $on_sales = App\Models\Product::where('category_id', $category_id)->get();
                        $i = 1;
                    @endphp
                    @foreach ($on_sales as $on_sale)
					<!-- Start Single List  -->
					<div class="single-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<div class="list-image overlay">
                                    @php
                                        $onsale_images = DB::table('product_images')
                                                ->where('product_id', $on_sale->id)
                                                ->join('products','product_images.product_id','=','products.id')
                                                ->select('products.product_slug','product_images.*')
                                                ->get();
                                        $i=1;
                                    @endphp
                                    @foreach($onsale_images as $onsale_image)
									<img src="{{asset('public/backend/img/products/'. $onsale_image->image)}}" alt="#">
                                    @endforeach
									<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12 no-padding">
								<div class="content">
									<h4 class="title"><a href="{{ route('products.show', $onsale_image->product_slug) }}">{{ $on_sale->product_title }}</a></h4>
									<p class="price with-discount">{{ $on_sale->buy_price }} Tk</p>
								</div>
							</div>
						</div>
					</div>
					<!-- End Single List  -->
                    @php   $i++     @endphp
                    @endforeach
				</div>
				<div class="col-lg-4 col-md-6 col-12">
					<div class="row">
						<div class="col-12">
							<div class="shop-section-title">
								<h1>Best Seller</h1>
							</div>
						</div>
					</div>
                    @php
                        $category_id = 9;
                        $best_sellers = App\Models\Product::where('category_id', $category_id)->get();
                        $i = 1;
                    @endphp
                    @foreach ($best_sellers as $best_seller)
					<!-- Start Single List  -->
					<div class="single-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<div class="list-image overlay">
                                    @php
                                    $best_seller_images = DB::table('product_images')
                                            ->where('product_id', $best_seller->id)
                                            ->join('products','product_images.product_id','=','products.id')
                                            ->select('products.product_slug','product_images.*')
                                            ->get();
                                    $i=1;
                                @endphp
                                @foreach($best_seller_images as $best_seller_image)
									<img src="{{asset('public/backend/img/products/'. $best_seller_image->image)}}" alt="{{ $best_seller->product_slug }}">
                                @endforeach
									<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12 no-padding">
								<div class="content">
									<h5 class="title"><a href="{{ route('products.show', $best_seller_image->product_slug) }}">{{ $best_seller->product_title }}</a></h5>
									<p class="price with-discount">{{ $best_seller->buy_price }} Tk</p>
								</div>
							</div>
						</div>
					</div>
					<!-- End Single List  -->
                    @php   $i++     @endphp
                    @endforeach
				</div>
				<div class="col-lg-4 col-md-6 col-12">
					<div class="row">
						<div class="col-12">
							<div class="shop-section-title">
								<h1>Top viewed</h1>
							</div>
						</div>
					</div>
					<!-- Start Single List  -->
					<div class="single-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<div class="list-image overlay">
									<img src="{{URL::TO('public/frontend/images/list/shop-list7.jpg')}}" alt="#">
									<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12 no-padding">
								<div class="content">
									<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
									<p class="price with-discount">$22</p>
								</div>
							</div>
						</div>
					</div>
					<!-- End Single List  -->
					<!-- Start Single List  -->
					<div class="single-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<div class="list-image overlay">
									<img src="{{URL::TO('public/frontend/images/list/shop-list8.jpg')}}" alt="#">
									<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12 no-padding">
								<div class="content">
									<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
									<p class="price with-discount">$35</p>
								</div>
							</div>
						</div>
					</div>
					<!-- End Single List  -->
					<!-- Start Single List  -->
					<div class="single-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<div class="list-image overlay">
									<img src="{{URL::TO('public/frontend/images/list/shop-list9.jpg')}}" alt="#">
									<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12 no-padding">
								<div class="content">
									<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
									<p class="price with-discount">$99</p>
								</div>
							</div>
						</div>
					</div>
					<!-- End Single List  -->
				</div>
			</div>
		</div>
	</section>
	<!-- End Shop Home List  -->
@endsection

