<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seller;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $pending  = Seller::where('status', 'pending')->count();
        $approved = Seller::where('status', 'approved')->count();
        $rejected = Seller::where('status', 'rejected')->count();

        $total = $pending + $approved + $rejected;

        if ($total > 0) {
            $pPct = round(($pending  / $total) * 100);
            $aPct = round(($approved / $total) * 100);
            $rPct = round(($rejected / $total) * 100);
        } else {
            $pPct = $aPct = $rPct = 0;
        }

        return view('admin.dashboard', compact(
            'pending', 'approved', 'rejected',
            'total', 'pPct', 'aPct', 'rPct'
        ));
    }
}
