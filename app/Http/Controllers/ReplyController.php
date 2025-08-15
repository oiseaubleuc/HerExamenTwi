<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request, Tweet $tweet) {
        $data = $request->validate(['body' => ['required','string','max:280']]);
        $tweet->replies()->create($data + ['user_id' => $request->user()->id]);
        return back();
    }
}
