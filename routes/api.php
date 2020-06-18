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

# @todo implement auth
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('clientes', 'ClienteController@index');
Route::get('clientes/{cliente}', 'ClienteController@view');
Route::post('clientes', 'ClienteController@create');
Route::put('clientes/{cliente}', 'ClienteController@update');
Route::delete('clientes/{cliente}', 'ClienteController@delete');

Route::get('clientes/{cliente}/planos', 'ClienteController@viewPlanos');
Route::get('clientes/{cliente}/planos/{id}', 'ClienteController@viewPlano');
Route::post('clientes/{cliente}/planos/{id}', 'ClienteController@createPlano');
Route::delete('clientes/{cliente}/planos/{id}', 'ClienteController@deletePlano');
