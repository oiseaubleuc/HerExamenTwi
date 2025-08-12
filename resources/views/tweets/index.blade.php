@extends('layouts.app')

@section('content')
    @auth
        <form method="POST" action="{{ route('tweets.store') }}" class="bg-white p-4 rounded shadow mb-4">
            @csrf
            <textarea name="body" rows="3" class="w-full border rounded p-2" placeholder="What's happening?">{{ old('body') }}</textarea>
            @error('body')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            <div class="text-right mt-2">
                <button class="px-4 py-2 bg-blue-600 text-white rounded">Tweet</button>
            </div>
        </form>
    @else
        <div class="bg-white p-4 rounded shadow mb-4 text-center text-sm">
            <a class="text-blue-600 underline" href="{{ route('login') }}">Log in</a> to post a tweet.
        </div>
    @endauth

    @forelse($tweets as $tweet)
        <article class="bg-white p-4 rounded shadow mb-3">
            <div class="flex justify-between">
                <div>
                    <a href="{{ route('profile.show', ['username' => $tweet->user->username]) }}"
                       class="font-bold hover:underline">
                        {{ $tweet->user->username }}
                    </a>
                    <span class="text-gray-500 text-sm">· {{ $tweet->created_at->diffForHumans() }}</span>
                </div>
                @if(auth()->id() === $tweet->user_id)
                    <form method="POST" action="{{ route('tweets.destroy',$tweet) }}">
                        @csrf @method('DELETE')
                        <button class="text-red-600 text-sm">Delete</button>
                    </form>
                @endif
            </div>

            <p class="mt-2">{{ $tweet->body }}</p>

            <div class="mt-3 text-sm flex items-center gap-4">
                @auth
                    @if($tweet->likes->where('user_id',auth()->id())->count())
                        <form method="POST" action="{{ route('likes.destroy',$tweet) }}">
                            @csrf @method('DELETE')
                            <button>♥ {{ $tweet->likes->count() }}</button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('likes.store',$tweet) }}">
                            @csrf
                            <button>♡ {{ $tweet->likes->count() }}</button>
                        </form>
                    @endif
                @else
                    <span>♡ {{ $tweet->likes->count() }}</span>
                @endauth
            </div>
        </article>
    @empty
        <div class="bg-white p-4 rounded shadow text-center text-gray-500">No tweets yet.</div>
    @endforelse

    <div class="mt-4">{{ $tweets->links() }}</div>
@endsection
