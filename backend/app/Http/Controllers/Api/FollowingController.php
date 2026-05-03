<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\FollowingService;
use Exception;

class FollowingController extends Controller
{
    public function __construct(private FollowingService $service) {}


    public function listConnections()
    {
        try {
            return $this->service->listConnections();
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }






    public function followUser($id)
    {
        try {
            return $this->service->followUser($id);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    public function unfollowUser($id)
    {
        try {
            return $this->service->unfollowUser($id);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    public function followArtist($id)
    {
        try {
            return $this->service->followArtist($id);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    public function unfollowArtist($id)
    {
        try {
            return $this->service->unfollowArtist($id);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
