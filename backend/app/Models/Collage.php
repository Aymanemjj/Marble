<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Collage extends Model
{
    protected $fillabel =[
        'title',
        'description',
        'public',
        'user_id'
    ];


    public function owner():BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function content():HasMany{
        return $this->hasMany(Piece::class);
    }
}
