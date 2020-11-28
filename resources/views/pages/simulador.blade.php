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

</script>

@endsection

