@extends('pdf.layout')

@section('content')
{{-- Laporan daftar stok produk yang diurutkan berdasarkan stok secara menurun --}}

<div class="srs-reference">
    <strong>Referensi Laporan:</strong> Daftar stok produk berdasarkan stok tertinggi
</div>

<div class="stats-row">
    <div class="stat-box">
        <div class="value">{{ $products->count() }}</div>
        <div class="label">Total Produk</div>
    </div>
    <div class="stat-box">
        <div class="value">{{ $products->sum('stock') }}</div>
        <div class="label">Total Stok</div>
    </div>
    <div class="stat-box">
        <div class="value">{{ $products->max('stock') }}</div>
        <div class="label">Stok Tertinggi</div>
    </div>
    <div class="stat-box">
        <div class="value">{{ $products->where('stock', '<', 2)->count() }}</div>
        <div class="label">Perlu Restock</div>
    </div>
</div>

<div class="info-box">
    <p><strong>Jenis Laporan:</strong> Daftar stok produk yang diurutkan berdasarkan stok secara menurun</p>
    <p><strong>Format:</strong> PDF</p>
    <p><strong>Nama Toko:</strong> {{ $seller->nama_toko }}</p>
    <p><strong>Urutan:</strong> Stok tertinggi ke terendah</p>
    <p><strong>Total Produk:</strong> {{ $products->count() }} jenis produk</p>
    <p><strong>Total Stok:</strong> {{ $products->sum('stock') }} unit</p>
    <p><strong>Kriteria:</strong> Setiap produk dilengkapi rating, kategori produk, dan harga</p>
</div>

<h3 style="margin-bottom: 15px; color: #f97316;">📦 Daftar Stok Produk (Urut Stok Tertinggi)</h3>
<table>
    <thead>
        <tr>
            <th style="width:5%">No</th>
            <th style="width:35%">Nama Produk</th>
            <th style="width:13%">Kategori Produk</th>
            <th style="width:15%">Harga</th>
            <th style="width:12%">Stok</th>
            <th style="width:10%">Rating</th>
            <th style="width:10%">Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $index => $product)
        <tr @if($product->stock >= 50) class="highlight-row" @endif>
            <td class="text-center">{{ $index + 1 }}</td>
            <td><strong>{{ $product->name }}</strong></td>
            <td>{{ ucfirst(str_replace('-', ' ', $product->category_slug)) }}</td>
            <td class="text-right">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
            <td class="text-center">
                @if($product->stock < 2)
                    <span class="badge badge-danger">{{ $product->stock }}</span>
                @elseif($product->stock < 10)
                    <span class="badge badge-warning">{{ $product->stock }}</span>
                @elseif($product->stock < 50)
                    <span class="badge badge-info">{{ $product->stock }}</span>
                @else
                    <span class="badge badge-success">{{ $product->stock }}</span>
                @endif
            </td>
            <td class="text-center">
                @if($product->avg_rating > 0)
                    <span class="badge badge-success">{{ number_format($product->avg_rating, 1) }} ★</span>
                @else
                    <span class="badge badge-info">-</span>
                @endif
            </td>
            <td class="text-center">
                @if($product->stock == 0)
                    <span class="badge badge-danger">HABIS</span>
                @elseif($product->stock < 2)
                    <span class="badge badge-warning">RESTOCK</span>
                @elseif($product->stock < 10)
                    <span class="badge badge-info">SEDANG</span>
                @else
                    <span class="badge badge-success">AMAN</span>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="no-data">Tidak ada data produk tersedia</td>
        </tr>
        @endforelse
    </tbody>
</table>

@if($products->count() > 0)
<div class="page-break"></div>

<div class="info-box">
    <p><strong>Ringkasan Stok:</strong></p>
    <p>• <strong>Produk Stok Tinggi (≥50 unit):</strong> {{ $products->where('stock', '>=', 50)->count() }} produk</p>
    <p>• <strong>Produk Stok Sedang (10-49 unit):</strong> {{ $products->whereBetween('stock', [10, 49])->count() }} produk</p>
    <p>• <strong>Produk Stok Rendah (2-9 unit):</strong> {{ $products->whereBetween('stock', [2, 9])->count() }} produk</p>
    <p>• <strong>Produk Perlu Restock (<2 unit):</strong> {{ $products->where('stock', '<', 2)->count() }} produk</p>
    <p>• <strong>Produk Habis:</strong> {{ $products->where('stock', 0)->count() }} produk</p>
