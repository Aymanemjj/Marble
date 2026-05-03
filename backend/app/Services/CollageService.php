<?php

namespace App\Services;

use App\Dtos\CollageDTO;
use App\Models\Collage;
use App\Models\Piece;
use Illuminate\Support\Facades\Auth;

class CollageService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function list()
    {
        $collages = Collage::where('public', true)->get();


        return response()->json([
            'success' => true,
            'message' => 'All collages',
            'data' => ['collages' => CollageDTO::collection($collages)]
        ], 200);
    }

    public function privateList()
    {
        $collages = Collage::where('public', true)->where('user_id', Auth::id())->get();


        return response()->json([
            'success' => true,
            'message' => 'Your collages',
            'data' => ['collages' => CollageDTO::collection($collages)]
        ], 200);
    }

    public function store($request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
        Auth::user()->isAdmin()
            ?$validated['administered'] = true
            :$validated['administered'] = false;        

        $collage = Collage::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Collages created',
            'data' => ['collages' => CollageDTO::make($collage)]
        ], 201);
    }


    public function update(Collage $collage, $request)
    {
        $validated = $request->validated();
        $collage->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Collages updated',
            'data' => ['collage' => CollageDTO::make($collage)]
        ], 201);
    }


    public function show(Collage $collage)
    {
        $collage->load('owner');
        $collage->load("pieces");

        return response()->json([
            'success' => true,
            'message' => 'Collages updated',
            'data' => ['collages' => CollageDTO::make($collage)]
        ], 201);
    }

    public function delete(Collage $collage)
    {
        $collage->delete();

        return response()->json([
            'success' => true,
            'message' => 'Collages has ben deleted',
        ], 200);
    }

    public function addPieceToCollage(Collage $collage, $piece_id)
    {
        $piece = Piece::find($piece_id);
        if (is_null($piece)) {
            return response()->json([
                'success' => false,
                'message' => 'Piece not found',
            ], 404);
        }
        $collage->pieces()->attach($piece->id);

        return response()->json([
            'success' => true,
            'message' => "Piece added to {$collage->title} collage",
        ], 201);
    }



    public function removePieceFromCollage(Collage $collage, Piece $piece)
    {
        $collage->pieces()->detach($piece->id);

        return response()->json([
            'success' => true,
            'message' => "Piece removed from {$collage->title}",
        ], 200);
    }
}
