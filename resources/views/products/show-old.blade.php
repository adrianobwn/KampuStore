@php($title = $product->name)
@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <div>
        <img src="{{ $product->image_url ?? 'https://via.placeholder.com/800x600?text=Produk' }}" alt="{{ $product->name }}" class="w-full rounded-lg shadow">
    </div>
    <div>
        <h1 class="text-2xl font-semibold">{{ $product->name }}</h1>
        <div class="mt-2 flex items-center gap-3">
            <div>
                @for ($i=1; $i<=5; $i++)
                    <span class="star text-xl">{{ $i <= floor($avg) ? '★' : '☆' }}</span>
                @endfor
            </div>
            <div class="text-gray-600 text-sm">{{ $avg }} dari 5 ({{ $count }} ulasan)</div>
        </div>
        <div class="mt-3 text-3xl font-bold text-blue-700">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
        <div class="mt-1 text-sm text-gray-600">Stok: {{ $product->stock }}</div>

        <div class="mt-4 space-y-2">
            <h2 class="font-semibold">Deskripsi</h2>
            <p class="text-gray-800">{!! nl2br(e($product->description)) !!}</p>
        </div>

        <div class="mt-6">
            <a href="#review-form" class="bg-emerald-600 text-white px-4 py-2 rounded hover:bg-emerald-700">Tulis Ulasan</a>
        </div>
    </div>
</div>

<div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-8">
    <div class="md:col-span-2">
        <h3 class="text-xl font-semibold mb-4">Ulasan Pembeli</h3>
        @forelse ($product->reviews as $r)
            <div class="bg-white p-4 rounded-lg shadow mb-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="font-medium">{{ $r->user ? $r->user->name : $r->guest_name }}</div>
                        <div class="text-sm text-gray-500">{{ $r->created_at->diffForHumans() }}</div>
                    </div>
                    <div>
                        @for ($i=1; $i<=5; $i++)
                            <span class="star">{{ $i <= $r->rating ? '★' : '☆' }}</span>
                        @endfor
                    </div>
                </div>
                <p class="mt-2">{!! nl2br(e($r->body)) !!}</p>
            </div>
        @empty
            <p class="text-gray-600">Belum ada ulasan untuk produk ini.</p>
        @endforelse
    </div>
    <div>
        <div id="review-form" class="bg-white p-4 rounded-lg shadow">
            <h4 class="font-semibold mb-3">Tulis Ulasan</h4>
            <form method="POST" action="{{ route('reviews.store', $product) }}" class="space-y-3">
                @csrf
                @guest
                <div>
                    <label class="block text-sm font-medium">Nama</label>
                    <input type="text" name="guest_name" value="{{ old('guest_name') }}" class="mt-1 border rounded px-3 py-2 w-full" placeholder="Nama Anda" required>
                    @error('guest_name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium">Nomor HP</label>
                    <input type="text" name="guest_phone" value="{{ old('guest_phone') }}" class="mt-1 border rounded px-3 py-2 w-full" placeholder="08xxxxxxxxxx" required>
                    @error('guest_phone')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium">Email</label>
                    <input type="email" name="guest_email" value="{{ old('guest_email') }}" class="mt-1 border rounded px-3 py-2 w-full" placeholder="email@example.com" required>
                    @error('guest_email')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
                @endguest
                <div>
                    <label class="block text-sm font-medium">Rating</label>
                    <select name="rating" class="mt-1 border rounded px-3 py-2 w-full" required>
                        @for ($i=5; $i>=1; $i--)
                            <option value="{{ $i }}">{{ $i }} - {{ str_repeat('★', $i) }}</option>
                        @endfor
                    </select>
                    @error('rating')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium">Ulasan</label>
                    <textarea name="body" rows="4" class="mt-1 border rounded px-3 py-2 w-full" placeholder="Bagikan pengalaman Anda" required>{{ old('body') }}</textarea>
                    @error('body')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
                <button class="bg-emerald-600 text-white w-full py-2 rounded hover:bg-emerald-700">Kirim Ulasan</button>
            </form>
        </div>
    </div>
</div>
@endsection

