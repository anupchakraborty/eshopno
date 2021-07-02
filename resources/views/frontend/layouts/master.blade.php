<!DOCTYPE html>
<html lang="zxx">
<head>
	<!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
	<!-- Title Tag  -->
    <title>

    	@yield('title', 'Eshop | Home')

    </title>
   <!-- Start Shop header  -->
    @include('frontend.partials.style')
    <!-- End Shop header  -->
</head>
<body class="js">

    @yield('content')

	<!-- Start Shop Blog  -->
    @include('frontend.partials.blog')
	<!-- End Shop Blog  -->

	<!-- Start Shop services -->
    @include('frontend.partials.services')
	<!-- End Shop services -->

	<!-- Start Shop Newsletter  -->
    @include('frontend.partials.newsletter')
	<!-- End Shop Newsletter -->

    <!-- Start Footer Area -->
    @include('frontend.partials.footer')
	<!-- End Footer Area -->

    <!-- Start Scripts Area -->
        @include('frontend.partials.scripts')
    <!-- End Scripts Area -->
</body>
</html>
