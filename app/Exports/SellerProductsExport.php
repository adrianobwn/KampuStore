<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\DB;

class SellerProductsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    protected $sellerId;

    public function __construct($sellerId)
    {
        $this->sellerId = $sellerId;
    }

    public function collection()
    {
        return Product::select(
                'products.*',
                DB::raw('COALESCE(AVG(reviews.rating), 0) as avg_rating'),
                DB::raw('COUNT(reviews.id) as review_count')
            )
            ->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
            ->where('products.seller_id', $this->sellerId)
            ->groupBy('products.id')
            ->orderBy('products.created_at', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Produk',
            'Kategori',
            'Kondisi',
            'Size',
            'Harga',
            'Stok',
            'Rating',
            'Jumlah Review',
            'Status Stok',
            'Tanggal Upload'
        ];
    }

    public function map($product): array
    {
        static $no = 0;
        $no++;

        $status = $product->stock > 10 ? 'Aman' : ($product->stock > 0 ? 'Menipis' : 'Habis');
        $kategori = ucfirst(str_replace('-', ' ', $product->category_slug));

        return [
            $no,
            $product->name,
            $kategori,
            ucfirst($product->condition),
            $product->size ?: '-',
            'Rp ' . number_format($product->price, 0, ',', '.'),
            $product->stock,
            number_format($product->avg_rating, 2),
            $product->review_count,
            $status,
            $product->created_at->format('d M Y')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,  // No
            'B' => 35, // Nama Produk
            'C' => 15, // Kategori
            'D' => 10, // Kondisi
            'E' => 10, // Size
            'F' => 18, // Harga
            'G' => 8,  // Stok
            'H' => 10, // Rating
            'I' => 15, // Review
            'J' => 12, // Status
            'K' => 15, // Tanggal
        ];
    }
}
