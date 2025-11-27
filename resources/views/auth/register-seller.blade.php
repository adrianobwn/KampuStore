@php($title = 'Daftar Toko | KampuStore')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 min-h-screen">

<nav class="fixed top-0 left-0 right-0 z-50 bg-slate-900/80 backdrop-blur-lg border-b border-blue-500/20">
    <div class="container mx-auto px-6 py-4">
        <div class="flex items-center justify-between">
            <a href="{{ route('home') }}" class="text-xl font-bold text-white">KampuStore</a>
            <a href="{{ route('login') }}" class="text-sm text-blue-400 hover:text-blue-300">Sudah punya akun? Login</a>
        </div>
    </div>
</nav>

<main class="pt-24 pb-12 px-4">
    <div class="container mx-auto max-w-4xl">
        <div class="bg-slate-800/50 backdrop-blur-lg rounded-2xl shadow-2xl border border-blue-500/20 p-8">
            
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-white mb-2">Daftar Toko Baru</h1>
                <p class="text-gray-400">Lengkapi data toko dan informasi PIC untuk verifikasi</p>
            </div>

            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- SECTION 1: AKUN LOGIN --}}
                <div class="bg-slate-900/50 rounded-xl p-6 border border-slate-700/50">
                    <h2 class="text-xl font-semibold text-white mb-4">1. Data Akun Login</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                class="w-full px-4 py-2 bg-slate-800 border border-slate-600 rounded-lg text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                            @error('name')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Email (@students.undip.ac.id)</label>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                class="w-full px-4 py-2 bg-slate-800 border border-slate-600 rounded-lg text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                            @error('email')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                            <input type="password" name="password" required
                                class="w-full px-4 py-2 bg-slate-800 border border-slate-600 rounded-lg text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                            @error('password')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" required
                                class="w-full px-4 py-2 bg-slate-800 border border-slate-600 rounded-lg text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                        </div>
                    </div>
                </div>

                {{-- SECTION 2: DATA TOKO --}}
                <div class="bg-slate-900/50 rounded-xl p-6 border border-slate-700/50">
                    <h2 class="text-xl font-semibold text-white mb-4">2. Informasi Toko</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Nama Toko *</label>
                            <input type="text" name="nama_toko" value="{{ old('nama_toko') }}" required
                                class="w-full px-4 py-2 bg-slate-800 border border-slate-600 rounded-lg text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                            @error('nama_toko')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Deskripsi Singkat *</label>
                            <textarea name="deskripsi_singkat" rows="3" required
                                class="w-full px-4 py-2 bg-slate-800 border border-slate-600 rounded-lg text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">{{ old('deskripsi_singkat') }}</textarea>
                            @error('deskripsi_singkat')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                {{-- SECTION 3: DATA PIC --}}
                <div class="bg-slate-900/50 rounded-xl p-6 border border-slate-700/50">
                    <h2 class="text-xl font-semibold text-white mb-4">3. Data Penanggung Jawab (PIC)</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Nama PIC *</label>
                            <input type="text" name="nama_pic" value="{{ old('nama_pic') }}" required
                                class="w-full px-4 py-2 bg-slate-800 border border-slate-600 rounded-lg text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                            @error('nama_pic')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">No. Handphone PIC *</label>
                            <input type="text" name="no_hp_pic" value="{{ old('no_hp_pic') }}" required
                                class="w-full px-4 py-2 bg-slate-800 border border-slate-600 rounded-lg text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                            @error('no_hp_pic')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Email PIC (@students.undip.ac.id) *</label>
                            <input type="email" name="email_pic" value="{{ old('email_pic') }}" required
                                class="w-full px-4 py-2 bg-slate-800 border border-slate-600 rounded-lg text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                            @error('email_pic')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">No. KTP PIC *</label>
                            <input type="text" name="no_ktp_pic" value="{{ old('no_ktp_pic') }}" required maxlength="16"
                                class="w-full px-4 py-2 bg-slate-800 border border-slate-600 rounded-lg text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                            @error('no_ktp_pic')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                {{-- SECTION 4: ALAMAT PIC --}}
                <div class="bg-slate-900/50 rounded-xl p-6 border border-slate-700/50">
                    <h2 class="text-xl font-semibold text-white mb-4">4. Alamat PIC</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Alamat (Nama Jalan) *</label>
                            <input type="text" name="alamat_pic" value="{{ old('alamat_pic') }}" required
                                class="w-full px-4 py-2 bg-slate-800 border border-slate-600 rounded-lg text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                            @error('alamat_pic')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">RT *</label>
                                <input type="text" name="rt" value="{{ old('rt') }}" required
                                    class="w-full px-4 py-2 bg-slate-800 border border-slate-600 rounded-lg text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                                @error('rt')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">RW *</label>
                                <input type="text" name="rw" value="{{ old('rw') }}" required
                                    class="w-full px-4 py-2 bg-slate-800 border border-slate-600 rounded-lg text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                                @error('rw')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-300 mb-2">Kelurahan *</label>
                                <input type="text" name="kelurahan" value="{{ old('kelurahan') }}" required
                                    class="w-full px-4 py-2 bg-slate-800 border border-slate-600 rounded-lg text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                                @error('kelurahan')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">Provinsi *</label>
                                <input type="text" name="provinsi" value="{{ old('provinsi') }}" required
                                    class="w-full px-4 py-2 bg-slate-800 border border-slate-600 rounded-lg text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                                @error('provinsi')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">Kabupaten/Kota *</label>
                                <input type="text" name="kota" value="{{ old('kota') }}" required
                                    class="w-full px-4 py-2 bg-slate-800 border border-slate-600 rounded-lg text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                                @error('kota')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SECTION 5: UPLOAD DOKUMEN --}}
                <div class="bg-slate-900/50 rounded-xl p-6 border border-slate-700/50">
                    <h2 class="text-xl font-semibold text-white mb-4">5. Upload Dokumen</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Foto PIC *</label>
                            <input type="file" name="foto_pic" required accept="image/jpeg,image/png,image/jpg"
                                class="w-full px-4 py-2 bg-slate-800 border border-slate-600 rounded-lg text-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, JPEG, PNG. Maksimal 2MB</p>
                            @error('foto_pic')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">File KTP PIC *</label>
                            <input type="file" name="file_ktp_pic" required accept="application/pdf,image/jpeg,image/png,image/jpg"
                                class="w-full px-4 py-2 bg-slate-800 border border-slate-600 rounded-lg text-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                            <p class="text-xs text-gray-500 mt-1">Format: PDF, JPG, JPEG, PNG. Maksimal 4MB</p>
                            @error('file_ktp_pic')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                {{-- SUBMIT --}}
                <div class="flex items-center justify-between">
                    <a href="{{ route('login') }}" class="text-gray-400 hover:text-white">Kembali</a>
                    <button type="submit" class="px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-lg shadow-lg transition duration-200">
                        Daftar Toko
                    </button>
                </div>
            </form>

        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('status'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('status') }}',
        confirmButtonColor: '#2563eb'
    });
</script>
@endif

@if($errors->any())
<script>
    Swal.fire({
        icon: 'error',
        title: 'Terjadi Kesalahan',
        html: '<ul class="text-left">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
        confirmButtonColor: '#2563eb'
    });
</script>
@endif

</body>
</html>
