@extends('layouts.guest')

@section('content')
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-white mb-2">Maak je account aan</h2>
        <p class="text-dark-bg-300">Registreer je om de Twitter clone functionaliteiten te testen</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-white mb-2">Volledige naam</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                class="w-full px-4 py-3 bg-dark-bg-800 border border-dark-bg-700 rounded-lg text-white placeholder-dark-bg-400 focus:outline-none focus:ring-2 focus:ring-dark-green-500 focus:border-dark-green-500 transition-all duration-200"
                placeholder="Voer je volledige naam in">
            @error('name')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="username" class="block text-sm font-medium text-white mb-2">Gebruikersnaam</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-dark-bg-400 text-lg">@</span>
                <input type="text" name="username" id="username" value="{{ old('username') }}" required
                    class="w-full pl-10 px-4 py-3 bg-dark-bg-800 border border-dark-bg-700 rounded-lg text-white placeholder-dark-bg-400 focus:outline-none focus:ring-2 focus:ring-dark-green-500 focus:border-dark-green-500 transition-all duration-200"
                    placeholder="Kies een gebruikersnaam">
            </div>
            @error('username')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

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
                placeholder="Maak een sterk wachtwoord aan">
            @error('password')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-white mb-2">Bevestig wachtwoord</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required
                class="w-full px-4 py-3 bg-dark-bg-800 border border-dark-bg-700 rounded-lg text-white placeholder-dark-bg-400 focus:outline-none focus:ring-2 focus:ring-dark-green-500 focus:border-dark-green-500 transition-all duration-200"
                placeholder="Bevestig je wachtwoord">
        </div>

        <button type="submit"
            class="w-full py-3 px-4 bg-dark-green-600 hover:bg-dark-green-700 text-white rounded-lg font-semibold text-base transition-all duration-200 hover:shadow-lg transform hover:-translate-y-0.5">
            Account aanmaken
        </button>

        <div class="text-center text-sm text-dark-bg-300 pt-4 border-t border-dark-bg-700">
            Heb je al een account? 
            <a href="{{ route('login') }}" class="text-dark-green-400 hover:text-dark-green-300 font-medium transition-colors">
                Log hier in
            </a>
        </div>
    </form>
@endsection
