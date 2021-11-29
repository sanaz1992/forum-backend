<?php

use Illuminate\Support\Facades\Route;

use  \App\Http\Controllers\API\V1\Channel\ChannelController;


Route::prefix('/channel')->group(function () {

    Route::get('/all', [ChannelController::class, 'getAllChannelsList'])->name('channel.all');
    Route::post('/create', [ChannelController::class, 'create'])->name('channel.create');
    Route::put('/update', [ChannelController::class, 'update'])->name('channel.update');
    Route::delete('/delete', [ChannelController::class, 'delete'])->name('channel.delete');

});
