<?php

namespace App\Services;

use App\Dtos\CollageDTO;
use App\Models\Collage;
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

    public function getAllCollages()
    {
        $collages = Collage::where('public', true)->get();


        return response()->json([
            'success' => true,
            'message' => 'All collages',
            'data' => ['collages' => CollageDTO::collection($collages)]
        ], 200);
    }

    public function store($request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
        $collage = Collage::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'All collages',
            'data' => ['collages' => CollageDTO::make($collage)]
        ], 201);
    }


    public function update(Collage $collage, $request)
    {
        $validated = $request->validated();

        $collage = Collage::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'All collages',
            'data' => ['collages' => CollageDTO::make($collage)]
        ], 201);
    }
}
