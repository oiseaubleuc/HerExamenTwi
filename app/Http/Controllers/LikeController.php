<?php

namespace App\Http\Controllers;

use App\Models\Tweet;

class LikeController extends Controller
{
    public function store(Tweet $tweet)
    {
        $tweet->likes()->firstOrCreate(['user_id' => auth()->id()]);
        return back();
    }

    public function destroy(Tweet $tweet)
    {
        $tweet->likes()->where('user_id', auth()->id())->delete();
        return back();
    }
}
