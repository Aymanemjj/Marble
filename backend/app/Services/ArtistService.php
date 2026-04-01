<?php

namespace App\Services;

use App\Http\Resources\ArtistResource;
use App\Models\Artist;

class ArtistService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    public function getAllArtists()
    {
        $artists = Artist::all();

        return response()->json([
            'success' => true,
            'message' => 'All artists',
            'data' => ['artists' => ArtistResource::collection($artists)]
        ]);
    }


    public function storeArtist($request)
    {
        $validated = $request->validated();

        $artist = Artist::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Artist saved',
            'data' => ['artist' => ArtistResource::make($artist)]
        ]);
    }

    public function updateArtist($artist_id, $request)
    {
        $validated = $request->validated();

        $artist = Artist::find($artist_id);
        $artist->update($validated);
        $artist->save();

        return response()->json([
            'sucsess' => true,
            'message' => "$artist->firstname $artist->lastname has ben updated",
            'data' => ['artist' => ArtistResource::make($artist)]
        ]);
    }

    public function getArtist($artist_id)
    {
        $artist = Artist::find($artist_id);
        $pieces = null;

        if (!$artist) {
            return response()->json([
                'sucsess' => false,
                'message' => "Artist doesn't exist",
            ]);
        }

        return response()->json([
            'sucsess' => true,
            'message' => "$artist->firstname $artist->lastname has ben found",
            'data' => ['artist' => ArtistResource::make($artist), 'pieces' => PieceResource::collection($pieces)]
        ]);
    }

    public function deleteArtist($artist_id)
    {
        $artist = Artist::find($artist_id);

        if (!$artist) {
            return response()->json([
                'sucsess' => false,
                'message' => "Artist doesn't exist",
            ]);
        }

        $artist->delete();

        return response()->json([
            'sucsess' => true,
            'message' => "$artist->firstname $artist->lastname has ben deleted",
        ]);
    }
}