</div>

<table>
    <thead>
        <tr>
            <th>Kategori Stok</th>
            <th>Jumlah Produk</th>
            <th>Persentase</th>
            <th>Total Unit</th>
            <th>Rekomendasi</th>
        </tr>
    </thead>
    <tbody>
        <tr class="highlight-row">
            <td><span class="badge badge-success">Stok Tinggi (≥50)</span></td>
            <td class="text-center">{{ $products->where('stock', '>=', 50)->count() }}</td>
            <td class="text-center">{{ $products->count() > 0 ? round(($products->where('stock', '>=', 50)->count() / $products->count()) * 100, 1) : 0 }}%</td>
            <td class="text-center">{{ $products->where('stock', '>=', 50)->sum('stock') }}</td>
            <td>Stok Aman</td>
        </tr>
        <tr>
            <td><span class="badge badge-info">Stok Sedang (10-49)</span></td>
            <td class="text-center">{{ $products->whereBetween('stock', [10, 49])->count() }}</td>
            <td class="text-center">{{ $products->count() > 0 ? round(($products->whereBetween('stock', [10, 49])->count() / $products->count()) * 100, 1) : 0 }}%</td>
            <td class="text-center">{{ $products->whereBetween('stock', [10, 49])->sum('stock') }}</td>
            <td>Monitor Berkala</td>
        </tr>
        <tr>
            <td><span class="badge badge-warning">Stok Rendah (2-9)</span></td>
            <td class="text-center">{{ $products->whereBetween('stock', [2, 9])->count() }}</td>
            <td class="text-center">{{ $products->count() > 0 ? round(($products->whereBetween('stock', [2, 9])->count() / $products->count()) * 100, 1) : 0 }}%</td>
            <td class="text-center">{{ $products->whereBetween('stock', [2, 9])->sum('stock') }}</td>
            <td>Segera Restock</td>
        </tr>
        <tr>
            <td><span class="badge badge-danger">Stok Kosong (0)</span></td>
            <td class="text-center">{{ $products->where('stock', 0)->count() }}</td>
            <td class="text-center">{{ $products->count() > 0 ? round(($products->where('stock', 0)->count() / $products->count()) * 100, 1) : 0 }}%</td>
            <td class="text-center">{{ $products->where('stock', 0)->sum('stock') }}</td>
            <td>Restock Mendesak</td>
        </tr>
    </tbody>
</table>

@if($products->where('stock', '>=', 0)->count() > 0)
<h3 style="margin-bottom: 15px; color: #f97316;">📊 Statistik Nilai Stok</h3>
<table>
    <thead>
        <tr>
            <th>Metrik</th>
            <th>Nilai</th>
            <th>Deskripsi</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Total Nilai Stok</td>
            <td class="text-right">Rp {{ number_format($products->sum(function($product) { return $product->stock * $product->price; }), 0, ',', '.') }}</td>
            <td>Total nilai semua stok tersedia</td>
        </tr>
        <tr>
            <td>Rata-rata Stok per Produk</td>
            <td class="text-center">{{ $products->count() > 0 ? round($products->sum('stock') / $products->count(), 1) : 0 }} unit</td>
            <td>Rata-rata jumlah stok untuk setiap produk</td>
        </tr>
        <tr>
            <td>Produk dengan Stok Tertinggi</td>
            <td>{{ $products->where('stock', $products->max('stock'))->first()->name ?? '-' }} ({{ $products->max('stock') }} unit)</td>
            <td>Produk dengan jumlah stok terbanyak</td>
        </tr>
        <tr class="highlight-row">
            <td>Produk Perlu Perhatian</td>
            <td class="text-center">{{ $products->where('stock', '<', 2)->count() }} produk</td>
            <td>Produk yang segera memerlukan restock</td>
        </tr>
    </tbody>
</table>
@endif
@endif

<div class="info-box" style="margin-top: 30px;">
    <p><strong>Keterangan Laporan:</strong></p>
    <p>Laporan ini menampilkan daftar stok produk yang diurutkan berdasarkan stok secara menurun.</p>
    <p>Setiap produk dilengkapi dengan informasi rating, kategori produk, dan harga.</p>
    <p>Urutan ditampilkan dari stok tertinggi hingga stok terendah untuk memudahkan pengelolaan inventory.</p>
    <p>Status stok dikategorikan untuk membantu identifikasi produk yang memerlukan perhatian khusus.</p>
</div>
@endsection
