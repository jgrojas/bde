@extends('master/master')


@section('slider')
		<!-- Slider
		============================================= -->
		<section id="slider" class="slider-element slider-parallax page-section min-vh-60 min-vh-md-100 include-header">
			<div class="slider-inner" style="background: url('images/Slide2.jpeg') center center no-repeat; background-size: cover;">
				<div class="vertical-middle">
					<div class="text-center py-5 py-md-0">
						<img src="images/slider-logo.png" alt="Logo" height="180">

						<!-- Slider Navigation
						============================================= -->
						<nav class="custom-hero-nav">
							<ul class="one-page-menu" data-easing="easeInOutExpo" data-speed="1300" data-offset="60">
								<li class="active"><a href="#" data-href="#slider">Home</a></li>
								<li><a href="#" data-offset="56" data-href="#service">Reporte Global</a></li>
								<li><a href="#" data-href="#price">Reporte por Nave</a></li>
								<li><a href="#" data-href="#shop">Mapa</a></li>
								<li><a href="#" data-href="#testimonial">Testimonial</a></li>
								<li><a href="#" data-href="#contact">Contact</a></li>
							</ul>
						</nav>
					</div>
				</div>

				<div class="video-wrap">
					<div class="video-overlay" style="background: rgba(0,0,0,0.3);"></div>
				</div>

				<!-- Slider Appointment Button
				============================================= -->
				<!-- <a href="#" class="button button-large button-color button-appointment d-none d-lg-block" data-scrollto="#contact" data-offset="62" data-easing="easeInOutExpo" data-speed="1300"><i class="icon-calendar2"></i> Make An Appointment</a> -->

				<!-- Slider Social Icons
				============================================= -->
				<!-- <div class="slider-social d-none d-lg-block clearfix">
					<a href="https://facebook.com/semicolonweb" target="_blank" class="social-icon si-small si-borderless si-facebook">
						<i class="icon-facebook"></i>
						<i class="icon-facebook"></i>
					</a>
					<a href="https://twitter.com/__semicolon" target="_blank" class="social-icon si-small si-borderless si-twitter">
						<i class="icon-twitter"></i>
						<i class="icon-twitter"></i>
					</a>
					<a href="https://instagram.com/semicolonweb" target="_blank" class="social-icon si-small si-borderless si-instagram">
						<i class="icon-instagram"></i>
						<i class="icon-instagram"></i>
					</a>
					<a href="https://youtube.com/semicolonweb" target="_blank" class="social-icon si-small si-borderless si-youtube">
						<i class="icon-youtube"></i>
						<i class="icon-youtube"></i>
					</a>
				</div>
 -->
			</div>
		</section>
@endsection

