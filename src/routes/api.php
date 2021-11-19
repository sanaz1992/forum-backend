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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::prefix('/v1')->group(function () {

    Route::prefix('/auth')->group(function () {

        Route::post('/register', '\App\Http\Controllers\API\V01\Auth\AuthController@register')->name('auth.register');
        Route::post('/login', '\App\Http\Controllers\API\V01\Auth\AuthController@login')->name('auth.login');
        Route::post('/logout', '\App\Http\Controllers\API\V01\Auth\AuthController@logout')->name('auth.logout');

        Route::middleware('auth:sanctum')
            ->get('/user', function (Request $request) {
            return $request->user();
        })->name('auth.user');

    });

});
