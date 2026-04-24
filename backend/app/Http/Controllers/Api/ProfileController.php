<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Artist;
use App\Models\Profile;
use App\Models\User;
use App\Services\ProfileService;
use Exception;

class ProfileController extends Controller
{

    public function __construct(private ProfileService $service) {}


    /**
     * Display the specified resource.
     */
    public function userProfile(User $user)
    {
        try {
            return $this->service->getUserProfile($user);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function userGallery(User $user)
    {
        try {
            return $this->service->getUserGallery($user);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    public function artistProfile(Artist $artist)
    {
        try {
            return $this->service->getArtistProfile($artist);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    public function artistGallery(Artist $artist)
    {
        try {
            return $this->service->getArtistGallery($artist);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileRequest $request, Profile $profile)
    {
        try {
            return $this->service->updateProfile($request);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
