@extends('pdf.pro-layout')

@section('content')
{{-- LAPORAN DAFTAR PRODUK DAN RATING-NYA YANG DIURUTKAN BERDASARKAN RATING SECARA MENURUN (DESCENDING) --}}

<div class="metadata-section">
    <div class="metadata-grid">
        <div class="metadata-item">
            <div class="metadata-label">Total Produk</div>
            <div class="metadata-value">{{ $products->count() }}</div>
        </div>
        <div class="metadata-item">
            <div class="metadata-label">Produk Dengan Rating</div>
            <div class="metadata-value">{{ $products->where('avg_rating', '>', 0)->count() }}</div>
        </div>
        <div class="metadata-item">
            <div class="metadata-label">Rating Tertinggi</div>
            <div class="metadata-value">{{ $products->max('avg_rating') > 0 ? number_format($products->max('avg_rating'), 1) : '0.0' }}</div>
        </div>
        <div class="metadata-item">
            <div class="metadata-label">Total Review</div>
            <div class="metadata-value">{{ $products->sum('review_count') ?? 0 }}</div>
        </div>
        <div class="metadata-item">
            <div class="metadata-label">Kategori Aktif</div>
            <div class="metadata-value">{{ $category ? ucfirst(str_replace('-', ' ', $category)) : 'Semua Kategori' }}</div>
        </div>
        <div class="metadata-item">
            <div class="metadata-label">Rata-rata Rating</div>
            <div class="metadata-value">{{ $products->where('avg_rating', '>', 0)->count() > 0 ? number_format($products->where('avg_rating', '>', 0)->avg('avg_rating'), 1) : '0.0' }}</div>
        </div>
        <div class="metadata-item">
            <div class="metadata-label">Produk Tanpa Rating</div>
            <div class="metadata-value">{{ $products->where('avg_rating', 0)->count() }}</div>
        </div>
        <div class="metadata-item">
            <div class="metadata-label">Tanggal Cetak</div>
            <div class="metadata-value">{{ $generatedDate->format('d/m/Y H:i') }}</div>
        </div>
    </div>
</div>

@if($category)
<div class="warning-box">
    <p><strong>FILTER KATEGORI:</strong> {{ ucfirst(str_replace('-', ' ', $category)) }}</p>
</div>
@endif

<h2 class="section-title">DAFTAR PRODUK BERDASARKAN RATING TERTINGGI</h2>

