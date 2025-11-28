@extends('pdf.layout')

@section('content')
{{-- SRS-11: Laporan Daftar Produk dan Rating (Diurutkan Menurun) --}}

<div class="info-box">
    <p><strong>Jenis Laporan:</strong> Peringkat Produk Berdasarkan Rating (SRS-MartPlace-11)</p>
    <p><strong>Total Produk:</strong> {{ $products->count() }}</p>
    @if($category)
    <p><strong>Kategori:</strong> {{ ucfirst(str_replace('-', ' ', $category)) }}</p>
    @endif
    <p><strong>Urutan:</strong> Rating tertinggi ke terendah</p>
</div>

<table>
    <thead>
        <tr>
            <th style="width:5%">No</th>
            <th style="width:25%">Nama Produk</th>
            <th style="width:15%">Nama Toko</th>
            <th style="width:12%">Kategori</th>
            <th style="width:13%">Harga</th>
            <th style="width:15%">Lokasi Provinsi</th>
            <th style="width:10%">Rating</th>
            <th style="width:5%">Review</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $index => $product)
        <tr>
            <td class="text-center">{{ $index + 1 }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->nama_toko ?? $product->seller_name ?? '-' }}</td>
            <td>{{ ucfirst(str_replace('-', ' ', $product->category_slug)) }}</td>
            <td class="text-right">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
            <td>{{ $product->seller_province ?? '-' }}</td>
            <td class="text-center">
                @if($product->avg_rating > 0)
                    <span class="badge badge-success">{{ number_format($product->avg_rating, 1) }} ★</span>
                @else
                    <span class="badge badge-info">-</span>
                @endif
            </td>
            <td class="text-center">{{ $product->review_count ?? 0 }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="8" class="text-center">Tidak ada data</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
