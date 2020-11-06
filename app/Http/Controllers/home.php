<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class home extends Controller
{
    public function index()
    {

    	$arribos_capitanias=DB::TABLE('capitanias')
    						->join('arribos_naves_puertos','arribos_naves_puertos.id_capitania','=','capitanias.id_capitania')
    						->select(DB::RAW('nom_capitania, count(nom_capitania) as total'))
    						->groupby('nom_capitania')
    						->orderby('total','DESC')
    						->get();

    	return $arribos_capitanias;
    		
        return view('pages.home');
    } 
}
