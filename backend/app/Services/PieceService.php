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
        $searched = false;

        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('title', 'like', "%{$filters['search']}%")
                    ->orWhereHas('artistOwner', function ($q) use ($filters) {
                        $q->where('firstname', 'like', "%{$filters['search']}%")
                            ->orWhere('lastname', 'like', "%{$filters['search']}%");
                    })
                    ->orWhereHas('userOwner', function ($q) use ($filters) {
                        $q->where('firstname', 'like', "%{$filters['search']}%")
                            ->orWhere('lastname', 'like', "%{$filters['search']}%");
                    });
            });
            $searched = true;
        }

        if (!empty($filters['tags'])) {
            // $query->whereIn('tags.name', $filters['tags']);
            $query->whereHas('tags', function ($q) use ($filters) {
                $q->where('name', $filters['tags']);
            });

            $searched = true;
        }

        $query->whereHas('tags')->inRandomOrder();

        if (!$searched) {
            $query->take(50);
        }

        $pieces = $query->get();

        return response()->json([
            'success' => true,
            'message' => 'All available pieces',
            'data'    => ['pieces' => PieceDTO::collection($this->algorithm($pieces, $searched))]
        ]);
    }

    private function algorithm($pieces, $searched)
    {

        

        return $pieces;
    }


    private function overWeightCookie($name)
    {
            $data = json_decode($_COOKIE[$name]);
            $serialized_data = serialize($data);
            $size = (strlen($serialized_data) * 8 / 1024);

            return $size > 3;

    }
    private function cleanCookie($name)
    {

        if (!$this->overWeightCookie($name)) return;

        $prefs = json_decode($_COOKIE[Auth::user()->email . '_prefs'], true);
        arsort($prefs);
        array_splice($prefs, sizeof($prefs) / 2, sizeof($prefs)-1);

        return;
    }

    public function setPrefrences($request)
    {

        $data = $request->validated();
        $piece = Piece::find($data['piece']);
        $auth = Auth::user();

        if (isset($_COOKIE[$auth->email . '_prefs'])) {
            $this->cleanCookie($auth->email . '_prefs');

            $prefs = json_decode($_COOKIE[$auth->email . '_prefs'], true);

            foreach ($piece->tags as $tag) {
                $prefs[$tag->name] += $data['duration'];
            }
        } else {
            $prefs = [];

            foreach ($piece->tags as $tag) {
                $prefs[$tag->name] = $data['duration'];
            }
        }

        $this->markViewed($piece);

        setcookie($auth->email . '_prefs', json_encode($prefs), [
            'expires'  => time() + (86400 * 30),
            'path'     => '/',
            'secure'   => true,
            'httponly' => true,
        ]);
        return;
    }


    private function markViewed(Piece $piece)
    {
        $piece->viewedBy()->attach(Auth::id());
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

        if (Auth::user()->isAdmin()) {
            $validated['artist_id'] = $validated['artist'];
            $validated['administered'] = true;
        } else {
            $validated['user_id'] = Auth::id();
        }

        $validated['path'] = $request->file('path')->store('pieces', 'public');
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

        if (Auth::user()->isAdmin()) {
            $validated['artist_id'] = $validated['artist'];
        }

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


