<!DOCTYPE html>
<html dir="ltr" lang="en-US">
@include('includes.head')
@yield('styles')	
<body class="stretched page-transition" data-loader-html="<img class='infinite animated pulse' src='images/slider-logo_bw.png' width='300'>">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		@include('includes.header')

		@include('includes.slider')
		
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
	<!-- <script src="https://maps.google.com/maps/api/js?key=YOUR-API-KEY"></script> -->

	<!-- Bootstrap Select Plugin -->
	<script src="js/components/bs-select.js"></script>

	<!-- Select Splitter Plugin -->
	<script src="js/components/selectsplitter.js"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="js/functions.js"></script>
	
	@yield('javascripts')
</body>
</html>