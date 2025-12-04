@extends('pdf.pro-layout')

@section('content')
{{-- SRS-MartPlace-09: Platform Laporan daftar akun penjual aktif dan tidak aktif (format PDF) --}}

<h2 class="section-title">DAFTAR AKUN PENJUAL AKTIF DAN TIDAK AKTIF - UPDATED {{ date('Y-m-d H:i:s') }}</h2>

<div class="metadata-section">
    <div class="metadata-grid">
        <div class="metadata-item">
            <div class="metadata-label">Total Penjual</div>
            <div class="metadata-value">{{ $sellers->count() }}</div>
        </div>
        <div class="metadata-item">
            <div class="metadata-label">Akun Aktif</div>
            <div class="metadata-value">{{ $sellers->where('status', 'approved')->count() }}</div>
        </div>
        <div class="metadata-item">
            <div class="metadata-label">Menunggu Verifikasi</div>
            <div class="metadata-value">{{ $sellers->where('status', 'pending')->count() }}</div>
        </div>
        <div class="metadata-item">
            <div class="metadata-label">Ditolak</div>
            <div class="metadata-value">{{ $sellers->where('status', 'rejected')->count() }}</div>
        </div>
        <div class="metadata-item">
            <div class="metadata-label">Persentase Aktif</div>
            <div class="metadata-value">{{ $sellers->count() > 0 ? round(($sellers->where('status', 'approved')->count() / $sellers->count()) * 100, 1) : 0 }}%</div>
        </div>
        <div class="metadata-item">
            <div class="metadata-label">Tanggal Cetak</div>
            <div class="metadata-value">{{ $generatedDate->format('d/m/Y H:i') }}</div>
        </div>
    </div>
</div>

<table style="width:100%; border-collapse: collapse; margin-top: 20px;">
    <thead>
        <tr style="background: #1e40af !important;">
            <th style="width:5%; text-align:center; border:2px solid #fff; background:#1e40af; color:#fff; padding:12px 8px; font-size:11px; font-weight:700;">NO</th>
            <th style="width:19%; text-align:center; border:2px solid #fff; background:#1e40af; color:#fff; padding:12px 8px; font-size:11px; font-weight:700;">NAMA TOKO</th>
            <th style="width:14%; text-align:center; border:2px solid #fff; background:#1e40af; color:#fff; padding:12px 8px; font-size:11px; font-weight:700;">NAMA PIC</th>
            <th style="width:16%; text-align:center; border:2px solid #fff; background:#1e40af; color:#fff; padding:12px 8px; font-size:11px; font-weight:700;">EMAIL PIC</th>
            <th style="width:11%; text-align:center; border:2px solid #fff; background:#1e40af; color:#fff; padding:12px 8px; font-size:11px; font-weight:700;">NO HP</th>
            <th style="width:13%; text-align:center; border:2px solid #fff; background:#1e40af; color:#fff; padding:12px 8px; font-size:11px; font-weight:700;">KABUPATEN</th>
            <th style="width:13%; text-align:center; border:2px solid #fff; background:#1e40af; color:#fff; padding:12px 8px; font-size:11px; font-weight:700;">PROVINSI</th>
            <th style="width:9%; text-align:center; border:2px solid #fff; background:#1e40af; color:#fff; padding:12px 8px; font-size:11px; font-weight:700;">STATUS</th>
        </tr>
    </thead>
    <tbody>
        @forelse($sellers as $index => $seller)
        <tr>
            <td class="text-center" style="font-weight: bold; background:#f8fafc; border:1px solid #e2e8f0;">{{ $index + 1 }}</td>
            <td style="border:1px solid #e2e8f0;"><strong>{{ $seller->nama_toko ?? '-' }}</strong></td>
            <td style="border:1px solid #e2e8f0;">{{ $seller->nama_pic ?? '-' }}</td>
            <td style="font-size: 9px; border:1px solid #e2e8f0;">{{ $seller->email_pic ?? '-' }}</td>
            <td class="text-center" style="border:1px solid #e2e8f0;">{{ $seller->no_hp_pic ?? '-' }}</td>
            <td style="border:1px solid #e2e8f0;">{{ $seller->kota ?? $seller->kecamatan ?? '-' }}</td>
            <td style="border:1px solid #e2e8f0;">{{ $seller->provinsi ?? '-' }}</td>
            <td class="text-center" style="border:1px solid #e2e8f0;">
                @if($seller->status == 'approved')
                    <span class="badge badge-success">AKTIF</span>
                @elseif($seller->status == 'pending')
                    <span class="badge badge-warning">PENDING</span>
                @else
                    <span class="badge badge-danger">DITOLAK</span>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8" class="no-data">
                Tidak ada data penjual tersedia
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@if($sellers->count() > 0)
<div class="page-break"></div>

<div class="summary-box">
    <h3 class="summary-title">RINGKASAN STATUS AKUN PENJUAL</h3>
    <table>
        <thead>
            <tr>
                <th style="width:25%">STATUS</th>
                <th style="width:25%">JUMLAH</th>
                <th style="width:25%">PERSENTASE</th>
                <th style="width:25%">DESKRIPSI</th>
            </tr>
        </thead>
        <tbody>
            <tr class="highlight-row">
                <td><span class="badge badge-success">AKTIF</span></td>
                <td class="text-center">{{ $sellers->where('status', 'approved')->count() }}</td>
                <td class="text-center">{{ $sellers->count() > 0 ? round(($sellers->where('status', 'approved')->count() / $sellers->count()) * 100, 1) : 0 }}%</td>
                <td>Penjual yang telah diverifikasi dan dapat bertransaksi</td>
            </tr>
            <tr>
                <td><span class="badge badge-warning">PENDING</span></td>
                <td class="text-center">{{ $sellers->where('status', 'pending')->count() }}</td>
                <td class="text-center">{{ $sellers->count() > 0 ? round(($sellers->where('status', 'pending')->count() / $sellers->count()) * 100, 1) : 0 }}%</td>
                <td>Penjual yang sedang dalam proses verifikasi</td>
            </tr>
            <tr>
                <td><span class="badge badge-danger">DITOLAK</span></td>
                <td class="text-center">{{ $sellers->where('status', 'rejected')->count() }}</td>
                <td class="text-center">{{ $sellers->count() > 0 ? round(($sellers->where('status', 'rejected')->count() / $sellers->count()) * 100, 1) : 0 }}%</td>
                <td>Penjual yang ditolak pengajuannya</td>
            </tr>
        </tbody>
    </table>
</div>
@endif

<div class="warning-box">
    <p><strong>KETERANGAN LAPORAN:</strong></p>
    <p>• <strong>Jenis Laporan:</strong> Platform menyediakan laporan daftar akun penjual aktif dan tidak aktif dalam format PDF.</p>
    <p>• <strong>Filter Status:</strong> Laporan mencakup semua status akun penjual (aktif, pending, ditolak).</p>
    <p>• <strong>Informasi yang Ditampilkan:</strong> Setiap penjual dilengkapi dengan data nama toko, informasi PIC, dan lokasi.</p>
    <p>• <strong>Penggunaan Laporan:</strong> Digunakan untuk monitoring dan evaluasi status verifikasi penjual di platform.</p>
    <p>• <strong>Sumber Data:</strong> Data diambil langsung dari database sistem kampuStore pada tanggal {{ $generatedDate->format('d F Y H:i:s') }}.</p>
    <p><em>Laporan ini dicetak secara otomatis oleh sistem dan merupakan dokumen resmi dari platform kampuStore.</em></p>
</div>
@endsection