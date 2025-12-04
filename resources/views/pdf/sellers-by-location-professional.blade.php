@extends('pdf.pro-layout')

@section('content')
{{-- LAPORAN DAFTAR PENJUAL (TOKO) UNTUK SETIAP LOKASI PROVINSI --}}

<div class="metadata-section">
    <div class="metadata-grid">
        <div class="metadata-item">
            <div class="metadata-label">Total Toko Aktif</div>
            <div class="metadata-value">{{ $totalSellers }}</div>
        </div>
        <div class="metadata-item">
            <div class="metadata-label">Jumlah Provinsi</div>
            <div class="metadata-value">{{ $sellersByLocation->count() }}</div>
        </div>
        <div class="metadata-item">
            <div class="metadata-label">Provinsi Terbanyak</div>
            <div class="metadata-value">{{ $sellersByLocation->first()->provinsi ?? 'N/A' }}</div>
        </div>
        <div class="metadata-item">
            <div class="metadata-label">Toko Terbanyak</div>
            <div class="metadata-value">{{ $sellersByLocation->max('total') }} Toko</div>
        </div>
        <div class="metadata-item">
            <div class="metadata-label">Rata-rata/Provinsi</div>
            <div class="metadata-value">{{ $sellersByLocation->count() > 0 ? round($totalSellers / $sellersByLocation->count(), 1) : 0 }} Toko</div>
        </div>
        <div class="metadata-item">
            <div class="metadata-label">Tanggal Cetak</div>
            <div class="metadata-value">{{ $generatedDate->format('d/m/Y H:i') }}</div>
        </div>
        <div class="metadata-item">
            <div class="metadata-label">Filter Lokasi</div>
            <div class="metadata-value">{{ $selectedLocation ?? 'Semua Provinsi' }}</div>
        </div>
        <div class="metadata-item">
            <div class="metadata-label">Status Toko</div>
            <div class="metadata-value">Hanya Aktif</div>
        </div>
    </div>
</div>

<h2 class="section-title">DAFTAR PENJUAL (TOKO) PER PROVINSI</h2>

<table>
    <thead>
        <tr>
            <th style="width:5%">NO</th>
            <th style="width:25%">PROVINSI</th>
            <th style="width:18%">JUMLAH TOKO</th>
            <th style="width:12%">PERSENTASE</th>
            <th style="width:15%">STATUS</th>
            <th style="width:15%">DISTRIBUSI</th>
            <th style="width:10%">RANKING</th>
        </tr>
    </thead>
    <tbody>
        @forelse($sellersByLocation as $index => $location)
        <tr>
            <td class="text-center">{{ $index + 1 }}</td>
            <td><strong>{{ $location->provinsi ?? 'Tidak Diketahui' }}</strong></td>
            <td class="text-center">{{ $location->total }} Toko</td>
            <td class="text-center">{{ $totalSellers > 0 ? round(($location->total / $totalSellers) * 100, 1) : 0 }}%</td>
            <td class="text-center">
                @if($location->total >= 20)
                    <span class="badge badge-success">TINGGI</span>
                @elseif($location->total >= 10)
                    <span class="badge badge-warning">SEDANG</span>
                @else
                    <span class="badge badge-info">RENDAH</span>
                @endif
            </td>
            <td class="text-center">{{ $location->total }} Toko Terdaftar</td>
            <td class="text-center">
                @if($index == 0)
                    <span class="badge badge-success">#1</span>
                @elseif($index == 1)
                    <span class="badge badge-warning">#2</span>
                @elseif($index == 2)
                    <span class="badge badge-info">#3</span>
                @else
                    <span class="badge">#{{ $index + 1 }}</span>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="no-data">
                <i class="uil uil-map-marker-alt" style="font-size: 16px; margin-right: 8px;"></i>
                Tidak ada data toko aktif per provinsi
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@if($sellersDetail && $sellersDetail->count() > 0)
<div class="page-break"></div>

<div class="metadata-section">
    <div class="metadata-item">
        <div class="metadata-label">Provinsi Terpilih</div>
        <div class="metadata-value">{{ $selectedLocation }}</div>
    </div>
    <div class="metadata-item">
        <div class="metadata-label">Jumlah Toko</div>
        <div class="metadata-value">{{ $sellersDetail->count() }} Toko</div>
    </div>
    <div class="metadata-item">
        <div class="metadata-label">Filter</div>
        <div class="metadata-value">Hanya Toko Status AKTIF</div>
    </div>
