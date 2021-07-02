@include('frontend.partials.header')

@include('frontend.partials.body_header')

@include('frontend.partials.slider')

	<div class="product-area most-popular section">
        <div class="container">
            <div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2>All Product In
							<span class="badge badge-info">{{ $category->cat_name }} category</span>
						</h2>
					</div>
				</div>
            </div>
            <div class="row">
            	<div class="col-3"></div>
                <div class="col-9">
                    <div class="owl-carousel popular-slider">
                    	@php
                    		$products = $category->products()->paginate(9);
                    	@endphp

                    	@if($products->count() >0)

                        @php
                            $i = 1;
                        @endphp
                        @foreach($products as $product)
							<!-- Start Single Product -->
							<div class="single-product">
								<div class="product-img">
                                    @foreach($product->images as $image)
									<a href="{{ route('products.show', $product->product_slug) }}">
										<img class="default-img" style="width:500px; height:300px;" src="{{asset('backend/img/products/'. $image->image)}}" alt="{{ $product->product_slug }}">
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
                        {{-- </div> --}}
                        @php   $i++;      @endphp
	                    @endforeach
							<!-- End Single Product -->
                    	@else
                    		<div class="alert alert-warning text-center">
                    			<p>&nbsp; &nbsp; No Product has added yet in this category !!</p>
                    		</div>
                    	@endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('frontend.partials.footer')
