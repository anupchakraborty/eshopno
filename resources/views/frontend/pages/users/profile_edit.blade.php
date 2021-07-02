@extends('frontend.layouts.master')
@section('title')
    EShop | Profile
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

  <div class="card">
    <div class="card-body register-card-body">
      <div class="row">
      	<div class="col-md-4"></div>
      	<div class="col-md-8">
      		      <h5 class="login-box-msg">{{ __('Update Your Information') }}</h5>

	      <form action="{{ route('user.profile.update') }}" method="post">

	        @csrf

	          <div class="form-row">
	            <div class="form-group col-md-6">
	              <label for="inputEmail4">First Name</label>
	              <input type="text" id="first_name" class="form-control @error('first_name') is-invalid @enderror" name="first_name" required autocomplete="first_name" Value="{{$user->first_name}}" autofocus>
	                  @error('first_name')
	                        <span class="invalid-feedback" role="alert">
	                            <strong>{{ $message }}</strong>
	                        </span>
	                  @enderror
	            </div>
	            <div class="form-group col-md-6">
	              <label for="inputEmail4">Last Name</label>
	              <input type="text" id="last_name" class="form-control @error('last_name') is-invalid @enderror" name="last_name" required autocomplete="last_name" Value="{{$user->last_name}}" autofocus>
	                  @error('last_name')
	                        <span class="invalid-feedback" role="alert">
	                            <strong>{{ $message }}</strong>
	                        </span>
	                  @enderror
	            </div>
	            <div class="form-group col-md-6">
	              <label for="inputEmail4">Phone</label>
	              <input type="text" id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" required autocomplete="phone" Value="{{$user->phone}}" autofocus>
	                  @error('phone')
	                        <span class="invalid-feedback" role="alert">
	                            <strong>{{ $message }}</strong>
	                        </span>
	                  @enderror
	            </div>
	            <div class="form-group col-md-6">
	              <label for="inputEmail4">Email Address</label>
	              <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email" Value="{{$user->email}}" autofocus>
	                  @error('email')
	                        <span class="invalid-feedback" role="alert">
	                            <strong>{{ $message }}</strong>
	                        </span>
	                  @enderror
	            </div>
	            <div class="form-group col-md-12">
              <label for="inputPassword4">Password</label>
              <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="password" Value="{{$user->password}}" autofocus>
                  @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                  @enderror

            	</div>
	            <div class="form-group col-md-6">
	                <label for="inputAddress">Street Address</label>
	                <textarea id="street_address" class="form-control @error('street_address') is-invalid @enderror" name="street_address" required autocomplete="street_address" autofocus>{{$user->street_address}}</textarea>
	                  @error('street_address')
	                        <span class="invalid-feedback" role="alert">
	                            <strong>{{ $message }}</strong>
	                        </span>
	                  @enderror
	            </div>
	            <div class="form-group col-md-6">
	                <label for="inputAddress2">Shipping Address</label>
	                <textarea id="shipping_address" class="form-control @error('shipping_address') is-invalid @enderror" name="shipping_address" autocomplete="shipping_address" autofocus>{{$user->shipping_address}}</textarea>
	                  @error('shipping_address')
	                        <span class="invalid-feedback" role="alert">
	                            <strong>{{ $message }}</strong>
	                        </span>
	                  @enderror
	            </div>
	            <div class="form-group col-md-6">
	              <label for="inputState">Division</label><br/>
	              <select id="division_id" class="form-control @error('division_id') is-invalid @enderror" name="division_id" required>
	                <option selected>Select Your Division</option>
	                @foreach($divisions as $division)
	                    <option value="{{ $division->id }}" {{ $user->division_id == $division->id ? 'selected': '' }}>{{ $division->name }}</option>
	                @endforeach
	              </select>
	                  @error('division_id')
	                        <span class="invalid-feedback" role="alert">
	                            <strong>{{ $message }}</strong>
	                        </span>
	                  @enderror
	            </div>
	            <div class="form-group col-md-6">
	              <label for="inputCity">District</label><br/>
	              <select id="district_id" class="form-control @error('district_id') is-invalid @enderror" name="district_id" required>
	                <option selected>Select Your District</option>
	                @foreach($districts as $district)
	                  <option value="{{ $district->id }}"{{ $user->district_id == $district->id ? 'selected': '' }}>{{ $district->name }}</option>
	                @endforeach
	              </select>
	                  @error('district_id')
	                        <span class="invalid-feedback" role="alert">
	                            <strong>{{ $message }}</strong>
	                        </span>
	                  @enderror
	            </div>
	            <div class="form-group">
	                <button type="submit" class="btn btn-primary btn-block">{{ __('Update') }}</button>
	            </div>
	          </div>
	      </form>
	    </div>
	  </div>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->

@endsection
