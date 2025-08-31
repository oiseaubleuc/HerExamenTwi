@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Create Tweet Section -->
        @auth
            <div class="bg-dark-bg-900 border border-dark-bg-800 rounded-2xl p-6 shadow-xl mb-8">
                <h3 class="text-lg font-semibold text-white mb-4">Wat gebeurt er?</h3>
                <form method="POST" action="{{ route('tweets.store') }}" class="space-y-4">
                    @csrf
                    <textarea name="body" rows="4" maxlength="280"
                              class="w-full bg-dark-bg-800 text-white outline-none border border-dark-bg-700 rounded-xl p-4 placeholder-dark-bg-400 focus:border-dark-green-500 focus:ring-2 focus:ring-dark-green-500 transition-all duration-200 resize-none"
                              placeholder="Deel je gedachten met de wereld..." required>{{ old('body') }}</textarea>
                    @error('body')
                    <p class="text-red-400 text-sm">{{ $message }}</p>
                    @enderror
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-dark-bg-400">280 karakters over</span>
                        <button class="px-6 py-3 bg-dark-green-600 hover:bg-dark-green-700 text-white rounded-xl font-semibold transition-all duration-200 hover:shadow-lg transform hover:-translate-y-0.5">
                            Tweet
                        </button>
                    </div>
                </form>
            </div>
        @else
            <div class="bg-dark-bg-900 border border-dark-bg-800 rounded-2xl p-6 shadow-xl text-center mb-8">
                <p class="text-dark-bg-300 mb-4">Doe mee met het gesprek!</p>
                <a class="inline-flex items-center px-6 py-3 bg-dark-green-600 hover:bg-dark-green-700 text-white rounded-xl font-semibold transition-all duration-200 hover:shadow-lg transform hover:-translate-y-0.5" href="{{ route('login') }}">
                    Log in om een tweet te plaatsen
                </a>
            </div>
        @endauth

        <!-- Tweets Feed -->
        <div class="space-y-6">
            @forelse($tweets as $tweet)
                @include('tweets.item', ['tweet' => $tweet])
            @empty
                <div class="bg-dark-bg-900 border border-dark-bg-800 rounded-2xl p-8 shadow-xl text-center">
                    <div class="text-dark-bg-400 mb-4">
                        <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        <p class="text-lg font-medium">Nog geen tweets</p>
                        <p class="text-sm">Wees de eerste om iets te delen!</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-8">
            {{ $tweets->links() }}
        </div>
    </div>
@endsection
