@extends('backend.layouts.master')

@section('admin_content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>View Your Products</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
              <li class="breadcrumb-item active">View Product</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">View Product</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <td scope="col"><strong>Product Title</strong></td>
                                  <td scope="col">{{ $view->product_title }}</td>
                                </tr>
                              </tbody>
                              <tbody>
                                <tr>
                                  <td scope="col"><strong>Product Description</strong></td>
                                  <td scope="col">{{ $view->product_description }}</td>
                                </tr>
                              </tbody>
                              <tbody>                              
                              <tbody>
                                <tr>
                                  <td scope="col"><strong>Quantity</strong></td>
                                  <td scope="col">{{ $view->quantity }}</td>
                                </tr>
                              </tbody>
                              <tbody>
                                <tr>
                                  <td scope="col"><strong>Sell price</strong></td>
                                  <td scope="col">{{ $view->sell_price }}</td>
                                </tr>
                              </tbody>
                              <tbody>
                                <tr>
                                  <td scope="col"><strong>Buy price</strong></td>
                                  <td scope="col">{{ $view->buy_price }}</td>
                                </tr>
                              </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>


@endsection