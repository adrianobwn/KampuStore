@extends('pdf.layout')

@section('content')
{{-- SRS-10: Laporan Daftar Penjual untuk Setiap Lokasi Provinsi --}}

<div class="info-box">
    <p><strong>Jenis Laporan:</strong> Daftar Penjual per Lokasi {{ ucfirst($groupBy) }} (SRS-MartPlace-10)</p>
    <p><strong>Total Penjual Aktif:</strong> {{ $totalSellers }}</p>
    <p><strong>Jumlah Lokasi:</strong> {{ $sellersByLocation->count() }}</p>
</div>

<table>
    <thead>
        <tr>
            <th style="width:10%">No</th>
            <th style="width:60%">{{ ucfirst($groupBy) }}</th>
            <th style="width:30%">Jumlah Toko</th>
        </tr>
    </thead>
    <tbody>
        @forelse($sellersByLocation as $index => $loc)
        <tr>
            <td class="text-center">{{ $index + 1 }}</td>
            <td>{{ $loc->$groupBy ?? '-' }}</td>
            <td class="text-center">{{ $loc->total }} toko</td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="text-center">Tidak ada data</td>
        </tr>
        @endforelse
    </tbody>
</table>

@if($sellersDetail && $sellersDetail->count() > 0)
<div class="page-break"></div>

<h3 style="margin-top:0;">Detail Penjual di {{ $selectedLocation }}</h3>
<table>
    <thead>
        <tr>
            <th style="width:5%">No</th>
            <th style="width:25%">Nama Toko</th>
            <th style="width:20%">Nama PIC</th>
            <th style="width:20%">Email</th>
            <th style="width:15%">No HP</th>
            <th style="width:15%">Kota</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sellersDetail as $index => $seller)
        <tr>
            <td class="text-center">{{ $index + 1 }}</td>
            <td>{{ $seller->nama_toko }}</td>
            <td>{{ $seller->nama_pic }}</td>
            <td>{{ $seller->email_pic }}</td>
            <td>{{ $seller->no_hp_pic }}</td>
            <td>{{ $seller->kota }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection
