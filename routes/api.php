<?php

use App\Http\Controllers\ApiController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/usuarios',[ApiController::class,'getUsers']);

Route::get('/comanda',[ApiController::class,'getComanda']);
Route::get('/seguimiento',[ApiController::class,'getSeguimiento']);
Route::get('/familia/productos',[ApiController::class,'getFamiliaProductos']);
Route::get('/productos',[ApiController::class,'getProductos']);
