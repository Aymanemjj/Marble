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

    public function owner(): BelongsTo
    {
        return $this->administered
            ? $this->belongsTo(Artist::class,'creator_id')
            : $this->belongsTo(User::class, 'creator_id');
    }


    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
