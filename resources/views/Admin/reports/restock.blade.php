<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Restock Barang | kampuStore Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        * { font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }
        body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; }
        .gradient-text { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .fade-in { animation: fadeIn 0.6s ease-out; }
        @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.5; } }
        .pulse-animation { animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
        @media print {
            body { background: white; }
            .no-print { display: none; }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-purple-50 to-indigo-100">

    {{-- Navbar --}}
    <nav class="bg-white border-b border-gray-200 fixed w-full z-50 top-0 shadow-sm no-print">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3">
                        <img src="{{ asset('images/logo.png') }}" alt="kampuStore" class="h-10 w-10">
                        <span class="text-2xl font-bold gradient-text">kampuStore</span>
                    </a>
                    
                    <div class="hidden md:ml-10 md:flex md:space-x-8">
                        <a href="{{ route('admin.dashboard') }}" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            <i class="uil uil-estate mr-2"></i>Dashboard
                        </a>
                        <a href="{{ route('admin.sellers.index') }}" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            <i class="uil uil-store mr-2"></i>Pengajuan Toko
                        </a>
                        <a href="{{ route('admin.reports.sellers') }}" class="border-purple-600 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            <i class="uil uil-chart-line mr-2"></i>Laporan
                        </a>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-3 focus:outline-none">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-purple-600 to-indigo-600 flex items-center justify-center text-white font-bold">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        </button>
                        
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-56 rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5" style="display: none;">
                            <div class="p-4 border-b border-gray-100">
                                <p class="font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                                <p class="text-sm text-gray-500">Admin</p>
                            </div>
                            <div class="py-2">
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    <i class="uil uil-estate mr-2"></i>Dashboard
                                </a>
                            </div>
                            <div class="border-t border-gray-100 p-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded">
                                        <i class="uil uil-sign-out-alt mr-2"></i>Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="pt-20 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            
            {{-- Header --}}
            <div class="mb-8 fade-in">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900 mb-2">Laporan Restock Barang</h1>
                        <p class="text-gray-600">SRS-MartPlace-14: Produk yang memerlukan restock segera</p>
                    </div>
                    <div class="text-right no-print">
                        <p class="text-sm text-gray-500">{{ now()->format('d F Y') }}</p>
                        <p class="text-2xl font-bold text-red-600 pulse-animation">{{ $totalLowStock }}</p>
                        <p class="text-xs text-gray-500">Produk Perlu Restock</p>
                    </div>
                </div>

                {{-- Stats Overview --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-red-800">URGENT (Stok &lt; 5)</p>
                                <p class="text-2xl font-bold text-red-900">{{ $urgentCount }}</p>
                                <p class="text-xs text-red-700 mt-1">Restock Segera!</p>
                            </div>
                            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center pulse-animation">
                                <i class="uil uil-exclamation-triangle text-red-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-yellow-800">Low Stock (Stok &lt; {{ $threshold }})</p>
                                <p class="text-2xl font-bold text-yellow-900">{{ $totalLowStock }}</p>
                                <p class="text-xs text-yellow-700 mt-1">Total Produk</p>
                            </div>
                            <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                                <i class="uil uil-box text-yellow-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-blue-800">Threshold</p>
                                <p class="text-2xl font-bold text-blue-900">{{ $threshold }} unit</p>
                                <p class="text-xs text-blue-700 mt-1">Batas Minimum</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="uil uil-sliders-v-alt text-blue-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Filter --}}
            <div class="bg-white rounded-2xl shadow-md p-6 mb-6 fade-in no-print">
                <form method="GET" action="{{ route('admin.reports.restock') }}" class="flex items-end gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Threshold (Batas Stok)</label>
                        <select name="threshold" class="rounded-lg border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                            <option value="5" {{ request('threshold', 10) == 5 ? 'selected' : '' }}>Stok &lt; 5</option>
                            <option value="10" {{ request('threshold', 10) == 10 ? 'selected' : '' }}>Stok &lt; 10</option>
                            <option value="15" {{ request('threshold', 10) == 15 ? 'selected' : '' }}>Stok &lt; 15</option>
                            <option value="20" {{ request('threshold', 10) == 20 ? 'selected' : '' }}>Stok &lt; 20</option>
                        </select>
                    </div>
                    
                    <div class="flex space-x-2">
                        <button type="submit" class="bg-purple-600 text-white px-4 py-2.5 rounded-lg hover:bg-purple-700 transition">
                            <i class="uil uil-filter mr-2"></i>Filter
                        </button>
                        <button type="button" onclick="window.print()" class="bg-green-600 text-white px-4 py-2.5 rounded-lg hover:bg-green-700 transition">
                            <i class="uil uil-print"></i>
                        </button>
                    </div>
                </form>
                
                <div class="mt-4 p-3 bg-red-50 rounded-lg border border-red-200">
                    <p class="text-sm text-red-800">
                        <i class="uil uil-info-circle mr-1"></i>
                        <strong>Alert:</strong> Menampilkan produk dengan stok di bawah <strong>{{ $threshold }} unit</strong>. Segera lakukan restock untuk produk dengan label URGENT.
                    </p>
                </div>
            </div>

            {{-- Table --}}
            <div class="bg-white rounded-2xl shadow-md overflow-hidden fade-in">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-lg font-bold text-gray-900">Daftar Produk Perlu Restock</h2>
                    <p class="text-sm text-gray-500">Diurutkan dari stok paling sedikit</p>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Toko</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kontak PIC</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok Saat Ini</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($products as $product)
                            <tr class="hover:bg-gray-50 {{ $product->stock < 5 ? 'bg-red-50' : '' }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($product->stock == 0)
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-600 text-white pulse-animation">
                                            <i class="uil uil-ban"></i> HABIS
                                        </span>
                                    @elseif($product->stock < 5)
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-500 text-white pulse-animation">
                                            <i class="uil uil-exclamation-octagon"></i> URGENT
                                        </span>
                                    @else
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            <i class="uil uil-exclamation-triangle"></i> LOW
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        @if($product->image_url)
                                            <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="w-12 h-12 rounded-lg object-cover mr-3">
                                        @endif
                                        <div>
                                            <div class="font-medium text-gray-900">{{ $product->name }}</div>
                                            <div class="text-xs text-gray-500">{{ ucfirst(str_replace('-', ' ', $product->category_slug)) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $product->nama_toko }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    <div>
                                        <i class="uil uil-phone mr-1"></i>{{ $product->no_hp_pic }}
                                    </div>
                                    <div class="text-xs text-gray-400 mt-1">
                                        <i class="uil uil-envelope mr-1"></i>{{ $product->email_pic }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if($product->stock == 0)
                                            <div class="w-4 h-4 rounded-full bg-red-600 mr-2 pulse-animation"></div>
                                            <span class="text-2xl font-bold text-red-600">{{ $product->stock }}</span>
                                        @elseif($product->stock < 5)
                                            <div class="w-4 h-4 rounded-full bg-red-500 mr-2 pulse-animation"></div>
                                            <span class="text-2xl font-bold text-red-600">{{ $product->stock }}</span>
                                        @else
                                            <div class="w-4 h-4 rounded-full bg-yellow-500 mr-2"></div>
                                            <span class="text-2xl font-bold text-yellow-600">{{ $product->stock }}</span>
                                        @endif
                                        <span class="ml-1 text-xs text-gray-500">unit</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <i class="uil uil-check-circle text-6xl text-green-500 mb-3"></i>
                                        <p class="text-lg font-semibold text-gray-700">Semua Produk Aman!</p>
                                        <p class="text-sm text-gray-500 mt-1">Tidak ada produk yang memerlukan restock saat ini</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if($totalLowStock > 0)
            <div class="mt-6 bg-purple-600 text-white rounded-2xl shadow-md p-6 fade-in no-print">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold mb-2">
                            <i class="uil uil-bell mr-2"></i>Tindakan yang Disarankan
                        </h3>
                        <ul class="space-y-1 text-sm opacity-90">
                            <li>✓ Hubungi penjual untuk konfirmasi restock</li>
                            <li>✓ Prioritaskan produk dengan label URGENT</li>
                            <li>✓ Monitor stok secara berkala</li>
                        </ul>
                    </div>
                    <div class="text-right">
                        <div class="text-4xl font-bold">{{ $urgentCount }}</div>
                        <div class="text-sm opacity-75">Produk Urgent</div>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </main>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
