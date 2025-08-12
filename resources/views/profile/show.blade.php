{{-- resources/views/profile/show.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="bg-white p-4 rounded shadow mb-4 flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold">{{ $user->name }}</h1>
            <p class="text-gray-500">@{{ $user->username }}</p>
            <p class="text-sm text-gray-600">
                {{ $user->followers_count }} Followers · {{ $user->following_count }} Following
            </p>
        </div>

        @auth
            @if(auth()->id() === $user->id)
                <a href="{{ route('me') }}" class="text-sm text-blue-600 underline">My profile</a>
            @endif
        @endauth
    </div>

    {{-- Tweet form only on YOUR own profile --}}
    @auth
        @if(auth()->id() === $user->id)
            <form method="POST" action="{{ route('tweets.store') }}" class="bg-white p-4 rounded shadow mb-4">
                @csrf
                <textarea name="body" rows="3" class="w-full border rounded p-2"
                          placeholder="What's happening?">{{ old('body') }}</textarea>
                @error('body')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                <div class="text-right mt-2">
                    <button class="px-4 py-2 bg-blue-600 text-white rounded">Tweet</button>
                </div>
            </form>
        @endif
    @endauth

    @forelse($tweets as $tweet)
        @include('tweets._item', ['tweet'=>$tweet])
    @empty
        <div class="bg-white p-4 rounded shadow text-center text-gray-500">No tweets yet.</div>
    @endforelse

    <div class="mt-4">{{ $tweets->links() }}</div>
@endsection
