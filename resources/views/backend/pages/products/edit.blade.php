@extends('backend.layouts.master')

@section('admin_content')
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Product for Your Shop</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">edit product</li>
                </ol>
            </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

        <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card card-success">
                            <div class="card-header">
                            <h3 class="card-title">Edit Product</h3>
                            </div>


                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li><strong>Please Fill !! &nbsp;</strong>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- form start -->
                            <form action="{{Route('admin.product.update', $prod_edit->id )}}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Product Title</label>
                                        <input type="text" class="form-control" name= "product_title" value="{{ $prod_edit->product_title }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Product Category</label>
                                        <select name="cat_id" class="form-control">
                                              <option value="">Please Select a Category</option>
                                            @foreach($main_category as $cat)
                                                <option value="{{ $cat->id }}"{{ $cat->id == $prod_edit->cat_id ? 'selected' : '' }}>{{ $cat->cat_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Brand</label>
                                        <select name="brand_id" class="form-control">
                                              <option value="">Please Select a Brand</option>
                                            @foreach($main_brand as $brand)
                                                <option value="{{ $brand->id }}"{{ $brand->id == $prod_edit->brand_id ? 'selected' : '' }}>{{ $brand->brand_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Product Description</label>
                                        <textarea rows="5" class="form-control" name= "product_description"> {{ $prod_edit->product_description }} </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Quantity</label>
                                        <input type="text" class="form-control" name= "quantity" value="{{ $prod_edit->quantity }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Sell Price</label>
                                        <input type="text" class="form-control" name= "sell_price" value="{{ $prod_edit->sell_price }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Buy Price</label>
                                        <input type="text" class="form-control" name= "buy_price" value="{{ $prod_edit->buy_price }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Product Color</label>
                                        <input type="text" class="form-control" name= "product_color" value="{{ $prod_edit->product_color }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Product Size</label>
                                        <input type="text" class="form-control" name= "product_size" value="{{ $prod_edit->product_size }}">
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit"  class="btn btn-success">Update Product</button>
                                        <button type="reset"  class="btn btn-success">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection

