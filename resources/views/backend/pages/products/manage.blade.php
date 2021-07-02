@extends('backend.layouts.master')

@section('admin_content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Your Products</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Manage Product</li>
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
                            <h3 class="card-title">Manage Product</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="card">
                                <div class="card-body">
                                    <table class="display" style="width:100%" id="myTable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Product Code</th>
                                                <th>Title</th>
                                                <th>Quantity</th>
                                                <th>Brand</th>
                                                <th>Buy Price</th>
                                                <th>Product Size</th>
                                                <th>Product Color</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($manage_products as $product )
                                                <tr>
                                                    <td>{{ $loop->index+1 }}</td>
                                                    <td>#POES{{ $product->id }}</td>
                                                    <td>{{ $product->product_title }}</td>
                                                    <td>{{ $product->quantity }}</td>
                                                    <td>{{ $product->brand_name }}</td>
                                                    <td>{{ $product->buy_price }}</td>
                                                    <td>{{ $product->product_size }}</td>
                                                    <td>{{ $product->product_color }}</td>
                                                    <td>
                                                    @if($product->status == 1)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-danger">Deactive</span>
                                                    @endif
                                                    </td>
                                                    <td>
                                                        @if($product->status == 1)
                                                        <a class="btn btn-sm btn-dark" href="{{Route('admin.product.deactiveproduct',$product->id)}}">
                                                            <i class="fas fa-thumbs-down"></i>
                                                        </a>
                                                        @else
                                                        <a class="btn btn-sm btn-success" href="{{Route('admin.product.activeproduct',$product->id)}}">
                                                            <i class="fas fa-thumbs-up"></i>
                                                        </a>
                                                        @endif
                                                        <a class="btn btn-sm btn-info" href="{{Route('admin.product.view', $product->id)}}">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a class="btn btn-sm btn-warning" href="{{Route('admin.product.edit', $product->id)}}">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a  href="#deleteModal{{ $product->id }}" class="btn btn-sm btn-danger" data-toggle="modal">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                        <!--Delete Modal -->
                                                        <div id="deleteModal{{ $product->id }}" class="modal fade">
                                                            <div class="modal-dialog modal-confirm">
                                                                <div class="modal-content">
                                                                    <div class="modal-header flex-column">
                                                                        <div class="icon-box">
                                                                            <i class="material-icons">&#xE5CD;</i>
                                                                        </div>
                                                                        <h4 class="modal-title w-100">Are you sure?</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Do you really want to delete these records? This process cannot be undone.</p>
                                                                    </div>
                                                                    <div class="modal-footer justify-content-center">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                        <form action="{!! Route('admin.product.delete', $product->id) !!}" method="post">
                                                                            @csrf
                                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Product Code</th>
                                                <th>Title</th>
                                                <th>Quantity</th>
                                                <th>Brand</th>
                                                <th>Buy Price</th>
                                                <th>Product Size</th>
                                                <th>Product Color</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>


@endsection
