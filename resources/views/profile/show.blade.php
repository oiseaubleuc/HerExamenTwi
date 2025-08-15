@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto">

        {{-- Banner --}}
        <div class="h-40 bg-gray-200 relative rounded-b">
            @if($user->banner_path)
                <img src="{{ asset($user->banner_path) }}" alt="" class="h-40 w-full object-cover rounded-b">
            @endif
        </div>

        {{-- Avatar + Edit/Follow --}}
        <div class="px-4 relative">
            <div class="flex justify-between items-end -mt-10">
                <div class="flex items-end gap-4">
                    <div class="h-24 w-24 rounded-full ring-4 ring-white overflow-hidden bg-gray-300">
                        @if($user->avatar_path)
                            <img src="{{ asset($user->avatar_path) }}" alt="" class="h-full w-full object-cover">
                        @endif
                    </div>
                    <div class="pb-2">
                        <div class="text-2xl font-bold">{{ '@' . $user->username }}</div>
                        <div class="text-gray-600">{{ $user->name }}</div>
                    </div>
                </div>

                @auth
                    @if(auth()->id() === $user->id)
                        <a href="{{ route('profile.edit') }}"
                           class="px-4 py-2 rounded-full border bg-white text-sm">Edit profile</a>
                    @else
                        {{-- Volgen/ontvolgen knop kun je later koppelen --}}
                        <form method="POST" action="{{ route('users.follow', $user) }}">
                            @csrf
                            <button class="px-4 py-2 rounded-full bg-black text-white text-sm">Follow</button>
                        </form>
                    @endif
                @endauth
            </div>

            {{-- Bio + joined + counts --}}
            <div class="mt-4 space-y-2">
                @if($user->bio)
                    <p class="whitespace-pre-line">{{ $user->bio }}</p>
                @endif
                <div class="text-gray-600 text-sm flex items-center gap-4">
                    <span>Joined {{ optional($user->created_at)->format('F Y') ?? '—' }}</span>
                    <span><strong>{{ $user->following_count }}</strong> Following</span>
                    <span><strong>{{ $user->followers_count }}</strong> Followers</span>


                </div>
            </div>

            {{-- Tabs --}}
            @php
                $active = $tab;
                $tabs = [
                    'tweets'  => 'Tweets',
                    'replies' => 'Tweets & replies',
                    'media'   => 'Media',
                    'likes'   => 'Likes',
                ];
            @endphp
            <nav class="mt-4 border-b flex gap-6 text-sm">
                @foreach($tabs as $key => $label)
                    <a href="{{ route('profile.show', ['username' => $user->username, 'tab' => $key]) }}"
                       class="pb-3 -mb-px {{ $active === $key ? 'border-b-2 border-black font-semibold' : 'text-gray-500 hover:text-black' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </nav>
        </div>

        {{-- Content --}}
        <div class="px-4 mt-4 space-y-4">
            @if($tab === 'replies')
                @forelse($replies as $reply)
                    @include('profile._reply_item', ['reply' => $reply])
                @empty
                    <div class="bg-white p-4 rounded-xl shadow text-center text-gray-500">No replies.</div>
                @endforelse
                {{ $replies->links() }}
            @else
                @forelse($tweets as $tweet)
                    @include('tweets.item', ['tweet' => $tweet])
                @empty
                    <div class="bg-white p-4 rounded-xl shadow text-center text-gray-500">Nothing here yet.</div>
                @endforelse
                {{ $tweets->links() }}
            @endif
        </div>
    </div>
@endsection
