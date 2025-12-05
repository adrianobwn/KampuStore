@extends('pdf.layout')

@section('content')
<table>
    <thead>
        <tr>
            <th style="width:5%">No</th>
            <th style="width:35%">Produk</th>
            <th style="width:20%">Kategori</th>
            <th style="width:25%">Harga</th>
            <th style="width:15%">Stock</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $index => $product)
        <tr>
            <td class="text-center">{{ $index + 1 }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ ucfirst(str_replace('-', ' ', $product->category_slug)) }}</td>
            <td class="text-right">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
            <td class="text-center">{{ $product->stock }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="no-data">Tidak ada produk yang memerlukan restock</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
