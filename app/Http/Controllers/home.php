<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class home extends Controller
{
    public function index()
    {
        return view('pages.home');
    } 
}
