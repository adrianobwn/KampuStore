@php($title = 'Daftar Sebagai Penjual | KampuStore')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .input-field {
            width: 100%;
            padding: 12px 16px;
            background: white;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            color: #111827;
            font-size: 15px;
            transition: all 0.3s;
        }
        
        .input-field:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }
        
        .label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }
        
        .error-msg {
            color: #dc2626;
            font-size: 13px;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
        }
    </style>
</head>
<body class="min-h-screen">

<nav class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-lg border-b border-purple-200 shadow-lg">
    <div class="container mx-auto px-6 py-4">
        <div class="flex items-center justify-between">
            <a href="{{ route('home') }}" class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent flex items-center gap-2">
                <i class="uil uil-shop"></i>
                KampuStore
            </a>
            <a href="{{ route('login') }}" class="text-sm text-purple-600 hover:text-purple-700 font-semibold flex items-center gap-2 transition">
                <i class="uil uil-signin"></i>
                Sudah punya akun penjual? Login
            </a>
        </div>
    </div>
</nav>

<main class="pt-28 pb-12 px-4">
    <div class="container mx-auto max-w-4xl">
        <div class="bg-white backdrop-blur-lg rounded-3xl shadow-2xl p-8 md:p-10">
            
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-purple-100 to-indigo-100 rounded-full mb-4">
                    <i class="uil uil-store-alt text-4xl text-purple-600"></i>
                </div>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">Daftar Sebagai Penjual</h1>
                <p class="text-gray-600 mb-5 text-lg">Lengkapi data toko dan informasi PIC untuk verifikasi</p>
                <div class="bg-gradient-to-r from-purple-50 to-indigo-50 border-2 border-purple-200 rounded-2xl p-5 text-sm text-gray-700 max-w-2xl mx-auto">
                    <div class="flex items-start gap-3">
                        <i class="uil uil-info-circle text-2xl text-purple-600 mt-0.5"></i>
                        <div class="text-left">
                            <strong class="text-purple-700 block mb-1">Info untuk Pembeli:</strong>
                            <span>Kamu tidak perlu mendaftar atau login untuk berbelanja. 
                            Langsung kunjungi <a href="{{ route('products.index') }}" class="text-purple-600 underline hover:text-purple-700 font-semibold">halaman market</a> untuk mulai belanja!</span>
                        </div>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- SECTION 1: AKUN LOGIN --}}
                <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl p-6 border-2 border-purple-100">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="flex items-center justify-center w-10 h-10 bg-purple-600 text-white rounded-full font-bold">1</div>
                        <h2 class="text-xl font-bold text-gray-900">Data Akun Login</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="label">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name') }}" required class="input-field" placeholder="Masukkan nama lengkap">
                            @error('name')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="label">Email (@students.undip.ac.id)</label>
                            <input type="email" name="email" value="{{ old('email') }}" required class="input-field" placeholder="nama@students.undip.ac.id">
                            @error('email')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="label">Password</label>
                            <input type="password" name="password" required class="input-field" placeholder="Min. 8 karakter">
                            @error('password')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" required class="input-field" placeholder="Ulangi password">
                        </div>
                    </div>
                </div>

                {{-- SECTION 2: DATA TOKO --}}
                <div class="bg-gradient-to-br from-indigo-50 to-white rounded-2xl p-6 border-2 border-indigo-100">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="flex items-center justify-center w-10 h-10 bg-indigo-600 text-white rounded-full font-bold">2</div>
                        <h2 class="text-xl font-bold text-gray-900">Informasi Toko</h2>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="label">Nama Toko *</label>
                            <input type="text" name="nama_toko" value="{{ old('nama_toko') }}" required class="input-field" placeholder="Nama toko Anda">
                            @error('nama_toko')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="label">Deskripsi Singkat *</label>
                            <textarea name="deskripsi_singkat" rows="3" required class="input-field" placeholder="Jelaskan tentang toko Anda">{{ old('deskripsi_singkat') }}</textarea>
                            @error('deskripsi_singkat')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                {{-- SECTION 3: DATA PIC --}}
                <div class="bg-gradient-to-br from-blue-50 to-white rounded-2xl p-6 border-2 border-blue-100">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="flex items-center justify-center w-10 h-10 bg-blue-600 text-white rounded-full font-bold">3</div>
                        <h2 class="text-xl font-bold text-gray-900">Data Penanggung Jawab (PIC)</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="label">Nama PIC *</label>
                            <input type="text" name="nama_pic" value="{{ old('nama_pic') }}" required class="input-field" placeholder="Nama penanggung jawab">
                            @error('nama_pic')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="label">No. Handphone PIC *</label>
                            <input type="text" name="no_hp_pic" value="{{ old('no_hp_pic') }}" required class="input-field" placeholder="08xxxxxxxxxx">
                            @error('no_hp_pic')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="label">Email PIC (@students.undip.ac.id) *</label>
                            <input type="email" name="email_pic" value="{{ old('email_pic') }}" required class="input-field" placeholder="pic@students.undip.ac.id">
                            @error('email_pic')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="label">No. KTP PIC *</label>
                            <input type="text" name="no_ktp_pic" value="{{ old('no_ktp_pic') }}" required maxlength="16" class="input-field" placeholder="16 digit KTP">
                            @error('no_ktp_pic')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                {{-- SECTION 4: ALAMAT PIC --}}
                <div class="bg-gradient-to-br from-teal-50 to-white rounded-2xl p-6 border-2 border-teal-100">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="flex items-center justify-center w-10 h-10 bg-teal-600 text-white rounded-full font-bold">4</div>
                        <h2 class="text-xl font-bold text-gray-900">Alamat PIC</h2>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="label">Alamat (Nama Jalan) *</label>
                            <input type="text" name="alamat_pic" value="{{ old('alamat_pic') }}" required class="input-field" placeholder="Jl. Contoh No. 123">
                            @error('alamat_pic')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div>
                                <label class="label">RT *</label>
                                <input type="text" name="rt" value="{{ old('rt') }}" required class="input-field" placeholder="001">
                                @error('rt')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="label">RW *</label>
                                <input type="text" name="rw" value="{{ old('rw') }}" required class="input-field" placeholder="002">
                                @error('rw')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                            </div>
                            <div class="col-span-2">
                                <label class="label">Kelurahan *</label>
                                <input type="text" name="kelurahan" value="{{ old('kelurahan') }}" required class="input-field" placeholder="Nama kelurahan">
                                @error('kelurahan')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="label">Kota *</label>
                                <input type="text" name="kota" value="{{ old('kota') }}" required class="input-field" placeholder="Semarang">
                                @error('kota')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="label">Provinsi *</label>
                                <input type="text" name="provinsi" value="{{ old('provinsi') }}" required class="input-field" placeholder="Jawa Tengah">
                                @error('provinsi')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SECTION 5: DOKUMEN --}}
                <div class="bg-gradient-to-br from-orange-50 to-white rounded-2xl p-6 border-2 border-orange-100">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="flex items-center justify-center w-10 h-10 bg-orange-600 text-white rounded-full font-bold">5</div>
                        <h2 class="text-xl font-bold text-gray-900">Dokumen Verifikasi</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="label">Foto PIC *</label>
                            <input type="file" name="foto_pic" required accept="image/jpeg,image/jpg,image/png" 
                                class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl text-gray-900 focus:border-orange-500 focus:ring-4 focus:ring-orange-100 transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                            <p class="text-xs text-gray-500 mt-2">Format: JPG, JPEG, PNG (Max. 2MB)</p>
                            @error('foto_pic')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="label">File KTP PIC *</label>
                            <input type="file" name="file_ktp_pic" required accept="application/pdf,image/jpeg,image/jpg,image/png"
                                class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl text-gray-900 focus:border-orange-500 focus:ring-4 focus:ring-orange-100 transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                            <p class="text-xs text-gray-500 mt-2">Format: PDF, JPG, JPEG, PNG (Max. 4MB)</p>
                            @error('file_ktp_pic')<p class="error-msg"><i class="uil uil-exclamation-circle"></i>{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full px-6 py-4 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-bold rounded-xl shadow-2xl transition duration-300 transform hover:scale-105 flex items-center justify-center gap-3 text-lg">
                    <i class="uil uil-check-circle text-2xl"></i>
                    Daftar Sekarang
                </button>
                
                <p class="text-center text-sm text-gray-600">
                    Dengan mendaftar, Anda menyetujui syarat & ketentuan KampuStore
                </p>
            </form>

        </div>
    </div>
</main>

<footer class="bg-white/95 backdrop-filter backdrop-blur-lg border-t border-purple-200 py-6 mt-12">
    <div class="container mx-auto px-4 text-center">
        <p class="text-gray-600 text-sm">
            &copy; {{ date('Y') }} <strong class="bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">KampuStore</strong> - Marketplace Mahasiswa UNDIP
        </p>
    </div>
</footer>

</body>
</html>
