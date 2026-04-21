<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AdminService;
use Exception;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(private AdminService $service) {}

    public function banUser(User $user)
    {
        try {
            return $this->service->banUser($user);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    public function unbanUser(User $user)
    {
        try {
            return $this->service->unbanUser($user);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    public function statistics()
    {
        try {
            return $this->service->getStatistics();
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
