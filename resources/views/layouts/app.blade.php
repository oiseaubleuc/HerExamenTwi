<!doctype html>
<html lang="en" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mini Twitter</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-dark-bg-950 text-white min-h-screen">
    <!-- Top Navigation Bar -->
    <nav class="bg-dark-bg-900 border-b border-dark-bg-800 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo and Brand -->
                <div class="flex items-center">
                    <a href="{{ route('tweets.index') }}" class="flex items-center space-x-3">
                        <x-application-logo class="w-8 h-8 fill-current text-dark-green-400" />
                        <span class="text-xl font-bold text-dark-green-400">Mini Twitter</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('tweets.index') }}" class="text-dark-bg-300 hover:text-white transition-colors px-3 py-2 rounded-md text-sm font-medium">
                        Home
                    </a>
                </div>

                <!-- User Menu -->
                <div class="flex items-center space-x-4">
                    @auth
                        <div class="flex items-center space-x-3">
                            <span class="text-dark-bg-300 text-sm">{{ auth()->user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="px-4 py-2 bg-dark-green-600 hover:bg-dark-green-700 text-white rounded-lg transition-all duration-200 hover:shadow-lg transform hover:-translate-y-0.5">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="flex items-center space-x-3">
                            <a class="px-4 py-2 text-dark-green-400 hover:text-dark-green-300 transition-colors" href="{{ route('login') }}">Login</a>
                            <a class="px-4 py-2 bg-dark-green-600 hover:bg-dark-green-700 text-white rounded-lg transition-all duration-200 hover:shadow-lg transform hover:-translate-y-0.5" href="{{ route('register') }}">Register</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark-bg-900 border-t border-dark-bg-800 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center space-x-3 mb-4 md:mb-0">
                    <x-application-logo class="w-6 h-6 fill-current text-dark-green-400" />
                    <span class="text-dark-green-400 font-medium">Mini Twitter</span>
                </div>
                <div class="text-dark-bg-400 text-sm">
                    © {{ date('Y') }} Mini Twitter. All rights reserved.
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