</div>

<h2 class="section-title">DAFTAR DETAIL TOKO DI PROVINSI {{ $selectedLocation }}</h2>

<table>
    <thead>
        <tr>
            <th style="width:5%">NO</th>
            <th style="width:25%">NAMA TOKO</th>
            <th style="width:18%">NAMA PIC</th>
            <th style="width:20%">EMAIL PIC</th>
            <th style="width:15%">NO HP PIC</th>
            <th style="width:17%">KOTA</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sellersDetail as $index => $seller)
        <tr>
            <td class="text-center">{{ $index + 1 }}</td>
            <td><strong>{{ $seller->nama_toko }}</strong></td>
            <td>{{ $seller->nama_pic }}</td>
            <td>{{ $seller->email_pic }}</td>
            <td class="text-center">{{ $seller->no_hp_pic }}</td>
            <td>{{ $seller->kota }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

@if($sellersByLocation->count() > 0)
<div class="page-break"></div>

<div class="summary-box">
    <h3 class="summary-title">ANALISIS DISTRIBUSI TOKO</h3>
    <div class="summary-grid">
        <div class="summary-item">
            <div class="summary-value">{{ $sellersByLocation->first()->provinsi }}</div>
            <div class="summary-label">PROVINSI TERBANYAK</div>
        </div>
        <div class="summary-item">
            <div class="summary-value">{{ $sellersByLocation->first()->total }} Toko</div>
            <div class="summary-label">JUMLAH TERBANYAK</div>
        </div>
        <div class="summary-item">
            <div class="summary-value">{{ $sellersByLocation->last()->provinsi }}</div>
            <div class="summary-label">PROVINSI PALING SEDIKIT</div>
        </div>
        <div class="summary-item">
            <div class="summary-value">{{ $sellersByLocation->last()->total }} Toko</div>
            <div class="summary-label">JUMLAH PALING SEDIKIT</div>
        </div>
    </div>
</div>

<table style="margin-bottom: 30px;">
    <thead>
        <tr>
            <th style="width:30%">KRITERIA KETERSEDIAAN</th>
            <th style="width:20%">JUMLAH PROVINSI</th>
            <th style="width:15%">PERSNTASE</th>
            <th style="width:35%">DESKRIPSI</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Tinggi (≥20 Toko)</td>
            <td class="text-center">{{ $sellersByLocation->where('total', '>=', 20)->count() }}</td>
            <td class="text-center">{{ $sellersByLocation->count() > 0 ? round(($sellersByLocation->where('total', '>=', 20)->count() / $sellersByLocation->count()) * 100, 1) : 0 }}%</td>
            <td>Ketersediaan toko sangat tinggi</td>
        </tr>
        <tr>
            <td>Sedang (10-19 Toko)</td>
            <td class="text-center">{{ $sellersByLocation->whereBetween('total', [10, 19])->count() }}</td>
            <td class="text-center">{{ $sellersByLocation->count() > 0 ? round(($sellersByLocation->whereBetween('total', [10, 19])->count() / $sellersByLocation->count()) * 100, 1) : 0 }}%</td>
            <td>Ketersediaan toko sedang</td>
        </tr>
        <tr>
            <td>Rendah (1-9 Toko)</td>
            <td class="text-center">{{ $sellersByLocation->where('total', '<=', 9)->count() }}</td>
            <td class="text-center">{{ $sellersByLocation->count() > 0 ? round(($sellersByLocation->where('total', '<=', 9)->count() / $sellersByLocation->count()) * 100, 1) : 0 }}%</td>
            <td>Ketersediaan toko rendah</td>
        </tr>
    </tbody>
</table>
@endif

<div class="warning-box">
    <p><strong>KETERANGAN:</strong></p>
    <p>• <strong>Filter:</strong> Laporan ini hanya menampilkan toko dengan status AKTIF (approved).</p>
    <p>• <strong>Unsur Data:</strong> Setiap toko dilengkapi dengan informasi nama toko, data PIC, dan lokasi.</p>
    <p>• <strong>Penggunaan:</strong> Laporan ini digunakan untuk analisis distribusi geografis penjual.</p>
    <p><em>Laporan ini dicetak pada {{ $generatedDate->format('d F Y H:i:s') }} dan merupakan dokumen resmi dari sistem kampuStore.</em></p>
</div>
@endsection