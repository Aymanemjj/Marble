<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCollageRequest;
use App\Http\Requests\UpdateCollageRequest;
use App\Models\Collage;
use App\Models\Piece;
use App\Services\CollageService;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CollageController extends Controller
{

    use AuthorizesRequests;

    public function __construct(private CollageService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return $this->service->list();
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function privateIndex()
    {
        try {
            return $this->service->privateList();
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCollageRequest $request)
    {
        try {
            return $this->service->store($request);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Collage $collage)
    {
        try {
            return $this->service->show($collage);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCollageRequest $request, Collage $collage)
    {
        $this->authorize('update', $collage);

        try {
            return $this->service->update($collage, $request);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Collage $collage)
    {
        $this->authorize('delete', $collage);
        try {
            return $this->service->delete($collage);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function addPieceToCollage(Collage $collage,Piece $piece)
    {
        $this->authorize('update', $collage);
        try {
            return $this->service->addPieceToCollage($collage, $piece);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    public function removePieceFromCollage(Collage $collage, Piece $piece)
    {
        $this->authorize('update', $collage);
        try {
            return $this->service->removePieceFromCollage($collage, $piece);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
