<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Profile extends Model
{
    protected $fillable = [
        'picture',
        'banner',
        'biography',
        'user_id',
        "fav_piece_id_1",
        'fav_piece_id_2'
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function FavPieces(): BelongsTo
    {
        return $this->favPiece1()->merge($this->favPiece2());
    }

    public function favPiece1(): BelongsTo
    {
        return $this->belongsTo(Piece::class, 'fav_piece_id_1');
    }

    public function favPiece2(): BelongsTo
    {
        return $this->belongsTo(Piece::class, 'fav_piece_id_2');
    }
}
