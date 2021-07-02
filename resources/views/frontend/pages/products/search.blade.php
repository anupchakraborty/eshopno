@extends('frontend.layouts.master')
@section('title')
    EShop | Searching
@endsection
	<div class="row">
		<div class="col-3">

		</div>
		<div class="col-9">
			<div class="jumbotron">
			  <h1 class="display-4">Eshop</h1>
			  <p class="lead my-4">Welcome to Eshop, a simple e-commerce site for calling extra attention to featured content or information.</p>
			  <hr class="my-4">
			  <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
			</div>
		</div>
	</div>

	<div class="product-area most-popular section">
        <div class="container">
            <div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2> {{ $products_search }} Searching Result.....</h2>
					</div>
				</div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="owl-carousel popular-slider">
						@foreach($products as $product)
						<!-- Start Single Product -->
						<div class="single-product">
							<div class="product-img">
								<a href="product-details.html">
									<a href="{{ route('products.show', $product->product_slug) }}">
									<img class="default-img" src="{{URL::TO('frontend/images/products/p1.jpg')}}" alt="#">
									<img class="hover-img" src="{{URL::TO('frontend/images/products/p2.jpg')}}" alt="#">
									<span class="out-of-stock">Hot</span>
								</a>
								<div class="button-head">
									<div class="product-action">
										<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
										<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
										<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
									</div>
									<div class="product-action-2">
										<a title="Add to cart" href="#">Add to cart</a>
									</div>
								</div>
							</div>
							<div class="product-content">

								<h3><a href="{{ route('products.show', $product->product_slug) }}">{{ $product->product_title }}</a></h3>
								<div class="product-price">
									<span class="old">$60.00</span>
									<span>{{ $product->sell_price }}</span>
								</div>
							</div>
						</div>
                    	@endforeach
						<!-- End Single Product -->
                    </div>
                </div>
            </div>
        </div>
    </div>

