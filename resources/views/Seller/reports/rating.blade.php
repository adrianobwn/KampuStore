<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Rating Produk - {{ $seller->nama_toko }} | kampuStore</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        * { font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .fade-in { animation: fadeIn 0.6s ease-out; }
        @media print { body { background: white; } .no-print { display: none; } }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 min-h-screen">

{{-- NAVBAR --}}
<nav class="fixed top-0 left-0 right-0 z-50 bg-slate-900/95 backdrop-blur-xl border-b border-blue-500/30 shadow-lg no-print">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <a href="{{ route('seller.dashboard') }}" class="flex items-center gap-2">
                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-lg flex items-center justify-center">
                    <i class="uil uil-shop text-white text-lg"></i>
                </div>
                <span class="text-xl sm:text-2xl font-bold bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent">kampuStore</span>
            </a>
            
            <div class="hidden md:flex items-center gap-6">
                <a href="{{ route('seller.dashboard') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium text-gray-300 hover:text-white hover:bg-slate-800/50 transition-all">
                    <i class="uil uil-dashboard text-base"></i><span>Dashboard</span>
                </a>
                <a href="{{ route('seller.products.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium text-gray-300 hover:text-white hover:bg-slate-800/50 transition-all">
                    <i class="uil uil-box text-base"></i><span>Produk Saya</span>
                </a>
                <div class="relative" x-data="{ openReports: false }">
                    <button @click="openReports = !openReports" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium text-white bg-blue-500/20 border border-blue-500/40">
                        <i class="uil uil-chart-line text-base"></i><span>Laporan</span><i class="uil uil-angle-down ml-1"></i>
                    </button>
                    <div x-show="openReports" @click.away="openReports = false" class="absolute left-0 mt-2 w-56 rounded-lg shadow-lg bg-slate-800 border border-blue-500/30" style="display: none;">
                        <div class="py-2">
                            <a href="{{ route('seller.reports.stock') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-slate-700">
                                <i class="uil uil-box mr-2"></i>Laporan Stok
                            </a>
                            <a href="{{ route('seller.reports.rating') }}" class="block px-4 py-2 text-sm text-white bg-blue-500/10">
                                <i class="uil uil-star mr-2"></i>Laporan Rating
                            </a>
                            <a href="{{ route('seller.reports.restock') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-slate-700">
                                <i class="uil uil-exclamation-triangle mr-2"></i>Restock Alert
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium text-red-400 hover:text-red-300 hover:bg-red-500/10 transition-all">
                        <i class="uil uil-sign-out-alt text-base"></i><span class="hidden sm:inline">Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<main class="pt-24 pb-12 px-4">
    <div class="container mx-auto max-w-7xl">
        
        <div class="mb-6 fade-in">
            <h1 class="text-3xl font-bold text-white mb-2">Laporan Daftar Produk Berdasarkan Rating</h1>
            <p class="text-gray-400">Toko: {{ $seller->nama_toko }}</p>
            <p class="text-gray-500 text-sm mt-1">Tanggal dibuat: {{ now()->format('d-m-Y') }} oleh {{ Auth::user()->name }}</p>
        </div>

        <div class="bg-slate-800/50 rounded-2xl border border-blue-500/30 p-6 mb-6 fade-in no-print">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-400 text-sm">Total Produk</p>
                    <p class="text-3xl font-bold text-blue-400">{{ $products->count() }}</p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('seller.reports.rating.export') }}" class="bg-green-600 text-white px-4 py-2.5 rounded-lg hover:bg-green-700 transition inline-flex items-center">
                        <i class="uil uil-file-download-alt mr-1"></i>Excel
                    </a>
                    <button onclick="window.print()" class="bg-blue-600 text-white px-4 py-2.5 rounded-lg hover:bg-blue-700 transition">
                        <i class="uil uil-print"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="bg-slate-800/50 backdrop-blur-lg rounded-2xl border border-blue-500/30 overflow-hidden fade-in">
            <div class="p-6 border-b border-blue-500/20">
                <h2 class="text-lg font-bold text-white">Daftar Produk (Urutan berdasarkan Rating)</h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-slate-700/50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Produk</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Harga</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Stock</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Rating</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/50">
                        @forelse($products as $index => $product)
                        <tr class="hover:bg-slate-700/30">
                            <td class="px-6 py-4 text-sm text-gray-300">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 text-sm text-white font-medium">{{ $product->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-300">{{ ucfirst(str_replace('-', ' ', $product->category_slug)) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-300">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $product->stock > 10 ? 'bg-green-500/20 text-green-400' : ($product->stock > 0 ? 'bg-yellow-500/20 text-yellow-400' : 'bg-red-500/20 text-red-400') }}">
                                    {{ $product->stock }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= floor($product->avg_rating))
                                            <i class="uil uil-star text-yellow-400 text-lg"></i>
                                        @elseif($i - 0.5 <= $product->avg_rating)
                                            <i class="uil uil-star-half-alt text-yellow-400 text-lg"></i>
                                        @else
                                            <i class="uil uil-star text-gray-600 text-lg"></i>
                                        @endif
                                    @endfor
                                    <span class="text-sm font-bold text-yellow-400">{{ number_format($product->avg_rating, 2) }}</span>
                                    <span class="text-xs text-gray-500">({{ $product->review_count }} review)</span>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">Tidak ada produk</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
