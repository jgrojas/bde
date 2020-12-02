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
                    ->select(DB::RAW('paises.nombre, nave.eslora, nave.trb, nave.anoconstru, agencianave.id_agencia_arribo, paises.nombre, nave.dwt'))
                    ->where('omimatricula','=',$matricula)
                    ->get();

        $agencias_nave=DB::TABLE('nave_agencianave')
                    ->join('agencianave','agencianave.id_agencia_arribo','=','nave_agencianave.id_agencia_arribo')
                    ->select(DB::RAW('nave_agencianave.omimatricula, agencianave.id_agencia_arribo, agencianave.agencia_arribo'))
                    ->where('omimatricula','=',$matricula)
                    ->groupby('nave_agencianave.omimatricula','agencianave.id_agencia_arribo','agencianave.agencia_arribo')
                    ->get();

    	$track=DB::TABLE('arribos_naves_puertos')
    				->select(DB::RAW('ST_AsGeoJSON(geometry) as geometry,arribos_naves_puertos.pto_origen'))
    				->where('omimatricula','=',$matricula)
                    ->whereNotNull ('geometry')
    				->orderby('fecha_arribo','DESC')
    				->limit(1)    				
    				->get(); 

        $track1=DB::TABLE('arribos_naves_puertos')
                    ->select(DB::RAW('geometry,arribos_naves_puertos.pto_origen'))
                    ->where('omimatricula','=',$matricula)
                    ->whereNotNull ('geometry')
                    ->orderby('fecha_arribo','DESC')
                    ->limit(1)                  
                    ->get();   

        $arribos=DB::SELECT(DB::RAW("select count(s.omimatricula) as arribos, s.fecha from (select omimatricula, extract (year from anp.fecha_arribo) as fecha from arribos_naves_puertos anp where omimatricula = '".$matricula."') as s group by fecha"));


        $dist_parque=DB::SELECT("select distinct(p2.nom_parque),nr.omimatricula,cp.nom_categoria,p2.geometry as parque,ST_Length(ST_Transform(ST_ShortestLine('".$track1[0]->geometry."',p2.geometry),3857)) as linea_corta from naves_recorrido nr, pnn p2 inner join categoria_pnn cp on (cp.id_categoria=p2.id_categoria) where nr.omimatricula ='".$matricula."' order by linea_corta limit 5");


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

    	$array=[$track,$detalles_nave,$arribos,$dist_parque,$agencias_nave];
    	return $array;
    } 

}
