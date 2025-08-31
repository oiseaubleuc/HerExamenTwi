<article class="bg-dark-bg-900 border border-dark-bg-800 p-4 rounded-xl shadow-lg mb-3">
    <div class="flex justify-between items-start">
        <div class="min-w-0">
            <a href="{{ route('profile.show', $tweet->user->username) }}"
               class="font-semibold hover:underline truncate text-dark-green-400 hover:text-dark-green-300 transition-colors">
                {{ $tweet->user->name }}
            </a>
            <span class="text-dark-bg-400 text-sm">· {{ $tweet->created_at->diffForHumans() }}</span>
        </div>

        @if(auth()->id() === $tweet->user_id)
            <form method="POST" action="{{ route('tweets.destroy', $tweet) }}">
                @csrf @method('DELETE')
                <button class="text-red-400 text-xs hover:text-red-300 transition-colors">Delete</button>
            </form>
        @endif
    </div>

    <p class="mt-2 whitespace-pre-line break-words text-white">{{ $tweet->body }}</p>

    <div class="mt-3 text-sm flex items-center gap-5">
        @auth
            @if($tweet->liked_by_auth)
                <form method="POST" action="{{ route('likes.destroy', $tweet) }}">
                    @csrf @method('DELETE')
                    <button class="flex items-center gap-1 text-red-400 hover:text-red-300 transition-colors" aria-pressed="true" title="Unlike">
                        <span>♥</span><span>{{ $tweet->likes_count }}</span>
                    </button>
                </form>
            @else
                <form method="POST" action="{{ route('likes.store', $tweet) }}">
                    @csrf
                    <button class="flex items-center gap-1 text-dark-bg-400 hover:text-dark-green-400 transition-colors" aria-pressed="false" title="Like">
                        <span>♡</span><span>{{ $tweet->likes_count }}</span>
                    </button>
                </form>
            @endif
        @else
            <span class="flex items-center gap-1 text-dark-bg-400"><span>♡</span><span>{{ $tweet->likes_count }}</span></span>
        @endauth

        <span class="text-dark-bg-400">{{ $tweet->replies_count }} replies</span>
    </div>

    {{-- Replies --}}
    <div class="mt-4 space-y-3">
        @foreach($tweet->replies as $reply)
            <div class="pl-3 border-l border-dark-bg-700">
                <div class="text-sm">
                    <strong class="text-dark-green-400">{{ $reply->user->name }}</strong>
                    <span class="text-dark-bg-400">· {{ $reply->created_at->diffForHumans() }}</span>
                </div>
                <div class="break-words text-white">{{ $reply->body }}</div>
            </div>
        @endforeach

        @auth
            <form method="POST" action="{{ route('replies.store', $tweet) }}" class="flex gap-2">
                @csrf
                <input name="body" class="flex-1 bg-dark-bg-800 text-white border border-dark-bg-700 rounded-lg px-3 py-2 placeholder-dark-bg-400 focus:border-dark-green-500 focus:ring-1 focus:ring-dark-green-500 transition-colors"
                       placeholder="Reply…" maxlength="280" required>
                <button class="px-3 py-2 rounded-lg bg-dark-green-600 hover:bg-dark-green-700 text-white transition-colors">Send</button>
            </form>
        @endauth
    </div>
</article>
