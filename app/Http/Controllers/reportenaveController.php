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

    	return view('pages.reportepornave',array('list_nave'=>$list_nave));
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

        $arribos=DB::SELECT(DB::RAW("select count(s.omimatricula) as arribos, s.fecha from (select omimatricula, extract (year from anp.fecha_arribo) as fecha from arribos_naves_puertos anp where omimatricula = '".$matricula."') as s group by fecha"));

        $dist_parque=DB::TABLE('distancia_parque')
                    ->select(DB::RAW('distancia_parque.omimatricula, distancia_parque.nombrenave, distancia_parque.nom_parque, distancia_parque.ruta, distancia_parque.parque, distancia_parque.linea_corta'))
                    ->where('distancia_parque.omimatricula','=',$matricula)
                    ->orderby('distancia_parque.linea_corta')
                    ->limit(3)
                    ->get();

        /*$rutas_parques=DB::TABLE('rutas_intersect')
                    ->select(DB::RAW('rutas_intersect.pto_origen, rutas_intersect.nom_puerto, rutas_intersect.nom_parque, rutas_intersect.ruta, rutas_intersect.parque'))
                    ->where('pto_origen','=',$puerto_origen)
                    ->get();

        /*$punto_aleatorio=DB::TABLE('buffer_tracks')
                    ->select(DB::RAW('ST_GeneratePoints(ST_AsGeoJSON(geom),1) as geometry, buffer_tracks.pto_origen, buffer_tracks.nom_puerto'))
                    ->where('pto_origen','=',$puerto_origen)
                    ->get();*/

        /*$punto_emergencia=DB::TABLE('puertos')
                    ->select(DB::RAW('$punto_aleatorio.nom_puerto as origen'))
                    ->where('pto_origen','=',$puerto_origen)
                    ->get();*/

    	$array=[$track,$detalles_nave,$arribos];
    	return $array;
    } 

}
