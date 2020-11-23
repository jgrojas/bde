<!DOCTYPE html>
<html dir="ltr" lang="en-US">
@include('includes.head')

<body class="stretched page-transition" data-loader-html="<img class='infinite animated pulse' src='demos/barber/images/slider-logo.svg' width='300'>">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		@include('includes.header')

		@yield('slider')
		
		@yield('content')		

		@include('includes.footer')

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

	<!-- JavaScripts
	============================================= -->
	<script src="js/jquery.js"></script>
	<script src="js/plugins.min.js"></script>
	<script src="https://maps.google.com/maps/api/js?key=YOUR-API-KEY"></script>
	
	<!-- Footer Scripts
	============================================= -->
	<script src="js/functions.js"></script>
	@yield('javascripts')
</body>
</html>