<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class RetweetController extends Controller
{
    public function store(Tweet $tweet)
    {
        $user = auth()->user();
        $user->retweets()->toggle($tweet);

        return back()->with('status', 'Tweet ' . ($tweet->retweets()->where('user_id', $user->id)->exists() ? 'retweeted' : 'unretweeted'));
    }
}
