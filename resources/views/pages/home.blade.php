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
								<img src="demos/barber/images/about/sign.png" alt="Image" width="200">
							</div>
							<div class="col-md-3 col-6 d-none d-md-block">
								<img src="images/2.jpg" alt="Image">
							</div>
						</div>
					</div>
				</div>

				<!-- Service Page Section
				============================================= -->
				<div id="service" class="section page-section bg-transparent p-0 mt-0 clearfix">

					<div class="row align-items-stretch clearfix bottommargin">

						<!-- Service Image
						============================================= -->
						<div class="col-lg-6 center col-padding parallax" style="background-image: url('demos/barber/images/sections/1.jpg');" data-bottom-top="background-position:0px 100px;" data-top-bottom="background-position:0px -300px;">
							<div class="vertical-middle dark">
								<div class="heading-block border-0 center">
									<h2 class="nott ls0" style="font-size: 54px">Reporte Global</h2>
								</div>
							</div>
						</div>

						<!-- Service Featured Boxes
						============================================= -->
						<div class="col-lg-6 col-padding" style="background-color: #F9F9F9">
							<div>
								<div class="row clearfix" style="padding: 20px 0">
									<div class="col-lg-10 col-md-8 bottommargin">
										<div class="feature-box fbox-plain">
											<div class="fbox-icon">
												<a href="#"><img src="demos/barber/images/icons/scessior.svg" alt="Image"></a>
											</div>
											<div class="fbox-content">
												<h3>Cantidad de Arribos</h3>
												<p>Durante el periodo 2012-2020 han arribado al país XX número de naves de las XX (X%) han arribo en 2020.</p>
												Gráfica de número de arribos por año
											</div>
										</div>
									</div>
									<div class="col-lg-10 col-md-8 bottommargin">
										<div class="feature-box fbox-plain">
											<div class="fbox-icon">
												<a href="#"><img src="demos/barber/images/icons/moustache.svg" alt="Image"></a>
											</div>
											<div class="fbox-content">
												<h3>Cantidad de Arribos por capitanía</h3>
												<p>A continuación se presenta las cinco capitanías con más arribos en 2020</p>
												TABLA
											</div>
										</div>
									</div>
									<div class="col-lg-10 col-md-8 bottommargin">
										<div class="feature-box fbox-plain">
											<div class="fbox-icon">
												<a href="#"><img src="demos/barber/images/icons/comb.svg" alt="Image"></a>
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
												<a href="#"><img src="demos/barber/images/icons/time.svg" alt="Image"></a>
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
												<a href="#"><img src="demos/barber/images/icons/drier1.svg" alt="Image"></a>
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

				<!-- Price Page Section - Parallax
				============================================= -->
				<div id="price" class="section page-section parallax pb-0 mb-0 dark" style="background-image: url('demos/barber/images/sections/3.jpg'); background-size: cover; height: 600px" data-bottom-top="background-position:0px 0px;" data-top-bottom="background-position:0px -300px;"></div>

				<div class="container bottommargin dark clearfix" style="margin-top: -500px">
					<div class="heading-block bottommargin-lg center clearfix">
						<img src="demos/barber/images/icons/wallet-white.svg" alt="Image" height="40" style="margin-bottom: 20px">
						<h2>Pricing</h2>
					</div>

					<!-- Price Items
					============================================= -->
					<div class="row dark col-padding clearfix" style="background-color: #121212">
						<div class="col-lg-6 price-wrap">
							<div class="price-header">
								<div class="price-name">
									<a href="#" class="color">Haircut</a>
								</div>
								<div class="price-dots">
									<span class="separator-dots"></span>
								</div>
								<div class="price-price">$39</div>
							</div>
							<p class="price-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt quos harum officia eaque nobis ut.</p>
						</div>

						<div class="col-lg-6 price-wrap">
							<div class="price-header">
								<div class="price-name">
									<a href="#" class="color">HairWash</a>
								</div>
								<div class="price-dots">
									<span class="separator-dots"></span>
								</div>
								<div class="price-price">$42</div>
							</div>
							<p class="price-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt quos harum officia eaque nobis ut.</p>
						</div>

						<div class="w-100 clear"></div>

						<div class="col-lg-6 price-wrap">
							<div class="price-header">
								<div class="price-name">
									<a href="#" class="color">Shave</a>
								</div>
								<div class="price-dots">
									<span class="separator-dots"></span>
								</div>
								<div class="price-price">$29</div>
							</div>
							<p class="price-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt quos harum officia eaque nobis ut.</p>
						</div>

						<div class="col-lg-6 price-wrap">
							<div class="price-header">
								<div class="price-name">
									<a href="#" class="color">Hair Colour</a>
								</div>
								<div class="price-dots">
									<span class="separator-dots"></span>
								</div>
								<div class="price-price">$17</div>
							</div>
							<p class="price-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt quos harum officia eaque nobis ut.</p>
						</div>

						<div class="w-100 clear"></div>

						<div class="col-lg-6 price-wrap">
							<div class="price-header">
								<div class="price-name">
									<a href="#" class="color">Moustache</a>
								</div>
								<div class="price-dots">
									<span class="separator-dots"></span>
								</div>
								<div class="price-price">$39</div>
							</div>
							<p class="price-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt quos harum officia eaque nobis ut.</p>
						</div>

						<div class="col-lg-6 price-wrap">
							<div class="price-header">
								<div class="price-name">
									<a href="#" class="color">Beard Trim</a>
								</div>
								<div class="price-dots">
									<span class="separator-dots"></span>
								</div>
								<div class="price-price">$42</div>
							</div>
							<p class="price-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt quos harum officia eaque nobis ut.</p>
						</div>

						<div class="w-100 clear"></div>

						<div class="col-lg-6 price-wrap">
							<div class="price-header">
								<div class="price-name">
									<a href="#" class="color">Facial</a>
								</div>
								<div class="price-dots">
									<span class="separator-dots"></span>
								</div>
								<div class="price-price">$29</div>
							</div>
							<p class="price-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt quos harum officia eaque nobis ut.</p>
						</div>

						<div class="col-lg-6 price-wrap">
							<div class="price-header">
								<div class="price-name">
									<a href="#" class="color">Head Massage</a>
								</div>
								<div class="price-dots">
									<span class="separator-dots"></span>
								</div>
								<div class="price-price">$17</div>
							</div>
							<p class="price-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt quos harum officia eaque nobis ut.</p>
						</div>

						<div class="col-12 center">
							<a href="#" class="button button-large button-color d-none d-lg-block "><i class="icon-calendar2"></i> Make An Appointment</a>
						</div>
					</div>

				</div>

				<!-- Shop Page Section
				============================================= -->
				<div id="shop" class="section m-0 page-section bg-transparent">

					<div class="container">
						<div class="heading-block center">
							<img src="demos/barber/images/icons/comb3.svg" alt="Image" height="40" style="margin-bottom: 20px">
							<h2>Shop</h2>
						</div>

						<div class="row col-mb-50 mb-0">
							<!-- Shop Item 1
							============================================= -->
							<div class="col-lg-3 col-md-6">
								<div class="product">
									<div class="product-image">
										<a href="#"><img src="demos/barber/images/shop/1.jpg" alt="High-Heel Girl's Sandals"></a>
										<a href="#" class="shop-icon"><i class="icon-shopping-cart"></i></a>
									</div>
									<div class="product-desc center">
										<div class="product-price"><ins>$21.49</ins></div>
										<div class="product-title"><h3><a href="#">Razor</a></h3></div>
									</div>
								</div>
							</div>

							<!-- Shop Item 2
							============================================= -->
							<div class="col-lg-3 col-md-6">
								<div class="product">
									<div class="product-image">
										<a href="#"><img src="demos/barber/images/shop/2.jpg" alt="High-Heel Girl's Sandals"></a>
										<a href="#" class="shop-icon"><i class="icon-shopping-cart"></i></a>
									</div>
									<div class="product-desc center">
										<div class="product-price"><ins>$12.49</ins></div>
										<div class="product-title"><h3><a href="#">Shave Brush</a></h3></div>
									</div>
								</div>
							</div>


							<!-- Shop Item 3
							============================================= -->
							<div class="col-lg-3 col-md-6">
								<div class="product">
									<div class="product-image">
										<a href="#"><img src="demos/barber/images/shop/3.jpg" alt="High-Heel Girl's Sandals"></a>
										<a href="#" class="shop-icon"><i class="icon-shopping-cart"></i></a>
									</div>
									<div class="product-desc center">
										<div class="product-price"><ins>$21.99</ins></div>
										<div class="product-title"><h3><a href="#">Beard oil</a></h3></div>
									</div>
								</div>
							</div>

							<!-- Shop Item 4
							============================================= -->
							<div class="col-lg-3 col-md-6">
								<div class="product">
									<div class="product-image">
										<a href="#"><img src="demos/barber/images/shop/4.jpg" alt="High-Heel Girl's Sandals"></a>
										<div class="sale-flash badge badge-success p-2">-50%*</div>
										<a href="#" class="shop-icon"><i class="icon-shopping-cart"></i></a>
									</div>
									<div class="product-desc center">
										<div class="product-price"><del>$24.99</del> <ins>$19.49</ins></div>
										<div class="product-title"><h3><a href="#">Hair Brush</a></h3></div>
									</div>
								</div>
							</div>
						</div>

						<div class="center">
							<a href="#" class="button button-large button-color">+ More Products</a>
						</div>

					</div>
				</div>

				<!-- Testimonial Page Section
				============================================= -->
				<div id="testimonial" class="section page-section parallax pb-0 dark clearfix" style="background-image: url('demos/barber/images/sections/2.jpg'); background-size: cover;" data-bottom-top="background-position:0px 0px;" data-top-bottom="background-position:0px -300px;">
					<div class="container clearfix">

						<div class="heading-block center">
							<img src="demos/barber/images/icons/stars.svg" alt="Image" height="50" style="margin-bottom: 20px">
							<h3 class="ls2">Testimonials</h3>
						</div>

						<!-- Testimonial Slider
						============================================= -->
						<div class="fslider testimonial testimonial-full bg-transparent border-0 shadow-none p-0 bottommargin-sm mx-auto center clearfix" data-arrows="false" style="max-width: 700px">
							<div class="flexslider">
								<div class="slider-wrap">
									<div class="slide">
										<div class="testi-content">
											<p>Collaboratively enhance intermandated innovation via cutting-edge core competencies. Professionally extend covalent e-markets and mission-critical communities. Dramatically communicate revolutionary web services for interactive synergy. Synergistically.</p>
											<div class="testi-meta">
												Steve Jobs
												<span class="ls0">Apple Inc.</span>
											</div>
										</div>
									</div>
									<div class="slide">
										<div class="testi-content">
											<p>Intrinsicly synergize excellent content whereas user friendly action items. Rapidiously transition multimedia based information after top-line alignments. Proactively e-enable front-end e-commerce without mission-critical customer service.</p>
											<div class="testi-meta">
												Collis Ta'eed
												<span class="ls0">Envato Inc.</span>
											</div>
										</div>
									</div>
									<div class="slide">
										<div class="testi-content">
											<p>Compellingly engage multimedia based niche markets via value-added manufactured products. Competently formulate goal-oriented content for installed base users. Uniquely leverage other's granular ROI without 24/365 collaboration and idea-sharing.</p>
											<div class="testi-meta">
												John Doe
												<span class="ls0">XYZ Inc.</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>

					<!-- Clients Logo Carousel Area
					============================================= -->
					<div id="oc-clients" class="owl-carousel owl-carousel-full image-carousel carousel-widget topmargin-lg mb-0" data-margin="0" data-nav="false" data-pagi="false" data-autoplay="3000" data-items-xs="3" data-items-sm="3" data-items-md="5" data-items-lg="6" data-items-xl="6" data-loop="true" style="z-index: 2; padding: 30px 0; border-top: 1px solid rgba(255,255,255,0.15);">

						<!-- Clients items
						============================================= -->
						<div class="oc-item"><a href="#"><img src="demos/barber/images/clients/1.png" alt="Brands"></a></div>
						<div class="oc-item"><a href="#"><img src="demos/barber/images/clients/4.png" alt="Brands"></a></div>
						<div class="oc-item"><a href="#"><img src="demos/barber/images/clients/6.png" alt="Brands"></a></div>
						<div class="oc-item"><a href="#"><img src="demos/barber/images/clients/2.png" alt="Brands"></a></div>
						<div class="oc-item"><a href="#"><img src="demos/barber/images/clients/3.png" alt="Brands"></a></div>
						<div class="oc-item"><a href="#"><img src="demos/barber/images/clients/5.png" alt="Brands"></a></div>
						<div class="oc-item"><a href="#"><img src="demos/barber/images/clients/7.png" alt="Brands"></a></div>
						<div class="oc-item"><a href="#"><img src="demos/barber/images/clients/8.png" alt="Brands"></a></div>
						<div class="oc-item"><a href="#"><img src="demos/barber/images/clients/9.png" alt="Brands"></a></div>

					</div>

					<div class="video-wrap" style="position: absolute; height: 100%; z-index: 1;">
						<div class="video-overlay" style="background: rgba(0,0,0,0.7);"></div>
					</div>

				</div>

				<!-- Barber Teams
				============================================= -->
				<div class="section bg-transparent mb-0 topmargin-sm clearfix">

					<div class="container clearfix">

						<div class="heading-block center">
							<img src="demos/barber/images/icons/team.svg" alt="Image" height="50" style="margin-bottom: 20px">
							<h3 class="ls2">Our Barbers</h3>
							<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius, esse eum doloremque deleniti nam voluptatem.</span>
						</div>

						<div class="row">
							<!-- Team 1
							============================================= -->
							<div class="col-md-4 bottommargin">
								<div class="team">
									<div class="team-image">
										<img src="demos/barber/images/barbers/1.jpg" alt="John Doe">
										<div class="bg-overlay">
											<div class="bg-overlay-content p-2 flex-column-reverse justify-content-between align-items-center">
												<div class="d-flex mb-3" data-hover-animate="fadeInUp" data-hover-animate-out="fadeOutDown" data-hover-speed="400" data-hover-parent=".team">
													<a href="#" class="social-icon si-rounded si-colored si-small si-facebook" title="Facebook">
														<i class="icon-facebook"></i>
														<i class="icon-facebook"></i>
													</a>
													<a href="#" class="social-icon si-rounded si-colored si-small si-gplus" title="gplus">
														<i class="icon-gplus"></i>
														<i class="icon-gplus"></i>
													</a>
													<a href="#" class="social-icon si-rounded si-colored si-small si-instagram" title="instagram">
														<i class="icon-instagram"></i>
														<i class="icon-instagram"></i>
													</a>
												</div>
												<a href="#" class="button button-large button-color m-0 w-100 text-center" data-hover-animate="fadeInDown" data-hover-animate-out="fadeOutUp" data-hover-speed="400" data-hover-parent=".team">Appointment</a>
											</div>
											<div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-speed="400" data-hover-parent=".team"></div>
										</div>
									</div>
									<div class="team-desc">
										<div class="team-title"><h4>John Doe</h4><span>Expert</span></div>
									</div>
								</div>
							</div>

							<!-- Team 2
							============================================= -->
							<div class="col-md-4 bottommargin">
								<div class="team">
									<div class="team-image">
										<img src="demos/barber/images/barbers/2.jpg" alt="Josh Thompson">
										<div class="bg-overlay">
											<div class="bg-overlay-content p-2 flex-column-reverse justify-content-between align-items-center">
												<div class="d-flex mb-3" data-hover-animate="fadeInUp" data-hover-animate-out="fadeOutDown" data-hover-speed="400" data-hover-parent=".team">
													<a href="#" class="social-icon si-rounded si-colored si-small si-facebook" title="Facebook">
														<i class="icon-facebook"></i>
														<i class="icon-facebook"></i>
													</a>
													<a href="#" class="social-icon si-rounded si-colored si-small si-gplus" title="gplus">
														<i class="icon-gplus"></i>
														<i class="icon-gplus"></i>
													</a>
													<a href="#" class="social-icon si-rounded si-colored si-small si-instagram" title="instagram">
														<i class="icon-instagram"></i>
														<i class="icon-instagram"></i>
													</a>
												</div>
												<a href="#" class="button button-large button-color m-0 w-100 text-center" data-hover-animate="fadeInDown" data-hover-animate-out="fadeOutUp" data-hover-speed="400" data-hover-parent=".team">Appointment</a>
											</div>
											<div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-speed="400" data-hover-parent=".team"></div>
										</div>
									</div>
									<div class="team-desc">
										<div class="team-title"><h4>Josh Thompson</h4><span>Barber</span></div>
									</div>
								</div>
							</div>

							<!-- Team 3
							============================================= -->
							<div class="col-md-4 bottommargin">
								<div class="team">
									<div class="team-image">
										<img src="demos/barber/images/barbers/3.jpg" alt="Mary Jane">
										<div class="bg-overlay">
											<div class="bg-overlay-content p-2 flex-column-reverse justify-content-between align-items-center">
												<div class="d-flex mb-3" data-hover-animate="fadeInUp" data-hover-animate-out="fadeOutDown" data-hover-speed="400" data-hover-parent=".team">
													<a href="#" class="social-icon si-rounded si-colored si-small si-facebook" title="Facebook">
														<i class="icon-facebook"></i>
														<i class="icon-facebook"></i>
													</a>
													<a href="#" class="social-icon si-rounded si-colored si-small si-gplus" title="gplus">
														<i class="icon-gplus"></i>
														<i class="icon-gplus"></i>
													</a>
													<a href="#" class="social-icon si-rounded si-colored si-small si-instagram" title="instagram">
														<i class="icon-instagram"></i>
														<i class="icon-instagram"></i>
													</a>
												</div>
												<a href="#" class="button button-large button-color m-0 w-100 text-center" data-hover-animate="fadeInDown" data-hover-animate-out="fadeOutUp" data-hover-speed="400" data-hover-parent=".team">Appointment</a>
											</div>
											<div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-speed="400" data-hover-parent=".team"></div>
										</div>
									</div>
									<div class="team-desc">
										<div class="team-title"><h4>Mary Jane</h4><span>Junior Barber</span></div>
									</div>
								</div>
							</div>
						</div>

					</div>

				</div>

				<!-- Contact Page Section
				============================================= -->
				<div id="contact" class="row align-items-stretch page-section pt-0 clearfix">

					<div class="col-lg-6 px-0 d-none d-md-block">
						<div class="gmap h-100" data-address="Ibiza, Spain" data-zoom="5" data-markers='[{ address: "Ibiza, Spain", icon:{ image: "demos/barber/images/map-marker.png", iconsize: [32, 39], iconanchor: [16,36] } }]' data-styles='[{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]'></div>
					</div>

					<div class="col-lg-6 col-padding" style="background-color: #F9F9F9;">
						<div>
							<h3 class="text-uppercase">Our Headquarters</h3>
							<div class="row topmargin-sm clearfix" style="font-size: 16px; line-height: 1.7;">
								<div class="col-lg-6">
									<address style="line-height: 1.7;">
										<strong>North America:</strong><br>
										795 Folsom Ave, Suite 600<br>
										San Francisco, CA 94107<br>
									</address>
								</div>
								<div class="col-lg-6">
									<abbr title="Phone Number"><strong>Phone:</strong></abbr> (1) 8547 632521<br>
									<abbr title="Fax"><strong>Fax:</strong></abbr> (1) 11 4752 1433<br>
									<abbr title="Email Address"><strong>Email:</strong></abbr> info@canvas.com
								</div>
							</div>

							<div class="form-widget">

								<div class="form-result"></div>

								<form class="mb-0" id="template-contactform" name="template-contactform" action="include/form.php" method="post">

									<div class="form-process">
										<div class="css3-spinner">
											<div class="css3-spinner-scaler"></div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6 form-group">
											<input type="text" id="template-contactform-name" name="template-contactform-name" value="" class="sm-form-control border-form-control required" placeholder="Name" />
										</div>
										<div class="col-md-6 form-group">
											<input type="email" id="template-contactform-email" name="template-contactform-email" value="" class="required email sm-form-control border-form-control" placeholder="Email Address" />
										</div>

										<div class="w-100"></div>

										<div class="col-md-4 form-group">
											<input type="text" id="template-contactform-phone" name="template-contactform-phone" value="" class="sm-form-control border-form-control" placeholder="Phone" />
										</div>

										<div class="col-md-8 form-group">
											<input type="text" id="template-contactform-subject" name="subject" value="" class="required sm-form-control border-form-control" placeholder="Subject" />
										</div>

										<div class="w-100"></div>

										<div class="col-12 form-group">
											<textarea class="required sm-form-control border-form-control" id="template-contactform-message" name="template-contactform-message" rows="7" cols="30" placeholder="Your Message"></textarea>
										</div>

										<div class="col-12 form-group">
											<button class="button button-large button-color ml-0 topmargin-sm" type="submit" id="template-contactform-submit" name="template-contactform-submit" value="submit">Send Message</button>
										</div>

										<div class="col-12 form-group d-none">
											<input type="text" id="template-contactform-botcheck" name="template-contactform-botcheck" value="" class="sm-form-control" />
										</div>
									</div>

									<input type="hidden" name="prefix" value="template-contactform-">

								</form>

							</div>
						</div>
					</div>

				</div>

				<a href="#" class="button button-full bg-color font-secondary center" style="padding: 60px 0; background-image: url('demos/barber/images/sections/4.jpg'); background-repeat: no-repeat; background-position: 10% 50%; background-size: cover;">
					<div class="container clearfix">
						Book your visit online and save upto <strong>25% Discount</strong> &rarr;
					</div>
				</a>

			</div>
		</section><!-- #content end -->
@endsection
