<?php

use App\Http\Controllers\Api\Auth\AuthController;
use Illuminate\Support\Facades\Route;


Route::middleware("auth:sanctum")->group(function () {

    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logOut'])->name('logout');

});




Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);
