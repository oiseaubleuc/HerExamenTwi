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
            <div class="bg-white p-6 rounded-xl shadow-sm text-center">
                <h2 class="text-xl font-semibold mb-4">Join the conversation!</h2>
                <div class="space-x-4">
                    <a href="{{ route('login') }}" 
                       class="inline-block px-6 py-2 bg-blue-500 text-white font-medium rounded-full hover:bg-blue-600 transition-colors">
                        Log in
                    </a>
                    <a href="{{ route('register') }}" 
                       class="inline-block px-6 py-2 bg-white text-blue-500 font-medium rounded-full border border-blue-500 hover:bg-blue-50 transition-colors">
                        Sign up
                    </a>
                </div>
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
