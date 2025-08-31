<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css','resources/js/app.js'])

    </head>
    <body class="font-sans text-white antialiased">
        <div class="min-h-screen bg-dark-bg-950 flex">
            <!-- Left Side - Branding and Info -->
            <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-dark-green-900 to-dark-green-800 p-12 flex-col justify-center">
                <div class="max-w-lg">
                    <div class="mb-8">
                        <x-application-logo class="w-16 h-16 fill-current text-white mb-6" />
                        <h1 class="text-5xl font-bold text-white mb-4">Mini Twitter</h1>
                        <p class="text-xl text-dark-green-100 leading-relaxed">
                            Een Twitter clone gebouwd met Laravel voor mijn schoolproject. Ontdek de functionaliteiten van een moderne social media applicatie.
                        </p>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-dark-green-400 rounded-full"></div>
                            <span class="text-dark-green-100">Real-time tweets en notificaties</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-dark-green-400 rounded-full"></div>
                            <span class="text-dark-green-100">Like en reply functionaliteit</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-dark-green-400 rounded-full"></div>
                            <span class="text-dark-green-100">User authentication en profielen</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="w-full lg:w-1/2 flex items-center justify-center p-8 lg:p-16">
                <div class="w-full max-w-md">
                    <!-- Mobile Logo (only visible on small screens) -->
                    <div class="lg:hidden text-center mb-8">
                        <x-application-logo class="w-16 h-16 fill-current text-dark-green-400 mx-auto mb-4" />
                        <h1 class="text-3xl font-bold text-dark-green-400">Mini Twitter</h1>
                    </div>

                    <div class="bg-dark-bg-900 border border-dark-bg-800 rounded-2xl p-8 lg:p-10 shadow-2xl">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
