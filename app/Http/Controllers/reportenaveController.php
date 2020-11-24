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
}
