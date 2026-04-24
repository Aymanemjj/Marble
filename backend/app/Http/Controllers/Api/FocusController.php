<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FocusTagsRequest;
use App\Services\FocusService;
use Exception;
use Illuminate\Http\Request;

class FocusController extends Controller
{
    public function __construct(private FocusService $service) {}


    public function getPieces(FocusTagsRequest $request)
    {
        try {
            return $this->service->getPieces($request);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
