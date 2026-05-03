<?php

namespace App\Services;

use App\Dtos\CreatorDTO;
use App\Dtos\PieceDTO;
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
            'data' => ['artists' => CreatorDTO::collection($artists)]
        ]);
    }


    public function storeArtist($request)
    {
        $validated = $request->validated();
        $validated['picture'] = $request->file('picture')->store('pictures', 'public');
        $validated['banner'] = $request->file('banner')->store('banners', 'public');
        $artist = Artist::create($validated);
        return response()->json([
            'success' => true,
            'message' => 'Artist saved',
            'data' => ['artist' => CreatorDTO::make($artist)]
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
            'success' => true,
            'message' => "$artist->firstname $artist->lastname has ben updated",
            'data' => ['artist' => CreatorDTO::make($artist)]
        ]);
    }

    public function getArtist($artist)
    {
        $pieces = null;

        if (!$artist) {
            return response()->json([
                'success' => false,
                'message' => "Artist doesn't exist",
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => "$artist->firstname $artist->lastname has ben found",
            'data' => ['artist' => CreatorDTO::make($artist), 'pieces' => PieceDTO::collection($pieces)]
        ]);
    }

    public function deleteArtist($artist)
    {

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
