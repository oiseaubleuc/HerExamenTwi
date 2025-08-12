<?php


namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function index()
    {
        $tweets = Tweet::with(['user', 'likes'])->latest()->paginate(20);
        return view('tweets.index', compact('tweets'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'body' => 'required|string|max:280'
        ]);

        Tweet::create([
            'body'    => $data['body'],
            'user_id' => $request->user()->id,
        ]);

        return back();
    }

    public function destroy(Tweet $tweet)
    {
        abort_unless(auth()->id() === $tweet->user_id, 403);
        $tweet->delete();
        return back();
    }
}
