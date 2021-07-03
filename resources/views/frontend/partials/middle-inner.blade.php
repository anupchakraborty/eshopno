        <!-- middle-inner -->
		<div class="middle-inner">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 col-md-2 col-12">
						<!-- Logo -->
						<div class="logo">
                            @php
                                $settings = App\Models\Setting::all();
                            @endphp
                            @foreach ($settings as $setting)
							    <a href="{{ route('index') }}"><img src="{!! asset('public/backend/img/'.$setting->logo) !!}" alt="logo"></a>
                            @endforeach
						</div>
						<!--/ End Logo -->
						<div class="mobile-nav"></div>
					</div>
					<div class="col-lg-8 col-md-7 col-12">
						<div class="search-bar-top">
							<div class="search-bar">
								<select>
                                    <option selected="selected">All Category</option>
                                    @foreach (App\Models\Category::orderBy('cat_name','asc')->where('parent_id', NULL)->get() as $parent)
                                        <option value="{{ $parent->id }}">{{ $parent->cat_name }}</option>
                                    @endforeach
								</select>
								<form action="{{ Route('products.search') }}" method="get">
									<input type="text" placeholder="Search here..." name="search">
									<button type="submit"  class="btnn"><i class="ti-search"></i></button>
								</form>
							</div>
						</div>
					</div>
					<div class="col-lg-2 col-md-3 col-12">
						<div class="right-bar">
							<!-- Search Form -->
							<div class="sinlge-bar">
								<a href="#" class="single-icon"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
							</div>
							<div class="sinlge-bar">
								<a href="#" class="single-icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
							</div>
							<div class="sinlge-bar shopping">
								<a href="#" class="single-icon"><i class="ti-bag"></i> <span id="total_items" class="total-count">{{ App\Models\Cart::totalItems() }} Items</span></a>
								<!-- Shopping Item -->
								<div class="shopping-item">
									<div class="dropdown-cart-header">
										<span id="total_items1">{{ App\Models\Cart::totalItems() }} Items</span>
										<a href="{{ route('carts') }}">View Cart</a>
									</div>
									<ul class="shopping-list">

                                    @php
                                        $total_price = 0;
                                    @endphp
                                    @foreach (App\Models\Cart::totalcarts() as $cart)
										<li>
                                            <form action="{{ route('carts.delete', $cart->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="cart_id" value="">
                                                <button type="submit" class="remove" title="Remove this item"><i class="fa fa-remove"></i></button>
                                            </form>
                                            @php
                                                $product_image = App\Models\ProductImage::where('product_id', $cart->product->id)->first();
                                            @endphp
                                            @if($product_image->image > 0)
											<a class="cart-img" href="{{ route('products.show', $cart->product->product_slug) }}"><img src="{{asset('public/backend/img/products/'. $product_image->image)}}" alt="#"></a>
                                            @endif
											<h4><a href="{{ route('products.show', $cart->product->product_slug) }}">{{ $cart->product->product_title }}</a></h4>
											<p class="quantity">{{ $cart->product_quantity }} -  <span class="amount">{{ $cart->product->buy_price }}</span></p>
										</li>
                                        @php
                                            $total_price += $cart->product_quantity * $cart->product->buy_price;
                                         @endphp
                                    @endforeach
									</ul>
									<div class="bottom">
										<div class="total">
											<span>Total</span>
											<span class="total-amount">{{ $total_price }} TK</span>
										</div>
										<a href="{{ route('checkouts') }}" class="btn animate">Checkout</a>
									</div>
								</div>
								<!--/ End Shopping Item -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
        <!-- middle-inner -->
