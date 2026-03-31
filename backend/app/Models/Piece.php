<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Piece extends Model
{
    protected $fillable=[
        'title',
        'story',
        'date',
        'path',
        'metadata',
        'administered',
    ];

    public function owner():BelongsToMany{
        return $this->administered ? $this->belongsToMany(User::class) : $this->belongsToMany(Artist::class);
    }

    public function tags():BelongsToMany{
        return $this->belongsToMany(Tag::class);
    }



}
