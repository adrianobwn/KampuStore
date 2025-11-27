<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Toko - {{ $seller->nama_toko }} | KampuStore</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.3), 0 8px 10px -6px rgb(0 0 0 / 0.3);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 min-h-screen flex flex-col">
<!-- DASHBOARD PENJUAL BARU -->

{{-- NAVBAR --}}
<nav class="fixed top-0 left-0 right-0 z-50 bg-slate-900/95 backdrop-blur-xl border-b border-blue-500/30 shadow-lg">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            {{-- Logo --}}
            <a href="{{ route('seller.dashboard') }}" class="flex items-center gap-2">
                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-lg flex items-center justify-center">
                    <i class="uil uil-shop text-white text-lg"></i>
                </div>
                <span class="text-xl sm:text-2xl font-bold bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent">
                    kampuStore
                </span>
            </a>
            
            {{-- Center Menu --}}
            <div class="hidden md:flex items-center gap-6">
                <a href="{{ route('seller.dashboard') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium text-white bg-blue-500/20 border border-blue-500/40">
                    <i class="uil uil-dashboard text-base"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('seller.products.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium text-gray-300 hover:text-white hover:bg-slate-800/50 transition-all">
                    <i class="uil uil-box text-base"></i>
                    <span>Produk Saya</span>
                </a>
                <div class="relative" x-data="{ openReports: false }">
                    <button @click="openReports = !openReports" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium text-gray-300 hover:text-white hover:bg-slate-800/50 transition-all">
                        <i class="uil uil-chart-line text-base"></i>
                        <span>Laporan</span>
                        <i class="uil uil-angle-down ml-1"></i>
                    </button>
                    <div x-show="openReports" @click.away="openReports = false" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         class="absolute left-0 mt-2 w-56 rounded-lg shadow-lg bg-slate-800 border border-blue-500/30"
                         style="display: none;">
                        <div class="py-2">
                            <a href="{{ route('seller.reports.stock') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-slate-700">
                                <i class="uil uil-box mr-2"></i>Laporan Stok
                            </a>
                            <a href="{{ route('seller.reports.rating') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-slate-700">
                                <i class="uil uil-star mr-2"></i>Laporan Rating
                            </a>
                            <a href="{{ route('seller.reports.restock') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-slate-700">
                                <i class="uil uil-exclamation-triangle mr-2"></i>Restock Alert
                            </a>
                        </div>
                    </div>
                </div>
                <a href="{{ route('products.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium text-gray-300 hover:text-white hover:bg-slate-800/50 transition-all">
                    <i class="uil uil-store text-base"></i>
                    <span>Market</span>
                </a>
            </div>

            {{-- Right Menu --}}
            <div class="flex items-center gap-3">
                {{-- User Info --}}
                <div class="hidden sm:flex items-center gap-2 px-3 py-2 bg-slate-800/50 rounded-lg border border-slate-700/50">
                    <i class="uil uil-shop text-blue-400"></i>
                    <span class="text-sm text-gray-300">{{ $seller->nama_toko }}</span>
                </div>
                
                {{-- Logout --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium text-red-400 hover:text-red-300 hover:bg-red-500/10 transition-all">
                        <i class="uil uil-sign-out-alt text-base"></i>
                        <span class="hidden sm:inline">Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<main class="flex-1 pt-24 pb-12 px-4">
    <div class="container mx-auto max-w-7xl">
        
        {{-- HEADER DENGAN STATUS TOKO --}}
        <div class="bg-slate-800/50 backdrop-blur-lg rounded-2xl shadow-2xl border border-blue-500/30 p-6 sm:p-8 mb-6 fade-in-up">
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                <div class="flex-1">
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white mb-2">{{ $seller->nama_toko }}</h1>
                    <p class="text-gray-400 mb-4 text-sm sm:text-base">{{ $seller->deskripsi_singkat }}</p>
                    <div class="flex flex-wrap items-center gap-2 sm:gap-3">
                        <span class="text-xs sm:text-sm text-gray-400">Status:</span>
                        @if($seller->status === 'approved')
                            <span class="px-3 py-1.5 bg-green-500/20 text-green-400 rounded-full text-xs sm:text-sm font-semibold border border-green-500/40 shadow-lg shadow-green-500/10">
                                <i class="uil uil-check-circle"></i> Terverifikasi
                            </span>
                        @elseif($seller->status === 'pending')
                            <span class="px-3 py-1.5 bg-yellow-500/20 text-yellow-400 rounded-full text-xs sm:text-sm font-semibold border border-yellow-500/40 shadow-lg shadow-yellow-500/10">
                                <i class="uil uil-clock"></i> Menunggu Verifikasi
                            </span>
                        @else
                            <span class="px-3 py-1.5 bg-red-500/20 text-red-400 rounded-full text-xs sm:text-sm font-semibold border border-red-500/40 shadow-lg shadow-red-500/10">
                                <i class="uil uil-times-circle"></i> Ditolak
                            </span>
                        @endif
                    </div>
                </div>
                @if($seller->status === 'approved')
                <a href="{{ route('seller.products.create') }}" class="px-4 sm:px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2 text-sm sm:text-base">
                    <i class="uil uil-plus text-lg"></i>
                    <span>Tambah Produk</span>
                </a>
                @endif
            </div>
        </div>

        @if($seller->status === 'pending')
        {{-- NOTIFIKASI PENDING --}}
        <div class="bg-gradient-to-r from-yellow-500/10 to-orange-500/10 border border-yellow-500/40 rounded-xl p-4 sm:p-6 mb-6 shadow-xl fade-in-up">
            <div class="flex items-start gap-3 sm:gap-4">
                <div class="flex-shrink-0 p-2 bg-yellow-500/20 rounded-lg">
                    <i class="uil uil-exclamation-triangle text-2xl sm:text-3xl text-yellow-400"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <h3 class="text-base sm:text-lg font-semibold text-yellow-400 mb-2">Toko Menunggu Verifikasi</h3>
                    <p class="text-gray-300 text-xs sm:text-sm leading-relaxed">
                        Pendaftaran toko Anda sedang dalam proses verifikasi oleh admin. 
                        Anda akan menerima email notifikasi setelah proses verifikasi selesai.
                        Biasanya proses ini memakan waktu 1-3 hari kerja.
                    </p>
                </div>
            </div>
        </div>
        @elseif($seller->status === 'rejected')
        {{-- NOTIFIKASI REJECTED --}}
        <div class="bg-gradient-to-r from-red-500/10 to-pink-500/10 border border-red-500/40 rounded-xl p-4 sm:p-6 mb-6 shadow-xl fade-in-up">
            <div class="flex items-start gap-3 sm:gap-4">
                <div class="flex-shrink-0 p-2 bg-red-500/20 rounded-lg">
                    <i class="uil uil-times-circle text-2xl sm:text-3xl text-red-400"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <h3 class="text-base sm:text-lg font-semibold text-red-400 mb-2">Pendaftaran Toko Ditolak</h3>
                    <p class="text-gray-300 text-xs sm:text-sm mb-3 leading-relaxed">{{ $seller->rejection_reason ?? 'Alasan tidak disebutkan.' }}</p>
                    <p class="text-gray-400 text-xs">
                        Silakan hubungi admin atau perbaiki data pendaftaran Anda.
                    </p>
                </div>
            </div>
        </div>
        @endif

        @if($seller->status === 'approved')
        {{-- STATISTIK CARDS --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6">
            {{-- Total Produk --}}
            <div class="bg-slate-800/50 backdrop-blur-lg rounded-xl p-6 border border-slate-700/50 card-hover fade-in-up">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-gradient-to-br from-blue-500/30 to-blue-600/30 rounded-lg shadow-lg">
                        <i class="uil uil-package text-2xl text-blue-400"></i>
                    </div>
                    <span class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Total</span>
                </div>
                <h3 class="text-3xl sm:text-4xl font-bold text-white mb-1">{{ $totalProducts }}</h3>
                <p class="text-sm text-gray-400">Produk</p>
            </div>

            {{-- Total Stok --}}
            <div class="bg-slate-800/50 backdrop-blur-lg rounded-xl p-6 border border-slate-700/50 card-hover fade-in-up" style="animation-delay: 0.1s;">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-gradient-to-br from-green-500/30 to-green-600/30 rounded-lg shadow-lg">
                        <i class="uil uil-layers text-2xl text-green-400"></i>
                    </div>
                    <span class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Total</span>
                </div>
                <h3 class="text-3xl sm:text-4xl font-bold text-white mb-1">{{ $totalStock }}</h3>
                <p class="text-sm text-gray-400">Item Stok</p>
            </div>

            {{-- Stok Menipis --}}
            <div class="bg-slate-800/50 backdrop-blur-lg rounded-xl p-6 border border-slate-700/50 card-hover fade-in-up" style="animation-delay: 0.2s;">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-gradient-to-br from-orange-500/30 to-orange-600/30 rounded-lg shadow-lg">
                        <i class="uil uil-exclamation-triangle text-2xl text-orange-400"></i>
                    </div>
                    <span class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Perlu Restock</span>
                </div>
                <h3 class="text-3xl sm:text-4xl font-bold text-white mb-1">{{ $lowStockProducts }}</h3>
                <p class="text-sm text-gray-400">Stok < 10</p>
            </div>

            {{-- Rating Toko (placeholder) --}}
            <div class="bg-slate-800/50 backdrop-blur-lg rounded-xl p-6 border border-slate-700/50 card-hover fade-in-up" style="animation-delay: 0.3s;">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-gradient-to-br from-yellow-500/30 to-yellow-600/30 rounded-lg shadow-lg">
                        <i class="uil uil-star text-2xl text-yellow-400"></i>
                    </div>
                    <span class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Rating</span>
                </div>
                <h3 class="text-3xl sm:text-4xl font-bold text-white mb-1">-</h3>
                <p class="text-sm text-gray-400">Coming Soon</p>
            </div>
        </div>

        {{-- TABEL PRODUK TERBARU --}}
        <div class="bg-slate-800/50 backdrop-blur-lg rounded-xl shadow-2xl border border-slate-700/50 p-4 sm:p-6 mb-6 fade-in-up">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg sm:text-xl font-semibold text-white">Produk Terbaru</h2>
                <a href="{{ route('seller.products.index') }}" class="text-xs sm:text-sm text-blue-400 hover:text-blue-300 transition-colors duration-200 flex items-center gap-1">
                    <span>Lihat Semua</span>
                    <i class="uil uil-arrow-right"></i>
                </a>
            </div>

            @if($products->count() > 0)
            <div class="overflow-x-auto -mx-4 sm:mx-0">
                <div class="inline-block min-w-full align-middle">
                    <table class="min-w-full">
                        <thead>
                            <tr class="border-b border-slate-700">
                                <th class="text-left py-3 px-4 text-xs sm:text-sm font-semibold text-gray-400 uppercase tracking-wider">Produk</th>
                                <th class="text-left py-3 px-4 text-xs sm:text-sm font-semibold text-gray-400 uppercase tracking-wider hidden md:table-cell">Kategori</th>
                                <th class="text-left py-3 px-4 text-xs sm:text-sm font-semibold text-gray-400 uppercase tracking-wider">Harga</th>
                                <th class="text-left py-3 px-4 text-xs sm:text-sm font-semibold text-gray-400 uppercase tracking-wider">Stok</th>
                                <th class="text-left py-3 px-4 text-xs sm:text-sm font-semibold text-gray-400 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr class="border-b border-slate-700/50 hover:bg-slate-700/30 transition-colors duration-200">
                                <td class="py-4 px-4">
                                    <div class="flex items-center gap-3">
                                        @if($product->image_url)
                                        <img src="{{ Storage::url($product->image_url) }}" alt="{{ $product->name }}" class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg object-cover ring-2 ring-slate-700">
                                        @else
                                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg bg-gradient-to-br from-slate-700 to-slate-800 flex items-center justify-center ring-2 ring-slate-700">
                                            <i class="uil uil-image text-gray-500"></i>
                                        </div>
                                        @endif
                                        <div class="min-w-0 flex-1">
                                            <p class="text-white font-medium text-sm sm:text-base truncate">{{ $product->name }}</p>
                                            <p class="text-xs text-gray-400 truncate hidden sm:block">{{ Str::limit($product->description, 40) }}</p>
                                            <span class="md:hidden mt-1 inline-block px-2 py-0.5 bg-blue-500/20 text-blue-400 rounded text-xs">
                                                {{ ucfirst(str_replace('-', ' ', $product->category_slug)) }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-4 hidden md:table-cell">
                                    <span class="px-2.5 py-1 bg-blue-500/20 text-blue-400 rounded-lg text-xs font-medium border border-blue-500/30">
                                        {{ ucfirst(str_replace('-', ' ', $product->category_slug)) }}
                                    </span>
                                </td>
                                <td class="py-4 px-4">
                                    <span class="text-white font-semibold text-sm sm:text-base whitespace-nowrap">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td class="py-4 px-4">
                                    @if($product->stock < 10)
                                    <span class="px-2 py-1 bg-orange-500/20 text-orange-400 rounded-lg text-xs sm:text-sm font-bold border border-orange-500/30">{{ $product->stock }}</span>
                                    @else
                                    <span class="px-2 py-1 bg-green-500/20 text-green-400 rounded-lg text-xs sm:text-sm font-bold border border-green-500/30">{{ $product->stock }}</span>
                                    @endif
                                </td>
                                <td class="py-4 px-4">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('products.show', $product) }}" class="p-2 text-blue-400 hover:text-blue-300 hover:bg-blue-500/10 rounded-lg transition-all duration-200" title="Lihat">
                                            <i class="uil uil-eye text-lg"></i>
                                        </a>
                                        <a href="{{ route('seller.products.edit', $product) }}" class="p-2 text-yellow-400 hover:text-yellow-300 hover:bg-yellow-500/10 rounded-lg transition-all duration-200" title="Edit">
                                            <i class="uil uil-edit text-lg"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @else
            <div class="text-center py-12">
                <div class="mb-4">
                    <i class="uil uil-box text-5xl sm:text-6xl text-gray-600"></i>
                </div>
                <p class="text-gray-400 mb-6 text-sm sm:text-base">Belum ada produk</p>
                <a href="{{ route('seller.products.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    <i class="uil uil-plus"></i>
                    <span>Tambah Produk Pertama</span>
                </a>
            </div>
            @endif
        </div>

        {{-- INFORMASI TOKO --}}
        <div class="bg-slate-800/50 backdrop-blur-lg rounded-xl shadow-2xl border border-slate-700/50 p-4 sm:p-6 fade-in-up">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-2 bg-gradient-to-br from-blue-500/30 to-cyan-500/30 rounded-lg">
                    <i class="uil uil-info-circle text-2xl text-blue-400"></i>
                </div>
                <h2 class="text-lg sm:text-xl font-semibold text-white">Informasi Toko</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                <div class="p-4 bg-slate-900/30 rounded-lg border border-slate-700/30">
                    <p class="text-xs sm:text-sm text-gray-400 mb-2 flex items-center gap-2">
                        <i class="uil uil-user"></i>
                        Nama PIC
                    </p>
                    <p class="text-white font-medium text-sm sm:text-base">{{ $seller->nama_pic }}</p>
                </div>
                <div class="p-4 bg-slate-900/30 rounded-lg border border-slate-700/30">
                    <p class="text-xs sm:text-sm text-gray-400 mb-2 flex items-center gap-2">
                        <i class="uil uil-envelope"></i>
                        Email PIC
                    </p>
                    <p class="text-white font-medium text-sm sm:text-base break-all">{{ $seller->email_pic }}</p>
                </div>
                <div class="p-4 bg-slate-900/30 rounded-lg border border-slate-700/30">
                    <p class="text-xs sm:text-sm text-gray-400 mb-2 flex items-center gap-2">
                        <i class="uil uil-phone"></i>
                        No. HP PIC
                    </p>
                    <p class="text-white font-medium text-sm sm:text-base">{{ $seller->no_hp_pic }}</p>
                </div>
                <div class="p-4 bg-slate-900/30 rounded-lg border border-slate-700/30">
                    <p class="text-xs sm:text-sm text-gray-400 mb-2 flex items-center gap-2">
                        <i class="uil uil-location-point"></i>
                        Lokasi
                    </p>
                    <p class="text-white font-medium text-sm sm:text-base">{{ $seller->kota }}, {{ $seller->provinsi }}</p>
                </div>
                <div class="sm:col-span-2 p-4 bg-slate-900/30 rounded-lg border border-slate-700/30">
                    <p class="text-xs sm:text-sm text-gray-400 mb-2 flex items-center gap-2">
                        <i class="uil uil-map-marker"></i>
                        Alamat Lengkap
                    </p>
                    <p class="text-white font-medium text-sm sm:text-base leading-relaxed">
                        {{ $seller->alamat_pic }}, RT {{ $seller->rt }} / RW {{ $seller->rw }}, 
                        Kel. {{ $seller->kelurahan }}, {{ $seller->kota }}, {{ $seller->provinsi }}
                    </p>
                </div>
            </div>
        </div>
        @endif

    </div>
</main>

{{-- FOOTER --}}
<footer class="bg-slate-900/80 border-t border-slate-800 py-6 mt-auto">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-gray-400 text-sm text-center sm:text-left">
                © 2025 <span class="font-semibold text-blue-400">KampuStore</span>. All rights reserved.
            </p>
            <div class="flex items-center gap-6">
                <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200 text-sm">
                    Bantuan
                </a>
                <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200 text-sm">
                    Kebijakan
                </a>
                <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200 text-sm">
                    Kontak
                </a>
            </div>
        </div>
    </div>
</footer>

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

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
