<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::post('/register',[RegisterController::class, 'register']);

Route::post('/login',[RegisterController::class, 'login']);
