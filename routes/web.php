<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Models\Empleado;
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

//Se hace uso de Clases para llamar las diversas funciones que le dan funcionalid a la App Web
Route::get('/',[EmpleadoController::class,'index'])->name('index');
Route::post('/create',[EmpleadoController::class,'create'])->name('create');
Route::post('/destroy',[EmpleadoController::class,'destroy'])->name('destroy');
Route::post('/edit',[EmpleadoController::class,'edit'])->name('edit');
Route::resource('empleado',EmpleadoController::class);