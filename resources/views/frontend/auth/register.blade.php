<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>
        @yield('title', 'Eshop')
   </title>

  <link rel="icon" type="image/png" href="{{URL::To('frontend/images/favicon.png')}}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('frontend/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('frontend/css/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('frontend/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

<style type="text/css">

  .register-box {
    width: 550px;
}
</style>
</head>
<body class="hold-transition register-page">
<div class="register-box mt-2">
  <div class="register-logo">
     <img src="{{URL::To('frontend/images/logo.png')}}" alt="#">
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <h5 class="login-box-msg">{{ __('Register for Shoping') }}</h5>

      @include('backend.partials.message')

      <form action="{{ route('register') }}" method="post">

        @csrf

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail4">First Name</label>
              <input type="text" id="first_name" class="form-control @error('first_name') is-invalid @enderror" name="first_name" required autocomplete="first_name" placeholder="Enter Your First Name" autofocus>
                  @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                  @enderror
            </div>
            <div class="form-group col-md-6">
              <label for="inputEmail4">Last Name</label>
              <input type="text" id="last_name" class="form-control @error('last_name') is-invalid @enderror" name="last_name" required autocomplete="last_name" placeholder="Enter Your Last Name" autofocus>
                  @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                  @enderror
            </div>
            <div class="form-group col-md-6">
              <label for="inputEmail4">Phone</label>
              <input type="text" id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" required autocomplete="phone" placeholder="Enter Your phone number" autofocus>
                  @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                  @enderror
            </div>
            <div class="form-group col-md-6">
              <label for="inputEmail4">Email Address</label>
              <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email" placeholder="Enter Your Email Address" autofocus>
                  @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                  @enderror
            </div>
            <div class="form-group col-md-6">
              <label for="inputPassword4">Password</label>
              <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="password" placeholder="Enter Your Password" autofocus>
                  @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                  @enderror

            </div>
            <div class="form-group col-md-6">
              <label for="inputPassword4">Confirm Password</label>
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  placeholder="Enter Your Confirm Password" required autocomplete="new-password" autofocus>
            </div>
            <div class="form-group col-md-6">
                <label for="inputAddress">Street Address</label>
                <textarea id="street_address" class="form-control @error('street_address') is-invalid @enderror" name="street_address" required autocomplete="street_address" placeholder="1234 Main St" autofocus></textarea>
                  @error('street_address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                  @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="inputAddress2">Shipping Address</label>
                <textarea id="shipping_address" class="form-control @error('shipping_address') is-invalid @enderror" name="shipping_address" autocomplete="shipping_address" placeholder="1234 Main St" autofocus></textarea>
                  @error('shipping_address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                  @enderror
            </div>
            <div class="form-group col-md-6">
              <label for="inputState">Division</label>
              <select id="division_id" class="form-control @error('division_id') is-invalid @enderror" name="division_id" required>
                <option selected>Select Your Division</option>
                @foreach($divisions as $division)
                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                @endforeach
              </select>
                  @error('division_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                  @enderror
            </div>
            <div class="form-group col-md-6">
              <label for="inputCity">District</label>
              <select id="district_area" class="form-control @error('district_id') is-invalid @enderror" name="district_id" required>

              </select>
                  @error('district_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                  @enderror
            </div>
            <div class="form-group col-md-8">
                <div class="form-check">
                    <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                    <label for="agreeTerms">
                     I agree to the <a href="#">terms</a>
                    </label>
                </div>
            </div>
            <div class="form-group col-md-4">
                <button type="submit" class="btn btn-primary btn-block">{{ __('Register') }}</button>
            </div>
          </div>
      </form>
              <div class="social-auth-links text-center">
                <p>- OR -</p>
                <a href="#" class="btn btn-block btn-primary">
                  <i class="fab fa-facebook mr-2"></i>
                  Sign up using Facebook
                </a>
                <a href="#" class="btn btn-block btn-danger">
                  <i class="fab fa-google-plus mr-2"></i>
                  Sign up using Google+
                </a>
              </div>

      <a href="{{ route('login') }}" class="text-center">I already have an account</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->


<!-- jQuery -->
<script src="{{asset('frontend/js/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('frontend/js/adminlte.min.js')}}"></script>

<script>
    $("#division_id").change(function(){
        var division = $("#division_id").val();
        //alert(division);
        $("#district_area").html("");
        var option = "<option selected>Select Your District</option>";
        //send a ajax request to server
        $.get( "http://127.0.0.1:8000/get-districts/"+division, function( data ) {

            data = JSON.parse(data);
            data.forEach(function(element){
                option += "<option value='"+ element.id +"'>"+ element.name +"</option>";
            });
            $("#district_area").html(option);
        });
    })
</script>
</body>
</html>
