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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('jwt.auth')->group(function () {
Route::apiresource('cor', 'App\Http\Controllers\CorController');
Route::apiresource('especie', 'App\Http\Controllers\EspecieController');
Route::apiresource('anilha', 'App\Http\Controllers\AnilhaController');
Route::apiresource('passaro', 'App\Http\Controllers\PassaroController');


Route::post('refresh',  'App\Http\Controllers\AuthController@refresh');
Route::post('logout' ,  'App\Http\Controllers\AuthController@logout');
Route::post('me',  'App\Http\Controllers\AuthController@me');
    
});




Route::post('login', 'App\Http\Controllers\AuthController@login');
