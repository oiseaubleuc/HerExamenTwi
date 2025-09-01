<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function toggle(User $user)
    {
        abort_if($user->id === Auth::id(), 403);

        $me = Auth::user();
        $me->following()->toggle($user->id);

        return back()->with('status', $me->following()->where('followed_id', $user->id)->exists() ? 'Followed user' : 'Unfollowed user');
    }
}
