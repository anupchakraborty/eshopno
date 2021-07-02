@extends('frontend.layouts.master')

@section('title')
    Eshop | {{ $product->product_title }}
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
							<li class="active"><a href="blog-single.html">View Product</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->

	<!-- Start Contact -->
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->

                            @foreach (App\Models\Category::orderBy('cat_name','asc')->where('parent_id', NULL)->get() as $parent)
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#{{ $parent->cat_slug }}">
											<span class="badge pull-right">
                                                {{-- @if(!empty($parent->parent_id))

                                                @else --}}
                                                    <i class="fa fa-plus"></i>
                                                {{-- @endif --}}

                                            </span>
											{{ $parent->cat_name }}
										</a>
									</h4>
								</div>
								<div id="{{ $parent->cat_slug }}" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
                                            @foreach (App\Models\Category::orderBy('cat_name','asc')->where('parent_id', $parent->id)->get() as $child)
                                            <li><a href="{{ Route('categories.show', $child->id) }}">{{ $child->cat_name }}</a></li>
                                            @endforeach
										</ul>
									</div>
								</div>
							</div>
                            @endforeach
						</div><!--/category-products-->

						<div class="brands_products"><!--brands_products-->
							<h2>Brands</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
                                    @foreach (App\Models\Brand::orderBy('brand_name','asc')->where('status',1)->get() as $brands)
									<li>
                                        <a href="">
                                            @php
                                                $count_brand_products = DB::table('products')->where('brand_id',$brands->id)->get();
                                                $count_brand_product = count($count_brand_products);
                                             @endphp
                                            <span class="pull-right">
                                                ({{ $count_brand_product }})
                                            </span>
                                            {{ $brands->brand_name }}
                                        </a>
                                    </li>
                                    @endforeach
								</ul>
							</div>
						</div><!--/brands_products-->

						<div class="price-range"><!--price-range-->
							<h2>Price Range</h2>
							<div class="well">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b>$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div><!--/price-range-->

						<div class="shipping text-center"><!--shipping-->
							<img src="{{ asset('frontend/images/home/shipping.jpg') }}" alt="" />
						</div><!--/shipping-->

					</div>
				</div>

				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="view-product">
                                    @php
                                        $view_product_img = DB::table('product_images')->where('product_id',$product->id)->first();
                                    @endphp
                                    <img src="{{ asset('backend/img/products/'. $view_product_img->image) }}" alt="" />
                                    <h3>ZOOM</h3>
                                </div>
                                <div id="similar-product" class="carousel slide" data-ride="carousel">
                                    <!-- Wrapper for slides -->
                                        <div class="carousel-inner">
                                            <div class="carousel-item active" style="padding-left: 20px">
                                                <a href=""><img src="{{ asset('frontend/images/product-details/similar1.jpg') }}" alt="" style="padding-left: 10px"></a>
                                                <a href=""><img src="{{ asset('frontend/images/product-details/similar2.jpg') }}" alt="" style="padding-left: 10px"></a>
                                                <a href=""><img src="{{ asset('frontend/images/product-details/similar3.jpg') }}" alt="" style="padding-left: 10px"></a>
                                            </div>
                                            <div class="carousel-item" style="padding-left: 20px">
                                                <a href=""><img src="{{ asset('frontend/images/product-details/similar1.jpg') }}" alt="" style="padding-left: 10px"></a>
                                                <a href=""><img src="{{ asset('frontend/images/product-details/similar2.jpg') }}" alt="" style="padding-left: 10px"></a>
                                                <a href=""><img src="{{ asset('frontend/images/product-details/similar3.jpg') }}" alt="" style="padding-left: 10px"></a>
                                            </div>
                                            <div class="carousel-item" style="padding-left: 20px">
                                                <a href=""><img src="{{ asset('frontend/images/product-details/similar1.jpg') }}" alt="" style="padding-left: 10px"></a>
                                                <a href=""><img src="{{ asset('frontend/images/product-details/similar2.jpg') }}" alt="" style="padding-left: 10px"></a>
                                                <a href=""><img src="{{ asset('frontend/images/product-details/similar3.jpg') }}" alt="" style="padding-left: 10px"></a>
                                            </div>

                                        </div>

                                    <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
                                </div>

                            </div>
                            <div class="col-sm-7">
                                <div class="product-information"><!--/product-information-->
                                        <img src="{{ asset('frontend/images/product-details/new.jpg') }}" class="newarrival" alt="" />
                                    <div class="row">
                                        <h2>{{ $product->product_title }}</h2>
                                        <p>Web ID: {{ $product->id }}</p>
                                    </div>
                                    <div class="row">
                                        <img src="{{ asset('frontend/images/product-details/rating.png') }}" alt="" />
                                    </div>
                                    <div class="row">
                                        <span>
                                            <form class="form-inline" action="{{ route('carts.store') }}" method="POST">
                                                @csrf
                                                <span>{{ $product->buy_price }}TK</span>
                                                <label>Quantity:</label>
                                                <input type="text" value="1" />
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit" class="btn btn-fefault cart">
                                                    <i class="fa fa-shopping-cart"></i> Add to Cart
                                                </button>
                                            </form>

                                        </span>
                                        <p><b>Availability:</b> In Stock</p>
                                        <p><b>Condition:</b> New</p>
                                        <p><b>Brand:</b> ESHOP</p>
                                        <a href=""><img src="{{ asset('frontend/images/product-details/share.png') }}" class="share img-responsive"  alt="" /></a>
                                    </div>
                                </div><!--/product-information-->
                            </div>
                        </div>
					</div><!--/product-details-->

					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li><a href="#details" data-toggle="tab">Details</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Company Profile</a></li>
								<li><a href="#tag" data-toggle="tab">Tag</a></li>
								<li class="active"><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade" id="details" >
                                <div class="row ml-4">
                                    <table>
                                        <tr>
                                            <td width="20%"><strong>Product Name: </strong></td>
                                            <td width="80%">{{ $product->product_title }}</td>
                                        </tr>
                                        <tr>
                                            <td width="20%"><strong>Product details:</strong></td>
                                            <td width="80%">{{ $product->product_description }}</td>
                                        </tr>
                                    </table>
                                </div>
							</div>

							<div class="tab-pane fade" id="companyprofile" >
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="{{ asset('frontend/images/home/gallery1.jpg') }}" alt="" />
                                                    <h2>$56</h2>
                                                    <p>Easy Polo Black Edition</p>
                                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="{{ asset('frontend/images/home/gallery3.jpg') }}" alt="" />
                                                    <h2>$56</h2>
                                                    <p>Easy Polo Black Edition</p>
                                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="{{ asset('frontend/images/home/gallery2.jpg') }}" alt="" />
                                                    <h2>$56</h2>
                                                    <p>Easy Polo Black Edition</p>
                                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="{{ asset('frontend/images/home/gallery4.jpg') }}" alt="" />
                                                    <h2>$56</h2>
                                                    <p>Easy Polo Black Edition</p>
                                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
							</div>

							<div class="tab-pane fade" id="tag" >
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="{{ asset('frontend/images/home/gallery1.jpg') }}" alt="" />
                                                    <h2>$56</h2>
                                                    <p>Easy Polo Black Edition</p>
                                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="{{ asset('frontend/images/home/gallery2.jpg') }}" alt="" />
                                                    <h2>$56</h2>
                                                    <p>Easy Polo Black Edition</p>
                                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="{{ asset('frontend/images/home/gallery3.jpg') }}" alt="" />
                                                    <h2>$56</h2>
                                                    <p>Easy Polo Black Edition</p>
                                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="{{ asset('frontend/images/home/gallery4.jpg') }}" alt="" />
                                                    <h2>$56</h2>
                                                    <p>Easy Polo Black Edition</p>
                                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
							</div>

							<div class="tab-pane fade active in" id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
									</ul>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
									<p><b>Write Your Review</b></p>

									<form action="#">
										<span>
											<input type="text" placeholder="Your Name"/>
											<input type="email" placeholder="Email Address"/>
										</span>
										<textarea name="" ></textarea>
										<b>Rating: </b> <img src="{{ asset('frontend/images/product-details/rating.png') }}" alt="" />
										<button type="button" class="btn btn-default pull-right">
											Submit
										</button>
									</form>
								</div>
							</div>

						</div>
					</div><!--/category-tab-->

					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">recommended items</h2>

						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="carousel-item active">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                        <img src="{{ asset('frontend/images/home/recommend1.jpg') }}" alt="" />
                                                        <h2>$56</h2>
                                                        <p>Easy Polo Black Edition</p>
                                                        <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                        <img src="{{ asset('frontend/images/home/recommend2.jpg') }}" alt="" />
                                                        <h2>$56</h2>
                                                        <p>Easy Polo Black Edition</p>
                                                        <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                        <img src="{{ asset('frontend/images/home/recommend3.jpg') }}" alt="" />
                                                        <h2>$56</h2>
                                                        <p>Easy Polo Black Edition</p>
                                                        <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
								</div>
                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                        <img src="{{ asset('frontend/images/home/recommend1.jpg') }}" alt="" />
                                                        <h2>$56</h2>
                                                        <p>Easy Polo Black Edition</p>
                                                        <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                        <img src="{{ asset('frontend/images/home/recommend2.jpg') }}" alt="" />
                                                        <h2>$56</h2>
                                                        <p>Easy Polo Black Edition</p>
                                                        <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                        <img src="{{ asset('frontend/images/home/recommend3.jpg') }}" alt="" />
                                                        <h2>$56</h2>
                                                        <p>Easy Polo Black Edition</p>
                                                        <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
								</div>
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>
						</div>
					</div><!--/recommended_items-->

				</div>
			</div>
		</div>
	</section>
	<!--/ End Contact -->

