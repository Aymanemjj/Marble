<?php

namespace App\Services;

use App\Models\Artist;
use App\Models\Collage;
use App\Models\Piece;
use App\Models\Tag;
use App\Models\User;

class AdminService
{

    public function banUser(User $user)
    {
        $user->active = false;
        $user->save();
        return response()->json([
            'success' => true,
            'message' => "$user->firstname $user->lastname has ben banned"
        ], 200);
    }


    public function unbanUser(User $user)
    {
        $user->active = true;
        $user->save();
        return response()->json([
            'success' => true,
            'message' => "$user->firstname $user->lastname has ben unbanned"
        ], 200);
    }

    public function getStatistics()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'counts' => [
                    'users'    => User::count(),
                    'artists'  => Artist::count(),
                    'pieces'   => Piece::count(),
                    'collages' => Collage::count(),
                    'tags'     => Tag::count(),
                ],
                'users' => User::all(),
            ]
        ]);
    }
}
