<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $seller = $user->seller;

        if (!$seller) {
            return redirect()->route('products.index')
                ->with('error', 'Anda belum terdaftar sebagai penjual.');
        }

        $products = $seller->products()->latest()->take(5)->get();
        $totalProducts = $seller->products()->count();
        $totalStock = $seller->products()->sum('stock');
        $lowStockProducts = $seller->products()->where('stock', '<', 2)->count();

        // SRS-08: Sebaran stok setiap produk
        $stockByProduct = $seller->products()
            ->select('name', 'stock')
            ->orderBy('stock', 'desc')
            ->take(10)
            ->get();

        // SRS-08: Sebaran rating per produk
        $ratingByProduct = $seller->products()
            ->select('products.id', 'products.name', DB::raw('COALESCE(AVG(reviews.rating), 0) as avg_rating'), DB::raw('COUNT(reviews.id) as review_count'))
            ->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
            ->groupBy('products.id', 'products.name')
            ->orderBy('avg_rating', 'desc')
            ->take(10)
            ->get();

        // SRS-08: Sebaran pemberi rating berdasarkan lokasi provinsi
        $productIds = $seller->products()->pluck('id');
        $reviewersByProvince = Review::whereIn('product_id', $productIds)
            ->whereNotNull('guest_province')
            ->select('guest_province', DB::raw('count(*) as total'))
            ->groupBy('guest_province')
            ->orderBy('total', 'desc')
            ->get();

        // Total reviews untuk produk seller
        $totalReviews = Review::whereIn('product_id', $productIds)->count();
        
        // Average rating keseluruhan
        $avgRating = Review::whereIn('product_id', $productIds)->avg('rating') ?? 0;

        return view('Seller.dashboard', compact(
            'seller',
            'products',
            'totalProducts',
            'totalStock',
            'lowStockProducts',
            'stockByProduct',
            'ratingByProduct',
            'reviewersByProvince',
            'totalReviews',
            'avgRating'
        ));
    }
}
