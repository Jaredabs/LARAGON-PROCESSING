<?php

use App\Http\Controllers\RutasController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('index');


Route::get('ayuda', [RutasController::class,('mostrarAyuda')])->name('mostrar-ayuda');

Route::get('inicio', [RutasController::class,('mostrarInicio')])->name('mostrar-inicio');

Route::get('pagina1', [RutasController::class,('mostrarPag1')])->name('mostrar-pagina1');

Route::get('pagina2', [RutasController::class,('mostrarPag2')])->name('mostrar-pagina2');

Route::get('pagina3', [RutasController::class,('mostrarPag3')])->name('mostrar-pagina3');

Route::get('pagina4', [RutasController::class,('mostrarPag4')])->name('mostrar-pagina4');

Route::get('pagina5', [RutasController::class,('mostrarPag5')])->name('mostrar-pagina5');

Route::get('pagina6', [RutasController::class,('mostrarPag6')])->name('mostrar-pagina6');
Route::get('pagina44', [RutasController::class,('mostrarPag7')])->name('mostrar-pagina7');

Route::post('Hacer una suma',[RutasController::class,('hacerSuma')])->name('suma');
Route::post('Hacer una resta',[RutasController::class,('hacerResta')])->name('resta');
Route::post('Hacer una multiplicacion',[RutasController::class,('hacerMultiplicacion')])->name('multiplicacion');
Route::post('Hacer una division',[RutasController::class,('hacerDivision')])->name('division');

Route::post('Hacer validnom',[RutasController::class,('hacerVal')])->name('validar');
