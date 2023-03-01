<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable, HasFactory;

    protected $fillable = [
        'first_name', 'last_name', 'is_admin', 'points', 'email', 'password'
    ];

    protected $hidden = [
        'password',
    ];

    public function matches()
    {
        return $this->belongsToMany(LotteryGameMatch::class, 'lottery_game_match_users')->using(UserMatch::class)->withTimestamps();
    }

    public function win_matches()
    {
        return $this->belongsToMany(LotteryGameMatch::class, 'lottery_game_match_users')->where('winner_id', $this->id);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
