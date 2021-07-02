@extends('backend.layouts.master')
@section('title')
    Add Division | Admin Panel
@endsection
@section('admin_content')
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Add Division</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">add Division</li>
                </ol>
            </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

        <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card card-success">
                            <div class="card-header">
                            <h3 class="card-title">Add Division</h3>
                            </div>

                            <!-- form start -->
                            <form action="{{Route('admin.division.store')}}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Division Name</label>
                                        <input type="text" class="form-control" name= "name" placeholder="Enter Division Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Priority</label>
                                        <input type="text" class="form-control" name= "priority" placeholder="Enter Priority ID">
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit"  class="btn btn-success">Add Division</button>
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

