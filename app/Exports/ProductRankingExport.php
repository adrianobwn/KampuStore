<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\DB;

class ProductRankingExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $limit;
    protected $category;

    public function __construct($limit = 50, $category = null)
    {
        $this->limit = $limit;
        $this->category = $category;
    }

    public function collection()
    {
        $query = Product::select(
                'products.*',
                'sellers.nama_toko',
                DB::raw('COALESCE(AVG(reviews.rating), 0) as avg_rating'),
                DB::raw('COUNT(reviews.id) as review_count')
            )
            ->join('sellers', 'products.seller_id', '=', 'sellers.id')
            ->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
            ->groupBy('products.id', 'sellers.nama_toko');

        if ($this->category) {
            $query->where('products.category_slug', $this->category);
        }

        return $query->orderBy('avg_rating', 'desc')
            ->orderBy('review_count', 'desc')
            ->limit($this->limit)
            ->get();
    }

    public function headings(): array
    {
        return [
            'Rank',
            'Nama Produk',
            'Toko',
            'Rating',
            'Jumlah Review',
            'Stok',
            'Harga'
        ];
    }

    public function map($product): array
    {
        static $rank = 0;
        $rank++;

        return [
            $rank,
            $product->name,
            $product->nama_toko,
            number_format($product->avg_rating, 2),
            $product->review_count,
            $product->stock,
            'Rp ' . number_format($product->price, 0, ',', '.')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
