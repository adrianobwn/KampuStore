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
use Barryvdh\DomPDF\Facade\Pdf;

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
     * SRS-10: Laporan Daftar Penjual per Lokasi Provinsi
     */
    public function sellersByLocation(Request $request)
    {
        // SRS-10: Default group by provinsi sesuai SRS
        $groupBy = $request->get('group_by', 'provinsi');

        $sellersByLocation = Seller::select($groupBy, DB::raw('count(*) as total'))
            ->where('status', 'approved')
            ->whereNotNull($groupBy)
            ->groupBy($groupBy)
            ->orderBy('total', 'desc')
            ->get();

        // Detail penjual per lokasi
        $selectedLocation = $request->get('location');
        $sellersDetail = null;
        if ($selectedLocation) {
            $sellersDetail = Seller::where('status', 'approved')
                ->where($groupBy, $selectedLocation)
                ->orderBy('nama_toko')
                ->get();
        }

        $totalSellers = Seller::where('status', 'approved')->count();

        return view('admin.reports.sellers-by-location', compact('sellersByLocation', 'totalSellers', 'groupBy', 'sellersDetail', 'selectedLocation'));
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
     * Export Methods PDF (SRS-09, 10, 11)
     */
    public function exportSellers(Request $request)
    {
        $query = Seller::with('user');

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        if ($request->has('date_from') && $request->date_from != '') {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->has('date_to') && $request->date_to != '') {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $sellers = $query->orderBy('created_at', 'desc')->get();

        $pdf = Pdf::loadView('pdf.sellers', [
            'title' => 'Laporan Daftar Akun Penjual',
            'sellers' => $sellers,
        ]);

        return $pdf->download('Laporan_Daftar_Penjual_' . date('Y-m-d') . '.pdf');
    }

    public function exportSellersByLocation(Request $request)
    {
        $groupBy = $request->get('group_by', 'provinsi');

        $sellersByLocation = Seller::select($groupBy, DB::raw('count(*) as total'))
            ->where('status', 'approved')
            ->whereNotNull($groupBy)
            ->groupBy($groupBy)
            ->orderBy('total', 'desc')
            ->get();

        $selectedLocation = $request->get('location');
        $sellersDetail = null;
        if ($selectedLocation) {
            $sellersDetail = Seller::where('status', 'approved')
                ->where($groupBy, $selectedLocation)
                ->orderBy('nama_toko')
                ->get();
        }

        $totalSellers = Seller::where('status', 'approved')->count();

        $pdf = Pdf::loadView('pdf.sellers-by-location', [
            'title' => 'Laporan Penjual per ' . ucfirst($groupBy),
            'sellersByLocation' => $sellersByLocation,
            'totalSellers' => $totalSellers,
            'groupBy' => $groupBy,
            'sellersDetail' => $sellersDetail,
            'selectedLocation' => $selectedLocation,
        ]);

        return $pdf->download('Laporan_Penjual_per_' . ucfirst($groupBy) . '_' . date('Y-m-d') . '.pdf');
    }

    public function exportProductRanking(Request $request)
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

        $pdf = Pdf::loadView('pdf.product-ranking', [
            'title' => 'Laporan Peringkat Produk',
            'products' => $products,
            'category' => $category,
        ]);

        return $pdf->download('Laporan_Peringkat_Produk_' . date('Y-m-d') . '.pdf');
    }
}
