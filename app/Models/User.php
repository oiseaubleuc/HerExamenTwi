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
    use HasFactory,  Notifiable;
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'avatar_path',
    ];
    public function getRouteKeyName(): string
    {
        return 'username';
    }


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

    public function retweets()
    {
        return $this->belongsToMany(Tweet::class, 'retweets', 'user_id', 'tweet_id')->withTimestamps();
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

    public function isFollowedBy(User $user): bool
    {
        return $this->followers()->where('follower_id', $user->id)->exists();
    }

    public function isFollowing(User $user): bool
    {
        return $this->following()->where('followed_id', $user->id)->exists();
    }
}
