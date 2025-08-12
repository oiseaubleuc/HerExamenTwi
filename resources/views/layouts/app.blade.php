<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mini Twitter</title>
    <!-- Tailwind via CDN (no Vite) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
<div class="max-w-2xl mx-auto p-4">
    <nav class="mb-6 flex justify-between">
        <a href="{{ route('tweets.index') }}" class="font-bold">Mini Twitter</a>
        <div class="text-sm">
            @auth
                <span class="mr-3 text-gray-600">{{ auth()->user()->name }}</span>
                <form class="inline" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button>Logout</button>
                </form>
            @else
                <a class="mr-3" href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    </nav>

    <main>
        @yield('content')
    </main>
</div>
</body>
</html>
