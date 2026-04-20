<?php

use App\Http\Controllers\Api\ArtistController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\CollageController;
use App\Http\Controllers\Api\PieceController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\FollowingController;
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
    Route::post('/follow/user/{id}', [FollowingController::class, 'followUser'])->name('follow-user');
    Route::post('/follow/artist/{id}', [FollowingController::class, 'followArtist'])->name('follow-artist');
    Route::delete('/unfollow/user/{id}', [FollowingController::class, 'unfollowUser'])->name('unfollow-user');
    Route::delete('/unfollow/artist/{id}', [FollowingController::class, 'unfollowArtist'])->name('unfollow-artist');



    //Artist Routes
    Route::get('/artists', [ArtistController::class, 'index'])->name('artist-index');
    Route::post('/admin/artist/create', [ArtistController::class, 'store'])->name('artist-create');
    Route::get('/artist/{artist}', [ArtistController::class, 'store'])->name('artist-details');
    Route::put('/admin/artist/{artist}/update', [ArtistController::class, 'update'])->name('artist-update');
    Route::put('/admin/artist/{artist}/delete', [ArtistController::class, 'update'])->name('artist-update');

    
});



//Authentication
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
