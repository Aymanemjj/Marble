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
        'user_id'
    ];

    public function Artistowner(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }

    public function Userowner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
