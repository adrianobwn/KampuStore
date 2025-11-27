<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $q          = trim((string) $request->query('q', ''));
        $cats       = (array) $request->query('cat', []);
        $cond       = (array) $request->query('cond', []);    // ['baru','bekas']
        $sizes      = (array) $request->query('size', []);    // ['S','M','L','XL']
        $priceMin   = (int) $request->query('pmin', 0);
        $priceMax   = (int) $request->query('pmax', 0);
        $ratingMin  = (int) $request->query('rmin', 0);       // 0..5
        $inStock    = (bool) $request->boolean('in_stock', false);
        $area       = (array) $request->query('area', []);    // lokasi (kecamatan Semarang)

        // Kategori (hardcode sesuai mockup)
        $allCats = [
            ['name' => 'Fashion',            'slug' => 'fashion'],
            ['name' => 'Alat Kuliah',        'slug' => 'alat-kuliah'],
            ['name' => 'Buku & Alat Tulis',  'slug' => 'buku-alat-tulis'],
            ['name' => 'Elektronik',         'slug' => 'elektronik'],
        ];

        $areas = [
            'Banyumanik',
            'Candisari',
            'Gajahmungkur',
            'Gayamsari',
            'Genuk',
            'Gunungpati',
            'Mijen',
            'Ngaliyan',
            'Pedurungan',
            'Semarang Barat',
            'Semarang Selatan',
            'Semarang Tengah',
            'Semarang Timur',
            'Semarang Utara',
            'Tembalang',
            'Tugu',
        ];

        $products = Product::query()
            ->when($q, fn($qb) =>
                $qb->where(fn($w) =>
                    $w->where('name','like',"%{$q}%")
                      ->orWhere('description','like',"%{$q}%")
                      ->orWhere('seller_name','like',"%{$q}%")
                )
            )
            ->when($cats, fn($qb) => $qb->whereIn('category_slug', $cats))
            ->when($cond, fn($qb) => $qb->whereIn('condition', $cond)) // 'baru'|'bekas'
            ->when($sizes, fn($qb) => $qb->whereIn('size', $sizes))     // 'S','M','L','XL'
            ->when($priceMin > 0, fn($qb) => $qb->where('price','>=',$priceMin))
            ->when($priceMax > 0, fn($qb) => $qb->where('price','<=',$priceMax))
            ->when($inStock, fn($qb) => $qb->where('stock','>',0))
            ->when($ratingMin > 0, function($qb) use ($ratingMin) {
                $qb->whereRaw(
                    '(select coalesce(avg(rating),0) from reviews where reviews.product_id = products.id) >= ?',
                    [$ratingMin]
                );
            })
            ->when($area, function($qb) use ($area) {
                // GANTI 'seller_area' dengan nama kolom lokasi di tabel products kamu
                $qb->whereIn('seller_area', $area);
            })
            ->latest()
            ->paginate(12);

        return view('products.index', [
            'products'  => $products,
            'q'         => $q,
            'allCats'   => $allCats,
            'cats'      => $cats,
            'cond'      => $cond,
            'sizes'     => $sizes,
            'priceMin'  => $priceMin,
            'priceMax'  => $priceMax,
            'ratingMin' => $ratingMin,
            'inStock'   => $inStock,
            'area'      => $area,
            'areas'     => $areas,
        ]);
    }

    public function show(Product $product)
    {
        $product->load(['reviews.user']);

        $avg   = round($product->reviews()->avg('rating') ?? 0, 1);
        $count = $product->reviews()->count();
        
        // Check if current user is the seller of this product
        $isSeller = auth()->check() 
            && auth()->user()->seller 
            && $product->seller_id === auth()->user()->seller->id;

        return view('products.show', compact('product', 'avg', 'count', 'isSeller'));
    }
}
