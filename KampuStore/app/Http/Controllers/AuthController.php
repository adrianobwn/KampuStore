<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('products.index'));
        }

        return back()->withErrors(['email' => 'Kredensial tidak valid'])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    // WAJIB email UNDIP
                    'regex:/@(students\.)?undip\.ac\.id$/i',
                    'unique:users,email',
                ],
                'password' => ['required', 'confirmed', Password::defaults()],
            ],
            [
                // pesan khusus kalau regex UNDIP gagal
                'email.regex' => 'Registrasi hanya boleh menggunakan email kampus UNDIP (…@students.undip.ac.id).',
            ]
        );

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            // jangan lupa di-hash
            'password' => bcrypt($data['password']),
        ]);

        return redirect()
            ->route('login')
            ->with('status', 'Akun berhasil dibuat. Silakan login dengan email UNDIP kamu.');
    }

    public function logout(Request $request)
    {
        Auth::logout();     
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('status', 'You have been logged out.');
    }
}

