<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\PieceController;
use Illuminate\Support\Facades\Route;


Route::middleware("auth:sanctum")->group(function () {


    //Authentication
    Route::get('/profile', [AuthController::class, 'profile'])->name('logout');
    Route::post('/logout', [AuthController::class, 'logOut'])->name('logout');


    //Pieces
    Route::post('/piece/new', [PieceController::class, 'store'])->name('piece-new');
    Route::put('/piece/{piece}/update', [PieceController::class, 'update'])->name('piece-update');
    Route::delete('/piece/{piece}/delete', [PieceController::class, 'destroy'])->name('piece-delete');
    Route::get('/piece/{piece}', [PieceController::class, 'show'])->name('piece-details');
});



//Authentication
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
