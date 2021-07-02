@extends('backend.layouts.master')
@section('title')
   View Order | Admin Panel
@endsection
@section('admin_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>View Order</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">view Order</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
        <div class="card card-solid">
            <div class="card-header">
                <h5>View Order ID: #OIES{{ $order->id }}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-7">
                        @php
                            $carts = App\Models\Cart::where('order_id', $order->id)->get();
                        @endphp
                        @foreach($carts as $cart)
                        <div class="card">
                            @php
                                $product = App\Models\Product::where('id', $cart->product_id)->first();
                                $Image = App\Models\ProductImage::where('product_id', $product->id)->first();
                            @endphp
                            <div class="card-body">
                                <img src="{{ asset('backend/img/products/'.$Image->image) }}" alt="" style="width:550px; height:400px;">
                                <h4 class="mt-2 ml-3">Product Name: {{ $product->product_title }}</h4>
                                <p class="mt-2 ml-3">Brand Name: <span class="badge badge-info">{{ $product->brand->brand_name }}</span></p>
                                <p class="mt-2 ml-3">Product Description: {{ $product->product_description }}</p>
                                <h4 class="mt-2 ml-3">Available Colors</h4>
                                <div class="btn-group btn-group-toggle mt-2 ml-3" data-toggle="buttons">
                                    <label class="btn btn-default text-center active">
                                    <input type="radio" name="color_option" id="color_option_a1" autocomplete="off" checked>
                                    Green
                                    <br>
                                    <i class="fas fa-circle fa-2x text-green"></i>
                                    </label>
                                    <label class="btn btn-default text-center">
                                    <input type="radio" name="color_option" id="color_option_a2" autocomplete="off">
                                    Blue
                                    <br>
                                    <i class="fas fa-circle fa-2x text-blue"></i>
                                    </label>
                                    <label class="btn btn-default text-center">
                                    <input type="radio" name="color_option" id="color_option_a3" autocomplete="off">
                                    Purple
                                    <br>
                                    <i class="fas fa-circle fa-2x text-purple"></i>
                                    </label>
                                    <label class="btn btn-default text-center">
                                    <input type="radio" name="color_option" id="color_option_a4" autocomplete="off">
                                    Red
                                    <br>
                                    <i class="fas fa-circle fa-2x text-red"></i>
                                    </label>
                                    <label class="btn btn-default text-center">
                                    <input type="radio" name="color_option" id="color_option_a5" autocomplete="off">
                                    Orange
                                    <br>
                                    <i class="fas fa-circle fa-2x text-orange"></i>
                                    </label>
                                </div>
                                <h4 class="mt-2 ml-3">Size <small>Please select one</small></h4>
                                <div class="btn-group btn-group-toggle mt-2 ml-3" data-toggle="buttons">
                                    <label class="btn btn-default text-center">
                                    <input type="radio" name="color_option" id="color_option_b1" autocomplete="off">
                                    <span class="text-xl">S</span>
                                    <br>
                                    Small
                                    </label>
                                    <label class="btn btn-default text-center">
                                    <input type="radio" name="color_option" id="color_option_b2" autocomplete="off">
                                    <span class="text-xl">M</span>
                                    <br>
                                    Medium
                                    </label>
                                    <label class="btn btn-default text-center">
                                    <input type="radio" name="color_option" id="color_option_b3" autocomplete="off">
                                    <span class="text-xl">L</span>
                                    <br>
                                    Large
                                    </label>
                                    <label class="btn btn-default text-center">
                                    <input type="radio" name="color_option" id="color_option_b4" autocomplete="off">
                                    <span class="text-xl">XL</span>
                                    <br>
                                    Xtra-Large
                                    </label>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div><!-- /.col-sm-7 -->
                    <div class="col-sm-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="my-2">Orderer Name: {{ $order->name }}</h4>
                                <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                                <h5 class="my-2">Payment Type: <span class="badge badge-info"> {{ $order->payment->name }}</span></h5>
                                <h6 class="my-2">Orderer Transcation ID: <span class="badge badge-success">{{ $order->transcation_id }}</span></h6>
                                <p class="my-2">Orderer Phone: {{ $order->phone_no }}</p>
                                <p class="my-2">Orderer Email: {{ $order->email }}</p>
                                <p class="my-2">Orderer Shipping Address: {{ $order->shipping_address }}</p>

                                <p class="my-3">Order Status:
                                    <span class="badge badge-danger">
                                        @if($order->is_completed == 1)
                                            Completed
                                        @else
                                            Panding
                                        @endif
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div><!-- /.col-sm-5 -->
                </div><!-- /.row -->

                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Product Name</td>
                                <td>Quantity</td>
                                <td>Unit Price</td>
                                <td>Sub Total</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $carts = App\Models\Cart::where('order_id', $order->id)->get();

                            @endphp

                            @foreach ($carts as $cart)
                                @php
                                    $product = App\Models\Product::where('id', $cart->product_id)->first();
                                    $total_price = 0;
                                @endphp
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $product->product_title }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->buy_price }}</td>
                                    <td>
                                        @php
                                                $total_price += $cart->product_quantity * $cart->product->buy_price;
                                        @endphp
                                            {{ $cart->product_quantity * $cart->product->buy_price }} TK
                                    </td>
                                </tr>
                            @endforeach
                                <tr>
                                    <td colspan="4">Total</td>
                                    <td>{{ $total_price }} Tk</td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div><!-- /.card-body -->
        </div> <!-- /.card-solid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
