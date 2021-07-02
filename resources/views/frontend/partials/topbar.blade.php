		<!-- Topbar -->
		<div class="topbar">
			<div class="container">
				<div class="row">
					<div class="col-lg-5 col-md-12 col-12">
						<!-- Top Left -->
						<div class="top-left">
							<ul class="list-main">
                                @php
                                    $settings = App\Models\Setting::all();
                                @endphp
                                @foreach ($settings as $setting)
                                    <li><i class="ti-headphone-alt"></i>{{ $setting->phone }}</li>
                                    <li><i class="ti-email"></i> {{ $setting->email }}</li>
                                @endforeach
							</ul>
						</div>
						<!--/ End Top Left -->
					</div>
					<div class="col-lg-7 col-md-12 col-12">
						<!-- Top Right -->
						<div class="right-content">
							<ul class="list-main">
								<li><i class="ti-location-pin"></i> Store location</li>
								<li><i class="ti-alarm-clock"></i> <a href="#">Daily deal</a></li>
								<li><i class="ti-user"></i> <a href="{{ route('user.dashboard') }}">My account</a></li>
								<!-- Authentication Links -->
                        		@guest
									<li><i class="ti-power-off"></i>
										<a href="{{ route('login') }}">{{ __('SignIn') }}</a>
										</li>
									@if (Route::has('register'))
										<li><i class="ti-power-off"></i>
											<a href="{{ route('register') }}">{{ __('SignUp') }}</a>
										</li>
									@endif
									@else
										<li class="nav-item dropdown">
	                                	<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
	                                		<img src="{{ App\Helpers\ImageHelper::getUserImage(Auth::user()->id) }}" class="img rounded-circle" style="width: 30px; height: 30px">
	                                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
	                               		</a>
	                               		<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
	                                    	<a class="dropdown-item" href="{{ route('logout') }}"
	                                       				onclick="event.preventDefault();
	                                                     document.getElementById('logout-form').submit();">
	                                        	{{ __('Logout') }}
	                                    	</a>

	                                    	<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
	                                        @csrf
	                                    	</form>
                                		</div>
                            		</li>
                        			@endguest

                        			@include('backend.partials.message')
							</ul>
						</div>
						<!-- End Top Right -->
					</div>
				</div>
			</div>
		</div>
		<!-- End Topbar -->