<table>
    <thead>
        <tr>
            <th style="width:5%">NO</th>
            <th style="width:22%">NAMA PRODUK</th>
            <th style="width:16%">NAMA TOKO</th>
            <th style="width:14%">KATEGORI</th>
            <th style="width:12%">HARGA (RP)</th>
            <th style="width:13%">PROVINSI</th>
            <th style="width:10%">RATING</th>
            <th style="width:8%">REVIEW</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $index => $product)
        <tr>
            <td class="text-center">{{ $index + 1 }}</td>
            <td><strong>{{ $product->name }}</strong></td>
            <td>{{ $product->nama_toko ?? $product->seller_name ?? 'Toko tidak diketahui' }}</td>
            <td>{{ ucfirst(str_replace('-', ' ', $product->category_slug ?? 'Uncategorized')) }}</td>
            <td class="text-right">{{ number_format($product->price ?? 0, 0, ',', '.') }}</td>
            <td>{{ $product->seller_province ?? 'Lokasi tidak diketahui' }}</td>
            <td class="text-center">
                @if($product->avg_rating > 0)
                    <span class="badge badge-success">{{ number_format($product->avg_rating, 1) }}</span>
                @else
                    <span class="badge badge-warning">Belum</span>
                @endif
            </td>
            <td class="text-center">{{ $product->review_count ?? 0 }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="8" class="no-data">
                <i class="uil uil-package-alt" style="font-size: 16px; margin-right: 8px;"></i>
                Tidak ada data produk tersedia
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@if($products->count() > 0)
<div class="page-break"></div>

<div class="summary-box">
    <h3 class="summary-title">ANALISIS RATING PRODUK</h3>
    <div class="summary-grid">
        <div class="summary-item">
            <div class="summary-value">{{ $products->where('avg_rating', 5.0)->count() }}</div>
            <div class="summary-label">RATING 5.0 (SEMPURNA)</div>
        </div>
        <div class="summary-item">
            <div class="summary-value">{{ $products->whereBetween('avg_rating', [4.0, 4.9])->count() }}</div>
            <div class="summary-label">RATING 4.0-4.9 (SANGAT BAIK)</div>
        </div>
        <div class="summary-item">
            <div class="summary-value">{{ $products->whereBetween('avg_rating', [3.0, 3.9])->count() }}</div>
            <div class="summary-label">RATING 3.0-3.9 (CUKUP BAIK)</div>
        </div>
        <div class="summary-item">
            <div class="summary-value">{{ $products->whereBetween('avg_rating', [1.0, 2.9])->count() }}</div>
            <div class="summary-label">RATING 1.0-2.9 (KURANG BAIK)</div>
        </div>
        <div class="summary-item">
            <div class="summary-value">{{ $products->where('avg_rating', 0)->count() }}</div>
            <div class="summary-label">TANPA RATING</div>
        </div>
        <div class="summary-item">
            <div class="summary-value">{{ $products->where('avg_rating', '>', 0)->avg('avg_rating') ? number_format($products->where('avg_rating', '>', 0)->avg('avg_rating'), 1) : '0.0' }}</div>
            <div class="summary-label">RATA-RATA</div>
        </div>
    </div>
</div>

<table>
    <thead>
        <tr>
            <th style="width:25%">KATEGORI RATING</th>
            <th style="width:15%">JUMLAH PRODUK</th>
            <th style="width:15%">PERSENTASE</th>
            <th style="width:15%">TOTAL HARGA (RP)</th>
            <th style="width:30%">DESKRIPSI KUALITAS</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><span class="badge badge-success">5.0 - 4.5</span></td>
            <td class="text-center">{{ $products->whereBetween('avg_rating', [4.5, 5.0])->count() }}</td>
            <td class="text-center">{{ $products->count() > 0 ? round(($products->whereBetween('avg_rating', [4.5, 5.0])->count() / $products->count()) * 100, 1) : 0 }}%</td>
            <td class="text-right">{{ number_format($products->whereBetween('avg_rating', [4.5, 5.0])->sum('price'), 0, ',', '.') }}</td>
            <td>Kualitas Produk Sangat Memuaskan</td>
        </tr>
        <tr>
            <td><span class="badge badge-success">4.4 - 4.0</span></td>
            <td class="text-center">{{ $products->whereBetween('avg_rating', [4.0, 4.4])->count() }}</td>
            <td class="text-center">{{ $products->count() > 0 ? round(($products->whereBetween('avg_rating', [4.0, 4.4])->count() / $products->count()) * 100, 1) : 0 }}%</td>
            <td class="text-right">{{ number_format($products->whereBetween('avg_rating', [4.0, 4.4])->sum('price'), 0, ',', '.') }}</td>
            <td>Kualitas Produk Memuaskan</td>
        </tr>
        <tr>
            <td><span class="badge badge-warning">3.9 - 3.0</span></td>
            <td class="text-center">{{ $products->whereBetween('avg_rating', [3.0, 3.9])->count() }}</td>
            <td class="text-center">{{ $products->count() > 0 ? round(($products->whereBetween('avg_rating', [3.0, 3.9])->count() / $products->count()) * 100, 1) : 0 }}%</td>
            <td class="text-right">{{ number_format($products->whereBetween('avg_rating', [3.0, 3.9])->sum('price'), 0, ',', '.') }}</td>
            <td>Kualitas Produk Cukup Memuaskan</td>
        </tr>
        <tr>
            <td><span class="badge badge-info">2.9 - 1.0</span></td>
            <td class="text-center">{{ $products->whereBetween('avg_rating', [1.0, 2.9])->count() }}</td>
            <td class="text-center">{{ $products->count() > 0 ? round(($products->whereBetween('avg_rating', [1.0, 2.9])->count() / $products->count()) * 100, 1) : 0 }}%</td>
            <td class="text-right">{{ number_format($products->whereBetween('avg_rating', [1.0, 2.9])->sum('price'), 0, ',', '.') }}</td>
            <td>Kualitas Produk Kurang Memuaskan</td>
        </tr>
        <tr>
            <td><span class="badge badge-danger">0.0 - TANPA RATING</span></td>
            <td class="text-center">{{ $products->where('avg_rating', 0)->count() }}</td>
            <td class="text-center">{{ $products->count() > 0 ? round(($products->where('avg_rating', 0)->count() / $products->count()) * 100, 1) : 0 }}%</td>
            <td class="text-right">{{ number_format($products->where('avg_rating', 0)->sum('price'), 0, ',', '.') }}</td>
            <td>Produk Belum Memiliki Rating</td>
        </tr>
    </tbody>
</table>

@if($products->where('avg_rating', '>', 0)->count() > 0)
<div class="page-break"></div>

<h3 class="section-title">TOP 10 PRODUK DENGAN RATING TERTINGGI</h3>

<table>
    <thead>
        <tr>
            <th style="width:5%">RANK</th>
            <th style="width:28%">NAMA PRODUK</th>
            <th style="width:15%">NAMA TOKO</th>
            <th style="width:12%">RATING</th>
            <th style="width:12%">HARGA</th>
            <th style="width:15%">PROVINSI</th>
            <th style="width:13%">REVIEW</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products->where('avg_rating', '>', 0)->take(10) as $index => $product)
        <tr>
            <td class="text-center"><strong>{{ $index + 1 }}</strong></td>
            <td><strong>{{ $product->name }}</strong></td>
            <td>{{ $product->nama_toko ?? $product->seller_name ?? '-' }}</td>
            <td class="text-center"><span class="badge badge-success">{{ number_format($product->avg_rating, 1) }}</span></td>
            <td class="text-right">{{ number_format($product->price, 0, ',', '.') }}</td>
            <td>{{ $product->seller_province ?? '-' }}</td>
            <td class="text-center">{{ $product->review_count ?? 0 }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endif

<div class="warning-box">
    <p><strong>KETERANGAN LAPORAN:</strong></p>
    <p>• <strong>Urutan:</strong> Produk diurutkan berdasarkan rating secara menurun (descending).</p>
    <p>• <strong>Kriteria:</strong> Setiap produk dilengkapi dengan nama toko, kategori produk, harga, dan lokasi provinsi.</p>
    <p>• <strong>Rating Scale:</strong> 1.0 (Sangat Buruk) hingga 5.0 (Sangat Baik).</p>
    <p>• <strong>Penggunaan:</strong> Laporan ini digunakan untuk evaluasi kualitas produk dan identifikasi produk unggulan.</p>
    <p><em>Laporan ini dicetak pada {{ $generatedDate->format('d F Y H:i:s') }} dan merupakan dokumen resmi dari sistem kampuStore.</em></p>
</div>
@endsection