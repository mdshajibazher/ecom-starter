<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />

	
    <!-- Styles -->
    <link href="{{ asset('css/frontend.css') }}" rel="stylesheet">

	<!-- Document Title
	============================================= -->
	<title>@section('title')</title>

</head>

<body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		@include('layouts.frontend.partials.top-bar')

		@include('layouts.frontend.partials.header')

		@include('layouts.frontend.partials.slider')



		<!-- Content
		============================================= -->
		<section id="content">
            @yield('content')
		</section><!-- #content end -->

		@include('layouts.frontend.partials.footer')

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

	<!-- JavaScripts
	============================================= -->
	<script src="{{asset('frontend/js/jquery.js')}}"></script>
	<script src="{{asset('frontend/js/plugins.min.js')}}"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="{{asset('frontend/js/functions.js')}}"></script>

</body>
</html>