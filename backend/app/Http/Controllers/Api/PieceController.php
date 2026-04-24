<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilterRequest;
use App\Http\Requests\StoreAlgoPrefsRequest;
use App\Http\Requests\StorePieceRequest;
use App\Http\Requests\UpdatePieceRequest;
use App\Models\Piece;
use App\Services\PieceService;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PieceController extends Controller
{
    use AuthorizesRequests;

    public function __construct(private PieceService $service) {}


    /**
     * Display a listing of the resource.
     */
    public function index(FilterRequest $request)
    {
        try {
            return $this->service->list($request);
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
    public function store(StorePieceRequest $request)
    {
        $this->authorize('create');
        try {
            return $this->service->create($request);
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
    public function show(Piece $piece)
    {
        try {
            return $this->service->show($piece);
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
    public function update(UpdatePieceRequest $request, Piece $piece)
    {
        $this->authorize('update', $piece);
        try {
            return $this->service->update($piece, $request);
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
    public function destroy(Piece $piece)
    {
        $this->authorize('delete', $piece);
        try {
            return $this->service->delete($piece);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function setPrefs(StoreAlgoPrefsRequest $request)
    {
        try {
            return $this->service->setPrefrences($request);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
