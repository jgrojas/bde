<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use MStaack\LaravelPostgis\Eloquent\PostgisTrait;

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

    	/*$arribos_capitanias=DB::TABLE('capitanias')
    						->join('arribos_naves_puertos','arribos_naves_puertos.id_capitania','=','capitanias.id_capitania')
    						->select(DB::RAW('nom_capitania, count(nom_capitania) as total'))
    						->groupby('nom_capitania')
    						->orderby('total','DESC')
    						->limit(5)
    						->get();*/  

        $arribos_capitanias=DB::TABLE('arribos_capitanias')
                            ->select(DB::RAW('nom_capitania, total'))
                            ->orderby('total','DESC')
                            ->get(); 

        /*$arribos_anual=DB::TABLE('arribos_anual')
                            ->select(DB::RAW('year, sum(total)'))
                            ->groupby('year')
                            ->orderby('year')
                            ->get(); */

        $arribos_anual=DB::TABLE('arribos_naves_puertos')
                            ->select(DB::RAW('count(id_capitania), extract (year from fecha_arribo) as year'))
                            ->groupby('year')
                            ->get();

        $principales_zarpes=DB::TABLE('arribos_naves_puertos') 
                            ->join('puertos','puertos.id_puerto','=','arribos_naves_puertos.pto_origen') 
                            ->join('paises','paises.abreviatura_pais','=','puertos.abreviatura_pais')
                            ->select(DB::RAW('puertos.id_puerto,puertos.nom_puerto,paises.alfa_dos,paises.nombre,count(arribos_naves_puertos.pto_origen) as total, ST_AsGeoJSON(puertos.geometry) as geometry'))                            
                            ->groupby('puertos.id_puerto','puertos.nom_puerto','paises.alfa_dos','paises.nombre','puertos.geometry') 
                            ->orderby('total','DESC')
                            ->limit(10)
                            ->get();        

        $tipos_naves=DB::TABLE('tiponave')
                            ->join('nave','nave.codigotiponave','=','tiponave.cod_tiponave')
                            ->join('arribos_naves_puertos','arribos_naves_puertos.omimatricula','=','nave.omimatricula')
                            ->select(DB::RAW('tiponave.nom_tiponave,count(tiponave.nom_tiponave) as total'))
                            ->groupby('tiponave.nom_tiponave')
                            ->orderby('total','DESC')
                            ->limit(10)
                            ->get();

        $arribos_capitanias2020=DB::TABLE('capitanias')
                            ->whereBetween('arribos_naves_puertos.fecha_arribo',['2020-01-01','2020-11-21'])
                            ->join('arribos_naves_puertos','arribos_naves_puertos.id_capitania','=','capitanias.id_capitania')
                            ->select(DB::RAW('nom_capitania, count(nom_capitania) as total'))
                            ->groupby('nom_capitania')
                            ->orderby('total','DESC')
                            ->limit(5)
                            ->get();        
    	
        $punto_cercano=DB::TABLE('puertos')
                            ->select(DB::RAW("nom_puerto,geometry,st_distance(ST_Transform(ST_SetSRID(ST_GeomFromText('POINT(-71.107 12.028)'),4326),3857),ST_Transform(geometry,3857)) as distancia"))
                            ->orderby('distancia')
                            ->limit(1)
                            ->get();

        $razon_arribo=DB::TABLE('arribos_naves_puertos')
                            ->join('razon_arribos','razon_arribos.id_razon','=','arribos_naves_puertos.id_razonarribo')
                            ->select(DB::RAW('nom_razon,count(nom_razon) as total'))
                            ->groupby('nom_razon')
                            ->orderby('total','DESC')
                            ->limit(5)
                            ->get();

        //Estas son la consultas que estaban en naves pero parecen ser del reporte global

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

        $longitud_recorridos=DB::TABLE('naves_recorrido')
                    ->select(DB::RAW('naves_recorrido.omimatricula, naves_recorrido.nombrenave, sum(ST_Length(ST_Transform(naves_recorrido.geometry,3857))) as longitud'))
                    ->groupby('naves_recorrido.omimatricula','naves_recorrido.nombrenave')
                    ->orderby('longitud','DESC')
                    ->limit(10)
                    ->get();

        $arribos_naves=DB::TABLE('nave')
                    ->join('arribos_naves_puertos','arribos_naves_puertos.omimatricula','=','nave.omimatricula')
                    ->select(DB::RAW('nave.nombrenave, nave.omimatricula, count(arribos_naves_puertos.omimatricula) as arribos'))
                    ->groupby('nave.omimatricula', 'nave.nombrenave')
                    ->orderby('arribos','DESC')
                    ->limit(10)
                    ->get();

        return view('pages.home', array('arribos_capitanias'=>$arribos_capitanias,'num_naves'=>$num_naves,'num_naves2020'=>$num_naves2020,'num_naves2020_p'=>$num_naves2020_p,'principales_zarpes'=>$principales_zarpes,'tipos_naves'=>$tipos_naves,'razon_arribo'=>$razon_arribo,'arribos_anual'=>$arribos_anual));
    } 
}
