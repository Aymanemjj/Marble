<?php

namespace App\Services;

use App\Dtos\CreatorDTO;
use App\Dtos\PieceDTO;
use App\Models\Artist;
use App\Models\Piece;
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

        if (is_null($user)) {
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

    public function getUserGallery(User $user)
    {

        if (is_null($user)) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }


        $pieces = Piece::where('administered', false)->where('creator_id', $user->id)->get();
        return response()->json([
            'success' => true,
            'message' => 'User profie',
            'data' => PieceDTO::collection($pieces)
        ]);
    }



    public function getArtistProfile(Artist $artist)
    {

        if (is_null($artist)) {
            return response()->json([
                'success' => false,
                'message' => 'Artist not found'
            ], 404);
        }


        return response()->json([
            'success' => true,
            'message' => 'Artist profile',
            'data' => CreatorDTO::make($artist)
        ]);
    }



    public function getArtistGallery(Artist $artist)
    {

        if (is_null($artist)) {
            return response()->json([
                'success' => false,
                'message' => 'Artist not found'
            ], 404);
        }

        $pieces = Piece::where('administered', true)->where('creator_id', $artist->id)->get();
        return response()->json([
            'success' => true,
            'message' => 'Artist profile',
            'data' => PieceDTO::collection($pieces)
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
