<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Tweet $tweet)
    {
        $tweet->likes()->toggle([Auth::id()]);
        return back();
    }

    public function destroy(Tweet $tweet)
    {
        $tweet->likes()->detach(Auth::id());
        return back();
    }
}
