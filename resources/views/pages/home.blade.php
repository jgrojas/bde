@extends('master/master')

@section('styles')

<style type="text/css">
.flag{
	width: 20px;
}	

#plot_arrivos {
    height: 400px; 
}


.highcharts-figure, .highcharts-data-table table {
    min-width: 310px; 
    max-width: 800px;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #EBEBEB;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}
.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}
.highcharts-data-table th {
	font-weight: 600;
    padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}
.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

</style>

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
												<p>Durante el periodo 2012-2020 han arribado al país {{$num_naves[0]->total}} número de naves de las cuales {{$num_naves2020[0]->total}} ({{$num_naves2020_p}}%) han arribado durante el 2020.</p>
												
												<div id="plot_arribos">
													
												</div>

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
												<p>A continuación se presenta las cinco capitanías con más arribos entre 2012 y 2020</p>

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
												<p>(Haga click sobre la tabla para navegar al punto)</p>	
												<div class="col-md-12" id="map_point_puerto" style="height: 200px"></div>										
												<div class="col-md-12">
													<?php $int=1 ?>												
													<table class="table table-hover">
													  <thead>
														<tr>
														  <th>#</th>
														  <th>Nombre del puerto</th>
														  <th>País de origen</th>
														  <th>Total</th>
														  
														</tr>
													  </thead>
													  <tbody>
													  	@foreach($principales_zarpes as $zarpes)
															<tr onclick=puerto_point('{{$zarpes->id_puerto}}')>
															  <td>{{$int}}</td>
															  <td>{{$zarpes->nom_puerto}}</td>
															  <td><img class="flag" src="images/flags/{{$zarpes->alfa_dos}}.png"> {{$zarpes->nombre}}</td>
															  <td>{{$zarpes->total}}</td>															  
															</tr>
															<?php $int=$int+1 ?>														
														@endforeach													
													  </tbody>
													</table>
												</div>
												
											</div>
										</div>
									</div>
									<div class="col-lg-10 col-md-8 bottommargin">
										<div class="feature-box fbox-plain">
											<div class="fbox-icon">
												<a href="#"><img src="images/arrow-right.svg" alt="Image"></a>
											</div>
											<div class="fbox-content">
												<h3>Distribución de ingresos por Tipo de Nave</h3>
												<p></p>
												<div id="plot_tipos"></div>
											</div>

										</div>
									</div>
									<div class="col-lg-10 col-md-8">
										<div class="feature-box fbox-plain">
											<div class="fbox-icon">
												<a href="#"><img src="images/arrow-right.svg" alt="Image"></a>
											</div>
											<div class="fbox-content">
												<h3>Principales razones de arribo</h3>
												<p></p>
												<div class="col-md-12">
													<?php $int=1 ?>												
													<table class="table table-hover">
													  <thead>
														<tr>
														  <th>#</th>
														  <th>Razon Arribo</th>														  
														  <th>Total</th>
														  
														</tr>
													  </thead>
													  <tbody>
													  	@foreach($razon_arribo as $razon)
															<tr>
															  <td>{{$int}}</td>
															  <td>{{$razon->nom_razon}}</td>															  
															  <td>{{$razon->total}}</td>															  
															</tr>
															<?php $int=$int+1 ?>														
														@endforeach													
													  </tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Sección`para el mapa
				============================================= -->
				<div id="price" class="section page-section parallax pb-0 mb-0 dark" style="background-image: url('images/3.jpg'); background-size: cover; height: 600px" data-bottom-top="background-position:0px 0px;" data-top-bottom="background-position:0px -300px;"></div>

				<!-- <div class="container bottommargin dark clearfix" style="margin-top: -500px">
					<div class="heading-block bottommargin-lg center clearfix">
						
						<h2>Mapa de Zarpes a Colombia</h2>
					</div>
					<iframe id="mapa" class="iframe-placeholder" src="mapa" style="width: 100%; height: 430px"></iframe>    
					

				</div> -->

				
				

				<!-- <a href="#" class="button button-full bg-color font-secondary center" style="padding: 60px 0; background-image: url('demos/barber/images/sections/4.jpg'); background-repeat: no-repeat; background-position: 10% 50%; background-size: cover;">
					<div class="container clearfix">
						Book your visit online and save upto <strong>25% Discount</strong> &rarr;
					</div>
				</a> -->

			</div>
		</section><!-- #content end -->
@endsection

@section('javascripts')
<script type="text/javascript">
	
	//-------------------------------------------------------------------
	//Mapa localización de los puertos
	//-------------------------------------------------------------------

	function puerto_point(cod_puerto){				
		for (i = 0; i < principales_zarpes.features.length; i++){			
			if(principales_zarpes.features[i].properties.id_puerto==cod_puerto){				
				map_point_puerto.setView([principales_zarpes.features[i].geometry.coordinates[1], principales_zarpes.features[i].geometry.coordinates[0]], 12);
			}
		}	
	}

	var map_point_puerto = L.map('map_point_puerto', {
        center: [10, -72],
        zoom: 2,
        minZoom: 2,
        scrollWheelZoom: true,
        maxZoom: 13,        
        zoomControl:true
    });

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {	    
	    maxZoom: 18,
	    id: 'mapbox/streets-v11',
	    tileSize: 512,
	    zoomOffset: -1,
	    accessToken: 'your.mapbox.access.token'
	}).addTo(map_point_puerto);

    var principales_zarpes={!!json_encode($principales_zarpes)!!}

	geojson_temp={
		type: 'FeatureCollection',
	    features: []
	};

	for (i = 0; i < principales_zarpes.length; i++){		
		objeto={
				type: 'Feature',
		   		properties: {
				   	'id_puerto': principales_zarpes[i].id_puerto,
	                'nom_puerto': principales_zarpes[i].nom_puerto,                
	                'abreviatura_pais': principales_zarpes[i].abreviatura_pais,
	                'nombre': principales_zarpes[i].nombre,
	                'total': principales_zarpes[i].total,	                
			 	},
			 	'geometry': jQuery.parseJSON(principales_zarpes[i].geometry)
			}
			x=geojson_temp.features.length				
			geojson_temp.features[x]=objeto		
	}

	principales_zarpes=geojson_temp;
	var zarpes = new L.geoJson(principales_zarpes,{onEachFeature: interaccion_zarpes}).addTo(map_point_puerto);	
	
	function interaccion_zarpes(feature, layer) {	
		text='Puerto: '+feature.properties.nom_puerto+'<br>Total: '+feature.properties.total
		layer.bindTooltip(text);
		layer.on(
		{
			click: function (e) {				
				map_point_puerto.setView(e.latlng, 7);
			}
		});
	};

	//-------------------------------------------------------------------
	//Crear la gráfica de arrivos por año
	//-------------------------------------------------------------------	

	var arribos_anual={!!json_encode($arribos_anual)!!}
	var arribos_anual_array=[];

	for(i=0; i<arribos_anual.length; i++){
		arribos_anual_array[i]=[arribos_anual[i].year,Math.round(parseInt(arribos_anual[i].sum))];
	}

	Highcharts.chart('plot_arribos', {
	    chart: {
	        type: 'column'
	    },
	    title: {
	        text: 'Distribución de arribos para el periodo 2012-2020'
	    },
	    subtitle: {
	        text: 'Source: DIMAR'
	    },
	    xAxis: {
	        type: 'category',
	        labels: {
	            rotation: -45,
	            style: {
	                fontSize: '13px',
	                fontFamily: 'Verdana, sans-serif'
	            }
	        }
	    },
	    yAxis: {
	        min: 0,
	        title: {
	            text: 'Arribos'
	        }
	    },
	    legend: {
	        enabled: false
	    },
	    tooltip: {
	        pointFormat: 'Arribos: {point.y}'
	    },
	    series: [{
	        name: 'Population',
	        data: arribos_anual_array,
	        dataLabels: {
	            enabled: true,
	            rotation: -90,
	            color: '#FFFFFF',
	            align: 'right',
	            format: '{point.y}', // one decimal
	            y: 10, // 10 pixels down from the top
	            style: {
	                fontSize: '13px',
	                fontFamily: 'Verdana, sans-serif'
	            }
	        }
	    }]
	});

	//-------------------------------------------------------------------
	//Crear la gráfica de arrivos por año
	//-------------------------------------------------------------------

	

	var tipos_naves={!!json_encode($tipos_naves)!!}
	var tipos_naves_array=[];

	for(i=0; i<tipos_naves.length; i++){
		var randomcolor="#" + Math.floor(Math.random()*16777215).toString(16)
		tipos_naves_array[i]={name: tipos_naves[i].nom_tiponave, value: tipos_naves[i].total, color: randomcolor};
	}

	Highcharts.chart('plot_tipos', {    
    series: [{
        type: 'treemap',
        layoutAlgorithm: 'squarified',
        data: tipos_naves_array
    }],
    title: {
        text: 'Periodo 2012-2020'
    }
});

</script>
@endsection
