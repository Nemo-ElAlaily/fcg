<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'avatar_path',
    ];

    public function getFullNameAttribute()
    {
        return ucfirst($this -> first_name) . ' ' . ucfirst($this -> last_name);

    } // end of full name

    public function getAvatarPathAttribute()
    {
        if(substr( $this -> avatar, 0, 2 ) === "//"){
            return $this -> avatar;
        } else {
            return asset('uploads/users/' . $this -> avatar );
        } // end of if
    } // end of image path
}
