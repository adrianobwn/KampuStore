<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'KampuStore' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.4/dist/tailwind.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .star { color: #fbbf24; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900">
    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="{{ route('products.index') }}" class="font-semibold text-lg">KampuStore</a>
            <div class="flex items-center gap-4">
                @auth
                    <span class="text-sm text-gray-600">Halo, {{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-sm text-red-600 hover:underline">Logout</button>
                    </form>
                @else
                    <a class="text-sm text-blue-600 hover:underline" href="{{ route('login') }}">Login</a>
                    <a class="text-sm text-blue-600 hover:underline" href="{{ route('register') }}">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        @if (session('status'))
            <div class="mb-4 p-3 rounded bg-green-50 text-green-800 border border-green-200">{{ session('status') }}</div>
        @endif
        @yield('content')
    </main>

    <footer class="border-t border-gray-200 py-4 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} KampuStore
    </footer>
</body>
</html>

