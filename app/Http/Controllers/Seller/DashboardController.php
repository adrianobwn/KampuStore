<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $lowStockProducts = $seller->products()->where('stock', '<', 10)->count();

        return view('Seller.dashboard', compact(
            'seller',
            'products',
            'totalProducts',
            'totalStock',
            'lowStockProducts'
        ));
    }
}
