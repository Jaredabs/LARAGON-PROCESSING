<?php
use App\Http\Controllers\ImageController;
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
})->name('inicio');

Route::get('Registrar', [ImageController::class, 'show'])->name('register');
Route::post('Hacer-Registar',[ImageController:: class, 'create'])->name('registrar');
Route::post('Validar',[ImageController::class,'validar'])->name('acceso');
Route::post('Iniciar',[ImageController::class,'inicio'])->name('inicio');