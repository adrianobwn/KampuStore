@extends('layouts.admin')

@section('content')
    <!-- Header -->
    <div class="mb-8">
        <div class="flex justify-between items-center flex-wrap gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Dashboard Admin</h1>
                <p class="text-gray-600 dark:text-gray-400">Kelola pengajuan toko dan pantau aktivitas marketplace</p>
            </div>
            <div class="text-right bg-gradient-to-br from-orange-500 to-orange-600 px-6 py-4 rounded-xl shadow-lg text-white">
                <div class="text-sm opacity-90 mb-1">{{ now()->format('d F Y') }}</div>
                <div class="text-3xl font-bold">{{ $total }}</div>
                <div class="text-sm opacity-90">Total Pengajuan</div>
            </div>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="card p-6 hover:scale-105 transition-transform duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">Pending</div>
                    <div class="text-3xl font-bold text-yellow-600 dark:text-yellow-400">{{ $pending }}</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-2">{{ $pPct }}% dari total</div>
                </div>
                <div class="w-16 h-16 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-2xl flex items-center justify-center shadow-lg">
                    <i class="uil uil-clock text-white text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="card p-6 hover:scale-105 transition-transform duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">Disetujui</div>
                    <div class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $approved }}</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-2">{{ $aPct }}% dari total</div>
                </div>
                <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-green-500 rounded-2xl flex items-center justify-center shadow-lg">
                    <i class="uil uil-check-circle text-white text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="card p-6 hover:scale-105 transition-transform duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">Ditolak</div>
                    <div class="text-3xl font-bold text-red-600 dark:text-red-400">{{ $rejected }}</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-2">{{ $rPct }}% dari total</div>
                </div>
                <div class="w-16 h-16 bg-gradient-to-br from-red-400 to-red-500 rounded-2xl flex items-center justify-center shadow-lg">
                    <i class="uil uil-times-circle text-white text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row 1 -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Seller Statistics -->
        <div class="card p-6">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Statistik Penjual</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Jumlah penjual aktif dan tidak aktif</p>
                </div>
                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
                    <i class="uil uil-users-alt text-white"></i>
                </div>
            </div>

            <div class="flex justify-center items-end space-x-12 h-48 mb-4 bg-gray-50 dark:bg-gray-800 rounded-xl p-4">
                <div class="flex flex-col items-center">
                    <div class="text-lg font-bold text-gray-900 dark:text-white mb-2">{{ $approved }}</div>
                    <div class="w-20 bg-gradient-to-t from-green-500 to-green-400 rounded-t-lg shadow-lg transition-all hover:scale-105"
                         style="height: {{ max(30, ($total > 0 ? ($approved / $total) * 100 : 0) * 1.5) }}px;"></div>
                    <div class="text-xs text-gray-600 dark:text-gray-400 mt-3 font-medium">Aktif</div>
                </div>
                <div class="flex flex-col items-center">
                    <div class="text-lg font-bold text-gray-900 dark:text-white mb-2">{{ $pending + $rejected }}</div>
                    <div class="w-20 bg-gradient-to-t from-red-500 to-red-400 rounded-t-lg shadow-lg transition-all hover:scale-105"
                         style="height: {{ max(30, ($total > 0 ? (($pending + $rejected) / $total) * 100 : 0) * 1.5) }}px;"></div>
                    <div class="text-xs text-gray-600 dark:text-gray-400 mt-3 font-medium">Tidak Aktif</div>
                </div>
            </div>
        </div>

        <!-- Review Statistics -->
        <div class="card p-6">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Statistik Review</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Jumlah reviewer dan ulasan produk</p>
                </div>
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                    <i class="uil uil-star text-white"></i>
                </div>
            </div>

            <div class="flex justify-center items-end space-x-12 h-48 mb-4 bg-gray-50 dark:bg-gray-800 rounded-xl p-4">
                <div class="flex flex-col items-center">
                    <div class="text-lg font-bold text-gray-900 dark:text-white mb-2">{{ $totalReviews }}</div>
                    <div class="w-20 bg-gradient-to-t from-blue-500 to-blue-400 rounded-t-lg shadow-lg transition-all hover:scale-105"
                         style="height: {{ max(30, min(140, ($totalReviews / 10) * 1.5)) }}px;"></div>
                    <div class="text-xs text-gray-600 dark:text-gray-400 mt-3 font-medium">Total Review</div>
                </div>
                <div class="flex flex-col items-center">
                    <div class="text-lg font-bold text-gray-900 dark:text-white mb-2">{{ $uniqueReviewers }}</div>
                    <div class="w-20 bg-gradient-to-t from-orange-500 to-orange-400 rounded-t-lg shadow-lg transition-all hover:scale-105"
                         style="height: {{ max(30, min(140, ($uniqueReviewers / 10) * 1.5)) }}px;"></div>
                    <div class="text-xs text-gray-600 dark:text-gray-400 mt-3 font-medium">Unique Reviewer</div>
                </div>
            </div>

            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-3">
                        <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">User Terdaftar</div>
                        <div class="text-xl font-bold text-gray-900 dark:text-white">{{ $userReviewers }}</div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-3">
                        <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">Guest Reviewer</div>
                        <div class="text-xl font-bold text-gray-900 dark:text-white">{{ $guestReviewers }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row 2 -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Products by Category -->
        <div class="card p-6">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Distribusi Produk per Kategori</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Jumlah produk berdasarkan kategori</p>
                </div>
                <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg flex items-center justify-center">
                    <i class="uil uil-apps text-white"></i>
                </div>
            </div>

            @if($productsByCategory->count() > 0)
                @php($maxCategoryProducts = $productsByCategory->max('total'))
                <div class="flex justify-start items-end space-x-3 h-48 overflow-x-auto pb-4 bg-gray-50 dark:bg-gray-800 rounded-xl p-4">
                    @foreach($productsByCategory->take(8) as $category)
                        <div class="flex flex-col items-center flex-shrink-0 group">
                            <div class="text-sm font-bold text-gray-900 dark:text-white mb-2">{{ $category['total'] }}</div>
                            <div class="w-14 bg-gradient-to-t from-indigo-500 to-indigo-400 rounded-t-lg shadow-lg transition-all hover:scale-105 group-hover:from-indigo-600 group-hover:to-indigo-500"
                                 style="height: {{ max(30, ($category['total'] / $maxCategoryProducts) * 120) }}px;"></div>
                            <div class="text-xs text-gray-600 dark:text-gray-400 mt-3 w-14 text-center truncate font-medium">{{ Str::limit($category['category'], 8) }}</div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16 text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-800 rounded-xl">
                    <i class="uil uil-package text-5xl mb-3 opacity-50"></i>
                    <p class="text-sm">Belum ada data produk per kategori</p>
                </div>
            @endif
        </div>

        <!-- Sellers by Province -->
        <div class="card p-6">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Distribusi Toko per Provinsi</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Jumlah toko berdasarkan lokasi provinsi</p>
                </div>
                <div class="w-10 h-10 bg-gradient-to-br from-pink-500 to-pink-600 rounded-lg flex items-center justify-center">
                    <i class="uil uil-map-marker text-white"></i>
                </div>
            </div>

            @if($sellersByProvince->count() > 0)
                @php($maxProvinceSellers = $sellersByProvince->max('total'))
                <div class="flex justify-start items-end space-x-3 h-48 overflow-x-auto pb-4 bg-gray-50 dark:bg-gray-800 rounded-xl p-4">
                    @foreach($sellersByProvince->take(8) as $province)
                        <div class="flex flex-col items-center flex-shrink-0 group">
                            <div class="text-sm font-bold text-gray-900 dark:text-white mb-2">{{ $province->total }}</div>
                            <div class="w-14 bg-gradient-to-t from-pink-500 to-pink-400 rounded-t-lg shadow-lg transition-all hover:scale-105 group-hover:from-pink-600 group-hover:to-pink-500"
                                 style="height: {{ max(30, ($province->total / $maxProvinceSellers) * 120) }}px;"></div>
                            <div class="text-xs text-gray-600 dark:text-gray-400 mt-3 w-14 text-center truncate font-medium">{{ Str::limit($province->provinsi, 8) }}</div>
                        </div>
                    @endforeach
                </div>

                <div class="border-t border-gray-200 dark:border-gray-700 pt-4 mt-4">
                    <div class="grid grid-cols-2 gap-3">
                        @foreach($sellersByProvince->take(4) as $province)
                            <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-3">
                                <div class="text-xs text-gray-500 dark:text-gray-400 truncate mb-1">{{ $province->provinsi }}</div>
                                <div class="text-lg font-bold text-gray-900 dark:text-white">{{ $province->total }} <span class="text-xs font-normal text-gray-500 dark:text-gray-400">toko</span></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="text-center py-16 text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-800 rounded-xl">
                    <i class="uil uil-map-marker text-5xl mb-3 opacity-50"></i>
                    <p class="text-sm">Belum ada data toko per provinsi</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="{{ route('admin.sellers.index') }}"
           class="card p-6 hover:scale-105 transition-all duration-300 hover:border-orange-300 dark:hover:border-orange-700 group relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-orange-400/20 to-orange-600/20 rounded-full -mr-12 -mt-12 group-hover:scale-150 transition-transform duration-300"></div>
            <div class="flex items-center space-x-4 relative z-10">
                <div class="w-14 h-14 bg-gradient-to-br from-orange-400 to-orange-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                    <i class="uil uil-folder-open text-white text-2xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 dark:text-white text-lg">Lihat Semua Pengajuan</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Kelola pengajuan toko</p>
                </div>
            </div>
        </a>

        <a href="{{ route('products.index') }}"
           class="card p-6 hover:scale-105 transition-all duration-300 hover:border-blue-300 dark:hover:border-blue-700 group relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-blue-400/20 to-blue-600/20 rounded-full -mr-12 -mt-12 group-hover:scale-150 transition-transform duration-300"></div>
            <div class="flex items-center space-x-4 relative z-10">
                <div class="w-14 h-14 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                    <i class="uil uil-shopping-cart text-white text-2xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 dark:text-white text-lg">Ke Market</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Lihat produk marketplace</p>
                </div>
            </div>
        </a>

        <a href="{{ route('home') }}"
           class="card p-6 hover:scale-105 transition-all duration-300 hover:border-green-300 dark:hover:border-green-700 group relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-green-400/20 to-green-600/20 rounded-full -mr-12 -mt-12 group-hover:scale-150 transition-transform duration-300"></div>
            <div class="flex items-center space-x-4 relative z-10">
                <div class="w-14 h-14 bg-gradient-to-br from-green-400 to-green-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                    <i class="uil uil-home text-white text-2xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 dark:text-white text-lg">Beranda</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Kembali ke homepage</p>
                </div>
            </div>
        </a>
    </div>
@endsection