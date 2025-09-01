<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany};

class Tweet extends Model
{
    protected $fillable = ['user_id', 'body', 'media_path', 'visibility'];

    public function retweets(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'retweets', 'tweet_id', 'user_id')->withTimestamps();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'likes', 'tweet_id', 'user_id')->withTimestamps();
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class);
    }

    public function scopeFeed($q, User $user)
    {
        return $q->whereIn('user_id', function ($s) use ($user) {
            $s->select('followed_id')->from('follows')->where('follower_id', $user->id);
        })->orWhere('user_id', $user->id)
            ->withCount(['likes', 'replies'])
            ->latest();
    }

    public function likedBy(User $user): bool
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }
}
