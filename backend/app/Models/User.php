<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends GeneralUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'date_of_birth',
        'date_of_death',
        'email',
        'password',
        'role',
        'status',
        'main_medium',
    ];

    private function followedArtists():BelongsToMany
    {
        return $this->belongsToMany(Artist::class,);
    }

    private function followedUsers():BelongsToMany{
        return $this->belongsToMany(User::class);
    }

    public function getFollowing(){
        $artists = $this->followedArtists();
        $users = $this->followedUsers();

        return $artists->merge($users);
    }

    public function pieces():HasMany{
        return $this->hasMany(Piece::class);
    }

    public function profile(): HasOne{
        return $this->hasOne(Profile::class);
    }
}
