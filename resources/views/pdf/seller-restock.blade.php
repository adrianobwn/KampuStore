@extends('pdf.layout')

@section('content')
{{-- SRS-14: Laporan Daftar Stock Barang yang Harus Segera Dipesan (stock < 2) --}}

<div class="info-box">
    <p><strong>Jenis Laporan:</strong> Daftar Produk Segera Dipesan / Restock (SRS-MartPlace-14)</p>
    <p><strong>Nama Toko:</strong> {{ $seller->nama_toko }}</p>
    <p><strong>Kriteria:</strong> Stock &lt; {{ $threshold }}</p>
    <p><strong>Total Produk Perlu Restock:</strong> {{ $products->count() }}</p>
</div>

@if($products->count() > 0)
<div style="background:#fef2f2;border:1px solid #fecaca;padding:10px 15px;border-radius:6px;margin-bottom:15px;">
    <p style="margin:0;color:#991b1b;font-weight:600;">
        ⚠️ PERHATIAN: {{ $products->count() }} produk membutuhkan restock segera!
    </p>
</div>
@endif

<table>
    <thead>
        <tr>
            <th style="width:5%">No</th>
            <th style="width:35%">Nama Produk</th>
            <th style="width:15%">Kategori</th>
            <th style="width:20%">Harga</th>
            <th style="width:15%">Stock Saat Ini</th>
            <th style="width:10%">Status</th>
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
                <span class="badge badge-danger">{{ $product->stock }} unit</span>
            </td>
            <td class="text-center">
                @if($product->stock == 0)
                    <span class="badge badge-danger">HABIS</span>
                @else
                    <span class="badge badge-warning">SEGERA</span>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center" style="color:#166534;">
                ✓ Tidak ada produk yang memerlukan restock
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
