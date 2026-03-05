<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'picture',
        'banner',
        'biography',
        'user_id',
    ];
}
