<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class reportenaveController extends Controller
{
    public function index()
    {	

    	$list_nave=DB::TABLE('nave')
    				->select('omimatricula','nombrenave')
    				->get();

    	return view('pages.reportepornave',array('list_nave'=>$list_nave));
    }

    public function report(Request $request)
    {	
    	$matricula=$request ->input('array');

    	$track=DB::TABLE('arribos_naves_puertos')
    				->select(db::raw('ST_AsGeoJSON(geometry) as geometry'))
    				->where('omimatricula','=',$matricula)
    				->orderby('fecha_arribo','DESC')
    				->limit(10)    				
    				->get();

    	$array=[$track];

    	return $array;
    } 

}
