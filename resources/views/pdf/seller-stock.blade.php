@extends('pdf.layout')

@section('content')
{{-- SRS-12: Laporan Daftar Stock Produk (Diurutkan Menurun) --}}

<div class="info-box">
    <p><strong>Jenis Laporan:</strong> Daftar Stock Produk (SRS-MartPlace-12)</p>
    <p><strong>Nama Toko:</strong> {{ $seller->nama_toko }}</p>
    <p><strong>Total Produk:</strong> {{ $products->count() }}</p>
    <p><strong>Total Stock:</strong> {{ $products->sum('stock') }} unit</p>
    <p><strong>Urutan:</strong> Stock tertinggi ke terendah</p>
</div>

<table>
    <thead>
        <tr>
            <th style="width:5%">No</th>
            <th style="width:35%">Nama Produk</th>
            <th style="width:15%">Kategori</th>
            <th style="width:20%">Harga</th>
            <th style="width:15%">Stock</th>
            <th style="width:10%">Rating</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $index => $product)
        <tr>
            <td class="text-center">{{ $index + 1 }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ ucfirst(str_replace('-', ' ', $product->category_slug)) }}</td>
            <td class="text-right">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
            <td class="text-center">
                @if($product->stock < 2)
                    <span class="badge badge-danger">{{ $product->stock }}</span>
                @elseif($product->stock < 10)
                    <span class="badge badge-warning">{{ $product->stock }}</span>
                @else
                    <span class="badge badge-success">{{ $product->stock }}</span>
                @endif
            </td>
            <td class="text-center">
                @if($product->avg_rating > 0)
                    {{ number_format($product->avg_rating, 1) }} ★
                @else
                    -
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">Tidak ada data</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
