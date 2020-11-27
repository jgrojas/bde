<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class reportenaveController extends Controller
{
    public function index()
    {	

    	$list_nave=DB::TABLE('nave')
                    ->join('arribos_naves_puertos','arribos_naves_puertos.omimatricula','=','nave.omimatricula')
    				->select('nave.omimatricula','nave.nombrenave')
                    ->whereNotNull ('arribos_naves_puertos.geometry')
                    ->groupby('nave.omimatricula')
                    ->orderby('nave.nombrenave')
    				->get();

        $naves_eslora=DB::TABLE('nave')
                    ->join('tiponave','tiponave.cod_tiponave','=','nave.codigotiponave') 
                    ->join('arribos_naves_puertos','arribos_naves_puertos.omimatricula','=','nave.omimatricula')
                    ->select(DB::RAW('count(nave.nombrenave) as total, tiponave.categoria_eslora'))
                    ->groupby('tiponave.categoria_eslora')
                    ->get(); 

        $naves_trb=DB::TABLE('nave')
                    ->join('tiponave','tiponave.cod_tiponave','=','nave.codigotiponave') 
                    ->join('arribos_naves_puertos','arribos_naves_puertos.omimatricula','=','nave.omimatricula')
                    ->select(DB::RAW('count(nave.nombrenave) as total, tiponave.categoria_trb'))
                    ->groupby('tiponave.categoria_trb')
                    ->get();

        $nave_puerto=DB::TABLE('nave')
                    ->join('arribos_naves_puertos','arribos_naves_puertos.omimatricula','=','nave.omimatricula') 
                    ->join('puertos','puertos.id_puerto','=','arribos_naves_puertos.pto_origen')
                    ->select(DB::RAW('nave.nombrenave, puertos.nom_puerto, arribos_naves_puertos.fecha_arribo,puertos.geometry'))
                    ->groupby('nave.nombrenave','puertos.nom_puerto','arribos_naves_puertos.fecha_arribo','puertos.geometry')
                    ->get();

    	return view('pages.reportepornave',array('list_nave'=>$list_nave));
    }

    public function report(Request $request)
    {	
    	$matricula=$request ->input('array');

    	$track=DB::TABLE('arribos_naves_puertos')
    				->select(DB::RAW('ST_AsGeoJSON(geometry) as geometry'))
    				->where('omimatricula','=',$matricula)
    				->orderby('fecha_arribo','DESC')
    				->limit(10)    				
    				->get();    

    	$array=[$track];

    	return $array;
    } 

}
