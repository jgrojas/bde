@extends('master/master')

@section('styles')
<style type="text/css">
	.info {
	    padding: 6px 8px;
	    font: 14px/16px Arial, Helvetica, sans-serif;
	    background: white;
	    background: rgba(255,255,255,0.8);
	    box-shadow: 0 0 15px rgba(0,0,0,0.2);
	    border-radius: 5px;
	}
	.info h4 {
	    margin: 0 0 5px;
	    color: #777;
	}
</style>
@endsection

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
						<h2>Simulador de oleaje en el caribe colombiano</h2>
					</div>
					<div id="mapsimulator" style="height: 600px"></div>
				</div>

				
			</div>
		</section>
@endsection



@section('javascripts')

<script type="text/javascript">

	//-------------------------------------------------------------------
	//Crear mapa para simular el riesgo por oleaje
	//-------------------------------------------------------------------

	var mapsimulator = L.map('mapsimulator', {
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
	}).addTo(mapsimulator);

    var grilla={!!json_encode($grilla)!!}   

    geojson_temp={
		type: 'FeatureCollection',
	    features: []
	};

	for (i = 0; i < grilla.length; i++){		
		objeto={
				type: 'Feature',
		   		properties: {
				   	'point_id': grilla[i].point_id,	                
			 	},
			 	'geometry': jQuery.parseJSON(grilla[i].geometry)
			}
			x=geojson_temp.features.length				
			geojson_temp.features[x]=objeto		
	}

	grilla=geojson_temp;

	var grilla_lyr = new L.geoJson(grilla);	

	var marker_cluster_group = L.markerClusterGroup();

	marker_cluster_group.addLayer(grilla_lyr)

	mapsimulator.addLayer(marker_cluster_group);

	mapsimulator.fitBounds(marker_cluster_group.getBounds());	

	var button = L.control({position: 'bottomleft'});

	button.onAdd = function (map) {
	    this._div = L.DomUtil.create('div', 'info'); // create a div with a class "info"
	    this.update();
	    return this._div;
	};

	button.update = function (props) {
	    this._div.innerHTML = '<a class="button button-3d button-rounded button-green" onclick="simular()"><i class="icon-repeat"></i>Generar Localización</a>';
	};

	button.addTo(mapsimulator);

	var Icon = L.icon({
	    iconUrl: 'images/ocean-transportation.png',
	    iconSize:     [40, 40], // size of the icon	    
	    iconAnchor:   [40, 40], // point of the icon which will correspond to marker's location	    	    
	});

	function interaccion_buffer(feature, layer) {	
		text='Id punto: '+feature.properties.point_id+'<br>Promedio oleaje: '+feature.properties.avg
		layer.bindTooltip(text);		
	};

	function simular(){

		try {						
			mapsimulator.removeLayer(geojson_buffer_layer);	
			mapsimulator.removeLayer(marker);	
		} catch(err) {    	  	
		}
		
		$.ajax({		
		url: "simulacionpost",		
		beforeSend: function (xhr) {//This function is necessary to ajax 
					var token = $('meta[name="csrf_token"]').attr('content');
					if (token) {
						return xhr.setRequestHeader('X-CSRF-TOKEN', token);
					}
				},		
		type: "POST",
		success:function(data){


				
				// Add point

				var point_id=data[0][0].point_id;

				var geometry=jQuery.parseJSON(data[0][0].geometry);
				var long=geometry.coordinates[0];
				var lat=geometry.coordinates[1];
				

				var marker=L.marker([lat, long], {icon: Icon}).addTo(mapsimulator);


				
				//Add Bufer
				var buffer=data[1];

				objeto={
					type: 'Feature',
		   			properties: {
					   	'point_id': point_id,
		                'avg': buffer[0].avg	                
				 	},
				 	'geometry': jQuery.parseJSON(buffer[0].geometry)
				}

				geojson_buffer={
					type: 'FeatureCollection',
				    features: [objeto]
				};

				var geojson_buffer_layer=L.geoJson(geojson_buffer,{onEachFeature: interaccion_buffer}).addTo(mapsimulator);  
				mapsimulator.fitBounds(geojson_buffer_layer.getBounds());




			},
        error:function(){
	        	//map.spin(false);
	        	alert('Error');
        	} 
		});	
	}


</script>

@endsection

