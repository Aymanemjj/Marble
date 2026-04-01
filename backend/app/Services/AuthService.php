<?php

namespace App\Services;

use App\Http\Resources\AuthResource;
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

        $token = $user->createToken('Marble')->plainTextToken;


        return response()->json([
            'success' => true,
            'message' => 'Registered succesfully.',
            'data' => ["token" => $token, 'user' => AuthResource::make($user)]
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
            'data' =>  ["token" => $token, 'user' => AuthResource::make($user)]
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

    public function profile($request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Profil utilisateur récupéré',
            'data' => ["user" => AuthResource::make(Auth::user())],
        ], 200);
    }
}
