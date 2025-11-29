<?php

use App\Http\Controllers\SensorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Sensor;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/sensores', function () {

    $datos = Sensor::orderBy('created_at','desc')->take(20)->pluck('sensor1')->get();
    return response()->json($datos);
     //de sensores, ordena descendente(mas nuevo al viejo), dame ultimos 20 y solo dame datos de el campo sensor1
    //return view('welcome',compact('datos'));//enviaselo al html welcome.blade
});
Route::get('/sensores',[SensorController::class,'index']);
Route::get('/sensores',[SensorController::class,'vistaSensores']);
Route::post('/sensores',[SensorController::class,'store']);
