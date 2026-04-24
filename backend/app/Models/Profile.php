<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    protected $fillable = [
        'picture',
        'banner',
        'biography',
        'user_id',
    ];

    public function owner():BelongsTo{
        return $this->belongsTo(User::class);
    }
}
