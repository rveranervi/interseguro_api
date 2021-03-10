<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function (Request $request) {
    return view('welcome');
});

Route::post('/obtener_arreglo', function (Request $request) {
    $arreglo = array();
    for ($i=0; $i < $request->n_dimensiones; $i++) { 
    	$fila = array();
    	for ($z=0; $z < $request->n_dimensiones; $z++) { 
	    	$fila[$z] = rand(0,25);
	    }
	    $arreglo[$i] = $fila;
    }
    return serialize($arreglo);
});

Route::post('/reordenar_horario', function (Request $request) {
    $arreglo = unserialize($request->arreglo);
    $height = count($arreglo);
    $width = count($arreglo[0]);
    $arreglo90 = array();

    for ($i = 0; $i < $width; $i++) {
        for ($j = 0; $j < $height; $j++) {
            $arreglo90[$height - $i - 1][$j] = $arreglo[$height - $j - 1][$i];
        }
    }
    return serialize($arreglo90);
});

Route::post('/reordenar_antihorario', function (Request $request) {
    $arreglo = unserialize($request->arreglo);
    $height = count($arreglo);
    $width = count($arreglo[0]);
    $arreglo90 = array();

    for ($i = $width-1; $i >= 0; $i--) {
        for ($j = $height-1; $j >= 0; $j--) {
            $arreglo90[$height - $i - 1][$j] = $arreglo[$height - $j - 1][$i];
        }
    }
    return serialize($arreglo90);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
