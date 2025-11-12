@php($title = 'Login')
@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow">
    <h1 class="text-xl font-semibold mb-4">Masuk</h1>
    <form method="POST" action="{{ route('login.perform') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="mt-1 w-full border rounded px-3 py-2" required>
            @error('email')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium">Password</label>
            <input type="password" name="password" class="mt-1 w-full border rounded px-3 py-2" required>
            @error('password')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="flex items-center justify-between">
            <label class="inline-flex items-center gap-2 text-sm">
                <input type="checkbox" name="remember" class="rounded"> Ingat saya
            </label>
            <a href="{{ route('register') }}" class="text-sm text-blue-600 hover:underline">Daftar</a>
        </div>
        <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Masuk</button>
    </form>
</div>
@endsection

