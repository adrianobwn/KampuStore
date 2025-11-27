<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\DB;

class StockByRatingExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $minRating;
    protected $maxRating;

    public function __construct($minRating = 0, $maxRating = 5)
    {
        $this->minRating = $minRating;
        $this->maxRating = $maxRating;
    }

    public function collection()
    {
        return Product::select(
                'products.*',
                'sellers.nama_toko',
                DB::raw('COALESCE(AVG(reviews.rating), 0) as avg_rating'),
                DB::raw('COUNT(reviews.id) as review_count')
            )
            ->join('sellers', 'products.seller_id', '=', 'sellers.id')
            ->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
            ->groupBy('products.id', 'sellers.nama_toko')
            ->havingRaw('COALESCE(AVG(reviews.rating), 0) >= ?', [$this->minRating])
            ->havingRaw('COALESCE(AVG(reviews.rating), 0) <= ?', [$this->maxRating])
            ->orderBy('avg_rating', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Produk',
            'Toko',
            'Stok',
            'Rating',
            'Jumlah Review',
            'Status Stok'
        ];
    }

    public function map($product): array
    {
        static $no = 0;
        $no++;

        $status = $product->stock > 10 ? 'Aman' : ($product->stock > 0 ? 'Menipis' : 'Habis');

        return [
            $no,
            $product->name,
            $product->nama_toko,
            $product->stock,
            number_format($product->avg_rating, 2),
            $product->review_count,
            $status
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
