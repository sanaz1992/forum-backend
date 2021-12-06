<?php

use Illuminate\Support\Facades\Route;


Route::resource('threads', \App\Http\Controllers\API\V1\Thread\ThreadController::class);

Route::prefix('/threads')->group(function () {
    Route::resource('answers', \App\Http\Controllers\API\V1\Thread\AnswerController::class);

    Route::post('/{thread}/subscribe', [
        \App\Http\Controllers\API\V1\Thread\SubscribeController::class,
        'subscribe'
    ])->name('subscribe');

    Route::post('/{thread}/unsubscribe', [
        \App\Http\Controllers\API\V1\Thread\SubscribeController::class,
        'unSubscribe'
    ])->name('unSubscribe');
});
