<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Piece extends Model
{
    protected $fillable = [
        'title',
        'story',
        'date',
        'path',
        'metadata',
        'administered',
        'user_id',
        "artist_id"
    ];

    public function owner(): BelongsTo
    {
        return $this->administered
            ? $this->belongsTo(Artist::class, 'artist_id')
            : $this->belongsTo(User::class, 'user_id');
    }

    public function artistOwner(): BelongsTo
    {
        return $this->belongsTo(Artist::class, 'artist_id');
    }

    public function userOwner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }


    public function viewedBy(): BelongsToMany
    {
        return $this->belongsToMany(Piece::class, 'views', 'piece_id', 'user_id');
    }
}
