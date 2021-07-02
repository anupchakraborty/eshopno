@extends('frontend.layouts.master')

@section('title')
   Eshop  | CheckOut page
@endsection

@section('content')
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
                            <li class="active"><a href="blog-single.html">Checkout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
    @if(App\Models\Cart::totalItems() > 0)
    <!-- Start Checkout -->
    <section class="shop checkout section">
        <div class="container">
            <!-- Form -->
            <form class="form" method="POST" action="{{ route('checkouts.store') }}">
                @csrf
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <div class="checkout-form">
                            <h2>Make Your Checkout Here</h2>
                            <p>Please register in order to checkout more quickly</p>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>First Name<span>*</span></label>
                                            <input type="text" name="first_name" value="{{ Auth::check() ?Auth::user()->first_name : '' }}" placeholder="Enter Your First Name" required="required">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Last Name<span>*</span></label>
                                            <input type="text" name="last_name" value="{{ Auth::check() ?Auth::user()->last_name : '' }}" placeholder="Enter Your Last Name" required="required">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Email Address<span>*</span></label>
                                            <input type="email" name="email" value="{{ Auth::check() ?Auth::user()->email : '' }}" placeholder="Enter Your Email Address" required="required">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Phone Number<span>*</span></label>
                                            <input type="text" name="phone" value="{{ Auth::check() ?Auth::user()->phone : '' }}" placeholder="Enter Your Phone Number" required="required">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                        <label for="inputState">Division<span>*</span></label>
                                        <select id="division_id" class="form-control" name="division_id" required>
                                            <option selected>Select Your Division</option>
                                            @foreach(App\Models\Division::all() as $division)
                                                <option value="{{ $division->id }}">{{ $division->name }}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>District<span>*</span></label>
                                            <select id="district_id" class="form-control" name="district_id" required>
                                                <option selected>Select Your District</option>
                                                @foreach(App\Models\District::all() as $district)
                                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Message<span>*</span></label>
                                            <textarea name="message" placeholder="Ask Any Query"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Shipping Address<span>*</span></label>
                                            <textarea name="shipping_address" value="{{ Auth::check() ?Auth::user()->shipping_address : '' }}" placeholder="Enter Your Shipping Address" required="required"></textarea>
                                        </div>
                                    </div>
                                </div>

                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="order-details">
                            <!-- Order Widget -->
                            <div class="single-widget">
                                <h2>CART  DETAILS</h2>
                                <div class="content">
                                    @php
                                        $total_price = 0;
                                    @endphp
                                    @foreach (App\Models\Cart::totalcarts() as $cart)
                                        @php
                                            $total_price += $cart->product_quantity * $cart->product->buy_price;
                                        @endphp
                                    @endforeach
                                    <ul>
                                        <li>Sub Total<span>{{ $total_price }} Tk</span></li>
                                        <li>(+) Shipping<span>
                                            @php
                                                $shipping_cost = App\Models\Setting::first()->shipping_cost;
                                            @endphp
                                            {{ $shipping_cost }} Tk</span>
                                        </li>
                                        <li class="last">Total<span>{{ $total_price + $shipping_cost }} Tk</span></li>
                                    </ul>
                                </div>
                            </div>
                            <!--/ End Order Widget -->
                            <!-- Order Widget -->
                            <div class="single-widget">
                                <h2>Payments</h2>
                                <div class="content">
                                    <div class="payment">
                                        {{-- <label>Select Payment Method<span>*</span></label> --}}
                                        <select name="payment_method_id" id="payment" required="required">
                                            <option selected>Select Any Payment Method</option>
                                            @foreach($payments as $payment)
                                                <option value="{{ $payment->id }}">{{ $payment->name }}</option>
                                            @endforeach
                                        </select>
                                        @foreach($payments as $payment)
                                            @if($payment->id == 1)
                                            <div id="payment_{{ $payment->short_name }}" class="hidden">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <strong>Finishing Order Process</strong>
                                                    </div>
                                                    <div class="card-body">
                                                        <label>For Cash In nothing neccessary. Just Click Finish Order !</label>
                                                        <hr/>
                                                        <strong>Thanks, For Buying product in our shop.</strong>
                                                    </div>
                                                </div>
                                            </div>
                                            @else
                                            <div id="payment_{{ $payment->short_name }}" class="hidden">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <strong>Finishing Order Process</strong>
                                                    </div>
                                                    <div class="card-body">
                                                        <h6>{{ $payment->short_name }} Payment</h6>
                                                        <hr/>

                                                        <div class="alert alert-success">
                                                            <span>Please send the above money and write down your transcation code below there</span>
                                                        </div>

                                                            <label>{{ $payment->name }} NO : {{ $payment->payment_no }}</label><br>
                                                            <label>Account Type : {{ $payment->payment_type }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        @endforeach

                                            <div class="form-group">
                                                <input type="text" name="transcation_id" id="transcation_id" placeholder="Enter Transcation ID" class="form-control hidden">
                                            </div>

                                    </div>
                                </div>
                            </div>
                            <!--/ End Order Widget -->
                            <!-- Payment Method Widget -->
                            <div class="single-widget payement">
                                <div class="content">
                                    <img src="{{ asset('frontend/images/payment-method.png') }}" alt="#">
                                </div>
                            </div>
                            <!--/ End Payment Method Widget -->
                            <!-- Button Widget -->
                            <div class="single-widget get-button">
                                <div class="content">
                                    <div class="button">
                                        <button type="submit" class="btn">Order Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
                <!--/ End Form -->
        </div>
    </section>
    <!--/ End Checkout -->
    @else
    <div class="container">
        <div class="alert alert-warning">
            <strong> <p class="text-danger"> There is no Item in Your Cart.</p></strong>
        </div>
    </div>
    @endif
@endsection


@section('scripts')
<script>
    $("#payment").change(function(){
        $payment_method = $("#payment").val();
        //alert();
        if($payment_method == 1){
            $("#payment_cash_in").removeClass('hidden');
            $("#payment_bkash").addClass('hidden');
            $("#payment_roket").addClass('hidden');
        }
        else if($payment_method == 2){
            $("#payment_bkash").removeClass('hidden');
            $("#payment_cash_in").addClass('hidden');
            $("#payment_roket").addClass('hidden');
            $("#transcation_id").removeClass('hidden');
        }
        else if($payment_method == 3){
            $("#payment_roket").removeClass('hidden');
            $("#payment_cash_in").addClass('hidden');
            $("#payment_bkash").addClass('hidden');
            $("#transcation_id").removeClass('hidden');
        }
    })
</script>

<script>
    $("#division_id").change(function(){
        var division = $("#division_id").val();
        //alert(division);
        $("#district_area").html("");
        var option = "<option selected>Select Your District</option>";
        //send a ajax request to server
        $.get( "http://127.0.0.1:8000/get-districts/"+division, function( data ) {

             data = JSON.parse(data);
            //console.log(data);
            data.forEach(function(element){
                option += "<option value='"+ element.id +"'>"+ element.name +"</option>";
            });
             $("#district_area").html(option);
        });
    })
</script>
@endsection
