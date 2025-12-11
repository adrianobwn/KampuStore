@extends('layouts.admin')

@push('styles')
@include('partials.admin-styles')
<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 32px;
    }
    .stat-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 16px;
        padding: 24px;
        transition: all 0.3s;
    }
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    }
    .action-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 16px;
        padding: 20px;
        transition: all 0.3s;
        text-decoration: none;
        display: block;
    }
    .action-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    }
</style>
@endpush

@section('content')
<div class="content-wrapper">
    <!-- Header Section -->
    <div class="page-header-with-actions">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="page-title">Dashboard Admin</h1>
                <p class="page-subtitle">Kelola pengajuan toko dan pantau aktivitas marketplace</p>
            </div>
            <div class="text-center sm:text-right px-4 sm:px-6 py-3 sm:py-4 rounded-xl shadow-lg text-white" style="background:linear-gradient(135deg, var(--accent), #ea580c)">
                <div class="text-xs sm:text-sm opacity-90 mb-1">{{ now()->format('d F Y') }}</div>
                <div class="text-2xl sm:text-3xl font-bold">{{ $total }}</div>
                <div class="text-xs sm:text-sm opacity-90">Total Pengajuan</div>
            </div>
        </div>
    </div>

    <div class="divider"></div>

    <!-- Quick Actions -->
    <div class="mb-6 sm:mb-8">
        <h2 class="text-lg sm:text-xl font-bold mb-4" style="color:var(--text-main)">Aksi Cepat</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
            <a href="{{ route('admin.sellers.index') }}" class="action-card">
                <div style="display:flex;align-items:center;gap:16px">
                    <div class="stat-icon orange" style="width:56px;height:56px;font-size:24px;"><i class="uil uil-folder-open"></i></div>
                    <div>
                        <h3 class="font-bold text-base sm:text-lg mb-1" style="color:var(--text-main)">Pengajuan Toko</h3>
                        <p class="text-xs sm:text-sm" style="color:var(--text-muted)">Kelola pengajuan pembukaan toko</p>
                    </div>
                </div>
            </a>
            <a href="{{ route('admin.reports.index') }}" class="action-card">
                <div style="display:flex;align-items:center;gap:16px">
                    <div class="stat-icon blue" style="width:56px;height:56px;font-size:24px;"><i class="uil uil-chart-bar"></i></div>
                    <div>
                        <h3 class="font-bold text-base sm:text-lg mb-1" style="color:var(--text-main)">Laporan</h3>
                        <p class="text-xs sm:text-sm" style="color:var(--text-muted)">Lihat laporan dan statistik</p>
                    </div>
                </div>
            </a>
            <a href="{{ route('products.index') }}" class="action-card">
                <div style="display:flex;align-items:center;gap:16px">
                    <div class="stat-icon green" style="width:56px;height:56px;font-size:24px;"><i class="uil uil-shopping-cart"></i></div>
                    <div>
                        <h3 class="font-bold text-base sm:text-lg mb-1" style="color:var(--text-main)">Marketplace</h3>
                        <p class="text-xs sm:text-sm" style="color:var(--text-muted)">Lihat produk di marketplace</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="mb-6 sm:mb-8">
        <h2 class="text-lg sm:text-xl font-bold mb-4" style="color:var(--text-main)">Statistik Pengajuan</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
            <div class="stat-card">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex-1">
                        <p class="text-xs sm:text-sm font-semibold mb-1" style="color:var(--text-muted)">Pending</p>
                        <p class="stat-value" style="color:#eab308">{{ $pending }}</p>
                        <p class="text-xs mt-1" style="color:var(--text-muted)">{{ number_format($pPct, 1) }}% dari total</p>
                    </div>
                    <div class="stat-icon yellow"><i class="uil uil-clock"></i></div>
                </div>
                <div class="stat-bar"><div class="stat-bar-fill" style="width:{{ $pPct }}%;background:#eab308"></div></div>
            </div>

            <div class="stat-card">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex-1">
                        <p class="text-xs sm:text-sm font-semibold mb-1" style="color:var(--text-muted)">Disetujui</p>
                        <p class="stat-value" style="color:#22c55e">{{ $approved }}</p>
                        <p class="text-xs mt-1" style="color:var(--text-muted)">{{ number_format($aPct, 1) }}% dari total</p>
                    </div>
                    <div class="stat-icon green"><i class="uil uil-check-circle"></i></div>
                </div>
                <div class="stat-bar"><div class="stat-bar-fill" style="width:{{ $aPct }}%;background:#22c55e"></div></div>
            </div>

            <div class="stat-card">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex-1">
                        <p class="text-xs sm:text-sm font-semibold mb-1" style="color:var(--text-muted)">Ditolak</p>
                        <p class="stat-value" style="color:#ef4444">{{ $rejected }}</p>
                        <p class="text-xs mt-1" style="color:var(--text-muted)">{{ number_format($rPct, 1) }}% dari total</p>
                    </div>
                    <div class="stat-icon red"><i class="uil uil-times-circle"></i></div>
                </div>
                <div class="stat-bar"><div class="stat-bar-fill" style="width:{{ $rPct }}%;background:#ef4444"></div></div>
            </div>
        </div>
    </div>

    <!-- Charts Row 1 -->
    <div class="mb-6 sm:mb-8">
        <h2 class="text-lg sm:text-xl font-bold mb-4" style="color:var(--text-main)">Statistik Pengguna</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
            <!-- Seller Statistics -->
            <div class="card p-4 sm:p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-base sm:text-lg font-semibold" style="color:var(--text-main)">Statistik Penjual</h3>
                        <p class="text-xs sm:text-sm mt-1" style="color:var(--text-muted)">Jumlah penjual aktif dan tidak aktif</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button onclick="showDetail('sellers', 'Detail Statistik Penjual')" style="background:none;border:none;color:var(--text-muted);cursor:pointer;" title="Lihat Detail"><i class="uil uil-expand-arrows-alt text-xl"></i></button>
                        <div class="stat-icon purple" style="width:40px;height:40px;font-size:18px;"><i class="uil uil-users-alt"></i></div>
                    </div>
                </div>
                <div class="chart-area mb-4">
                    <div class="flex justify-center items-end gap-8 sm:gap-12" style="height:180px">
                        <div class="flex flex-col items-center">
                            <div class="text-base sm:text-lg font-bold mb-2" style="color:var(--text-main)">{{ $approved }}</div>
                            <div style="width:70px;background:linear-gradient(to top, #22c55e, #4ade80);border-radius:8px 8px 0 0;height:{{ max(40, ($total > 0 ? ($approved / $total) * 100 : 0) * 1.5) }}px"></div>
                            <div class="text-xs sm:text-sm mt-3 font-semibold" style="color:var(--text-muted)">Aktif</div>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="text-base sm:text-lg font-bold mb-2" style="color:var(--text-main)">{{ $pending + $rejected }}</div>
                            <div style="width:70px;background:linear-gradient(to top, #ef4444, #f87171);border-radius:8px 8px 0 0;height:{{ max(40, ($total > 0 ? (($pending + $rejected) / $total) * 100 : 0) * 1.5) }}px"></div>
                            <div class="text-xs sm:text-sm mt-3 font-semibold" style="color:var(--text-muted)">Tidak Aktif</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Review Statistics -->
            <div class="card p-4 sm:p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-base sm:text-lg font-semibold" style="color:var(--text-main)">Statistik Review</h3>
                        <p class="text-xs sm:text-sm mt-1" style="color:var(--text-muted)">Pengunjung yang memberikan komentar dan rating</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button onclick="showDetail('reviews', 'Detail Statistik Review')" style="background:none;border:none;color:var(--text-muted);cursor:pointer;" title="Lihat Detail"><i class="uil uil-expand-arrows-alt text-xl"></i></button>
                        <div class="stat-icon blue" style="width:40px;height:40px;font-size:18px;"><i class="uil uil-star"></i></div>
                    </div>
                </div>
                <div class="chart-area mb-4">
                    <div class="flex justify-center items-end gap-8 sm:gap-12" style="height:180px">
                        <div class="flex flex-col items-center">
                            <div class="text-base sm:text-lg font-bold mb-2" style="color:var(--text-main)">{{ $totalReviews }}</div>
                            <div style="width:70px;background:linear-gradient(to top, #3b82f6, #60a5fa);border-radius:8px 8px 0 0;height:{{ max(40, min(140, $totalReviews * 3)) }}px"></div>
                            <div class="text-xs sm:text-sm mt-3 font-semibold" style="color:var(--text-muted)">Total Review</div>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="text-base sm:text-lg font-bold mb-2" style="color:var(--text-main)">{{ $uniqueReviewers }}</div>
                            <div style="width:70px;background:linear-gradient(to top, var(--accent), #fb923c);border-radius:8px 8px 0 0;height:{{ max(40, min(140, $uniqueReviewers * 10)) }}px"></div>
                            <div class="text-xs sm:text-sm mt-3 font-semibold" style="color:var(--text-muted)">Total Pengunjung</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="divider"></div>

    <!-- Charts Row 2 -->
    <div class="mb-6 sm:mb-8">
        <h2 class="text-lg sm:text-xl font-bold mb-4" style="color:var(--text-main)">Distribusi Data</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
            <!-- Products by Category -->
            <div class="card p-4 sm:p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-base sm:text-lg font-semibold" style="color:var(--text-main)">Produk per Kategori</h3>
                        <p class="text-xs sm:text-sm mt-1" style="color:var(--text-muted)">Distribusi produk berdasarkan kategori</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button onclick="showDetail('productsByCategory', 'Detail Produk per Kategori')" style="background:none;border:none;color:var(--text-muted);cursor:pointer;" title="Lihat Detail"><i class="uil uil-expand-arrows-alt text-xl"></i></button>
                        <div class="stat-icon indigo" style="width:40px;height:40px;font-size:18px;"><i class="uil uil-apps"></i></div>
                    </div>
                </div>
                @if($productsByCategory->count() > 0)
                    @php $maxCat = $productsByCategory->max('total'); @endphp
                    <div class="chart-area">
                        <div class="flex justify-start items-end gap-2 sm:gap-3 overflow-x-auto pb-2" style="height:180px">
                            @foreach($productsByCategory->take(8) as $cat)
                                <div class="flex flex-col items-center flex-shrink-0">
                                    <div class="text-xs sm:text-sm font-bold mb-2" style="color:var(--text-main)">{{ $cat['total'] }}</div>
                                    <div style="width:50px;background:linear-gradient(to top, #6366f1, #818cf8);border-radius:8px 8px 0 0;height:{{ max(30, ($cat['total'] / $maxCat) * 120) }}px"></div>
                                    <div class="text-xs mt-3 font-semibold truncate" style="color:var(--text-muted);width:50px;text-align:center">{{ Str::limit($cat['category'], 6) }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="chart-area text-center" style="padding:48px 20px">
                        <i class="uil uil-package text-4xl sm:text-5xl mb-3" style="color:var(--text-muted);opacity:0.5"></i>
                        <p class="text-xs sm:text-sm" style="color:var(--text-muted)">Belum ada data produk</p>
                    </div>
                @endif
            </div>

            <!-- Sellers by Province -->
            <div class="card p-4 sm:p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-base sm:text-lg font-semibold" style="color:var(--text-main)">Toko per Provinsi</h3>
                        <p class="text-xs sm:text-sm mt-1" style="color:var(--text-muted)">Distribusi toko berdasarkan lokasi</p>
                    </div>
                    <div class="flex items-center gap-2">
                         <button onclick="showDetail('sellersByProvince', 'Detail Toko per Provinsi')" style="background:none;border:none;color:var(--text-muted);cursor:pointer;" title="Lihat Detail"><i class="uil uil-expand-arrows-alt text-xl"></i></button>
                        <div class="stat-icon pink" style="width:40px;height:40px;font-size:18px;"><i class="uil uil-map-marker"></i></div>
                    </div>
                </div>
                @if($sellersByProvince->count() > 0)
                    @php $maxProv = $sellersByProvince->max('total'); @endphp
                    <div class="chart-area mb-4">
                        <div class="flex justify-start items-end gap-2 sm:gap-3 overflow-x-auto pb-2" style="height:180px">
                            @foreach($sellersByProvince->take(8) as $prov)
                                <div class="flex flex-col items-center flex-shrink-0">
                                    <div class="text-xs sm:text-sm font-bold mb-2" style="color:var(--text-main)">{{ $prov->total }}</div>
                                    <div style="width:50px;background:linear-gradient(to top, #ec4899, #f472b6);border-radius:8px 8px 0 0;height:{{ max(30, ($prov->total / $maxProv) * 120) }}px"></div>
                                    <div class="text-xs mt-3 font-semibold truncate" style="color:var(--text-muted);width:50px;text-align:center">{{ Str::limit($prov->provinsi, 6) }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div style="border-top:1px solid var(--card-border);padding-top:16px">
                        <div class="grid grid-cols-2 gap-2 sm:gap-3">
                            @foreach($sellersByProvince->take(4) as $prov)
                                <div class="chart-area p-2 sm:p-3">
                                    <div class="text-xs truncate mb-1" style="color:var(--text-muted)">{{ Str::limit($prov->provinsi, 15) }}</div>
                                    <div class="text-sm sm:text-lg font-bold" style="color:var(--text-main)">{{ $prov->total }} <span class="text-xs font-normal" style="color:var(--text-muted)">toko</span></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="chart-area text-center" style="padding:48px 20px">
                        <i class="uil uil-map-marker text-4xl sm:text-5xl mb-3" style="color:var(--text-muted);opacity:0.5"></i>
                        <p class="text-xs sm:text-sm" style="color:var(--text-muted)">Belum ada data toko</p>
                    </div>
                @endif
            </div>
        </div>
    </div>




    <!-- Detail Modal -->
    <div id="detailModal" class="modal-overlay" style="display:none;position:fixed;top:0;left:0;right:0;bottom:0;background:rgba(0,0,0,0.5);z-index:100;align-items:center;justify-content:center;padding:20px;">
        <div class="modal-content" style="background:var(--card-bg);border-radius:16px;max-width:800px;width:100%;max-height:90vh;display:flex;flex-direction:column;box-shadow:0 25px 50px -12px rgba(0,0,0,0.25);">
            <div class="modal-header" style="padding:24px;border-bottom:1px solid var(--card-border);display:flex;justify-content:space-between;align-items:center;">
                <h3 id="modalTitle" class="text-xl font-bold" style="color:var(--text-main)">Detail Data</h3>
                <button onclick="closeModal()" style="background:none;border:none;color:var(--text-muted);cursor:pointer;font-size:24px;"><i class="uil uil-times"></i></button>
            </div>
            <div class="modal-body" style="padding:24px;overflow-y:auto;">
                <div class="table-container">
                    <table style="width:100%;border-collapse:collapse;">
                        <thead id="modalThead"></thead>
                        <tbody id="modalTbody"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    // Data for charts
    const chartData = {
        sellers: [
            { label: 'Pending', value: {{ $pending }}, color: '#eab308' },
            { label: 'Aktif (Approved)', value: {{ $approved }}, color: '#22c55e' },
            { label: 'Tidak Aktif (Rejected)', value: {{ $rejected }}, color: '#ef4444' }
        ],
        reviews: [
            { label: 'Total Review', value: {{ $totalReviews }}, color: '#3b82f6' },
            { label: 'Total Pengunjung Unik', value: {{ $uniqueReviewers }}, color: '#f97316' },
            { label: 'Guest Reviewers', value: {{ $guestReviewers }}, color: '#a855f7' },
            { label: 'User Reviewers', value: {{ $userReviewers }}, color: '#ec4899' }
        ],
        productsByCategory: @json($productsByCategory),
        sellersByProvince: @json($sellersByProvince)
    };

    function showDetail(type, title) {
        console.log('Opening modal for:', type); // Debugging
        const modal = document.getElementById('detailModal');
        const modalTitle = document.getElementById('modalTitle');
        const thead = document.getElementById('modalThead');
        const tbody = document.getElementById('modalTbody');

        if (!modal) {
            console.error('Modal element not found!');
            return;
        }

        modalTitle.textContent = title;
        modal.style.display = 'flex';
        thead.innerHTML = '';
        tbody.innerHTML = '';

        let headers = [];
        let rows = [];

        if (type === 'sellers') {
            headers = ['Status', 'Jumlah'];
            rows = chartData.sellers.map(item => `
                <tr style="border-bottom:1px solid var(--card-border);">
                    <td style="padding:12px;color:var(--text-main);display:flex;align-items:center;gap:8px;">
                        <div style="width:12px;height:12px;border-radius:50%;background:${item.color}"></div>
                        ${item.label}
                    </td>
                    <td style="padding:12px;color:var(--text-main);font-weight:bold;">${item.value}</td>
                </tr>
            `);
        } else if (type === 'reviews') {
            headers = ['Metrik', 'Jumlah'];
            rows = chartData.reviews.map(item => `
                <tr style="border-bottom:1px solid var(--card-border);">
                    <td style="padding:12px;color:var(--text-main);display:flex;align-items:center;gap:8px;">
                        <div style="width:12px;height:12px;border-radius:50%;background:${item.color}"></div>
                        ${item.label}
                    </td>
                    <td style="padding:12px;color:var(--text-main);font-weight:bold;">${item.value}</td>
                </tr>
            `);
        } else if (type === 'productsByCategory') {
            headers = ['Kategori', 'Slug', 'Total Produk'];
            rows = chartData.productsByCategory.map(item => `
                <tr style="border-bottom:1px solid var(--card-border);">
                    <td style="padding:12px;color:var(--text-main);">${item.category}</td>
                    <td style="padding:12px;color:var(--text-muted);font-family:monospace;">${item.slug}</td>
                    <td style="padding:12px;color:var(--text-main);font-weight:bold;">${item.total}</td>
                </tr>
            `);
        } else if (type === 'sellersByProvince') {
            headers = ['Provinsi', 'Total Toko'];
            rows = chartData.sellersByProvince.map(item => `
                <tr style="border-bottom:1px solid var(--card-border);">
                    <td style="padding:12px;color:var(--text-main);">${item.provinsi}</td>
                    <td style="padding:12px;color:var(--text-main);font-weight:bold;">${item.total}</td>
                </tr>
            `);
        }

        // Render Headers
        let headerHtml = '<tr style="background:var(--bg-main);text-align:left;">';
        headers.forEach(h => {
             headerHtml += `<th style="padding:12px;color:var(--text-muted);font-weight:600;font-size:14px;">${h}</th>`;
        });
        headerHtml += '</tr>';
        thead.innerHTML = headerHtml;

        // Render Body
        if (rows.length > 0) {
            tbody.innerHTML = rows.join('');
        } else {
            tbody.innerHTML = '<tr><td colspan="'+headers.length+'" style="padding:24px;text-align:center;color:var(--text-muted);">Tidak ada data</td></tr>';
        }
    }

    function closeModal() {
        document.getElementById('detailModal').style.display = 'none';
    }

    // Close on click outside
    window.onclick = function(event) {
        const modal = document.getElementById('detailModal');
        if (event.target == modal) {
            closeModal();
        }
    }
</script>
@endsection
