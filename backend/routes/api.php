<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\ArtistController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\CollageController;
use App\Http\Controllers\Api\FocusController;
use App\Http\Controllers\Api\PieceController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\FollowingController;
use App\Http\Controllers\Api\TagController;
use Illuminate\Support\Facades\Route;


Route::middleware("auth:sanctum")->group(function () {


    //Authentication
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::get('/profile/pinia', [AuthController::class, 'profilePinia'])->name('profile-pinia');
    Route::post('/logout', [AuthController::class, 'logOut'])->name('logout');
    Route::patch('/profile/edit', [ProfileController::class, 'update'])->name('profile-update');




    //Pieces
    Route::post('/piece/create', [PieceController::class, 'store'])->name('piece-create');
    Route::put('/piece/{piece}/update', [PieceController::class, 'update'])->name('piece-update');
    Route::delete('/piece/{piece}/delete', [PieceController::class, 'destroy'])->name('piece-delete');



    //Collages

    Route::get('/profile/collage', [CollageController::class, 'privateIndex'])->name('collage-privateList');
    Route::post('/collage/create', [CollageController::class, 'store'])->name('collage-create');
    Route::put('/collage/{collage}/update', [CollageController::class, 'update'])->name('collage-update');
    Route::delete('/collage/{collage}/delete', [CollageController::class, 'destroy'])->name('collage-delete');

    //Collage pieces
    Route::post('/collage/{collage}/add/{piece}', [CollageController::class, 'addPieceToCollage'])->name('collage-add');
    Route::delete('/collage/{collage}/remove/{piece}', [CollageController::class, 'removePieceFromCollage'])->name('collage-remove-piece');



    //Following System

    Route::get('/profile/connections', [FollowingController::class, 'listConnections'])->name('connections-all');
    Route::post('/follow/user/{id}', [FollowingController::class, 'followUser'])->name('follow-user');
    Route::post('/follow/artist/{id}', [FollowingController::class, 'followArtist'])->name('follow-artist');
    Route::delete('/unfollow/user/{id}', [FollowingController::class, 'unfollowUser'])->name('unfollow-user');
    Route::delete('/unfollow/artist/{id}', [FollowingController::class, 'unfollowArtist'])->name('unfollow-artist');






    //Focus
    Route::post('/focus/pieces', [FocusController::class, 'getPieces'])->name('focus-pieces');

    //Tags
    Route::get('/tags/list', [TagController::class, 'index'])->name('tags-all');

    //Algorithms
    Route::post('/algo/prefs/set', [PieceController::class, 'setPrefs'])->name('set-algo-prefs');
});

Route::middleware(['auth:sanctum', 'isAdmin'])->group(function () {
    Route::post('/admin/tags/create', [TagController::class, 'store'])->name('tags-create');
    Route::patch('/admin/tags/{tag}/update', [TagController::class, 'update'])->name('tags-update');
    Route::delete('/admin/tags/{tag}/delete', [TagController::class, 'delete'])->name('tags-delete');


    //Artist 
    Route::post('/admin/artist/create', [ArtistController::class, 'store'])->name('artist-create');
    Route::patch('/admin/artist/{artist}/update', [ArtistController::class, 'update'])->name('artist-update');
    Route::delete('/admin/artist/{artist}/delete', [ArtistController::class, 'destroy'])->name('artist-destroy');


    //Administration
    Route::get('/admin/stats', [AdminController::class, 'statistics'])->name('admin-stats');
    Route::patch('/admin/users/{user}/ban', [AdminController::class, 'banUser'])->name('admin-ban');
    Route::patch('/admin/users/{user}/unban', [AdminController::class, 'unbanUser'])->name('admin-unban');
});

//Authentication
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');



// Creator profile
Route::get('/creator/user/{user}', [ProfileController::class, 'userProfile'])->name('user-profile')->middleware('auth:sanctum,nullable');;
Route::get('/creator/artist/{artist}', [ProfileController::class, 'artistProfile'])->name('artist-profile')->middleware('auth:sanctum,nullable');;
Route::get('/creator/artist/{artist}/gallery', [ProfileController::class, 'artistGallery'])->name('artist-gallery');
Route::get('/creator/user/{user}/gallery', [ProfileController::class, 'userGallery'])->name('user-gallery');

//Pieces
Route::post("/index", [PieceController::class, 'index'])->name('piece-all');
Route::get('/piece/{piece}', [PieceController::class, 'show'])->name('piece-details');


//Collages
Route::get('/collage', [CollageController::class, 'index'])->name('collage-all');
Route::get('/collage/{collage}', [CollageController::class, 'show'])->name('collage-show');


//Artist Routes
Route::get('/artists', [ArtistController::class, 'index'])->name('artist-index');
