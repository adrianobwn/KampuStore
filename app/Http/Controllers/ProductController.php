<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        
        // Filter lokasi lengkap
        $selProvinsi   = $request->query('provinsi', '');
        $selKota       = $request->query('kota', '');
        $selKecamatan  = $request->query('kecamatan', '');
        $selKelurahan  = $request->query('kelurahan', '');

        // Kategori (hardcode sesuai mockup)
        $allCats = [
            ['name' => 'Fashion',            'slug' => 'fashion'],
            ['name' => 'Alat Kuliah',        'slug' => 'alat-kuliah'],
            ['name' => 'Buku & Alat Tulis',  'slug' => 'buku-alat-tulis'],
            ['name' => 'Elektronik',         'slug' => 'elektronik'],
        ];

        // Data lokasi seller yang login (untuk default filter)
        $sellerLocation = null;
        if (Auth::check() && Auth::user()->seller && Auth::user()->seller->status === 'approved') {
            $seller = Auth::user()->seller;
            $sellerLocation = [
                'provinsi'  => $seller->provinsi ?? '',
                'kota'      => $seller->kota ?? '',
                'kecamatan' => $seller->kecamatan ?? '',
                'kelurahan' => $seller->kelurahan ?? '',
            ];
        }

        $products = Product::query()
            ->when($q, fn($qb) =>
                $qb->where(fn($w) =>
                    $w->where('name','like',"%{$q}%")
                      ->orWhere('description','like',"%{$q}%")
                      ->orWhere('seller_name','like',"%{$q}%")
                )
            )
            ->when($cats, fn($qb) => $qb->whereIn('category_slug', $cats))
            ->when($cond, fn($qb) => $qb->whereIn('condition', $cond))
            ->when($sizes, fn($qb) => $qb->whereIn('size', $sizes))
            ->when($priceMin > 0, fn($qb) => $qb->where('price','>=',$priceMin))
            ->when($priceMax > 0, fn($qb) => $qb->where('price','<=',$priceMax))
            ->when($inStock, fn($qb) => $qb->where('stock','>',0))
            ->when($ratingMin > 0, function($qb) use ($ratingMin) {
                $qb->whereRaw(
                    '(select coalesce(avg(rating),0) from reviews where reviews.product_id = products.id) >= ?',
                    [$ratingMin]
                );
            })
            // Filter lokasi lengkap
            ->when($selProvinsi, fn($qb) => $qb->where('seller_province', $selProvinsi))
            ->when($selKota, fn($qb) => $qb->where('seller_city', $selKota))
            ->when($selKecamatan, fn($qb) => $qb->whereHas('seller', fn($q) => $q->where('kecamatan', $selKecamatan)))
            ->when($selKelurahan, fn($qb) => $qb->whereHas('seller', fn($q) => $q->where('kelurahan', $selKelurahan)))
            ->latest()
            ->paginate(12);

        return view('products.index', [
            'products'       => $products,
            'q'              => $q,
            'allCats'        => $allCats,
            'cats'           => $cats,
            'cond'           => $cond,
            'sizes'          => $sizes,
            'priceMin'       => $priceMin,
            'priceMax'       => $priceMax,
            'ratingMin'      => $ratingMin,
            'inStock'        => $inStock,
            'selProvinsi'    => $selProvinsi,
            'selKota'        => $selKota,
            'selKecamatan'   => $selKecamatan,
            'selKelurahan'   => $selKelurahan,
            'sellerLocation' => $sellerLocation,
        ]);
    }

    public function show(Product $product)
    {
        $product->load(['reviews.user']);

        $avg   = round($product->reviews()->avg('rating') ?? 0, 1);
        $count = $product->reviews()->count();
        
        // Get product images
        $images = $product->images()->orderBy('sort_order')->get();
        
        // Pre-calculate image display variables
        $showImages = $images->count() > 0;
        $hasMultipleImages = $images->count() > 1;
        $showFallback = !$showImages && $product->image_url;
        $showPlaceholder = !$showImages && !$product->image_url;
        
        // Check if current user is the seller of this product
        $isSeller = auth()->check() 
            && auth()->user()->seller 
            && $product->seller_id === auth()->user()->seller->id;

        return view('products.show', compact('product', 'avg', 'count', 'isSeller', 'images', 'showImages', 'hasMultipleImages', 'showFallback', 'showPlaceholder'));
    }
}
