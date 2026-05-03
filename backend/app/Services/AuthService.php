<?php

namespace App\Services;

use App\Dtos\CollageDTO;
use App\Dtos\PieceDTO;
use App\Dtos\UserDTO;
use App\Http\Resources\AuthResource;
use App\Models\Collage;
use App\Models\Piece;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function register($request)
    {
        $validated = $request->validated();

        $validated['password'] = bcrypt($validated['password']);
        $user = User::create($validated);
        $profile = Profile::create(['user_id' => $user->id]);
        $token = $user->createToken('Marble')->plainTextToken;


        return response()->json([
            'success' => true,
            'message' => 'Registered succesfully.',
            'data' => ["token" => $token, 'user' => UserDTO::make($user)]
        ], 201);
    }

    public function login($request)
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Wrong credentials'
            ], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('Marble')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Logedin seccesfully.',
            'data' =>  ["token" => $token, 'user' => UserDTO::make($user)]
        ], 200);
    }



    public function logout(Request $request)
    {
        Auth::user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'LogedOut seccesfully.',
        ], 200);
    }

    public function profile()
    {

        $pieces = Piece::with(['tags', 'owner'])
            ->where('administered', false)
            ->where('user_id', Auth::id())
            ->get();

        $collages = Collage::with(['pieces.tags', 'owner'])
            ->where('administered', false)
            ->where('user_id', Auth::id())
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Profil utilisateur récupéré',
            'data' => ["user" => UserDTO::make(Auth::user()), 'pieces' => PieceDTO::collection($pieces), 'collages' => CollageDTO::collection($collages)],
        ], 200);
    }


    public function profilePinia($request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Profil utilisateur récupéré',
            'data' => ["user" => UserDTO::make(Auth::user())],
        ], 200);
    }
}
