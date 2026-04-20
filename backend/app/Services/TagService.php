<?php
namespace App\Services;

use App\Dtos\TagDTO;
use App\Models\Tag;

class TagService
{
    public function __construct() {}

    public function list()
    {
        $tags = Tag::all();
        return response()->json([
            'success' => true,
            'message' => 'All available tags',
            'data'    => ['tags' => TagDTO::collection($tags->toArray())]
        ]);
    }

    public function show(Tag $tag)
    {
        return response()->json([
            'success' => true,
            'message' => 'Tag retrieved successfully',
            'data'    => ['tag' => TagDTO::make($tag)]
        ]);
    }

    public function create($request)
    {
        $validated = $request->validated();
        $tag = Tag::create($validated);
        return response()->json([
            'success' => true,
            'message' => 'Tag created successfully',
            'data'    => ['tag' => TagDTO::make($tag)]
        ], 201);
    }

    public function update(Tag $tag, $request)
    {
        $validated = $request->validated();
        $tag->update($validated);
        return response()->json([
            'success' => true,
            'message' => 'Tag updated successfully',
            'data'    => ['tag' => TagDTO::make($tag)]
        ]);
    }

    public function delete(Tag $tag)
    {
        $tag->delete();
        return response()->json([
            'success' => true,
            'message' => 'Tag deleted successfully',
        ]);
    }
}