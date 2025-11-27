<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Http\Request;

class StockExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Product::with('seller')
            ->select('products.*', 'sellers.nama_toko')
            ->join('sellers', 'products.seller_id', '=', 'sellers.id');

        if ($this->request->has('category') && $this->request->category != '') {
            $query->where('category_slug', $this->request->category);
        }

        if ($this->request->has('seller_id') && $this->request->seller_id != '') {
            $query->where('seller_id', $this->request->seller_id);
        }

        $sortBy = $this->request->get('sort_by', 'name');
        $sortOrder = $this->request->get('sort_order', 'asc');
        
        if ($sortBy == 'stock') {
            $query->orderBy('products.stock', $sortOrder);
        } else {
            $query->orderBy('products.name', 'asc');
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Produk',
            'Toko',
            'Kategori',
            'Stok',
            'Harga',
            'Status'
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
            ucfirst(str_replace('-', ' ', $product->category_slug)),
            $product->stock,
            'Rp ' . number_format($product->price, 0, ',', '.'),
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
