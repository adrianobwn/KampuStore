<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Data seller status untuk SRS-MartPlace-07: jumlah pengguna penjual aktif dan tidak aktif
        $pending  = Seller::where('status', 'pending')->count();
        $approved = Seller::where('status', 'approved')->count(); // Aktif
        $rejected = Seller::where('status', 'rejected')->count(); // Tidak aktif

        $total = $pending + $approved + $rejected;

        if ($total > 0) {
            $pPct = round(($pending  / $total) * 100);
            $aPct = round(($approved / $total) * 100);
            $rPct = round(($rejected / $total) * 100);
        } else {
            $pPct = $aPct = $rPct = 0;
        }

        // SRS-MartPlace-07: Sebaran jumlah produk per kategori
        $productsByCategory = Product::select('category_slug', DB::raw('count(*) as total'))
            ->groupBy('category_slug')
            ->orderBy('total', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    'category' => ucfirst(str_replace('-', ' ', $item->category_slug)),
                    'slug' => $item->category_slug,
                    'total' => $item->total,
                ];
            });

        // SRS-MartPlace-07: Sebaran jumlah toko per lokasi provinsi
        $sellersByProvince = Seller::select('provinsi', DB::raw('count(*) as total'))
            ->where('status', 'approved')
            ->whereNotNull('provinsi')
            ->groupBy('provinsi')
            ->orderBy('total', 'desc')
            ->get();

        // SRS-MartPlace-07: Jumlah pengunjung yang memberikan komentar dan rating
        $totalReviews = Review::count();

        // Menghitung unique reviewer dengan lebih baik
        $guestReviewers = Review::whereNull('user_id')
            ->whereNotNull('guest_email')
            ->distinct('guest_email')
            ->count('guest_email');

        $userReviewers = Review::whereNotNull('user_id')
            ->distinct('user_id')
            ->count('user_id');

        $uniqueReviewers = $guestReviewers + $userReviewers;

        // Total produk
        $totalProducts = Product::count();

        return view('admin.dashboard', compact(
            'pending', 'approved', 'rejected',
            'total', 'pPct', 'aPct', 'rPct',
            'productsByCategory',
            'sellersByProvince',
            'totalReviews',
            'uniqueReviewers',
            'guestReviewers',
            'userReviewers',
            'totalProducts'
        ));
    }
}
