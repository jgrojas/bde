<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class home extends Controller
{
    public function index()
    {
        $num_naves=DB::TABLE('arribos_naves_puertos')
                            ->select(DB::RAW('count(id_capitania) as total'))
                            ->get();

        $num_naves2020=DB::TABLE('arribos_naves_puertos')
                            ->whereBetween('arribos_naves_puertos.fecha_arribo',['2020-01-01','2020-11-21'])
                            ->select(DB::RAW('count(id_capitania) as total'))
                            ->get();  

        $num_naves2020_p=round(($num_naves2020[0]->total/$num_naves[0]->total)*100);

    	$arribos_capitanias=DB::TABLE('capitanias')
    						->join('arribos_naves_puertos','arribos_naves_puertos.id_capitania','=','capitanias.id_capitania')
    						->select(DB::RAW('nom_capitania, count(nom_capitania) as total'))
    						->groupby('nom_capitania')
    						->orderby('total','DESC')
    						->limit(5)
    						->get();  

        $principales_zarpes=DB::TABLE('arribos_naves_puertos') 
                            ->join('puertos','puertos.id_puerto','=','arribos_naves_puertos.pto_origen') 
                            ->join('paises','paises.abreviatura_pais','=','puertos.abreviatura_pais')
                            ->select(DB::RAW('puertos.nom_puerto,paises.nombre,count(arribos_naves_puertos.pto_origen) as total,puertos.geometry'))
                            ->groupby('puertos.nom_puerto','paises.nombre','puertos.geometry') 
                            ->orderby('total','DESC') 
                            ->limit(10) 
                            ->get();

        $tipos_naves=DB::TABLE('tiponave')
                            ->join('nave','nave.codigotiponave','=','tiponave.cod_tiponave')
                            ->join('arribos_naves_puertos','arribos_naves_puertos.omimatricula','=','nave.omimatricula')
                            ->select(DB::RAW('tiponave.nom_tiponave,count(tiponave.nom_tiponave) as total'))
                            ->groupby('tiponave.nom_tiponave')
                            ->orderby('total','DESC')
                            ->get();

        $arribos_capitanias2020=DB::TABLE('capitanias')
                            ->whereBetween('arribos_naves_puertos.fecha_arribo',['2020-01-01','2020-11-21'])
                            ->join('arribos_naves_puertos','arribos_naves_puertos.id_capitania','=','capitanias.id_capitania')
                            ->select(DB::RAW('nom_capitania, count(nom_capitania) as total'))
                            ->groupby('nom_capitania')
                            ->orderby('total','DESC')
                            ->limit(5)
                            ->get();         
    	
        /*$punto_cercano=DB::TABLE('puertos')
                            ->select(DB::RAW("nom_puerto,geometry,st_distance(ST_Transform(ST_SetSRID(ST_GeomFromText('POINT(-71.107 12.028)'),4326),3857),ST_Transform(geometry,3857)) as distancia"))
                            ->orderby('distancia')
                            ->limit(1)
                            ->get();*/

        return view('pages.home', array('arribos_capitanias'=>$arribos_capitanias,'num_naves'=>$num_naves,'num_naves2020'=>$num_naves2020,'num_naves2020_p'=>$num_naves2020_p));
    } 
}
