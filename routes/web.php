<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservasController;
use App\Http\Controllers\UsersController;

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

//Pagina principal
Route::get('/', function () {
    return view('index');
});

//Pagina de seleccion de fecha
Route::get('/reservas/fecha', function () {
    return view('reservas.fecha');
});

//Pagina de seleccion de opciones para consulta de reservas
Route::get('/reservas/consultar', [ReservasController::class, 'consultar']);

//Paginas correspondientes al CRUD de Reservas
Route::resource('reservas', ReservasController::class);

//Paginas correspondientes al CRUD de Users
Route::resource('user', UsersController::class);

