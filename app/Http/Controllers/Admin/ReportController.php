<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SellersExport;
use App\Exports\SellersByLocationExport;
use App\Exports\ProductRankingExport;

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
     * Export Methods (SRS-09, 10, 11)
     */
    public function exportSellers(Request $request)
    {
        return Excel::download(new SellersExport($request), 'Laporan_Daftar_Penjual_' . date('Y-m-d') . '.xlsx');
    }

    public function exportSellersByLocation(Request $request)
    {
        $groupBy = $request->get('group_by', 'kota');
        return Excel::download(new SellersByLocationExport($groupBy), 'Laporan_Penjual_per_' . ucfirst($groupBy) . '_' . date('Y-m-d') . '.xlsx');
    }

    public function exportProductRanking(Request $request)
    {
        $limit = $request->get('limit', 50);
        $category = $request->get('category', null);
        return Excel::download(new ProductRankingExport($limit, $category), 'Laporan_Peringkat_Produk_' . date('Y-m-d') . '.xlsx');
    }
}
