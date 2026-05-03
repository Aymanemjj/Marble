<?php

namespace App\Services;

use App\Dtos\CreatorDTO;
use App\Models\Artist;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowingService
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}







    public function listConnections()
    {
        $user = Auth::user();
        return response()->json([
            'success' => true,
            'message' => 'Connections',
            'data' => [
                'following' => CreatorDTO::collection($user->getFollowing()),
                'followers' => CreatorDTO::collection($user->getFollowers()),
            ]
        ], 200);
    }




    public function followUser(INT $id)
    {

        if (Auth::id() === $id) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot follow yourself'
            ], 400);
        }

        if (!User::where('id', $id)->where('role', 'user')->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        $user = Auth::user();
        $user->followedUsers()->syncWithoutDetaching([$id]);

        return response()->json([
            'success' => true,
            'message' => 'Follow saved'
        ], 200);
    }

    public function unfollowUser($id)
    {



        $user = Auth::user();
        $user->followedUsers()->detach($id);

        return response()->json([
            'success' => true,
            'message' => 'Unfollowed successfully'
        ], 200);
    }


    public function followArtist($id)
    {
        if (!Artist::where('id', $id)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Artist not found'
            ], 404);
        }

        $user = Auth::user();
        $user->followedArtists()->syncWithoutDetaching([$id]);

        return response()->json([
            'success' => true,
            'message' => 'Artist followed successfully'
        ], 200);
    }

    public function unfollowArtist($id)
    {
        Auth::user()->followedArtists()->detach($id);

        return response()->json([
            'success' => true,
            'message' => 'Artist unfollowed successfully'
        ], 200);
    }
}
