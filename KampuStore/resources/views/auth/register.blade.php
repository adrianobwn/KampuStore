@php($title = 'Register')
@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow">
    <h1 class="text-xl font-semibold mb-4">Daftar</h1>
    <form method="POST" action="{{ route('register.perform') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium">Nama</label>
            <input type="text" name="name" value="{{ old('name') }}" class="mt-1 w-full border rounded px-3 py-2" required>
            @error('name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
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
        <div>
            <label class="block text-sm font-medium">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="mt-1 w-full border rounded px-3 py-2" required>
        </div>
        <div class="flex items-center justify-between">
            <span class="text-sm text-gray-600">Sudah punya akun?</span>
            <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:underline">Login</a>
        </div>
        <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Daftar</button>
    </form>
    <p class="text-xs text-gray-500 mt-3">Dengan mendaftar, Anda setuju pada kebijakan kami.</p>
    @endsection

