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


Route::apiresource('cor', 'App\Http\Controllers\CorController');
Route::apiresource('especie', 'App\Http\Controllers\EspecieController');
Route::apiresource('anilha', 'App\Http\Controllers\AnilhaController');
Route::apiresource('passaro', 'App\Http\Controllers\PassaroController');