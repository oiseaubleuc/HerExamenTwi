<article class="bg-white dark:bg-neutral-900 p-4 rounded-xl shadow mb-3">
    <div class="flex justify-between items-start">
        <div class="min-w-0">
            <a href="{{ route('profile.show', $tweet->user->username) }}"
               class="font-semibold hover:underline truncate">
                {{ $tweet->user->name }}
            </a>
            <span class="text-gray-500 text-sm">· {{ $tweet->created_at->diffForHumans() }}</span>
        </div>

        @if(auth()->id() === $tweet->user_id)
            <form method="POST" action="{{ route('tweets.destroy', $tweet) }}">
                @csrf @method('DELETE')
                <button class="text-red-600 text-xs hover:underline">Delete</button>
            </form>
        @endif
    </div>

    <p class="mt-2 whitespace-pre-line break-words">{{ $tweet->body }}</p>

    <div class="mt-3 text-sm flex items-center gap-5">
        @auth
            <form method="POST" action="{{ route('likes.toggle', $tweet) }}">
                @csrf
                <button class="flex items-center gap-1" title="{{ $tweet->liked_by_auth ? 'Unlike' : 'Like' }}">
                    <span>{!! $tweet->liked_by_auth ? '♥' : '♡' !!}</span>
                    <span>{{ $tweet->likes_count }}</span>
                </button>
            </form>
        @else
            <span class="flex items-center gap-1"><span>♡</span><span>{{ $tweet->likes_count }}</span></span>
        @endauth

        <span class="text-gray-500">{{ $tweet->replies_count }} replies</span>
    </div>

    {{-- Replies --}}
    <div class="mt-4 space-y-3">
        @foreach($tweet->replies as $reply)
            <div class="pl-3 border-l">
                <div class="text-sm">
                    <strong>{{ $reply->user->name }}</strong>
                    <span class="text-gray-500">· {{ $reply->created_at->diffForHumans() }}</span>
                </div>
                <div class="break-words">{{ $reply->body }}</div>
            </div>
        @endforeach

        @auth
            <form method="POST" action="{{ route('replies.store', $tweet) }}" class="flex gap-2">
                @csrf
                <input name="body" class="flex-1 border rounded px-3 py-2"
                       placeholder="Reply…" maxlength="280" required>
                <button class="px-3 py-2 rounded bg-gray-900 text-white">Send</button>
            </form>
        @endauth
    </div>
</article>
