<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'public',
        'user_id',
        'artist_id',
        'administered'
    ];


    public function owner(): BelongsTo
    {
        return $this->administered
            ? $this->belongsTo(Artist::class, 'artist_id')
            : $this->belongsTo(User::class, 'user_id');
    }

    public function pieces(): BelongsToMany
    {
        return $this->belongsToMany(Piece::class, 'collage_piece', 'collage_id', 'piece_id');
    }
}
