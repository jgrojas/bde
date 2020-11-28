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

        $random_point=DB::TABLE('buffer_tracks')
                    ->select('ST_GeneratePoints(ST_AsGeoJSON(geometry), 1)')
                    ->get();

    	return view('pages.reportepornave',array('list_nave'=>$list_nave,'list_rutas'=>$list_rutas));
    }

    public function report(Request $request)
    {	
    	$matricula=$request ->input('array');

        $eslora=DB::TABLE('nave')
                    ->select(DB::RAW('nave.eslora'))
                    ->where('omimatricula','=',$matricula)
                    ->get();

        $trb=DB::TABLE('nave')
                    ->select(DB::RAW('nave.trb'))
                    ->where('omimatricula','=',$matricula)
                    ->get();

        $construccion=DB::TABLE('nave')
                    ->select(DB::RAW('nave.anoconstru'))
                    ->where('omimatricula','=',$matricula)
                    ->get();

        $agencia_nave=DB::TABLE('nave')
                    ->join('agencianave','agencianave.id_agencia_arribo','=','nave.id_agencia_arribo')
                    ->select(DB::RAW('agencianave.agencia_arribo'))
                    ->where('omimatricula','=',$matricula)
                    ->get();

        $bandera=DB::TABLE('nave')
                    ->join('paises','paises.abreviatura_pais','=','nave.codigo_pais')
                    ->select(DB::RAW('paises.nombre'))
                    ->where('omimatricula','=',$matricula)
                    ->get();

        $dwt=DB::TABLE('nave')
                    ->select(DB::RAW('nave.dwt'))
                    ->where('omimatricula','=',$matricula)
                    ->get();

    	$track=DB::TABLE('arribos_naves_puertos')
    				->select(DB::RAW('ST_AsGeoJSON(geometry) as geometry'))
    				->where('omimatricula','=',$matricula)
    				->orderby('fecha_arribo','DESC')
    				->limit(10)    				
    				->get();    

    	$array=[$track,$eslora,$trb,$construccion,$agencia_nave,$bandera,$dwt];

    	return $array;
    } 

}
