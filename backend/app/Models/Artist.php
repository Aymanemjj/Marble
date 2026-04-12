<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artist extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'date_of_birth',
        'date_of_death',
        'main_medium',
        'picture',
        'banner',
        'biography'
    ];


    public function followers():BelongsToMany {
        return $this->belongsToMany(User::class);
    }

    public function pieces():HasMany{
        return $this->hasMany(Piece::class);
    }
}
