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
}
