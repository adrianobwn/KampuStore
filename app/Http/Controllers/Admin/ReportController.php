<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * SRS-09: Laporan Daftar Akun Penjual
     */
    public function sellers(Request $request)
    {
        $query = Seller::with('user');

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->has('date_from') && $request->date_from != '') {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->has('date_to') && $request->date_to != '') {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $sellers = $query->orderBy('created_at', 'desc')->get();

        return view('admin.reports.sellers', compact('sellers'));
    }

    /**
     * SRS-10: Laporan Daftar Penjual per Lokasi
     */
    public function sellersByLocation(Request $request)
    {
        $groupBy = $request->get('group_by', 'kota'); // kota or kecamatan

        $sellersByLocation = Seller::select($groupBy, DB::raw('count(*) as total'))
            ->where('status', 'approved')
            ->groupBy($groupBy)
            ->orderBy('total', 'desc')
            ->get();

        $totalSellers = Seller::where('status', 'approved')->count();

        return view('admin.reports.sellers-by-location', compact('sellersByLocation', 'totalSellers', 'groupBy'));
    }

    /**
     * SRS-11: Laporan Peringkat Produk
     */
    public function productRanking(Request $request)
    {
        $limit = $request->get('limit', 50);
        $category = $request->get('category', null);

        $query = Product::select(
                'products.*',
                'sellers.nama_toko',
                DB::raw('COALESCE(AVG(reviews.rating), 0) as avg_rating'),
                DB::raw('COUNT(reviews.id) as review_count')
            )
            ->join('sellers', 'products.seller_id', '=', 'sellers.id')
            ->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
            ->groupBy('products.id', 'sellers.nama_toko');

        if ($category) {
            $query->where('products.category_slug', $category);
        }

        $products = $query->orderBy('avg_rating', 'desc')
            ->orderBy('review_count', 'desc')
            ->limit($limit)
            ->get();

        $categories = Product::select('category_slug')->distinct()->pluck('category_slug');

        return view('admin.reports.product-ranking', compact('products', 'categories', 'limit', 'category'));
    }

    /**
     * SRS-12: Laporan Stok Produk
     */
    public function stock(Request $request)
    {
        $query = Product::with('seller')
            ->select('products.*', 'sellers.nama_toko')
            ->join('sellers', 'products.seller_id', '=', 'sellers.id');

        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->where('category_slug', $request->category);
        }

        // Filter by seller
        if ($request->has('seller_id') && $request->seller_id != '') {
            $query->where('seller_id', $request->seller_id);
        }

        // Sort
        $sortBy = $request->get('sort_by', 'name');
        $sortOrder = $request->get('sort_order', 'asc');
        
        if ($sortBy == 'stock') {
            $query->orderBy('products.stock', $sortOrder);
        } else {
            $query->orderBy('products.name', 'asc');
        }

        $products = $query->get();

        $categories = Product::select('category_slug')->distinct()->pluck('category_slug');
        $sellers = Seller::where('status', 'approved')->orderBy('nama_toko')->get();

        return view('admin.reports.stock', compact('products', 'categories', 'sellers'));
    }

    /**
     * SRS-13: Laporan Stok Produk berdasarkan Rating
     */
    public function stockByRating(Request $request)
    {
        $minRating = $request->get('min_rating', 0);
        $maxRating = $request->get('max_rating', 5);

        $products = Product::select(
                'products.*',
                'sellers.nama_toko',
                DB::raw('COALESCE(AVG(reviews.rating), 0) as avg_rating'),
                DB::raw('COUNT(reviews.id) as review_count')
            )
            ->join('sellers', 'products.seller_id', '=', 'sellers.id')
            ->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
            ->groupBy('products.id', 'sellers.nama_toko')
            ->havingRaw('COALESCE(AVG(reviews.rating), 0) >= ?', [$minRating])
            ->havingRaw('COALESCE(AVG(reviews.rating), 0) <= ?', [$maxRating])
            ->orderBy('avg_rating', 'desc')
            ->get();

        return view('admin.reports.stock-by-rating', compact('products', 'minRating', 'maxRating'));
    }

    /**
     * SRS-14: Laporan Restock Barang
     */
    public function restock(Request $request)
    {
        $threshold = $request->get('threshold', 10);

        $products = Product::with('seller')
            ->select('products.*', 'sellers.nama_toko', 'sellers.email_pic', 'sellers.no_hp_pic')
            ->join('sellers', 'products.seller_id', '=', 'sellers.id')
            ->where('products.stock', '<', $threshold)
            ->orderBy('products.stock', 'asc')
            ->get();

        $totalLowStock = $products->count();
        $urgentCount = $products->where('stock', '<', 5)->count();

        return view('admin.reports.restock', compact('products', 'threshold', 'totalLowStock', 'urgentCount'));
    }
}