@section('content')
		<!-- Content
		============================================= -->
		<section id="content" style="border-top: 8px solid #bf9456">

			<div class="content-wrap py-0">

				<!-- About Section
				============================================= -->
				<div id="about" class="section m-0 bg-transparent page-section" style="padding: 150px 0">
					<div class="container clearfix">
						<div class="row clearfix">
							<div class="col-md-3 col-6 d-none d-md-block">
								<img src="images/1b.jpg" alt="Image">
							</div>
							<div class="col-md-6 col-12 center" style="padding: 0 50px;">
								<img src="images/ocean-transportation.png" alt="Image" height="60" style="margin-bottom: 20px">
								<div class="heading-block bottommargin-sm">
									<h2>Nuestro reto</h2>
								</div>
								<p>
								La administración del tránsito de naves fluviales producen constantemente información espacial y alfanumérica que requieren ser almacenadas y monitoreadas con fines administrativos, económicos y ambientales de las naves que constantemente surcan en los mares colombianos. Este proceso de monitoreo plantea cuatro retos fundamentales: i) Administrar cada uno de los movimientos de las naves teniendo control del origen, destino y caracterización de la operación de la embarcación; ii) Velar por la protección de los  ecosistemas que por su riqueza biológica y las características particulares las definen como áreas de conservación ambiental; iii) alertar a las embarcaciones las cuales podrían verse afectadas al navegar en condiciones de alto oleaje. iv) alertar el cruce de barcos entre límites marítimos con otros países para actividades que no requieran cruzar fronteras (ej. actividades pesqueras).

								</p>
								<img src="images/slider-logo_bw.png" alt="Image" width="200">
							</div>
							<div class="col-md-3 col-6 d-none d-md-block">
								<img src="images/2.jpg" alt="Image">
							</div>
						</div>
					</div>
				</div>

				<!-- Reporte Global
				============================================= -->
				<div id="global" class="section page-section bg-transparent p-0 mt-0 clearfix">

					<div class="row align-items-stretch clearfix bottommargin">

						<!-- Reporte Imagen
						============================================= -->
						<div class="col-lg-6 center col-padding parallax" style="background-image: url('images/reporteglobal.jpg');" data-bottom-top="background-position:0px 100px;" data-top-bottom="background-position:0px -300px;">
							<div class="vertical-middle dark">
								<div class="heading-block border-0 center">
									<h2 class="nott ls0" style="font-size: 54px">Reporte Global</h2>
								</div>
							</div>
						</div>

						<!-- Datos del reporte
						============================================= -->
						<div class="col-lg-6 col-padding" style="background-color: #F9F9F9">
							<div>
								<div class="row clearfix" style="padding: 20px 0">
									<div class="col-lg-10 col-md-8 bottommargin">
										<div class="feature-box fbox-plain">
											<div class="fbox-icon">
												<a href="#"><img src="images/arrow-right.svg" alt="Image"></a>
											</div>
											<div class="fbox-content">
												<h3>Cantidad de Arribos</h3>
												<p>Durante el periodo 2012-2020 han arribado al país {{$num_naves[0]->total}} número de naves de las XX (X%) han arribo en 2020.</p>
												Gráfica de número de arribos por año
											</div>
										</div>
									</div>
									<div class="col-lg-10 col-md-8 bottommargin">
										<div class="feature-box fbox-plain">
											<div class="fbox-icon">
												<a href="#"><img src="images/arrow-right.svg" alt="Image"></a>
											</div>
											<div class="fbox-content">
												<h3>Cantidad de Arribos por capitanía</h3>
												<p>A continuación se presenta las cinco capitanías con más arribos en 2020</p>

												<?php $int=1 ?>
												
												<table class="table table-hover">
												  <thead>
													<tr>
													  <th>#</th>
													  <th>Nombre Capitanía</th>
													  <th>Total arribos</th>													  
													</tr>
												  </thead>
												  <tbody>
												  	@foreach($arribos_capitanias as $capitania)
														<tr>
														  <td>{{$int}}</td>
														  <td>{{$capitania->nom_capitania}}</td>
														  <td>{{$capitania->total}}</td>													  
														</tr>
														<?php $int=$int+1 ?>														
													@endforeach													
												  </tbody>
												</table>
											</div>
										</div>
									</div>
									<div class="col-lg-10 col-md-8 bottommargin">
										<div class="feature-box fbox-plain">
											<div class="fbox-icon">
												<a href="#"><img src="images/arrow-right.svg" alt="Image"></a>
											</div>
											<div class="fbox-content">
												<h3>Principales origenes que ingresan al país</h3>
												<p></p>
											</div>
										</div>
									</div>
									<div class="col-lg-10 col-md-8 bottommargin">
										<div class="feature-box fbox-plain">
											<div class="fbox-icon">
												<a href="#"><img src="images/arrow-right.svg" alt="Image"></a>
											</div>
											<div class="fbox-content">
												<h3>Great Location</h3>
												<p>Holisticly fashion cooperative ROI without unique intellectual capital. Synergistically engage orthogonal.</p>
											</div>
										</div>
									</div>
									<div class="col-lg-10 col-md-8">
										<div class="feature-box fbox-plain">
											<div class="fbox-icon">
												<a href="#"><img src="images/arrow-right.svg" alt="Image"></a>
											</div>
											<div class="fbox-content">
												<h3>Customer Service</h3>
												<p>Monotonectally evisculate high standards in best practices before exceptional web-readiness. Competently.</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>

					<div class="container topmargin-lg clearfix">

						<div class="row">
							<!-- Barber Category 1
							============================================= -->
							<div class="col-md-4 center bottommargin-lg">
								<div class="feature-box media-box">
									<div class="fbox-media" style="padding: 0 40px;">
										<a href="#"><img class="rounded-circle img-thumbnail" src="demos/barber/images/features/shave.jpg" alt="Why choose Us?"><span>Shave</span><div class="sale-flash badge badge-warning py-2 px-3 rounded-0">-30% OFF*</div></a>
									</div>
									<div class="fbox-content">
										<h3><span class="ls0 subtitle font-primary">Your Property in Good Hands.</span></h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi rem, facilis nobis voluptatum est voluptatem accusamus molestiae eaque perspiciatis mollitia.</p>
										<a href="#" class="more-link text-uppercase ls1 font-weight-bold" style="margin: 20px 0 0 0; font-style: normal;">Read More</a>
									</div>
								</div>
							</div>

							<!-- Barber Category 2
							============================================= -->
							<div class="col-md-4 center bottommargin-lg">
								<div class="feature-box media-box">
									<div class="fbox-media" style="padding: 0 40px;">
										<a href="#"><img class="rounded-circle img-thumbnail" src="demos/barber/images/features/haircut.jpg" alt="Effective Planning"><span>Haircut</span></a>
									</div>
									<div class="fbox-content">
										<h3><span class="ls0 subtitle font-primary">Construction Process Organized.</span></h3>
										<p>Porro repellat vero sapiente amet vitae quibusdam necessitatibus consectetur, labore totam. Accusamus perspiciatis asperiores labore esse.</p>
										<a href="#" class="more-link text-uppercase ls1 font-weight-bold" style="margin: 20px 0 0 0; font-style: normal;">Read More</a>
									</div>
								</div>
							</div>

							<!-- Barber Category 3
							============================================= -->
							<div class="col-md-4 center bottommargin-lg">
								<div class="feature-box media-box">
									<div class="fbox-media" style="padding: 0 40px;">
										<a href="#"><img class="rounded-circle img-thumbnail" src="demos/barber/images/features/hairwash.jpg" alt="Why choose Us?"><span>Hairwash</span></a>
									</div>
									<div class="fbox-content">
										<h3><span class="ls0 subtitle font-primary">We have got you Covered.</span></h3>
										<p>Quos, non, esse eligendi ab accusantium voluptatem. Maxime eligendi beatae, atque tempora ullam. Vitae delectus quia, consequuntur rerum quo.</p>
										<a href="#" class="more-link text-uppercase ls1 font-weight-bold" style="margin: 20px 0 0 0; font-style: normal;">Read More</a>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>



				<!-- Sección`para el mapa
				============================================= -->
				<div id="price" class="section page-section parallax pb-0 mb-0 dark" style="background-image: url('demos/barber/images/sections/3.jpg'); background-size: cover; height: 600px" data-bottom-top="background-position:0px 0px;" data-top-bottom="background-position:0px -300px;"></div>

				<div class="container bottommargin dark clearfix" style="margin-top: -500px">
					<div class="heading-block bottommargin-lg center clearfix">
						<!-- <img src="demos/barber/images/icons/wallet-white.svg" alt="Image" height="40" style="margin-bottom: 20px"> -->
						<h2>Mapa de Arribos a Colombia</h2>
					</div>
					<iframe id="mapa" class="iframe-placeholder" src="mapa" style="width: 100%; height: 430px"></iframe>    
					

				</div>

				
				

				<a href="#" class="button button-full bg-color font-secondary center" style="padding: 60px 0; background-image: url('demos/barber/images/sections/4.jpg'); background-repeat: no-repeat; background-position: 10% 50%; background-size: cover;">
					<div class="container clearfix">
						Book your visit online and save upto <strong>25% Discount</strong> &rarr;
					</div>
				</a>

			</div>
		</section><!-- #content end -->
@endsection
