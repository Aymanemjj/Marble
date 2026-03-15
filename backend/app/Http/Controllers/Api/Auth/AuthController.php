<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private AuthService $AuthService;

    public function __construct(AuthService $AuthService)
    {
        $this->AuthService = $AuthService;
    }


    public function register(RegisterRequest $request)
    {
        try {

            return response()->json([
                'success' => true,
                'message' => 'Inscription réussie.',
                'data' => $this->AuthService->register($request)
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            return response()->json([
                'success' => true,
                'message' => 'Connexion réussie.',
                'data' =>  $this->AuthService->login($request)
            ], 200);
            
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function profile(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Profil utilisateur récupéré',
            'data' => ["user"=>Auth::user()],
        ],200);
    }
    public function logOut(Request $request)
    {
        try {
            $this->AuthService->logOut($request);
            return response()->json([
                'success' => true,
                'message' => 'Déconnexion réussie.',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
