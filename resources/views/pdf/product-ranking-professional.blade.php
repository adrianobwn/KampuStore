@extends('pdf.pro-layout')

@section('content')
{{-- Produk dengan rating tertinggi berdasarkan ulasan pembeli --}}
{{-- Format: No | Produk | Kategori | Harga | Rating | Nama Toko | Provinsi --}}
{{-- ***) provinsi diisikan provinsi asal toko penjual --}}
{{-- Urutan: berdasarkan rating secara menurun (descending) --}}

<h2 class="section-title" style="font-size: 14px; line-height: 1.5; text-transform: uppercase;">Produk dengan rating tertinggi berdasarkan ulasan pembeli</h2>

<div class="metadata-section">
    <div class="metadata-grid">
        <div class="metadata-item">
            <div class="metadata-label">Tanggal Dibuat</div>
            <div class="metadata-value">{{ $generatedDate->format('d-m-Y') }}</div>
        </div>
        <div class="metadata-item">
            <div class="metadata-label">Dibuat Oleh</div>
            <div class="metadata-value">{{ $user ?? 'Admin' }}</div>
        </div>
        <div class="metadata-item">
            <div class="metadata-label">Total Produk</div>
            <div class="metadata-value">{{ $products->count() }}</div>
        </div>
        <div class="metadata-item">
            <div class="metadata-label">Filter Kategori</div>
            <div class="metadata-value">{{ $category ? ucfirst(str_replace('-', ' ', $category)) : 'Semua' }}</div>
        </div>
    </div>
</div>

<table>
    <thead>
        <tr>
            <th style="width:5%">NO</th>
            <th style="width:22%">PRODUK</th>
            <th style="width:14%">KATEGORI</th>
            <th style="width:14%">HARGA</th>
            <th style="width:10%">RATING</th>
            <th style="width:18%">NAMA TOKO</th>
            <th style="width:17%">PROVINSI</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $index => $product)
        <tr>
            <td class="text-center">{{ $index + 1 }}</td>
            <td><strong>{{ $product->name }}</strong></td>
            <td>{{ ucfirst(str_replace('-', ' ', $product->category_slug ?? 'Uncategorized')) }}</td>
            <td class="text-right">Rp {{ number_format($product->price ?? 0, 0, ',', '.') }}</td>
            <td class="text-center">
                @if($product->avg_rating > 0)
                    {{ number_format($product->avg_rating, 1) }}
                @else
                    -
                @endif
            </td>
            <td>{{ $product->nama_toko ?? $product->seller_name ?? '-' }}</td>
            <td>{{ $product->seller_province ?? '-' }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="no-data">Tidak ada data produk tersedia</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="warning-box" style="background:#f0f9ff;border-color:#3b82f6;">
    <p style="color:#1e40af;"><strong>KETERANGAN:</strong></p>
    <p style="color:#1e40af;">***) Provinsi diisikan provinsi asal toko penjual</p>
    <p style="color:#1e40af;">***) Diurutkan berdasarkan rating secara menurun (descending)</p>
</div>
@endsection
