<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// Import related models (outside the class!)
use App\Models\Tweet;
use App\Models\Like;
// use App\Models\Reply; // only if you want User->replies()

class User extends Authenticatable
{

    protected $fillable = [
        'name',
        'username', // keep if you have this column; remove if not using usernames
        'email',
        'password',
    ];
    public function getRouteKeyName(): string { return 'username'; }


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /* ---- Relationships ---- */

    // A user has many tweets
    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }

    // A user has many likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // Follow system (optional; requires 'follows' pivot)
    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'follower_id');
    }


}
