<?php

namespace App\Services;

use App\Dtos\PieceDTO;
use App\Models\Piece;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PieceService
{
    public function __construct() {}

    public function list($request)
    {
        $filters = $request->validated();
        $query = Piece::query();

        if (!empty($filters['search'])) {
            $query->where('title', 'like', "%{$filters['search']}%");
        }

        if (!empty($filters['tags'])) {
             $query->whereIn('tags.id', $filters['tags']);
        }
        $pieces = $query->whereHas('tags')->inRandomOrder()->take(10)->get();
        return response()->json([
            'success' => true,
            'message' => 'All available pieces',
            'data'    => ['pieces' => PieceDTO::collection($pieces)]
        ]);
    }

    public function show(Piece $piece)
    {
        $piece->load('tags');
        return response()->json([
            'success' => true,
            'message' => 'Piece retrieved successfully',
            'data'    => ['piece' => PieceDTO::make($piece)]
        ]);
    }

    public function create($request)
    {
        $validated = $request->validated();
        $validated['path'] = $request->file('path')->store('pieces', 'public');
        $validated['user_id'] = Auth::id();
        $tags = $validated['tags'] ?? [];
        unset($validated['tags']);
        $piece = Piece::create($validated);
        $piece->tags()->sync($tags);
        $piece->load('tags');
        $piece->load('owner');
        return response()->json([
            'success' => true,
            'message' => 'Piece created successfully',
            'data'    => ['piece' => PieceDTO::make($piece)]
        ], 201);
    }

    public function update(Piece $piece, $request)
    {
        $validated = $request->validated();
        if ($request->hasFile('path')) {
            Storage::disk('public')->delete($piece->path);
            $validated['path'] = $request->file('path')->store('pieces', 'public');
        }
        $tags = $validated['tags'] ?? [];
        unset($validated['tags']);
        $piece->update($validated);
        $piece->tags()->sync($tags);
        $piece->load('tags');
        return response()->json([
            'success' => true,
            'message' => 'Piece updated successfully',
            'data'    => ['piece' => PieceDTO::make($piece)]
        ]);
    }

    public function delete(Piece $piece)
    {
        Storage::disk('public')->delete($piece->path);
        $piece->delete();

        return response()->json([
            'success' => true,
            'message' => 'Piece deleted successfully',
            'data'    => []
        ]);
    }

    public function tags(Piece $piece)
    {
        return response()->json([
            'success' => true,
            'message' => 'Piece tags',
            'data'    => ['tags' => $piece->tags]
        ]);
    }
}
