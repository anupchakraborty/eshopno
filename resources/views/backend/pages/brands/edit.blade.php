@extends('backend.layouts.master')
@section('title')
    Brand | Admin Panel
@endsection
@section('admin_content')
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Brands for Your Shop</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">edit Brands</li>
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
                            <h3 class="card-title">Edit Brands</h3>
                            </div>

                            <!-- form start -->
                            <form action="{{Route('admin.brand.update', $brand->id )}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Brand Name</label>
                                        <input type="text" class="form-control" name= "brand_name" value="{{ $brand->brand_name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Brand Description</label>
                                        <textarea rows="5" class="form-control" name= "brand_description" placeholder="Enter Brand Description">{{ $brand->brand_description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Brand Old Image</label>
                                        <div class="row">
                                            <div class="cl-12">
                                                <img src="{!! asset('backend/img/brands/'.$brand->brand_image) !!}" width="100">
                                            </div>
                                        </div>
                                        <label for="exampleInputEmail1">Brand New Image(Optional)</label>
                                        <div class="row">
                                            <div class="cl-12">
                                                <input type="file" class="form-control" name= "image">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit"  class="btn btn-success">Update Brands</button>
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

