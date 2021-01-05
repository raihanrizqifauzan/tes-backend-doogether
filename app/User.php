<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Session;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    protected $table = 'user';
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password'
    ];

    public function session() {
        return $this->hasMany(Session::class, 'ID', 'userID');
    }

    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
        
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
