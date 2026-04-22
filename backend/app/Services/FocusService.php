<?php

namespace App\Services;

use App\Dtos\PieceDTO;
use App\Models\Piece;
use Illuminate\Support\Facades\DB;

class FocusService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    public function getPieces($request)
    {
        $validated = $request->validated();
        if (is_null($validated['tags'])) {
            $pieces = Piece::inRandomOrder()->take(10)->get();
            return response()->json([
                'success' => true,
                'message' => '10 random pieces',
                'data' => PieceDTO::collection($pieces)
            ], 200);
        }
        $Rtags = $validated['tags'];

        $pieces = Piece::whereHas('tags', function ($query) use ($Rtags) {
            $query->whereIn('tags.name', $Rtags);
        })->inRandomOrder()->take(10)->get();

        return response()->json([
            'success' => true,
            'message' => '10 random pieces',
            'data' => PieceDTO::collection($pieces)
        ], 200);
    }


}
