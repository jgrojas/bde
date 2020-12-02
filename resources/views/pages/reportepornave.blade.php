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
							<div class="col-md-3 col-6 d-none d-md-block">
								
							</div>						
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
									<select id="naves_list" class="selectpicker" data-live-search="true">
										@foreach($list_nave as $nave)	
										<option data-tokens="{{$nave->nombrenave}}" value="{{$nave->omimatricula}}">{{$nave->nombrenave}}</option>
										@endforeach	
									</select>
									<br><br>
									<a class="button button-3d button-rounded button-green" onclick="reportenave()"><i class="icon-repeat"></i>Generar reporte</a>
								</div>
							</div>
							<div class="col-md-6 col-12 d-none d-md-block">
							</div>
							
						</div>

						<div class="divider"><i class="icon-circle"></i></div>

						<div class="title-block">
							<h2 id="card-map-header">Seleccione una Nave para ver el reporte</h2>									
						</div>

						<div class="row clearfix" id="reporte_div" style="display: none">
							
							<!-- Caracteristicas de la nave -->
							<div class="col-md-6 col-12 d-none d-md-block">
								<div class="card bg-light mb-12">
								  	<div class="card-header" >
								  		<h4 style="margin-bottom: 0px !important">Características de la Nave</h4>
								  	</div>
								  	<div class="card-body">
								    	<table class="table table-hover">									  	
										  	<tbody>
										  		<tr>
												  <td>Origen</td>
												  <td id="r_origen"></td>
												</tr>									  	
												<tr>
												  <td>Matrícula</td>
												  <td id="r_matricula"></td>
												</tr>
												<tr>
												  <td>NIT Agencia</td>
												  <td id="r_idagencia"></td>
												</tr>
												<tr>
												  <td>Agencia</td>
												  <td id="r_agencia"></td>
												</tr>
												<tr>
												  <td>Eslora</td>
												  <td id="r_eslora"></td>
												</tr>
												<tr>
												  <td>TRB</td>
												  <td id="r_trb"></td>
												</tr>
												<tr>
												  <td>DWT</td>
												  <td id="r_dwt"></td>
												</tr>
												<tr>
												  <td>Fecha de construcción</td>
												  <td id="r_construccion"></td>
												</tr>	
										  </tbody>
										</table>
								  	</div>
								</div>
							</div>

							<!-- Ultimo recorrido -->
							<div class="col-md-6 col-12 d-none d-md-block">
								<div class="card bg-light mb-12">
								  	<div class="card-header" >
								  		<h4 style="margin-bottom: 0px !important">Último recorrido de la nave</h4>
								  	</div>
								  	<div class="card-body">
								    	<div id="mapexplorer" style="height: 300px">
								    		
								    	</div>
								  	</div>
								</div>
							</div>

							<div class="divider"><i class="icon-circle"></i></div>

							<!-- Número de veces que ha arribado la nave a Colombia -->
							<div class="col-md-6 col-12 d-none d-md-block">
								<div class="card bg-light mb-12">
								  	<div class="card-header" >
								  		<h4 style="margin-bottom: 0px !important">Número de veces que ha arribado la nave a Colombia</h4>
								  	</div>
								  	<div class="card-body">
								    	<div id="table_arribos"></div>
								  	</div>
								</div>
							</div>

							<!-- Alertas espaciales -->
							<div class="col-md-6 col-12 d-none d-md-block">
								<div class="card bg-light mb-12">
								  	<div class="card-header" >
								  		<h4 style="margin-bottom: 0px !important">Alertas Espaciales</h4>
								  	</div>
								  	<div class="card-body">

								  		<p>A continuación se presentan el análisis espacial del track basado en la estimación de la distancia entr el último recorrido de la nave y el Sistema de Parques Nacionales de Colombia. El campo de distancia se clasifica en 3 colores. Color Rojo: Cruce sobre un parque; Color Amarillo: Alerta de próximadad menor a 5 km; Color Verde: Distancia superior a 5 km</p>

								  		<h4 style="margin-bottom: 0px !important">Distancia a Parques Nacionales</h4>
								  		<div id="tabla_parques"></div>
								  	</div>
								</div>
							</div>

						</div>
					</div>
				</div>

			</div>
		</section>


@endsection

