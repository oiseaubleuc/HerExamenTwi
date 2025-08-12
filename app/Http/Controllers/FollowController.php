<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function toggle(User $user)
    {
        abort_if($user->id === auth()->id(), 403);

        $me = auth()->user();
        $me->following()->toggle($user->id);

        return back();
    }
}
