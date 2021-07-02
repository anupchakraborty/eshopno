@extends('frontend.layouts.master')
@section('title')
    EShop | Profile
@endsection
@section('content')
<!-- Preloader -->
<div class="preloader">
    <div class="preloader-inner">
        <div class="preloader-icon">
            <span></span>
            <span></span>
        </div>
    </div>
</div>
<!-- End Preloader2 -->

<!-- Header -->
<header class="header shop">
    <!-- Topbar -->
    @include('frontend.partials.topbar')
    <!-- End Topbar -->

    <!-- middle-inner -->
    @include('frontend.partials.middle-inner')
    <!-- middle-inner -->

    <!-- Header Inner -->
    <div class="header-inner">
        <div class="container">
            <div class="cat-nav-head">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="all-category">
                            <h3 class="cat-heading"><i class="fa fa-bars" aria-hidden="true"></i>CATEGORIES</h3>
                            <ul class="main-category">

                                @foreach (App\Models\Category::orderBy('cat_name','asc')->where('parent_id', NULL)->get() as $parent)

                                    <li><a href="{{ Route('categories.show', $parent->id) }}">{{ $parent->cat_name }}</a>
                                        <ul class="sub-category">
                                        @foreach (App\Models\Category::orderBy('cat_name','asc')->where('parent_id', $parent->id)->get() as $child)

                                            <li><a href="{{ Route('categories.show', $child->id) }}">{{ $child->cat_name }}</a></li>
                                        @endforeach
                                        </ul>
                                    </li>

                                @endforeach

                            </ul>
                        </div>
                    </div>

                    <!-- header-inner -->
                    @include('frontend.partials.header-inner')
                    <!-- header-inner -->
                </div>
            </div>
        </div>
    </div>
    <!--/ End Header Inner -->
</header>
<!--/ End Header -->


    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-3"></div>
          <div class="col-md-9">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center mt-3">
                  <img class="profile-user-img img-fluid img rounded-circle"
                       src="{{ App\Helpers\ImageHelper::getUserImage(Auth::user()->id) }}"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{ $user->first_name. ' '.$user->last_name }}</h3>

                <p class="text-muted text-center">Genarel User</p>

                <ul class="list-group list-group-unbordered mt-3">
                  <li class="list-group-item">
                    <b>Username</b> <a class="float-right">{{ $user->username }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Email Address</b> <a class="float-right">{{ $user->email }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Phone</b> <a class="float-right">{{ $user->phone }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Street Address</b> <a class="float-right">{{ $user->street_address }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Shipping Address</b> <a class="float-right">{{ $user->shipping_address }}</a>
                  </li>
                  <li class="list-group-item">

                    <b>Division</b> <a class="float-right">{{ $divisions->name }}</a>

                  </li>
                  <li class="list-group-item">

                    <b>District</b> <a class="float-right">{{ $districts->name }}</a>

                  </li>
                </ul>

                <a href="{{ route('user.profile') }}" class="btn btn-primary btn-block text-center"><b>Update Information</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Education</strong>

                <p class="text-muted">
                  B.S. in Computer Science from the University of Tennessee at Knoxville
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                <p class="text-muted">Malibu, California</p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                <p class="text-muted">
                  <span class="tag tag-danger">UI Design</span>
                  <span class="tag tag-success">Coding</span>
                  <span class="tag tag-info">Javascript</span>
                  <span class="tag tag-warning">PHP</span>
                  <span class="tag tag-primary">Node.js</span>
                </p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->


        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

@endsection
