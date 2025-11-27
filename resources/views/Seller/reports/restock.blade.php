<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Restock - {{ $seller->nama_toko }} | kampuStore</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        * { font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .fade-in { animation: fadeIn 0.6s ease-out; }
        @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.5; } }
        .pulse-animation { animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
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
                            <a href="{{ route('seller.reports.rating') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-slate-700">
                                <i class="uil uil-star mr-2"></i>Laporan Rating
                            </a>
                            <a href="{{ route('seller.reports.restock') }}" class="block px-4 py-2 text-sm text-white bg-blue-500/10">
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
            <h1 class="text-3xl font-bold text-white mb-2">Laporan Daftar Produk Segera Dipesan</h1>
            <p class="text-gray-400">Toko: {{ $seller->nama_toko }}</p>
            <p class="text-gray-500 text-sm mt-1">Tanggal dibuat: {{ now()->format('d-m-Y') }} oleh {{ Auth::user()->name }}</p>
        </div>

        @if($products->count() > 0)
        <div class="bg-red-500/10 border border-red-500/40 rounded-2xl p-6 mb-6 fade-in">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0 p-3 bg-red-500/20 rounded-lg pulse-animation">
                    <i class="uil uil-exclamation-triangle text-3xl text-red-400"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-red-400 mb-2">⚠️ Peringatan Stok Rendah!</h3>
                    <p class="text-gray-300 text-sm">Anda memiliki <strong class="text-red-400">{{ $products->count() }} produk</strong> dengan stok di bawah {{ $threshold }} unit. Segera lakukan restock untuk menghindari kehabisan barang.</p>
                </div>
            </div>
        </div>
        @endif

        <div class="bg-slate-800/50 rounded-2xl border border-blue-500/30 p-6 mb-6 fade-in no-print">
            <div class="flex justify-between items-center">
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <p class="text-gray-400 text-sm">Produk Perlu Restock</p>
                        <p class="text-3xl font-bold text-red-400">{{ $products->count() }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">Threshold</p>
                        <p class="text-3xl font-bold text-blue-400">{{ $threshold }} unit</p>
                    </div>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('seller.reports.restock.export') }}" class="bg-green-600 text-white px-4 py-2.5 rounded-lg hover:bg-green-700 transition inline-flex items-center">
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
                <h2 class="text-lg font-bold text-white">Daftar Produk (Urutan berdasarkan Kategori & Produk)</h2>
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
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/50">
                        @forelse($products as $index => $product)
                        <tr class="hover:bg-slate-700/30 {{ $product->stock == 0 ? 'bg-red-500/5' : '' }}">
                            <td class="px-6 py-4 text-sm text-gray-300">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if($product->stock == 0)
                                        <div class="pulse-animation">
                                            <i class="uil uil-ban text-red-500 text-xl"></i>
                                        </div>
                                    @elseif($product->stock < 5)
                                        <div class="pulse-animation">
                                            <i class="uil uil-exclamation-triangle text-yellow-500 text-xl"></i>
                                        </div>
                                    @endif
                                    <span class="text-sm text-white font-medium">{{ $product->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-300">{{ ucfirst(str_replace('-', ' ', $product->category_slug)) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-300">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-bold rounded-full {{ $product->stock == 0 ? 'bg-red-500/20 text-red-400 pulse-animation' : 'bg-yellow-500/20 text-yellow-400' }}">
                                    {{ $product->stock == 0 ? 'HABIS' : $product->stock . ' unit' }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="uil uil-check-circle text-6xl text-green-500 mb-3"></i>
                                    <p class="text-lg font-semibold text-green-400">Semua Produk Aman!</p>
                                    <p class="text-sm text-gray-500 mt-1">Tidak ada produk yang memerlukan restock saat ini</p>
                                </div>
                            </td>
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
