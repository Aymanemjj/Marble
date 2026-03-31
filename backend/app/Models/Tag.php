<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tag extends Model
{
    protected $fillable =[
        'name',
        'description'
    ];

    public function pieces():HasMany{
        return $this->hasMany(Piece::class);
    }

    
}
