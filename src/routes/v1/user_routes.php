<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/users')->group(function () {

    Route::get('/leaderboards', [
        \App\Http\Controllers\API\V1\User\UserController::class,
        'leaderboards'
    ])->name('users.leaderboards');

});
