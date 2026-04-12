<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collage extends Model
{
    use SoftDeletes;

    protected $fillabel =[
        'title',
        'description',
        'public',
        'user_id'
    ];


    public function owner():BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function content():BelongsToMany{
        return $this->belongsToMany(Piece::class);
    }
}
