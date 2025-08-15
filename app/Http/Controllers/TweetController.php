<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->id();

        $tweets = Tweet::query()
            ->with('user')
            ->withCount(['likes','replies'])
            ->withExists([
                'likes as liked_by_auth' => fn($q) => $q->where('user_id', $userId),
            ])
            ->latest()
            ->paginate(20);

        return view('tweets.index', compact('tweets'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'body' => ['required','string','max:280'],
        ]);

        $request->user()->tweets()->create($data);

        return back()->with('status', 'tweeted');
    }

    public function destroy(Tweet $tweet)
    {
        abort_unless($tweet->user_id === auth()->id(), 403);
        $tweet->delete();

        return back()->with('status', 'deleted');
    }
}
