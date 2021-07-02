@extends('backend.layouts.master')
@section('title')
    Shop Setting | Admin Panel
@endsection
@section('admin_content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Your Shop</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Shop Setting</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Shop Setting</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table">
                                        @foreach ($settings as $setting)
                                        <tr>
                                            <td>Shop Email</td>
                                            <td>{{ $setting->email }}</td>
                                        </tr>
                                        <tr>
                                            <td>Shop Phone</td>
                                            <td>{{ $setting->phone }}</td>
                                        </tr>
                                        <tr>
                                            <td>Shop Address</td>
                                            <td>{{ $setting->address }}</td>
                                        </tr>
                                        <tr>
                                            <td>Shop Logo</td>
                                            <td><img src="{!! asset('backend/img/'.$setting->logo) !!}" alt=""></td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div> <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>


@endsection
