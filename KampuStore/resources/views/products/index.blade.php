@php($title = 'Katalog Produk')
@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-4">
    <h1 class="text-2xl font-semibold">Katalog Produk</h1>
    <form class="flex items-center gap-2" method="GET" action="{{ route('products.index') }}">
        <input type="text" name="q" value="{{ $q }}" placeholder="Cari produk..." class="border rounded px-3 py-2">
        <button class="bg-gray-800 text-white px-4 py-2 rounded">Cari</button>
    </form>
  </div>

@if ($products->count() === 0)
    <p>Tidak ada produk.</p>
@else
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($products as $p)
            <a href="{{ route('products.show', $p) }}" class="bg-white rounded-lg shadow hover:shadow-md transition overflow-hidden">
                <img src="{{ $p->image_url ?? 'https://via.placeholder.com/600x400?text=Produk' }}" alt="{{ $p->name }}" class="w-full h-40 object-cover">
                <div class="p-4">
                    <h2 class="font-semibold line-clamp-2">{{ $p->name }}</h2>
                    <p class="text-blue-700 font-bold mt-1">Rp {{ number_format($p->price, 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-600">Stok: {{ $p->stock }}</p>
                    @php($avg = $p->averageRating())
                    @php($count = $p->reviewsCount())
                    <div class="mt-2 flex items-center gap-2 text-sm">
                        <span>
                            @for ($i=1; $i<=5; $i++)
                                <span class="star">{{ $i <= floor($avg) ? '★' : '☆' }}</span>
                            @endfor
                        </span>
                        <span class="text-gray-600">({{ $count }})</span>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    <div class="mt-6">{{ $products->withQueryString()->links() }}</div>
@endif
@endsection

