<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Tweet;
use App\Models\Reply;



class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }



    public function show(User $user, \Illuminate\Http\Request $request)
    {
        $tab = $request->query('tab', 'tweets');
        $uid = auth()->id();

        $user->loadCount(['followers','following']);

        $baseTweets = Tweet::where('user_id', $user->id)
            ->with(['user','replies.user'])
            ->withCount(['likes','replies'])
            ->latest();

        if ($uid) {
            $baseTweets->withExists(['likes as liked_by_auth' => fn($q) => $q->where('user_id',$uid)]);
        }

        $tweets = null; $replies = null;
        switch ($tab) {
            case 'media':
                $tweets = (clone $baseTweets)->whereNotNull('media_path')->paginate(20);
                break;
            case 'likes':
                $tweets = Tweet::whereHas('likes', fn($q) => $q->where('users.id',$user->id))
                    ->with(['user','replies.user'])->withCount(['likes','replies'])->latest();
                if ($uid) $tweets->withExists(['likes as liked_by_auth' => fn($q)=>$q->where('user_id',$uid)]);
                $tweets = $tweets->paginate(20);
                break;
            case 'replies':
                $replies = Reply::where('user_id',$user->id)->with(['user','tweet.user'])->latest()->paginate(20);
                break;
            default:
                $tweets = $baseTweets->paginate(20);
        }

        return view('profile.show', compact('user','tab','tweets','replies'));
    }

    public function me()
    {
        $u = auth()->user();
        abort_unless($u && $u->username, 404, 'Set your username first.');
        return redirect()->route('profile.show', $u->username);
    }

}
