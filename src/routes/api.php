<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use  \App\Http\Controllers\API\V1\Channel\ChannelController;
use  \App\Http\Controllers\API\V1\Auth\AuthController;

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

    Route::middleware('auth:sanctum')
        ->get('/user', function (Request $request) {
            return $request->user();
        })->name('auth.user');

    include __DIR__ . '\v1\auth_routes.php';

    include __DIR__ . '\v1\channel_routes.php';

    include __DIR__ . '\v1\thread_routes.php';

});
