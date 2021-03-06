<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class simuladorController extends Controller
{
    public function index()
    {	

    	$grilla=db::table('grilla_caribe')
    			->select(db::raw('point_id, ST_AsGeoJSON(geometry) as geometry'))
    			->get();    	

    	return view('pages.simulador', array('grilla'=>$grilla));
    }

    public function simulacion()
    {    	

    	$ubicacion_aleatoria=DB::TABLE('grilla_caribe')
    			->select(DB::RAW("point_id, ST_AsGeoJSON(geometry) as geometry"))
    			->inRandomOrder()
    			->limit(1)
    			->get();

    	$fecha_oleaje="2020-09-11 12:00:00";

    	$intersect=DB::select("select avg(o.altura_ola) as avg, ST_AsGeoJSON(nc.st_buffer) as geometry from nave_caribe nc, oleaje o inner join grilla_caribe gc on (gc.point_id = o.id_grilla) where st_intersects(nc.st_buffer, gc.geometry) and o.fecha = '".$fecha_oleaje."' and nc.point_id=".$ubicacion_aleatoria[0]->point_id." group by nc.st_buffer");

    	$array=[$ubicacion_aleatoria,$intersect];

    	return $array;
    }
}
