@extends('backend.layouts.master')
@section('title')
    Category | Admin Panel
@endsection
@section('admin_content')
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Add Category for Your Shop</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">add Category</li>
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
                            <h3 class="card-title">Add Category</h3>
                            </div>

                            <!-- form start -->
                            <form action="{{Route('admin.category.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Category Name</label>
                                        <input type="text" class="form-control" name= "cat_name" placeholder="Enter Category Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Category Description</label>
                                        <textarea rows="5" class="form-control" name= "cat_description" placeholder="Enter Category Description"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Parent ID</label>
                                        <select name="parent_id" class="form-control">
                                              <option value="">Please select a Category</option>
                                            @foreach($main_category as $category)
                                                <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Category Image</label>
                                        <div class="row">
                                            <div class="cl-md-4">
                                                <input type="file" class="form-control" name= "cat_image">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Category Status</label>
                                        <div class="row">
                                            &nbsp;&nbsp;&nbsp;<input type="checkbox" name= "status" value="1">
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit"  class="btn btn-success">Add Category</button>
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

