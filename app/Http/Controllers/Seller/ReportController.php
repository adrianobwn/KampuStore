<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SellerProductsExport;

class ReportController extends Controller
{
    /**
     * SRS-MartPlace-12: Laporan Daftar Produk Berdasarkan Stock
     */
    public function stock(Request $request)
    {
        $seller = Auth::user()->seller;
        
        if (!$seller || $seller->status !== 'approved') {
            return redirect()->route('seller.dashboard')
                ->with('error', 'Anda harus memiliki toko yang sudah diverifikasi.');
        }

        $products = Product::select(
                'products.*',
                DB::raw('COALESCE(AVG(reviews.rating), 0) as avg_rating')
            )
            ->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
            ->where('products.seller_id', $seller->id)
            ->groupBy('products.id')
            ->orderBy('products.stock', 'asc')
            ->get();

        return view('seller.reports.stock', compact('products', 'seller'));
    }

    /**
     * SRS-MartPlace-13: Laporan Daftar Produk Berdasarkan Rating
     */
    public function rating(Request $request)
    {
        $seller = Auth::user()->seller;
        
        if (!$seller || $seller->status !== 'approved') {
            return redirect()->route('seller.dashboard')
                ->with('error', 'Anda harus memiliki toko yang sudah diverifikasi.');
        }

        $products = Product::select(
                'products.*',
                DB::raw('COALESCE(AVG(reviews.rating), 0) as avg_rating'),
                DB::raw('COUNT(reviews.id) as review_count')
            )
            ->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
            ->where('products.seller_id', $seller->id)
            ->groupBy('products.id')
            ->orderBy('avg_rating', 'desc')
            ->get();

        return view('seller.reports.rating', compact('products', 'seller'));
    }

    /**
     * SRS-MartPlace-14: Laporan Daftar Produk Segera Dipesan (Restock)
     */
    public function restock(Request $request)
    {
        $seller = Auth::user()->seller;
        
        if (!$seller || $seller->status !== 'approved') {
            return redirect()->route('seller.dashboard')
                ->with('error', 'Anda harus memiliki toko yang sudah diverifikasi.');
        }

        $threshold = $request->get('threshold', 10);

        $products = Product::where('seller_id', $seller->id)
            ->where('stock', '<', $threshold)
            ->orderBy('category_slug', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        return view('seller.reports.restock', compact('products', 'seller', 'threshold'));
    }

    /**
     * Export Methods
     */
    public function exportStock(Request $request)
    {
        $seller = Auth::user()->seller;
        return Excel::download(
            new SellerProductsExport($seller->id), 
            'Laporan_Stok_Produk_' . $seller->nama_toko . '_' . date('Y-m-d') . '.xlsx'
        );
    }

    public function exportRating(Request $request)
    {
        $seller = Auth::user()->seller;
        return Excel::download(
            new SellerProductsExport($seller->id), 
            'Laporan_Rating_Produk_' . $seller->nama_toko . '_' . date('Y-m-d') . '.xlsx'
        );
    }

    public function exportRestock(Request $request)
    {
        $seller = Auth::user()->seller;
        return Excel::download(
            new SellerProductsExport($seller->id), 
            'Laporan_Restock_' . $seller->nama_toko . '_' . date('Y-m-d') . '.xlsx'
        );
    }
}
