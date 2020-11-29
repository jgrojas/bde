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

        $list_rutas=DB::TABLE('trayectos')
                    ->join('puertos','puertos.id_puerto','=','trayectos.pto_origen')
                    ->select('trayectos.pto_origen','puertos.nom_puerto')
                    ->limit(1)
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

        /*$random_point=DB::TABLE('buffer_tracks')
                    ->select('ST_GeneratePoints(ST_AsGeoJSON(geometry), 1)')
                    ->get();*/

    	return view('pages.reportepornave',array('list_nave'=>$list_nave,'list_rutas'=>$list_rutas));
    }

    public function report(Request $request)
    {	
    	$matricula=$request ->input('array');
        $puerto_origen=$request ->input('array'); 

        $detalles_nave=DB::TABLE('nave')
                    ->join('agencianave','agencianave.id_agencia_arribo','=','nave.id_agencia_arribo')
                    ->join('paises','paises.abreviatura_pais','=','nave.codigo_pais')
                    ->select(DB::RAW('paises.nombre, nave.eslora, nave.trb, nave.anoconstru, agencianave.agencia_arribo, paises.nombre, nave.dwt'))
                    ->where('omimatricula','=',$matricula)
                    ->get();

    	$track=DB::TABLE('arribos_naves_puertos')
    				->select(DB::RAW('ST_AsGeoJSON(geometry) as geometry,arribos_naves_puertos.pto_origen'))
    				->where('omimatricula','=',$matricula)
    				->orderby('fecha_arribo','DESC')
    				->limit(1)    				
    				->get();   

        $rutas_parques=DB::TABLE('rutas_intersect')
                    ->select(DB::RAW('rutas_intersect.pto_origen, rutas_intersect.nom_puerto, rutas_intersect.nom_parque, rutas_intersect.ruta, rutas_intersect.parque'))
                    ->where('pto_origen','=',$puerto_origen)
                    ->get();

    	$array=[$track,$detalles_nave];
    	return $array;
    } 

}
