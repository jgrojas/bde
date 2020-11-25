@extends('master/master')


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
							<div class="col-md-6 col-12 center" style="padding: 0 50px;">
								<img src="images/ocean-transportation.png" alt="Image" height="60" style="margin-bottom: 20px">
								<div class="heading-block bottommargin-sm">
									<h2>Reporte por nave</h2>
								</div>
								<p>
								En esta sección puede generar el reporte histórico de cada una de las naves que monitorea SIMAR.<br>Seleccione la nave sobre la cual quiere generar el reporte.
								</p>

								<div class="white-section">
									<label>Seleccione Nave:</label>
									<select class="selectpicker" data-live-search="true">
										@foreach($list_nave as $nave)	
										<option data-tokens="{{$nave->nombrenave}}" id="{{$nave->omimatricula}}">{{$nave->nombrenave}}</option>
										
										@endforeach	
									</select>
									<a href="#" class="button button-3d button-rounded button-green"><i class="icon-repeat"></i>Generar reporte</a>
								</div>
								
								
							</div>
							<div class="col-md-6 col- d-none d-md-block">
								<img src="images/2.jpg" alt="Image">
							</div>
						</div>
					</div>
				</div>

			</div>
		</section>


@endsection