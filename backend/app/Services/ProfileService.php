<?php

namespace App\Services;

use App\Dtos\CreatorDTO;
use App\Dtos\UserDTO;
use App\Models\Artist;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getUserProfile(User $user)
    {

        if (!is_null($user)) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }


        $user->load('profile');
        return response()->json([
            'success' => true,
            'message' => 'User profie',
            'data' => CreatorDTO::make($user)
        ]);
    }


    public function getArtistProfile(Artist $artist)
    {

        if (!is_null($artist)) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }


        return response()->json([
            'success' => true,
            'message' => 'User profie',
            'data' => CreatorDTO::make($artist)
        ]);
    }

    public function updateProfile($request)
    {
        $profile = Auth::user()->profile;
        $validated = $request->validated();


        if ($request->hasFile('banner')) {
            Storage::disk('public')->delete($profile->banner);
            $validated['banner'] = $request->file('banner')->store('banners', 'public');
        }

        if ($request->hasFile('picture')) {
            Storage::disk('public')->delete($profile->picture);
            $validated['picture'] = $request->file('picture')->store('pictures', 'public');
        }

        $profile->update($validated);
    }
}
