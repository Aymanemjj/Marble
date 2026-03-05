<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $fillable=[
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


}
