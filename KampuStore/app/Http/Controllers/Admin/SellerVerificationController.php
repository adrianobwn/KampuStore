<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SellerVerificationController extends Controller
{
    /**
     * LIST PENGAJUAN TOKO
     */
    public function index()
    {
        // Ambil semua seller + relasi user
        $sellers = Seller::with('user')
            ->latest()
            ->get();

        // Hitung angka-angka buat header (kayak di dashboard)
        $total    = $sellers->count();
        $pending  = $sellers->where('status', 'pending')->count();
        $approved = $sellers->where('status', 'approved')->count();
        $rejected = $sellers->where('status', 'rejected')->count();

        return view('admin.sellers.index', [
            'sellers'  => $sellers,
            'total'    => $total,
            'pending'  => $pending,
            'approved' => $approved,
            'rejected' => $rejected,
        ]);
    }

    /**
     * DETAIL PENGAJUAN TOKO
     */
    public function show(Seller $seller)
    {
        $seller->load('user');

        $fotoKtpUrl = $seller->foto_ktp
            ? Storage::url($seller->foto_ktp)
            : null;

        $fotoPicUrl = $seller->foto_pic
            ? Storage::url($seller->foto_pic)
            : null;

        $fileKtpUrl = $seller->file_ktp_pic
            ? Storage::url($seller->file_ktp_pic)
            : null;

        return view('admin.sellers.show', [
            'seller'      => $seller,
            'fotoKtpUrl'  => $fotoKtpUrl,
            'fotoPicUrl'  => $fotoPicUrl,
            'fileKtpUrl'  => $fileKtpUrl,
        ]);
    }

    /**
     * APPROVE
     */
    public function approve(Seller $seller)
    {
        $seller->update(['status' => 'approved']);

        // TODO: kirim email ke seller berisi akun/aktivasi
        return back()->with('success', 'Seller disetujui.');
    }

    /**
     * REJECT
     */
    public function reject(Seller $seller, Request $request)
    {
        $seller->update(['status' => 'rejected']);

        // TODO: kirim email berisi alasan penolakan
        return back()->with('success', 'Seller ditolak.');
    }
}
