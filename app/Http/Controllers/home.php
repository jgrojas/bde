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


    	$arribos_capitanias=DB::TABLE('capitanias')
    						->join('arribos_naves_puertos','arribos_naves_puertos.id_capitania','=','capitanias.id_capitania')
    						->select(DB::RAW('nom_capitania, count(nom_capitania) as total'))
    						->groupby('nom_capitania')
    						->orderby('total','DESC')
    						->limit(5)
    						->get();    	
    		
        return view('pages.home', array('arribos_capitanias'=>$arribos_capitanias,'num_naves'=>$num_naves));
    } 
}
