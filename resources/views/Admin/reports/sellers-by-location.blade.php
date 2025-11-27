<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjual per Lokasi | kampuStore Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        * { font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }
        body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; }
        .gradient-text { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .fade-in { animation: fadeIn 0.6s ease-out; }
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
                        <div class="relative" x-data="{ openReports: false }">
                            <button @click="openReports = !openReports" class="border-purple-600 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                <i class="uil uil-chart-line mr-2"></i>Laporan
                                <i class="uil uil-angle-down ml-1"></i>
                            </button>
                            <div x-show="openReports" @click.away="openReports = false" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 class="absolute left-0 mt-2 w-64 rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5"
                                 style="display: none;">
                                <div class="py-2">
                                    <a href="{{ route('admin.reports.sellers') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-50">
                                        <i class="uil uil-users-alt mr-2"></i>Daftar Akun Penjual
                                    </a>
                                    <a href="{{ route('admin.reports.sellers-location') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-50">
                                        <i class="uil uil-map-marker mr-2"></i>Penjual per Lokasi
                                    </a>
                                    <a href="{{ route('admin.reports.product-ranking') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-50">
                                        <i class="uil uil-trophy mr-2"></i>Peringkat Produk
                                    </a>
                                </div>
                            </div>
                        </div>
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
                        <h1 class="text-4xl font-bold text-gray-900 mb-2">Laporan Penjual per Lokasi</h1>
                        <p class="text-gray-600">Distribusi penjual berdasarkan lokasi</p>
                    </div>
                    <div class="text-right no-print">
                        <p class="text-sm text-gray-500">{{ now()->format('d F Y') }}</p>
                        <p class="text-2xl font-bold text-purple-600">{{ $totalSellers }}</p>
                        <p class="text-xs text-gray-500">Total Penjual Approved</p>
                    </div>
                </div>
            </div>

            {{-- Filter --}}
            <div class="bg-white rounded-2xl shadow-md p-6 mb-6 fade-in no-print">
                <form method="GET" action="{{ route('admin.reports.sellers-location') }}" class="flex items-end gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Group By</label>
                        <select name="group_by" class="rounded-lg border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                            <option value="kota" {{ $groupBy == 'kota' ? 'selected' : '' }}>Kota/Kabupaten</option>
                            <option value="kecamatan" {{ $groupBy == 'kecamatan' ? 'selected' : '' }}>Kecamatan</option>
                        </select>
                    </div>
                    
                    <div class="flex space-x-2">
                        <button type="submit" class="bg-purple-600 text-white px-4 py-2.5 rounded-lg hover:bg-purple-700 transition">
                            <i class="uil uil-filter mr-2"></i>Tampilkan
                        </button>
                        <a href="{{ route('admin.reports.sellers-location.export', request()->all()) }}" class="bg-green-600 text-white px-4 py-2.5 rounded-lg hover:bg-green-700 transition inline-flex items-center">
                            <i class="uil uil-file-download-alt mr-1"></i>Excel
                        </a>
                        <button type="button" onclick="window.print()" class="bg-blue-600 text-white px-4 py-2.5 rounded-lg hover:bg-blue-700 transition">
                            <i class="uil uil-print"></i>
                        </button>
                    </div>
                </form>
            </div>

            {{-- Chart --}}
            <div class="bg-white rounded-2xl shadow-md p-6 mb-6 fade-in">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Visualisasi Data</h2>
                <canvas id="locationChart" height="80"></canvas>
            </div>

            {{-- Table --}}
            <div class="bg-white rounded-2xl shadow-md overflow-hidden fade-in">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-lg font-bold text-gray-900">Distribusi Penjual</h2>
                    <p class="text-sm text-gray-500">Group by: {{ ucfirst($groupBy) }}</p>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ ucfirst($groupBy) }}</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Penjual</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Persentase</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($sellersByLocation as $index => $location)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-medium text-gray-900">{{ $location->$groupBy ?: 'Tidak Disebutkan' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="text-lg font-bold text-purple-600">{{ $location->total }}</span>
                                        <span class="ml-2 text-sm text-gray-500">penjual</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-32 bg-gray-200 rounded-full h-2 mr-3">
                                            <div class="bg-purple-600 h-2 rounded-full" style="width: {{ $totalSellers > 0 ? ($location->total / $totalSellers * 100) : 0 }}%"></div>
                                        </div>
                                        <span class="text-sm font-medium text-gray-900">
                                            {{ $totalSellers > 0 ? number_format($location->total / $totalSellers * 100, 1) : 0 }}%
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                    <i class="uil uil-inbox text-4xl mb-2 block"></i>
                                    Tidak ada data penjual
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr>
                                <td colspan="2" class="px-6 py-4 text-right font-bold text-gray-900">TOTAL</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-lg font-bold text-purple-600">{{ $totalSellers }}</span>
                                    <span class="ml-2 text-sm text-gray-500">penjual</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-medium text-gray-900">100%</span>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </main>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        const ctx = document.getElementById('locationChart');
        const data = {
            labels: [
                @foreach($sellersByLocation as $location)
                    '{{ $location->$groupBy ?: "Tidak Disebutkan" }}',
                @endforeach
            ],
            datasets: [{
                label: 'Jumlah Penjual',
                data: [
                    @foreach($sellersByLocation as $location)
                        {{ $location->total }},
                    @endforeach
                ],
                backgroundColor: [
                    'rgba(102, 126, 234, 0.8)',
                    'rgba(118, 75, 162, 0.8)',
                    'rgba(237, 100, 166, 0.8)',
                    'rgba(255, 154, 158, 0.8)',
                    'rgba(250, 208, 196, 0.8)',
                ],
                borderColor: [
                    'rgba(102, 126, 234, 1)',
                    'rgba(118, 75, 162, 1)',
                    'rgba(237, 100, 166, 1)',
                    'rgba(255, 154, 158, 1)',
                    'rgba(250, 208, 196, 1)',
                ],
                borderWidth: 2
            }]
        };

        new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
