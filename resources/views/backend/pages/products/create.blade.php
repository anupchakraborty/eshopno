@extends('backend.layouts.master')

@section('title')
    Create Products | Admin Panel
@endsection

@section('admin_content')
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Add Product for Your Shop</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">add product</li>
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
                            <h3 class="card-title">Add Product</h3>
                            </div>

                            <!-- form start -->
                            <form action="{{Route('admin.product.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Product Title</label>
                                        <input type="text" id="product_title" class="form-control" name= "product_title" placeholder="Enter Product Title">
                                        @error('product_title')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Product Category</label>
                                        <select name="category_id" id="category_id"  class="form-control">
                                              <option value="">Please Select a Category</option>
                                              @foreach($main_category as $category)
                                                <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
                                              @endforeach
                                              @error('category_id')
                                                <small class="text-danger">{{ $message }}</small>
                                              @enderror
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Brand</label>
                                        <select name="brand_id" id="brand_id"  class="form-control">
                                              <option value="">Please Select a Brand</option>
                                              @foreach($main_brand as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                              @endforeach
                                              @error('brand_id')
                                                 <small class="text-danger">{{ $message }}</small>
                                              @enderror
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Product Description</label>
                                        <textarea rows="5" id="product_description"  class="form-control" name= "product_description" placeholder="Enter Category Description"></textarea>
                                        @error('product_description')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Quantity</label>
                                        <input type="text" id="quantity"  class="form-control" name= "quantity" placeholder="Enter Quantity">
                                        @error('quantity')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Sell Price</label>
                                        <input type="text" id="sell_price"  class="form-control" name= "sell_price" placeholder="Enter Sell Price">
                                        @error('sell_price')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Buy Price</label>
                                        <input type="text" id="buy_price"  class="form-control" name= "buy_price" placeholder="Enter buy price">
                                        @error('buy_price')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Product Color</label>
                                        <input type="text" id="product_color"  class="form-control" name= "product_color" placeholder="Enter Product Color">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Product Size</label>
                                        <input type="text" id="product_size"  class="form-control" name= "product_size" placeholder="Enter Product Size">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Product Status</label>
                                        <div class="row mt-2">
                                            &nbsp;&nbsp;&nbsp; Active &nbsp;<input type="checkbox" id="status"  name= "status" value="1">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Product Image</label>
                                        <div class="row">
                                            <div class="cl-md-4">
                                                <input type="file" class="form-control" name= "product_image[]">
                                            </div>
                                            <div class="cl-md-4">
                                                <input type="file" class="form-control" name= "product_image[]">
                                            </div>
                                            <div class="cl-md-4">
                                                <input type="file" class="form-control" name= "product_image[]">
                                            </div>
                                            <div class="cl-md-4">
                                                <input type="file" class="form-control" name= "product_image[]">
                                            </div>
                                            <div class="cl-md-4">
                                                <input type="file" class="form-control" name= "product_image[]">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit"  class="btn btn-success">Add Product</button>
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

