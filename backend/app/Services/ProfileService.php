<?php

namespace App\Services;

use App\Dtos\CollageDTO;
use App\Dtos\CreatorDTO;
use App\Dtos\PieceDTO;
use App\Models\Artist;
use App\Models\Collage;
use App\Models\Piece;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ProfileService
{

    use AuthorizesRequests;

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


        $pieces = Piece::where('administered', false)->where('user_id', $user->id)->get();
        $collages = Collage::where('administered', false)->where('public', true)->where('user_id', $user->id)->get();

        return response()->json([
            'success' => true,
            'message' => 'User profie',
            'data' => ['pieces' => PieceDTO::collection($pieces), 'collages' => CollageDTO::collection($collages)]
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

        $pieces = Piece::where('administered', true)->where('artist_id', $artist->id)->get();
        $collages = Collage::where('administered', true)->where('public', true)->where('user_id', $artist->id)->get();

        return response()->json([
            'success' => true,
            'message' => 'Artist profile',
            'data' => ['pieces' => PieceDTO::collection($pieces), 'collages' => CollageDTO::collection($collages)]
        ]);
    }

    public function updateProfile($request)
    {
        $validated = $request->validated();

        if (!empty($validated['artist_id'])) {
            $profile = Artist::find($validated['artist_id']);
            Gate::authorize('updateArtist', $profile);
        } else {
            $profile = Auth::user()->profile;
            Gate::authorize('update', $profile);
        }

        if ($request->hasFile('banner') && $profile->banner != null) {
            Storage::disk('public')->delete($profile->banner);
            $validated['banner'] = $request->file('banner')->store('banners', 'public');
        }

        if ($request->hasFile('picture') && $profile->picture != null) {
            Storage::disk('public')->delete($profile->picture);
            $validated['picture'] = $request->file('picture')->store('pictures', 'public');
        }

        unset($validated['artist_id']);
        $profile->update($validated);

        return response()->json([
            'success' => true,
            'message'=> 'profile updated',
        ]);
    }
}
