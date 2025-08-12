{{-- resources/views/tweets/_item.blade.php --}}
<article class="bg-white p-4 rounded shadow mb-3">
    <div class="flex justify-between">
        <div>
            <a href="{{ route('profile.show', $tweet->user->username) }}" class="font-semibold hover:underline">
                {{ $tweet->user->name }}
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
                <form method="POST" action="{{ route('likes.destroy',$tweet) }}">@csrf @method('DELETE')<button>♥ {{ $tweet->likes->count() }}</button></form>
            @else
                <form method="POST" action="{{ route('likes.store',$tweet) }}">@csrf<button>♡ {{ $tweet->likes->count() }}</button></form>
            @endif
        @else
            <span>♡ {{ $tweet->likes->count() }}</span>
        @endauth
    </div>

    {{-- Replies --}}
    <div class="mt-4 space-y-3">
        @foreach($tweet->replies as $reply)
            <div class="pl-3 border-l">
                <div class="text-sm"><strong>{{ $reply->user->name }}</strong> · {{ $reply->created_at->diffForHumans() }}</div>
                <div>{{ $reply->body }}</div>
            </div>
        @endforeach

        @auth
            <form method="POST" action="{{ route('replies.store', $tweet) }}" class="flex gap-2">
                @csrf
                <input name="body" class="flex-1 border rounded p-2" placeholder="Reply…" maxlength="280">
                <button class="px-3 py-2 rounded bg-gray-900 text-white">Send</button>
            </form>
        @endauth
    </div>
</article>
