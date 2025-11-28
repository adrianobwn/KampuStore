@extends('pdf.layout')

@section('content')
{{-- SRS-09: Laporan Daftar Akun Penjual Aktif dan Tidak Aktif --}}

<div class="info-box">
    <p><strong>Jenis Laporan:</strong> Daftar Akun Penjual (SRS-MartPlace-09)</p>
    <p><strong>Total Data:</strong> {{ $sellers->count() }} penjual</p>
    <p><strong>Aktif:</strong> {{ $sellers->where('status', 'approved')->count() }} | 
       <strong>Tidak Aktif (Ditolak):</strong> {{ $sellers->where('status', 'rejected')->count() }} | 
       <strong>Pending:</strong> {{ $sellers->where('status', 'pending')->count() }}</p>
</div>

<table>
    <thead>
        <tr>
            <th style="width:5%">No</th>
            <th style="width:20%">Nama Toko</th>
            <th style="width:15%">Nama PIC</th>
            <th style="width:15%">Email</th>
            <th style="width:15%">No HP</th>
            <th style="width:15%">Lokasi</th>
            <th style="width:10%">Status</th>
            <th style="width:10%">Tgl Daftar</th>
        </tr>
    </thead>
    <tbody>
        @forelse($sellers as $index => $seller)
        <tr>
            <td class="text-center">{{ $index + 1 }}</td>
            <td>{{ $seller->nama_toko }}</td>
            <td>{{ $seller->nama_pic }}</td>
            <td>{{ $seller->email_pic }}</td>
            <td>{{ $seller->no_hp_pic }}</td>
            <td>{{ $seller->kota }}, {{ $seller->provinsi }}</td>
            <td class="text-center">
                @if($seller->status === 'approved')
                    <span class="badge badge-success">Aktif</span>
                @elseif($seller->status === 'rejected')
                    <span class="badge badge-danger">Tidak Aktif</span>
                @else
                    <span class="badge badge-warning">Pending</span>
                @endif
            </td>
            <td class="text-center">{{ $seller->created_at->format('d/m/Y') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="8" class="text-center">Tidak ada data</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
