<?php

namespace App\Services;

use App\Dtos\ArtistDTO;
use App\Http\Resources\ArtistResource;
use App\Models\Artist;
use Illuminate\Support\Facades\Storage;

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
            'data' => ['artists' => ArtistDTO::collection($artists)]
        ]);
    }


    public function storeArtist($request)
    {
        $validated = $request->validated();
        $validated['picture'] = $request->file('path')->store('pictures', 'public');
        $validated['banner'] = $request->file('path')->store('banners', 'public');

        $artist = Artist::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Artist saved',
            'data' => ['artist' => ArtistDTO::make($artist)]
        ]);
    }

    public function updateArtist(Artist $artist, $request)
    {
        $validated = $request->validated();
        
        if ($request->hasFile('banner')) {
            Storage::disk('public')->delete($artist->banner);
            $validated['banner'] = $request->file('banner')->store('banners', 'public');
        }

        if ($request->hasFile('picture')) {
            Storage::disk('public')->delete($artist->picture);
            $validated['picture'] = $request->file('picture')->store('pictures', 'public');
        }

        $artist->update($validated);
        $artist->save();

        return response()->json([
            'sucsess' => true,
            'message' => "$artist->firstname $artist->lastname has ben updated",
            'data' => ['artist' => ArtistDTO::make($artist)]
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
            'data' => ['artist' => ArtistDTO::make($artist), 'pieces' => PieceResource::collection($pieces)]
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
