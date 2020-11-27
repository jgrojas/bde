@extends('master/master')


@section('content')
		<!-- Content
		============================================= -->
		<section id="content" style="border-top: 8px solid #bf9456">

			<div class="content-wrap py-0">
				

				<!-- Sección`para el mapa
				============================================= -->
				<div class="section page-section parallax pb-0 mb-0 dark" style="background-image: url('images/3.jpg'); background-size: cover; height: 600px" data-bottom-top="background-position:0px 0px;" data-top-bottom="background-position:0px -300px;"></div>

				<div id="about"  class="container bottommargin dark clearfix" style="margin-top: -500px">
					<div class="heading-block bottommargin-lg center clearfix">
						
						<h2>Mapa de Zarpes a Colombia</h2>
					</div>
					<iframe id="mapa" class="iframe-placeholder" src="mapa" style="width: 100%; height: 800px"></iframe>
				</div>
			</div>
		</section>
@endsection