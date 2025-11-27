<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RestockExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $threshold;

    public function __construct($threshold = 10)
    {
        $this->threshold = $threshold;
    }

    public function collection()
    {
        return Product::with('seller')
            ->select('products.*', 'sellers.nama_toko', 'sellers.email_pic', 'sellers.no_hp_pic')
            ->join('sellers', 'products.seller_id', '=', 'sellers.id')
            ->where('products.stock', '<', $this->threshold)
            ->orderBy('products.stock', 'asc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Status Urgensi',
            'Nama Produk',
            'Toko',
            'Stok Saat Ini',
            'Harga',
            'Kontak PIC (HP)',
            'Email PIC'
        ];
    }

    public function map($product): array
    {
        static $no = 0;
        $no++;

        $status = $product->stock == 0 ? 'HABIS' : ($product->stock < 5 ? 'URGENT' : 'LOW');

        return [
            $no,
            $status,
            $product->name,
            $product->nama_toko,
            $product->stock,
            'Rp ' . number_format($product->price, 0, ',', '.'),
            $product->no_hp_pic,
            $product->email_pic
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
