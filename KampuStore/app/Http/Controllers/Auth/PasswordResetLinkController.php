<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
    /**
     * Tampilkan halaman form "Forgot Password"
     */
    public function create()
    {
        // view yang nanti kamu styling sama kayak login/register
        return view('auth.forgot-password');
    }

    /**
     * Proses kirim link reset password ke email
     */
    public function store(Request $request)
    {
        // validasi email
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // kirim link reset ke email
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // kalau sukses / gagal
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
}
