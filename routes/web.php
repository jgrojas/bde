<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\home;
use App\Http\Controllers\reportenaveController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[home::class, 'index']);
Route::get('reportenave',[reportenaveController::class, 'index']);
Route::post('reportenavepost',[reportenaveController::class, 'report']);

Route::get('mapa', function () {
    return view('pages/Mapa1');
});

Route::get('mapaframe', function () {
    return view('pages/mapaframe');
});