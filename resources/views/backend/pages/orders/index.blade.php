@extends('backend.layouts.master')
@section('title')
    Order | Admin Panel
@endsection
@section('admin_content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Your Orders</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Manage Orders</li>
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
                            <h3 class="card-title">Manage Orders</h3>


                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="card">
                                <div class="card-body">
                                    <table class="display" style="width:100%" id="myTable">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Customer Name</th>
                                                <th>Customer Phone</th>
                                                <th>Shipping Address</th>
                                                <th>Trancation ID</th>
                                                <th>Admin Seen</th>
                                                <th>Payment Status</th>
                                                <th>Order Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order )
                                                <tr>
                                                    <td>#OIES{{ $order->id}}</td>
                                                    <td>{{ $order->name }}</td>
                                                    <td>{{ $order->phone_no }}</td>
                                                    <td>{{ $order->shipping_address }}</td>
                                                    <td>{{ $order->transcation_id }}</td>
                                                    <td>
                                                        @if($order->is_seen_by_admin == 1)
                                                            <a href="{{Route('admin.order.adminseen',$order->id)}}">
                                                                <span class="badge bg-success">Seen</span>
                                                            </a>
                                                        @else
                                                            <a href="{{Route('admin.order.adminunseen',$order->id)}}">
                                                                <span class="badge bg-danger">Unseen</span>
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($order->is_paid == 1)
                                                            <a href="{{Route('admin.order.paid',$order->id)}}">
                                                                <span class="badge bg-success">Paid
                                                                    <br/>
                                                                    <small class="text-dark">
                                                                        -by{{ $order->payment->name }}
                                                                    </small>
                                                                </span>
                                                            </a>
                                                        @else
                                                            <a href="{{Route('admin.order.due',$order->id)}}">
                                                                <span class="badge bg-warning">Due</span>
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($order->is_completed == 1)
                                                            <a href="{{Route('admin.order.completed',$order->id)}}">
                                                                <span class="badge bg-light">Completed</span>
                                                            </a>
                                                        @else
                                                            <a href="{{Route('admin.order.panding',$order->id)}}">
                                                                <span class="badge bg-primary">Panding</span>
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-sm btn-secondary" href="{{Route('admin.order.show', $order->id)}}">
                                                            <i class="fas fa-eye"></i></a>
                                                        <a  href="#deleteModal{{ $order->id }}" class="btn btn-sm btn-danger" data-toggle="modal">
                                                            <i class="fa fa-trash"></i></a>
                                                        <!--Delete Modal1 -->
                                                        <div id="deleteModal{{ $order->id }}" class="modal fade">
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
                                                                        <form action="{!! Route('admin.order.delete', $order->id) !!}" method="post">
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
                                                <th>Order ID</th>
                                                <th>Customer Name</th>
                                                <th>Customer Phone</th>
                                                <th>Shipping Address</th>
                                                <th>Trancation ID</th>
                                                <th>Admin Seen</th>
                                                <th>Payment Status</th>
                                                <th>Order Status</th>
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
  </div>

@endsection
