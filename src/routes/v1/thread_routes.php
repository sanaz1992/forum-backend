<?php

use Illuminate\Support\Facades\Route;


Route::resource('threads', \App\Http\Controllers\API\V1\Thread\ThreadController::class);
