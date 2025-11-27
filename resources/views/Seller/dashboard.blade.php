<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Toko - {{ $seller->nama_toko }} | KampuStore</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body class="bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 min-h-screen">

{{-- NAVBAR --}}
<nav class="fixed top-0 left-0 right-0 z-50 bg-slate-900/80 backdrop-blur-lg border-b border-blue-500/20">
    <div class="container mx-auto px-6 py-4">
        <div class="flex items-center justify-between">
            <a href="{{ route('home') }}" class="text-xl font-bold text-white">KampuStore</a>
            <div class="flex items-center gap-4">
                <a href="{{ route('products.index') }}" class="text-sm text-gray-300 hover:text-white">Lihat Market</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-red-400 hover:text-red-300">Logout</button>
                </form>
            </div>
        </div>
    </div>
</nav>

<main class="pt-24 pb-12 px-4">
    <div class="container mx-auto max-w-7xl">
        
        {{-- HEADER DENGAN STATUS TOKO --}}
        <div class="bg-slate-800/50 backdrop-blur-lg rounded-2xl shadow-2xl border border-blue-500/20 p-8 mb-6">
            <div class="flex items-start justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-2">{{ $seller->nama_toko }}</h1>
                    <p class="text-gray-400 mb-4">{{ $seller->deskripsi_singkat }}</p>
                    <div class="flex items-center gap-3">
                        <span class="text-sm text-gray-400">Status:</span>
                        @if($seller->status === 'approved')
                            <span class="px-3 py-1 bg-green-500/20 text-green-400 rounded-full text-sm font-semibold border border-green-500/30">
                                <i class="uil uil-check-circle"></i> Terverifikasi
                            </span>
                        @elseif($seller->status === 'pending')
                            <span class="px-3 py-1 bg-yellow-500/20 text-yellow-400 rounded-full text-sm font-semibold border border-yellow-500/30">
                                <i class="uil uil-clock"></i> Menunggu Verifikasi
                            </span>
                        @else
                            <span class="px-3 py-1 bg-red-500/20 text-red-400 rounded-full text-sm font-semibold border border-red-500/30">
                                <i class="uil uil-times-circle"></i> Ditolak
                            </span>
                        @endif
                    </div>
                </div>
                @if($seller->status === 'approved')
                <a href="{{ route('seller.products.create') }}" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-lg shadow-lg transition duration-200">
                    <i class="uil uil-plus"></i> Tambah Produk
                </a>
                @endif
            </div>
        </div>

        @if($seller->status === 'pending')
        {{-- NOTIFIKASI PENDING --}}
        <div class="bg-yellow-500/10 border border-yellow-500/30 rounded-xl p-6 mb-6">
            <div class="flex items-start gap-4">
                <i class="uil uil-exclamation-triangle text-3xl text-yellow-400"></i>
                <div>
                    <h3 class="text-lg font-semibold text-yellow-400 mb-2">Toko Menunggu Verifikasi</h3>
                    <p class="text-gray-300 text-sm">
                        Pendaftaran toko Anda sedang dalam proses verifikasi oleh admin. 
                        Anda akan menerima email notifikasi setelah proses verifikasi selesai.
                        Biasanya proses ini memakan waktu 1-3 hari kerja.
                    </p>
                </div>
            </div>
        </div>
        @elseif($seller->status === 'rejected')
        {{-- NOTIFIKASI REJECTED --}}
        <div class="bg-red-500/10 border border-red-500/30 rounded-xl p-6 mb-6">
            <div class="flex items-start gap-4">
                <i class="uil uil-times-circle text-3xl text-red-400"></i>
                <div>
                    <h3 class="text-lg font-semibold text-red-400 mb-2">Pendaftaran Toko Ditolak</h3>
                    <p class="text-gray-300 text-sm mb-3">{{ $seller->rejection_reason ?? 'Alasan tidak disebutkan.' }}</p>
                    <p class="text-gray-400 text-xs">
                        Silakan hubungi admin atau perbaiki data pendaftaran Anda.
                    </p>
                </div>
            </div>
        </div>
        @endif

        @if($seller->status === 'approved')
        {{-- STATISTIK CARDS --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            {{-- Total Produk --}}
            <div class="bg-slate-800/50 backdrop-blur-lg rounded-xl p-6 border border-slate-700/50">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-blue-500/20 rounded-lg">
                        <i class="uil uil-package text-2xl text-blue-400"></i>
                    </div>
                    <span class="text-xs text-gray-400">Total</span>
                </div>
                <h3 class="text-3xl font-bold text-white mb-1">{{ $totalProducts }}</h3>
                <p class="text-sm text-gray-400">Produk</p>
            </div>

            {{-- Total Stok --}}
            <div class="bg-slate-800/50 backdrop-blur-lg rounded-xl p-6 border border-slate-700/50">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-green-500/20 rounded-lg">
                        <i class="uil uil-layers text-2xl text-green-400"></i>
                    </div>
                    <span class="text-xs text-gray-400">Total</span>
                </div>
                <h3 class="text-3xl font-bold text-white mb-1">{{ $totalStock }}</h3>
                <p class="text-sm text-gray-400">Item Stok</p>
            </div>

            {{-- Stok Menipis --}}
            <div class="bg-slate-800/50 backdrop-blur-lg rounded-xl p-6 border border-slate-700/50">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-orange-500/20 rounded-lg">
                        <i class="uil uil-exclamation-triangle text-2xl text-orange-400"></i>
                    </div>
                    <span class="text-xs text-gray-400">Perlu Restock</span>
                </div>
                <h3 class="text-3xl font-bold text-white mb-1">{{ $lowStockProducts }}</h3>
                <p class="text-sm text-gray-400">Stok < 10</p>
            </div>

            {{-- Rating Toko (placeholder) --}}
            <div class="bg-slate-800/50 backdrop-blur-lg rounded-xl p-6 border border-slate-700/50">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-yellow-500/20 rounded-lg">
                        <i class="uil uil-star text-2xl text-yellow-400"></i>
                    </div>
                    <span class="text-xs text-gray-400">Rating</span>
                </div>
                <h3 class="text-3xl font-bold text-white mb-1">-</h3>
                <p class="text-sm text-gray-400">Coming Soon</p>
            </div>
        </div>

        {{-- TABEL PRODUK TERBARU --}}
        <div class="bg-slate-800/50 backdrop-blur-lg rounded-xl shadow-2xl border border-slate-700/50 p-6 mb-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-white">Produk Terbaru</h2>
                <a href="{{ route('seller.products.index') }}" class="text-sm text-blue-400 hover:text-blue-300">
                    Lihat Semua <i class="uil uil-arrow-right"></i>
                </a>
            </div>

            @if($products->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-slate-700">
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Produk</th>
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Kategori</th>
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Harga</th>
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Stok</th>
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr class="border-b border-slate-700/50 hover:bg-slate-700/30 transition">
                            <td class="py-4 px-4">
                                <div class="flex items-center gap-3">
                                    @if($product->image_url)
                                    <img src="{{ Storage::url($product->image_url) }}" alt="{{ $product->name }}" class="w-12 h-12 rounded-lg object-cover">
                                    @else
                                    <div class="w-12 h-12 rounded-lg bg-slate-700 flex items-center justify-center">
                                        <i class="uil uil-image text-gray-500"></i>
                                    </div>
                                    @endif
                                    <div>
                                        <p class="text-white font-medium">{{ $product->name }}</p>
                                        <p class="text-xs text-gray-400">{{ Str::limit($product->description, 40) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="px-2 py-1 bg-blue-500/20 text-blue-400 rounded text-xs">
                                    {{ ucfirst(str_replace('-', ' ', $product->category_slug)) }}
                                </span>
                            </td>
                            <td class="py-4 px-4 text-white font-semibold">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </td>
                            <td class="py-4 px-4">
                                @if($product->stock < 10)
                                <span class="text-orange-400 font-semibold">{{ $product->stock }}</span>
                                @else
                                <span class="text-green-400 font-semibold">{{ $product->stock }}</span>
                                @endif
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('products.show', $product) }}" class="text-blue-400 hover:text-blue-300" title="Lihat">
                                        <i class="uil uil-eye"></i>
                                    </a>
                                    <a href="{{ route('seller.products.edit', $product) }}" class="text-yellow-400 hover:text-yellow-300" title="Edit">
                                        <i class="uil uil-edit"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center py-12">
                <i class="uil uil-box text-6xl text-gray-600 mb-4"></i>
                <p class="text-gray-400 mb-4">Belum ada produk</p>
                <a href="{{ route('seller.products.create') }}" class="inline-block px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
                    Tambah Produk Pertama
                </a>
            </div>
            @endif
        </div>

        {{-- INFORMASI TOKO --}}
        <div class="bg-slate-800/50 backdrop-blur-lg rounded-xl shadow-2xl border border-slate-700/50 p-6">
            <h2 class="text-xl font-semibold text-white mb-6">Informasi Toko</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-400 mb-1">Nama PIC</p>
                    <p class="text-white font-medium">{{ $seller->nama_pic }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-400 mb-1">Email PIC</p>
                    <p class="text-white font-medium">{{ $seller->email_pic }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-400 mb-1">No. HP PIC</p>
                    <p class="text-white font-medium">{{ $seller->no_hp_pic }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-400 mb-1">Lokasi</p>
                    <p class="text-white font-medium">{{ $seller->kota }}, {{ $seller->provinsi }}</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-sm text-gray-400 mb-1">Alamat Lengkap</p>
                    <p class="text-white font-medium">
                        {{ $seller->alamat_pic }}, RT {{ $seller->rt }} / RW {{ $seller->rw }}, 
                        Kel. {{ $seller->kelurahan }}, {{ $seller->kota }}, {{ $seller->provinsi }}
                    </p>
                </div>
            </div>
        </div>
        @endif

    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        confirmButtonColor: '#2563eb'
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: '{{ session('error') }}',
        confirmButtonColor: '#2563eb'
    });
</script>
@endif

@if(session('info'))
<script>
    Swal.fire({
        icon: 'info',
        title: 'Info',
        text: '{{ session('info') }}',
        confirmButtonColor: '#2563eb'
    });
</script>
@endif

</body>
</html>