@section('javascripts')
<script type="text/javascript">
	
	

	function reportenave(){

		$('#reporte_div').show();
		mapexplorer.invalidateSize();
		//juri_plot1.reflow();
			
		var matricula=$('#naves_list option:selected').val();
		var name=$('#naves_list option:selected').text();
		$("#card-map-header").html("Reporte para la Nave: " + name);
		$("#r_matricula").html(matricula);
		$.ajax({		
		url: "reportenavepost",
		data: {array: matricula},
		beforeSend: function (xhr) {//This function is necessary to ajax 
					var token = $('meta[name="csrf_token"]').attr('content');
					if (token) {
						return xhr.setRequestHeader('X-CSRF-TOKEN', token);
					}
				},		
		type: "POST",
		success:function(data){
				//map.spin(false);
				console.log(data);
				//Add track to map
				var track=data[0];
				var eslora=data[1][0].eslora;
				var trb=data[1][0].trb;
				var construccion=data[1][0].anoconstru;
				var nit_agencia=data[1][0].id_agencia_arribo;
				var bandera=data[1][0].nombre;
				var dwt=data[1][0].dwt;
				var agencia_nave=data[4][0].agencia_arribo;
				$("#r_eslora").html(eslora);
				$("#r_trb").html(trb);
				$("#r_construccion").html(construccion);
				$("#r_agencia").html(agencia_nave);
				$("#r_origen").html(bandera);
                $("#r_dwt").html(dwt);
                $("#r_idagencia").html(nit_agencia);
      

				try {	
					//map.removeLayer(states);					
					mapexplorer.removeLayer(track_geojson);
					$("#table_arribos").empty();
					$('#tabla_parques').empty();					
				} catch(err) {    	  	
				}

				geojson_temp={
					type: 'FeatureCollection',
				    features: []
				};

				for (i = 0; i < track.length; i++){		
					objeto={
							type: 'Feature',
					   		properties: {
							   		                
						 	},
						 	'geometry': jQuery.parseJSON(track[i].geometry)
						}
						x=geojson_temp.features.length				
						geojson_temp.features[x]=objeto		
				}

				track_geo=geojson_temp;
				track_geojson = new L.geoJson(track_geo,{}).addTo(mapexplorer);	
				mapexplorer.fitBounds(track_geojson.getBounds());

				//Create the table with arribos values by year

				var arribos=data[2];				

				var content = '<table id="table_arribos_data" class="table table-hover">';
				content += "<tr><th>Año</th><th>Arribos</th></tr>";

				for (i = 0; i < arribos.length; i++){
					
					fecha=arribos[i].fecha;
					arribos_temp=arribos[i].arribos;					
				    content += '<tr><td>' + fecha + '</td><td>' + arribos_temp + '</td></tr>';
				}

				content += "</table>";				

				$('#table_arribos').append(content);


				//Create the table with SNP

				var parques=data[3];

				var content = '<table id="table_arribos_data" class="table table-hover">';
				content += "<tr><th>Parque Nacional</th><th>Categoría</th><th>Distancia Nave</th></tr>";

				for (i = 0; i < parques.length; i++){
					
					parque_temp=parques[i].nom_parque;					
					categoria_temp=parques[i].nom_categoria;
					dist=Math.round(parques[i].linea_corta);
					if(dist>=5000){						
						content += '<tr><td>' + parque_temp + '</td><td>' + categoria_temp + '</td><td><span class="badge badge-success">' + dist + 'm</span></td></tr>';
					} else if (dist>0) {
						content += '<tr><td>' + parque_temp + '</td><td>' + categoria_temp + '</td><td><span class="badge badge-warning">' + dist + 'm</span></td></tr>';
					} else {
						content += '<tr><td>' + parque_temp + '</td><td>' + categoria_temp + '</td><td><span class="badge badge-danger">' + dist + 'm</span></td></tr>';
					}
				    
				}

				$('#tabla_parques').append(content);				

			},
        error:function(){
	        	//map.spin(false);
	        	alert('Error');
        	} 
		});	

	}

	//-------------------------------------------------------------------
	//Crear el mapa para exploración de localización de la nave
	//-------------------------------------------------------------------

	var mapexplorer = L.map('mapexplorer', {
        center: [10, -72],
        zoom: 4,
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
	}).addTo(mapexplorer);

	//-------------------------------------------------------------------
	//-------------------------------------------------------------------



</script>
@endsection