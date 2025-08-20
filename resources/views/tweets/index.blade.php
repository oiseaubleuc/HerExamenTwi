@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto p-4 space-y-4">

        @auth
            <form method="POST" action="{{ route('tweets.store') }}" class="bg-white dark:bg-neutral-900 p-4 rounded-xl shadow">
                @csrf
                <textarea name="body" rows="3" maxlength="280"
                          class="w-full bg-transparent outline-none border rounded p-2"
                          placeholder="What's happening?" required>{{ old('body') }}</textarea>
                @error('body')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
                <div class="text-right mt-2">
                    <button class="px-4 py-2 bg-blue-600 text-white rounded">Tweet</button>
                </div>
            </form>
        @else
            <div class="bg-white dark:bg-neutral-900 p-4 rounded-xl shadow text-center text-sm">
                <a class="text-blue-600 underline" href="{{ route('login') }}">Log in</a> to post a tweet with things
            </div>
        @endauth

        @forelse($tweets as $tweet)
            @include('tweets.item', ['tweet' => $tweet])
        @empty
            <div class="bg-white dark:bg-neutral-900 p-4 rounded-xl shadow text-center text-gray-500">
                No tweets yet.
            </div>
        @endforelse

        <div>{{ $tweets->links() }}</div>
    </div>
@endsection
