<?php

namespace App\Services;

use App\Models\Piece;
use Illuminate\Support\Facades\Auth;

class AlgoService
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}





    public function algorithm($pieces, $searched)
    {

        if (!isset($_COOKIE[Auth::user()->email . '_prefs'])) return $pieces;
        $prefs = json_decode($_COOKIE[Auth::user()->email . '_prefs']);
        arsort($prefs);

        $points = $this->getPoints($prefs);

        $piece_points = $this->pointsPerPiece($pieces, $points);
        uasort($pieces, function ($p1, $p2) use ($piece_points) {
            return $piece_points[$p2->id] - $piece_points[$p1->id];
        });

        return $pieces;
    }


    private function pointsPerPiece($pieces, $points)
    {

        $piece_points = [];

        foreach ($pieces as $piece) {
            $piece_points[$piece->id] = array_reduce(
                $piece->tags,
                function ($p, $tag) use ($points) {
                    isset($points[$tag])
                        ? $p += $points[$tag]
                        : $p += 2;
                    return $p;
                },
                0
            );
        }

        return $piece_points;
    }


    private function getPoints($prefs)
    {
        $points = [];
        $bar = array_sum($prefs) / sizeof($prefs);


        foreach ($prefs as $tag => $value) {
            if ($value >= $bar) {
                $points[$tag] = 3;
            } elseif ($value < 0) {
                $points[$tag] = 0;
            } else {
                $points[$tag] = 1;
            }
        }

        return $points;
    }

    private function isFatCookie($name)
    {
        $data = json_decode($_COOKIE[$name]);
        $serialized_data = serialize($data);
        $size = (strlen($serialized_data) * 8 / 1024);

        return $size > 3;
    }
    private function cleanCookie($name)
    {

        if (!$this->isFatCookie($name)) return;

        $prefs = json_decode($_COOKIE[Auth::user()->email . '_prefs'], true);
        arsort($prefs);
        array_splice($prefs, sizeof($prefs) / 2, sizeof($prefs) - 1);

        return;
    }

    public function setPrefrences($request)
    {
        $data = $request->validated();
        $increment = $data['duration'] >= 15 ? 1 : -1;

        $piece = Piece::find($data['piece_id']);
        $auth = Auth::user();

        $prefs = isset($_COOKIE[$auth->email . '_prefs'])
            ? json_decode($_COOKIE[$auth->email . '_prefs'], true)
            : [];

        foreach ($piece->tags as $tag) {
            isset($prefs[$tag->name])
                ? $prefs[$tag->name] += $increment
                : $prefs[$tag->name] = $increment;
        }

        $this->markViewed($piece);

        setcookie($auth->email . '_prefs', json_encode($prefs), [
            'expires'  => time() + (86400 * 30),
            'path'     => '/',
            'secure'   => true,
            'httponly' => true,
        ]);
    }

    private function markViewed(Piece $piece)
    {
        $piece->viewedBy()->syncWithPivotValues(
            [Auth::id()],
            ['last_seen' => now()],
            false
        );
    }
}
