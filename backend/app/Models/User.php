<?php

namespace App\Models;

use App\Interfaces\CreatorInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends GeneralUser implements CreatorInterface
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
        'active',
    ];

    public function followedArtists():BelongsToMany
    {
        return $this->belongsToMany(Artist::class,'artist_users', 'user_id','following_id');
    }

    public function followedUsers():BelongsToMany{
        return $this->belongsToMany(User::class, 'user_users', 'user_id', 'following_id');
    }

    public function getFollowing(){
        $artists = $this->followedArtists()->get();
        $users = $this->followedUsers()->get();

        return $artists->merge($users);
    }

    public function getFollowers(){
        return $this->belongsToMany(User::class, 'user_users', 'following_id')->get();
    }


    public function pieces():HasMany{
        return $this->hasMany(Piece::class);
    }

    public function profile(): HasOne{
        return $this->hasOne(Profile::class);
    }

    public function collages(){
        return $this->hasMany(Collage::class);
    }

    public function viewed():BelongsToMany{
        return $this->belongsToMany(Piece::class, 'views', 'user_id', 'piece_id');
    }
}
