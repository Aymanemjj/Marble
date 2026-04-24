<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collage extends Model
{
    use SoftDeletes;

    protected $fillable =[
        'title',
        'description',
        'public',
        'user_id'
    ];


    public function owner():BelongsTo{
        return $this->belongsTo(User::class, 'user_id');
    }
    public function pieces():BelongsToMany{
        return $this->belongsToMany(Piece::class);
    }

}
