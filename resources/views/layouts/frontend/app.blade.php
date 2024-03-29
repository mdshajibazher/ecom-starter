<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	
    <!-- Styles -->
    <link href="{{ asset('css/frontend.css') }}" rel="stylesheet">

	<!-- Document Title
	============================================= -->
	<title>@section('title')</title>

</head>

<body class="stretched">
	
	<!-- Document Wrapper
	============================================= -->
	<div id="vue-app" class="clearfix">

		@yield('onload-modal')
		
		@include('layouts.frontend.partials.top-bar')

		@include('layouts.frontend.partials.header')
		
		@yield('slider')

		<!-- Content
		============================================= -->
		<section id="content">
            @yield('content')
		</section><!-- #content end -->

		@include('layouts.frontend.partials.footer')
		@yield('modal')

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>
	<script src="{{asset('js/frontend.js')}}"></script>
	<!-- JavaScripts
	============================================= -->
	<script src="{{asset('frontend/js/jquery.js')}}"></script>
	<script src="{{asset('frontend/js/plugins.min.js')}}"></script>
	<!-- Footer Scripts
	============================================= -->
	<script src="{{asset('frontend/js/functions.js')}}"></script>
	
	@stack('js')

</body>
</html>