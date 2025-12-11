<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SellerApproved;
use App\Mail\SellerRejected;
use App\Models\Notification;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
        $total = $sellers->count();
        $pending = $sellers->where('status', 'pending')->count();
        $approved = $sellers->where('status', 'approved')->count();
        $rejected = $sellers->where('status', 'rejected')->count();

        return view('admin.sellers.index', [
            'sellers' => $sellers,
            'total' => $total,
            'pending' => $pending,
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
            'seller' => $seller,
            'fotoKtpUrl' => $fotoKtpUrl,
            'fotoPicUrl' => $fotoPicUrl,
            'fileKtpUrl' => $fileKtpUrl,
        ]);
    }

    /**
     * APPROVE
     */
    public function approve(Seller $seller)
    {
        $seller->update(['status' => 'approved']);

        // Kirim email (akan masuk queue)
        Mail::to($seller->email_pic)->send(new SellerApproved($seller));

        // Simpan notifikasi ke database (internal inbox)
        $htmlContent = view('emails.seller-approved', [
            'seller' => $seller,
            'activationUrl' => route('seller.dashboard')
        ])->render();

        Notification::create([
            'seller_id' => $seller->id,
            'type' => 'approval',
            'subject' => 'Pendaftaran Toko Anda Telah Disetujui - KampuStore',
            'message' => "Selamat! Pendaftaran toko {$seller->nama_toko} Anda telah disetujui oleh admin KampuStore.",
            'html_content' => $htmlContent,
        ]);

        return back()->with('success', 'Seller disetujui dan notifikasi telah dikirim.');
    }

    /**
     * REJECT
     */
    public function reject(Seller $seller)
    {
        // Get user before updating
        $user = $seller->user;
        $sellerEmail = $seller->email_pic;
        $sellerName = $seller->nama_toko;

        // Send rejection email first
        Mail::to($sellerEmail)->send(new SellerRejected($seller));

        // Update seller status to rejected and remove user association
        // Keep seller record for reporting purposes
        $seller->update([
            'status' => 'rejected',
            'user_id' => null, // Remove user association so they can register again
        ]);

        // Delete notifications related to this seller
        Notification::where('seller_id', $seller->id)->delete();

        // Delete the user account so they can register again with the same email
        if ($user) {
            $user->delete();
        }

        return redirect()->route('admin.sellers.index')
            ->with('success', "Seller " . $sellerName . " ditolak. Akun user sudah dihapus (bisa daftar ulang) dan email notifikasi telah dikirim. Data pengajuan tetap tersimpan untuk laporan.");
    }
}
