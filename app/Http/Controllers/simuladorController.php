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

    	$ubicacion_aleatoria=DB::TABLE('grilla_caribe')
    			->select(DB::RAW("ST_Buffer(grilla_caribe.geometry, 1, 'endcap=round join=round')"))
    			->inRandomOrder()
    			->limit(1)
    			->get();

    	$oleaje_dia=DB::TABLE('grilla_caribe')
    			->join('oleaje','oleaje.id_grilla','=','grilla_caribe.point_id')
    			->select(DB::RAW('oleaje.altura_ola,grilla_caribe.point_id,grilla_caribe.geometry'))
    			->where('oleaje.fecha','=','2020-09-11 12:00:00')
    			->get();

    	return view('pages.simulador', array('grilla'=>$grilla, 'ubicacion_aleatoria'=>$ubicacion_aleatoria));
    }
}
