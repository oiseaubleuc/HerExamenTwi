@extends('layouts.guest')

@section('content')
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-white mb-2">Welkom bij Mini Twitter</h2>
        <p class="text-dark-bg-300">Log in op je account om de functionaliteiten te testen</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-white mb-2">Email adres</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                class="w-full px-4 py-3 bg-dark-bg-800 border border-dark-bg-700 rounded-lg text-white placeholder-dark-bg-400 focus:outline-none focus:ring-2 focus:ring-dark-green-500 focus:border-dark-green-500 transition-all duration-200"
                placeholder="Voer je email adres in">
            @error('email')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-white mb-2">Wachtwoord</label>
            <input type="password" name="password" id="password" required
                class="w-full px-4 py-3 bg-dark-bg-800 border border-dark-bg-700 rounded-lg text-white placeholder-dark-bg-400 focus:outline-none focus:ring-2 focus:ring-dark-green-500 focus:border-dark-green-500 transition-all duration-200"
                placeholder="Voer je wachtwoord in">
            @error('password')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember"
                    class="h-4 w-4 bg-dark-bg-800 border-dark-bg-700 rounded text-dark-green-500 focus:ring-dark-green-500 focus:ring-offset-dark-bg-900">
                <label for="remember" class="ml-3 text-sm text-white">Onthoud mij</label>
            </div>
            <a href="{{ route('password.request') }}" class="text-sm text-dark-green-400 hover:text-dark-green-300 transition-colors">
                Wachtwoord vergeten?
            </a>
        </div>

        <button type="submit"
            class="w-full py-3 px-4 bg-dark-green-600 hover:bg-dark-green-700 text-white rounded-lg font-semibold text-base transition-all duration-200 hover:shadow-lg transform hover:-translate-y-0.5">
            Inloggen
        </button>

        <div class="text-center text-sm text-dark-bg-300 pt-4 border-t border-dark-bg-700">
            Heb je nog geen account? 
            <a href="{{ route('register') }}" class="text-dark-green-400 hover:text-dark-green-300 font-medium transition-colors">
                Registreer hier
            </a>
        </div>
    </form>
@endsection
