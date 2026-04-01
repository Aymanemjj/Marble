<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArtistRequest;
use App\Http\Requests\UpdateArtistRequest;
use App\Models\Artist;
use App\Services\ArtistService;
use Exception;

class ArtistController extends Controller
{


    public function __construct(private ArtistService $service) {}


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return $this->service->getAllArtists();
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
    public function store(StoreArtistRequest $request)
    {
        try {
            return $this->service->storeArtist($request);
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
    public function show($artist_id)
    {
        try {
            return $this->service->getArtist($artist_id);
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
    public function update(UpdateArtistRequest $request, $artist_id)
    {
        try {
            return $this->service->updateArtist($artist_id, $request);
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
    public function destroy($artist_id)
    {
        try {
            return $this->service->deleteArtist($artist_id);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    
}
