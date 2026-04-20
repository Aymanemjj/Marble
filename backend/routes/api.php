<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\CollageController;
use App\Http\Controllers\Api\PieceController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\FollowingController;
use Illuminate\Support\Facades\Route;


Route::middleware("auth:sanctum")->group(function () {


    //Authentication
    Route::get('/profile', [AuthController::class, 'profile'])->name('logout');
    Route::post('/logout', [AuthController::class, 'logOut'])->name('logout');

    Route::get('/creator/user/{user}', [ProfileController::class, 'userProfile'])->name('user-profile');
    Route::get('/creator/artist/{artist}', [ProfileController::class, 'artistProfile'])->name('artist-profile');

    Route::get('/test', function () {
        return response()->json(['message' => 'ok']);
    });
    //Pieces
    Route::get("/index", [PieceController::class, 'index'])->name('piece-all');
    Route::post('/piece/create', [PieceController::class, 'store'])->name('piece-create');
    Route::put('/piece/{piece}/update', [PieceController::class, 'update'])->name('piece-update');
    Route::delete('/piece/{piece}/delete', [PieceController::class, 'destroy'])->name('piece-delete');
    Route::get('/piece/{piece}', [PieceController::class, 'show'])->name('piece-details');


    //Collages
    Route::get('/collage', [CollageController::class, 'index'])->name('collage-all');
    Route::get('/profile/collage', [CollageController::class, 'privateIndex'])->name('collage-privateList');
    Route::get('/collage/{collage}', [CollageController::class, 'show'])->name('collage-show');
    Route::post('/collage/create', [CollageController::class, 'store'])->name('collage-create');
    Route::put('/collage/update', [CollageController::class, 'update'])->name('collage-update');
    Route::post('/collage/delete', [CollageController::class, 'destroy'])->name('collage-delete');
    Route::post('/collage/{collage}/add/{piece}', [CollageController::class, 'addPieceToCollage'])->name('collage-add');
    Route::post('/collage/{collage}/remove/{piece}', [CollageController::class, 'removePieceFromCollage'])->name('collage-remove');



    //Following System

    Route::get('/profile/followers', [FollowingController::class, 'indexFollowers'])->name('user-followers');
    Route::get('/profile/following', [FollowingController::class, 'indexFollowing'])->name('user-following');
    Route::get('/follow/user/{id}', [FollowingController::class, 'followUser'])->name('follow-user');
    Route::get('/follow/artist/{id}', [FollowingController::class, 'followArtist'])->name('follow-artist');
    Route::get('/unfollow/user/{id}', [FollowingController::class, 'unfollowUser'])->name('unfollow-user');
    Route::get('/unfollow/artist/{id}', [FollowingController::class, 'unfollowArtist'])->name('unfollow-artist');

    
});



//Authentication
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
