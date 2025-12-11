@extends('layouts.seller')

@section('title', 'Dashboard Toko - ' . $seller->nama_toko)

@push('styles')
<style>
        /* LAYOUT & UTILS */
        .content-wrapper {
            padding: 20px;
            max-width: 1400px;
            margin: 0 auto;
        }
        .divider {
            height: 2px;
            background: linear-gradient(90deg, rgba(249,115,22,0) 0%, #f97316 50%, rgba(249,115,22,0) 100%);
            margin: 32px 0;
            opacity: 1;
            border-radius: 2px;
            box-shadow: 0 0 10px rgba(249,115,22,0.3);
        }
        .flex { display: flex; }
        .flex-col { flex-direction: column; }
        .items-center { align-items: center; }
        .justify-between { justify-content: space-between; }
        .gap-4 { gap: 16px; }
        
        /* HEADER */
        .page-header-with-actions {
            margin-bottom: 24px;
        }
        @media (min-width: 640px) {
            .page-header-with-actions .header-content {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 16px;
            }
        }
        .page-title { font-size: 24px; font-weight: 700; color: var(--text-main); margin-bottom: 4px; }
        .page-subtitle { font-size: 14px; color: var(--text-muted); }
        .header-widget {
            background: linear-gradient(135deg, var(--accent), #f97316);
            color: white;
            padding: 12px 24px;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(249, 115, 22, 0.3);
            text-align: center;
        }
        @media (min-width: 640px) { .header-widget { text-align: right; } }

        /* GRIDS & CARDS */
        .grid-actions {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 16px;
        }
        @media (min-width: 640px) { .grid-actions { grid-template-columns: repeat(2, 1fr); } }
        @media (min-width: 1024px) { .grid-actions { grid-template-columns: repeat(4, 1fr); gap: 24px; } }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
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
        .stat-card:hover { transform: translateY(-4px); box-shadow: 0 20px 40px rgba(0,0,0,0.2); }
        
        .stat-icon { width: 56px; height: 56px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px; margin-bottom: 16px; }
        .stat-icon.blue { background: rgba(59,130,246,0.15); color: #3b82f6; }
        .stat-icon.green { background: rgba(34,197,94,0.15); color: #22c55e; }
        .stat-icon.orange { background: rgba(249,115,22,0.15); color: #f97316; }
        .stat-icon.yellow { background: rgba(234,179,8,0.15); color: #eab308; }
        .stat-value { font-size: 32px; font-weight: 800; color: var(--text-main); margin-bottom: 4px; }
        .stat-label { font-size: 13px; color: var(--text-muted); font-weight: 500; }

        .action-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 16px;
            padding: 20px;
            transition: all 0.3s;
            text-decoration: none;
            display: block;
            height: 100%;
        }
        .action-card:hover { transform: translateY(-4px); box-shadow: 0 10px 25px rgba(0,0,0,0.1); border-color: var(--accent); }
        
        .card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 24px;
        }
        .card-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; }
        .card-title { font-size: 18px; font-weight: 700; color: var(--text-main); }
        .card-link { font-size: 13px; color: var(--accent); text-decoration: none; display: flex; align-items: center; gap: 4px; }
        .card-link:hover { color: var(--accent-hover); }

        /* TABLE */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; padding: 12px 16px; font-size: 12px; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 1px solid var(--card-border); }
        td { padding: 16px; border-bottom: 1px solid var(--card-border); font-size: 14px; color: var(--text-main); }
        tr:hover td { background: rgba(249,115,22,0.03); }
        .product-cell { display: flex; align-items: center; gap: 12px; }
        .product-img { width: 48px; height: 48px; border-radius: 10px; object-fit: cover; background: var(--card-border); }
        .product-name { font-weight: 600; }
        .product-desc { font-size: 12px; color: var(--text-muted); }
        .badge { padding: 4px 10px; border-radius: 50px; font-size: 12px; font-weight: 600; }
        .badge-blue { background: rgba(59,130,246,0.2); color: #3b82f6; }
        .badge-green { background: rgba(34,197,94,0.2); color: #22c55e; }
        .badge-orange { background: rgba(249,115,22,0.2); color: #f97316; }
        .action-btn { display: inline-flex; align-items: center; justify-content: center; padding: 8px; border-radius: 8px; color: var(--text-muted); transition: all .2s; background: none; border: none; cursor: pointer; text-decoration: none; }
        .action-btn:hover { background: rgba(249,115,22,0.1); color: var(--accent); }
        .action-btn i { font-size: 18px; }

        /* ALERT */
        .alert { padding: 16px 20px; border-radius: 12px; margin-bottom: 24px; display: flex; align-items: flex-start; gap: 12px; }
        .alert-warning { background: rgba(234,179,8,0.1); border: 1px solid rgba(234,179,8,0.3); }
        .alert-warning i { color: #eab308; font-size: 24px; }
        .alert-error { background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.3); }
        .alert-error i { color: #ef4444; font-size: 24px; }
        .alert-title { font-weight: 600; margin-bottom: 4px; }
        .alert-text { font-size: 13px; color: var(--text-muted); }
        
        /* INFO GRID */
        .info-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; }
        .info-item { background: rgba(0,0,0,0.03); border-radius: 12px; padding: 16px; }
        .info-label { font-size: 12px; color: var(--text-muted); margin-bottom: 6px; display: flex; align-items: center; gap: 6px; }
        .info-value { font-size: 14px; font-weight: 500; color: var(--text-main); }
        .info-full { grid-column: 1/-1; }
        
        .empty-state { text-align: center; padding: 48px 24px; }
        .empty-state i { font-size: 64px; color: var(--text-muted); margin-bottom: 16px; }
        .empty-state p { color: var(--text-muted); margin-bottom: 20px; }
        .stat-bar { height: 6px; width: 100%; background: var(--bg-main); border-radius: 4px; overflow: hidden; margin-top: 16px; }
        .stat-bar-fill { height: 100%; border-radius: 4px; transition: width 1s ease; }

        .btn-add { display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; background: var(--accent); color: #111827; border-radius: 50px; font-size: 13px; font-weight: 600; text-decoration: none; transition: all .3s; }
        .btn-add:hover { background: var(--accent-hover); transform: translateY(-2px); }

        .text-lg { font-size: 18px; }
        .font-bold { font-weight: 700; }
        .mb-4 { margin-bottom: 16px; }
    </style>
@endpush

@section('content')
<div class="content-wrapper">
        <!-- Header Section -->
        <div class="page-header-with-actions">
            <div class="header-content">
                <div>
                    <h1 class="page-title">Dashboard</h1>
                    <p class="page-subtitle">Selamat datang kembali, {{ $seller->nama_pic }}!</p>
                </div>
                <div class="header-widget">
                    <div style="font-size:12px;opacity:0.9;margin-bottom:2px;">{{ now()->format('d F Y') }}</div>
                    <div style="font-size:24px;font-weight:700;">{{ $totalProducts }}</div>
                    <div style="font-size:12px;opacity:0.9;">Total Produk Aktif</div>
                </div>
            </div>
        </div>

        <div class="divider"></div>

        @if($seller->status === 'pending')
        <div class="alert alert-warning">
            <i class="uil uil-exclamation-triangle"></i>
            <div>
                <div class="alert-title">Toko Menunggu Verifikasi</div>
                <div class="alert-text">Pendaftaran toko Anda sedang dalam proses verifikasi. Biasanya memakan waktu 1-3 hari kerja.</div>
            </div>
        </div>
        @elseif($seller->status === 'rejected')
        <div class="alert alert-error">
            <i class="uil uil-times-circle"></i>
            <div>
                <div class="alert-title">Pendaftaran Ditolak</div>
                <div class="alert-text">{{ $seller->rejection_reason ?? 'Alasan tidak disebutkan.' }}</div>
            </div>
        </div>
        @endif

        @if($seller->status === 'approved')
        {{-- Aksi Cepat --}}
        <div class="mb-6" style="margin-bottom:32px;">
            <h2 class="text-lg font-bold mb-4" style="color:var(--text-main)">Aksi Cepat</h2>
            <div class="grid-actions">
                <a href="{{ route('seller.products.create') }}" class="action-card">
                    <div style="display:flex;align-items:center;gap:16px">
                        <div class="stat-icon orange"><i class="uil uil-plus-circle"></i></div>
                        <div>
                            <h3 style="font-weight:700;font-size:16px;color:var(--text-main);margin-bottom:4px;">Tambah Produk</h3>
                            <p style="font-size:12px;color:var(--text-muted);">Upload produk baru ke toko</p>
                        </div>
                    </div>
                </a>
                <a href="{{ route('seller.products.index') }}" class="action-card">
                    <div style="display:flex;align-items:center;gap:16px">
                        <div class="stat-icon blue"><i class="uil uil-box"></i></div>
                        <div>
                            <h3 style="font-weight:700;font-size:16px;color:var(--text-main);margin-bottom:4px;">Kelola Produk</h3>
                            <p style="font-size:12px;color:var(--text-muted);">Edit dan atur stok produk</p>
                        </div>
                    </div>
                </a>
                <a href="{{ route('seller.reports.index') }}" class="action-card">
                    <div style="display:flex;align-items:center;gap:16px">
                        <div class="stat-icon green"><i class="uil uil-chart-bar"></i></div>
                        <div>
                            <h3 style="font-weight:700;font-size:16px;color:var(--text-main);margin-bottom:4px;">Lihat Laporan</h3>
                            <p style="font-size:12px;color:var(--text-muted);">Statistik dan performa toko</p>
                        </div>
                    </div>
                </a>
                <a href="{{ route('products.index') }}" class="action-card">
                    <div style="display:flex;align-items:center;gap:16px">
                        <div class="stat-icon yellow"><i class="uil uil-shopping-cart"></i></div>
                        <div>
                            <h3 style="font-weight:700;font-size:16px;color:var(--text-main);margin-bottom:4px;">Lihat Market</h3>
                            <p style="font-size:12px;color:var(--text-muted);">Jelajahi marketplace</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        {{-- Stats --}}
        <div class="mb-6">
            <h2 class="text-lg font-bold mb-4" style="color:var(--text-main)">Statistik Toko</h2>
        </div>
        <div class="stats-grid">
            <div class="stat-card">
                <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                    <div>
                         <div class="stat-value">{{ $totalProducts }}</div>
                         <div class="stat-label">Total Produk</div>
                    </div>
                    <div class="stat-icon blue" style="margin:0;"><i class="uil uil-package"></i></div>
                </div>
                <div class="stat-bar"><div class="stat-bar-fill" style="width:100%;background:#3b82f6"></div></div>
            </div>
            <div class="stat-card">
                <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                    <div>
                         <div class="stat-value">{{ number_format($totalStock) }}</div>
                         <div class="stat-label">Total Stok</div>
                    </div>
                    <div class="stat-icon green" style="margin:0;"><i class="uil uil-layers"></i></div>
                </div>
                <div class="stat-bar"><div class="stat-bar-fill" style="width:100%;background:#22c55e"></div></div>
            </div>
            <div class="stat-card">
                 <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                    <div>
                         <div class="stat-value">{{ $lowStockProducts }}</div>
                         <div class="stat-label">Stok < 2 (Restock)</div>
                    </div>
                    <div class="stat-icon orange" style="margin:0;"><i class="uil uil-exclamation-triangle"></i></div>
                </div>
                @php $lowStockPct = $totalProducts > 0 ? ($lowStockProducts / $totalProducts) * 100 : 0; @endphp
                <div class="stat-bar"><div class="stat-bar-fill" style="width:{{ $lowStockPct }}%;background:#f97316"></div></div>
            </div>
            <div class="stat-card">
                 <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                    <div>
                         <div class="stat-value">{{ number_format($avgRating, 1) }}</div>
                         <div class="stat-label">Rating ({{ $totalReviews }} ulasan)</div>
                    </div>
                    <div class="stat-icon yellow" style="margin:0;"><i class="uil uil-star"></i></div>
                </div>
                @php $ratingPct = ($avgRating / 5) * 100; @endphp
                <div class="stat-bar"><div class="stat-bar-fill" style="width:{{ $ratingPct }}%;background:#eab308"></div></div>
            </div>
        </div>

        <div class="divider"></div>
        <div class="mb-6">
            <h2 class="text-lg font-bold mb-4" style="color:var(--text-main)">Distribusi Data</h2>
        </div>

        {{-- Charts Section --}}
        <style>
            .charts-grid { display:grid;grid-template-columns:repeat(auto-fit,minmax(350px,1fr));gap:24px;margin-bottom:28px; }
            @media(max-width:800px) { .charts-grid { grid-template-columns:1fr; } }
            .chart-card { background:var(--card-bg);border:1px solid var(--card-border);border-radius:16px;padding:24px; }
            .chart-title { font-size:16px;font-weight:700;color:var(--text-main);margin-bottom:4px;display:flex;align-items:center;gap:8px; }
            .chart-subtitle { font-size:12px;color:var(--text-muted);margin-bottom:20px; }
            
            /* Horizontal Bar Chart */
            .h-bar-chart { display:flex;flex-direction:column;gap:12px;max-height:300px;overflow-y:auto; }
            .h-bar-item { display:flex;align-items:center;gap:12px; }
            .h-bar-label { font-size:12px;color:var(--text-main);font-weight:500;min-width:80px;flex-shrink:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis; }
            .h-bar-track { flex:1;height:24px;background:rgba(148,163,184,0.15);border-radius:12px;overflow:hidden;position:relative; }
            .h-bar-fill { height:100%;border-radius:12px;display:flex;align-items:center;justify-content:flex-end;padding:0 8px;min-width:40px;transition:width 0.3s; }
            .h-bar-value { font-size:11px;font-weight:700;color:white;white-space:nowrap; }
            
            /* Legacy column chart (keeping for compatibility) */
            .bar-chart { display:flex;align-items:flex-end;justify-content:flex-start;gap:8px;height:180px;border-left:1px solid var(--card-border);border-bottom:1px solid var(--card-border);padding:16px 8px 0;overflow-x:auto; }
            .bar-item { display:flex;flex-direction:column;align-items:center;min-width:50px;flex-shrink:0; }
            .bar { width:40px;border-radius:6px 6px 0 0;position:relative;min-height:10px;transition:height 0.3s; }
            .bar-value { position:absolute;top:-22px;left:50%;transform:translateX(-50%);padding:2px 6px;border-radius:4px;font-size:10px;font-weight:700;color:white;white-space:nowrap; }
            .bar-label { font-size:9px;color:var(--text-muted);margin-top:6px;text-align:center;max-width:60px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap; }
        </style>

        <div class="charts-grid">
            {{-- Sebaran Stok per Produk --}}
            <div class="chart-card">
                <div class="chart-header" style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:20px;">
                    <div>
                        <div class="chart-title"><i class="uil uil-layers"></i> Sebaran Stok per Produk</div>
                        <div class="chart-subtitle">Top 10 produk berdasarkan jumlah stok</div>
                    </div>
                    <button onclick="showDetail('stockByProduct', 'Detail Stok per Produk')" style="background:none;border:none;color:var(--text-muted);cursor:pointer;padding:4px;" title="Lihat Detail">
                        <i class="uil uil-expand-arrows-alt" style="font-size:20px;"></i>
                    </button>
                </div>
                

                @if($stockByProduct->count() > 0)
                    @php $maxStock = $stockByProduct->max('stock') ?: 1; @endphp
                    <div class="bar-chart" style="height:220px;display:flex;align-items:flex-end;gap:12px;padding-top:20px;padding-bottom:10px;">
                        @foreach($stockByProduct as $item)
                            @php 
                                $pct = ($item->stock / $maxStock) * 100;
                                $colors = ['#3b82f6', '#22c55e', '#f97316', '#a855f7', '#06b6d4', '#ef4444', '#eab308', '#ec4899'];
                                $color = $colors[$loop->index % count($colors)];
                            @endphp
                            <div style="display:flex;flex-direction:column;align-items:center;min-width:60px;flex:1;">
                                <div style="font-weight:bold;color:var(--text-main);font-size:12px;margin-bottom:4px;">{{ $item->stock }}</div>
                                <div style="width:100%;max-width:50px;background:linear-gradient(to top, {{ $color }}, {{ $color }}99);border-radius:8px 8px 0 0;height:{{ max(30, ($pct/100)*150) }}px;transition:height 0.3s;"></div>
                                <div style="margin-top:8px;font-size:11px;color:var(--text-muted);text-align:center;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;width:60px;" title="{{ $item->name }}">
                                    {{ Str::limit($item->name, 10) }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="text-align:center;padding:30px;color:var(--text-muted);">
                        <i class="uil uil-info-circle" style="font-size:32px;"></i>
                        <p style="font-size:13px;">Belum ada data produk</p>
                    </div>
                @endif
            </div>

            {{-- Sebaran Rating per Produk --}}
            <div class="chart-card">
                <div class="chart-header" style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:20px;">
                    <div>
                        <div class="chart-title"><i class="uil uil-star"></i> Sebaran Rating per Produk</div>
                        <div class="chart-subtitle">Top 10 produk berdasarkan rating tertinggi</div>
                    </div>
                    <button onclick="showDetail('ratingByProduct', 'Detail Rating per Produk')" style="background:none;border:none;color:var(--text-muted);cursor:pointer;padding:4px;" title="Lihat Detail">
                        <i class="uil uil-expand-arrows-alt" style="font-size:20px;"></i>
                    </button>
                </div>


                @if($ratingByProduct->count() > 0)
                    @php $maxRating = 5; @endphp
                    <div class="bar-chart" style="height:220px;display:flex;align-items:flex-end;gap:12px;padding-top:20px;padding-bottom:10px;">
                        @foreach($ratingByProduct->filter(fn($item) => $item->review_count > 0)->take(10) as $item)
                            @php 
                                $pct = ($item->avg_rating / $maxRating) * 100;
                                $colors = ['#eab308', '#f97316', '#22c55e', '#3b82f6', '#a855f7', '#06b6d4', '#ef4444', '#ec4899'];
                                $color = $colors[$loop->index % count($colors)];
                            @endphp
                            <div style="display:flex;flex-direction:column;align-items:center;min-width:60px;flex:1;">
                                <div style="font-weight:bold;color:var(--text-main);font-size:12px;margin-bottom:4px;">{{ number_format($item->avg_rating, 1) }}</div>
                                <div style="width:100%;max-width:50px;background:linear-gradient(to top, {{ $color }}, {{ $color }}99);border-radius:8px 8px 0 0;height:{{ max(30, ($pct/100)*150) }}px;transition:height 0.3s;"></div>
                                <div style="margin-top:8px;font-size:11px;color:var(--text-muted);text-align:center;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;width:60px;" title="{{ $item->name }}">
                                    {{ Str::limit($item->name, 10) }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="text-align:center;padding:30px;color:var(--text-muted);">
                        <i class="uil uil-star" style="font-size:32px;"></i>
                        <p style="font-size:13px;">Belum ada data rating</p>
                    </div>
                @endif
            </div>

            {{-- Sebaran Pemberi Rating Berdasarkan Provinsi --}}
            <div class="chart-card">
                <div class="chart-header" style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:20px;">
                    <div>
                        <div class="chart-title"><i class="uil uil-map-marker"></i> Sebaran Rating per Provinsi</div>
                        <div class="chart-subtitle">Asal pemberi rating untuk produk Anda</div>
                    </div>
                    <button onclick="showDetail('reviewersByProvince', 'Detail Sebaran Rating per Provinsi')" style="background:none;border:none;color:var(--text-muted);cursor:pointer;padding:4px;" title="Lihat Detail">
                        <i class="uil uil-expand-arrows-alt" style="font-size:20px;"></i>
                    </button>
                </div>


                @if($reviewersByProvince->count() > 0)
                    @php $maxReviews = $reviewersByProvince->max('total') ?: 1; @endphp
                    <div class="bar-chart" style="height:220px;display:flex;align-items:flex-end;gap:12px;padding-top:20px;padding-bottom:10px;">
                        @foreach($reviewersByProvince->take(10) as $item)
                            @php 
                                $pct = ($item->total / $maxReviews) * 100;
                                $colors = ['#3b82f6', '#22c55e', '#f97316', '#a855f7', '#06b6d4', '#ef4444', '#eab308', '#ec4899'];
                                $color = $colors[$loop->index % count($colors)];
                            @endphp
                            <div style="display:flex;flex-direction:column;align-items:center;min-width:60px;flex:1;">
                                <div style="font-weight:bold;color:var(--text-main);font-size:12px;margin-bottom:4px;">{{ $item->total }}</div>
                                <div style="width:100%;max-width:50px;background:linear-gradient(to top, {{ $color }}, {{ $color }}99);border-radius:8px 8px 0 0;height:{{ max(30, ($pct/100)*150) }}px;transition:height 0.3s;"></div>
                                <div style="margin-top:8px;font-size:11px;color:var(--text-muted);text-align:center;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;width:60px;" title="{{ $item->guest_province }}">
                                    {{ Str::limit($item->guest_province, 10) }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="text-align:center;padding:30px;color:var(--text-muted);">
                        <i class="uil uil-map-marker" style="font-size:32px;"></i>
                        <p style="font-size:13px;">Belum ada rating dengan data provinsi</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="divider"></div>

        {{-- Recent Products --}}
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Produk Terbaru</h2>
                <a href="{{ route('seller.products.index') }}" class="card-link">Lihat Semua <i class="uil uil-arrow-right"></i></a>
            </div>
            @if($products->count() > 0)
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>
                                <div class="product-cell">
                                    @if($product->image_url)
                                    <img src="{{ Storage::url($product->image_url) }}" alt="{{ $product->name }}" class="product-img">
                                    @else
                                    <div class="product-img" style="display:flex;align-items:center;justify-content:center;"><i class="uil uil-image" style="color:var(--text-muted);"></i></div>
                                    @endif
                                    <div>
                                        <div class="product-name">{{ $product->name }}</div>
                                        <div class="product-desc">{{ Str::limit($product->description, 40) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge badge-blue">{{ ucfirst(str_replace('-', ' ', $product->category_slug)) }}</span></td>
                            <td style="font-weight:600;">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>
                                @if($product->stock < 10)
                                <span class="badge badge-orange">{{ $product->stock }}</span>
                                @else
                                <span class="badge badge-green">{{ $product->stock }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('products.show', $product) }}" class="action-btn" title="Lihat"><i class="uil uil-eye"></i></a>
                                <a href="{{ route('seller.products.edit', $product) }}" class="action-btn" title="Edit"><i class="uil uil-edit"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="empty-state">
                <i class="uil uil-box"></i>
                <p>Belum ada produk</p>
                <a href="{{ route('seller.products.create') }}" class="btn-add">
                    <i class="uil uil-plus"></i> Tambah Produk Pertama
                </a>
            </div>
            @endif
        </div>

        {{-- Shop Info --}}
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Informasi Toko</h2>
            </div>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label"><i class="uil uil-user"></i> Nama PIC</div>
                    <div class="info-value">{{ $seller->nama_pic }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label"><i class="uil uil-envelope"></i> Email PIC</div>
                    <div class="info-value">{{ $seller->email_pic }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label"><i class="uil uil-phone"></i> No. HP PIC</div>
                    <div class="info-value">{{ $seller->no_hp_pic }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label"><i class="uil uil-location-point"></i> Lokasi</div>
                    <div class="info-value">{{ $seller->kota }}, {{ $seller->provinsi }}</div>
                </div>
                <div class="info-item info-full">
                    <div class="info-label"><i class="uil uil-map-marker"></i> Alamat Lengkap</div>
                    <div class="info-value">{{ $seller->alamat_pic }}, RT {{ $seller->rt }} / RW {{ $seller->rw }}, Kel. {{ $seller->kelurahan }}, {{ $seller->kota }}, {{ $seller->provinsi }}</div>
                </div>
            </div>
        </div>
        @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
<script>
    Swal.fire({ icon: 'success', title: 'Berhasil!', text: '{{ session('success') }}', confirmButtonColor: '#f97316' });
</script>
@endif
@if(session('error'))
<script>
    Swal.fire({ icon: 'error', title: 'Error!', text: '{{ session('error') }}', confirmButtonColor: '#f97316' });
</script>
@endif

<script>
(function(){
    const KEY = 'kampuStoreTheme';
    const body = document.body;
    const toggle = document.querySelector('.js-theme-toggle');
    function apply(mode){
        if(mode === 'light'){ body.classList.add('theme-light'); body.classList.remove('theme-dark'); }
        else{ body.classList.remove('theme-light'); body.classList.add('theme-dark'); }
    }
    const saved = localStorage.getItem(KEY) || 'dark';
    apply(saved);
    if(toggle){
        toggle.checked = (saved !== 'light');
        toggle.addEventListener('change', () => {
            const mode = toggle.checked ? 'dark' : 'light';
            apply(mode);
            localStorage.setItem(KEY, mode);
        });
    }
})();
</script>

    {{-- Modal Detail --}}
    <div id="detailModal" class="modal-overlay" style="display:none;position:fixed;top:0;left:0;right:0;bottom:0;background:rgba(0,0,0,0.5);z-index:100;align-items:center;justify-content:center;padding:20px;">
        <div class="modal-content" style="background:var(--card-bg);border-radius:16px;max-width:800px;width:100%;max-height:90vh;display:flex;flex-direction:column;box-shadow:0 25px 50px -12px rgba(0,0,0,0.25);">
            <div class="modal-header" style="padding:24px;border-bottom:1px solid var(--card-border);display:flex;justify-content:space-between;align-items:center;">
                <h3 id="modalTitle" style="font-size:20px;font-weight:700;color:var(--text-main);margin:0;">Detail Data</h3>
                <button onclick="closeModal()" style="background:none;border:none;color:var(--text-muted);cursor:pointer;font-size:24px;"><i class="uil uil-times"></i></button>
            </div>
            <div class="modal-body" style="padding:24px;overflow-y:auto;">
                {{-- Chart Container di Modal --}}
                <div id="modalChartContainer" style="margin-bottom:30px;min-height:200px;display:flex;align-items:flex-end;justify-content:center;gap:16px;padding-bottom:10px;border-bottom:1px dashed var(--card-border);">
                    <!-- Chart will be rendered here -->
                </div>

                <div class="table-container">
                    <table style="width:100%;border-collapse:collapse;">
                        <thead id="modalThead"></thead>
                        <tbody id="modalTbody"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Data for charts passed from controller
    const chartData = {
        stockByProduct: @json($stockByProduct),
        ratingByProduct: @json($ratingByProduct),
        reviewersByProvince: @json($reviewersByProvince)
    };

    function generateBarChartHTML(data, type) {
        let html = '';
        let maxValue = 0;
        
        // Determine max value and map data structure
        let items = [];
        if (type === 'stockByProduct') {
            maxValue = Math.max(...data.map(d => d.stock));
            items = data.map(d => ({ label: d.name, value: d.stock, sub: '' }));
        } else if (type === 'ratingByProduct') {
            maxValue = 5; // Rating max 5
            items = data.map(d => ({ label: d.name, value: d.avg_rating, sub: d.review_count + ' reviews' }));
        } else if (type === 'reviewersByProvince') {
            maxValue = Math.max(...data.map(d => d.total));
            items = data.map(d => ({ label: d.guest_province, value: d.total, sub: '' }));
        }
        
        if (maxValue === 0) maxValue = 1;

        // Colors
        const colors = ['#3b82f6', '#22c55e', '#f97316', '#a855f7', '#06b6d4', '#ef4444', '#eab308', '#ec4899'];

        // Build HTML
        html = '<div style="display:flex;align-items:flex-end;gap:12px;height:250px;width:100%;overflow-x:auto;padding-bottom:5px;">';
        
        items.forEach((item, index) => {
            const pct = (item.value / maxValue) * 100;
            const color = colors[index % colors.length];
            const height = Math.max(30, (pct / 100) * 200); // Max height 200px
            
            html += `
                <div style="display:flex;flex-direction:column;align-items:center;min-width:60px;flex:1;">
                    <div style="font-weight:bold;color:var(--text-main);font-size:12px;margin-bottom:4px;">${type === 'ratingByProduct' ? parseFloat(item.value).toFixed(1) : item.value}</div>
                    <div style="width:100%;max-width:50px;background:linear-gradient(to top, ${color}, ${color}99);border-radius:8px 8px 0 0;height:${height}px;transition:height 0.5s;"></div>
                    <div style="margin-top:8px;font-size:11px;color:var(--text-muted);text-align:center;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;width:60px;" title="${item.label}">
                        ${item.label}
                    </div>
                </div>
            `;
        });
        
        html += '</div>';
        return html;
    }

    function showDetail(type, title) {
        const modal = document.getElementById('detailModal');
        const modalTitle = document.getElementById('modalTitle');
        const modalChart = document.getElementById('modalChartContainer');
        const thead = document.getElementById('modalThead');
        const tbody = document.getElementById('modalTbody');

        if (!modal) return;

        modalTitle.textContent = title;
        modal.style.display = 'flex';
        thead.innerHTML = '';
        tbody.innerHTML = '';
        modalChart.innerHTML = ''; // Clear previous chart

        const data = chartData[type];
        
        // Render Chart in Modal
        if (data && data.length > 0) {
            modalChart.innerHTML = generateBarChartHTML(data, type);
            modalChart.style.display = 'flex';
        } else {
            modalChart.style.display = 'none';
        }

        // Prepare Table Data
        let headers = [];
        let rows = [];

        if (type === 'stockByProduct') {
            headers = ['Nama Produk', 'Stok'];
            rows = data.map(item => `
                <tr style="border-bottom:1px solid var(--card-border);">
                    <td style="padding:12px;color:var(--text-main);">${item.name}</td>
                    <td style="padding:12px;color:var(--text-main);font-weight:bold;">${item.stock}</td>
                </tr>
            `);
        } else if (type === 'ratingByProduct') {
            headers = ['Nama Produk', 'Rating', 'Jumlah Review'];
            rows = data.map(item => `
                <tr style="border-bottom:1px solid var(--card-border);">
                    <td style="padding:12px;color:var(--text-main);">${item.name}</td>
                    <td style="padding:12px;color:var(--text-main);font-weight:bold;">${parseFloat(item.avg_rating).toFixed(1)} <i class="uil uil-star" style="color:#eab308"></i></td>
                    <td style="padding:12px;color:var(--text-muted);">${item.review_count}</td>
                </tr>
            `);
        } else if (type === 'reviewersByProvince') {
            headers = ['Provinsi', 'Jumlah Pemberi Rating'];
            rows = data.map(item => `
                <tr style="border-bottom:1px solid var(--card-border);">
                    <td style="padding:12px;color:var(--text-main);">${item.guest_province}</td>
                    <td style="padding:12px;color:var(--text-main);font-weight:bold;">${item.total}</td>
                </tr>
            `);
        }

        // Render Headers
        let headerHtml = '<tr style="background:var(--card-border);text-align:left;">';
        headers.forEach(h => {
             headerHtml += `<th style="padding:12px;color:var(--text-muted);font-weight:600;font-size:14px;">${h}</th>`;
        });
        headerHtml += '</tr>';
        thead.innerHTML = headerHtml;

        // Render Body
        if (rows.length > 0) {
            tbody.innerHTML = rows.join('');
        } else {
            tbody.innerHTML = '<tr><td colspan="'+headers.length+'" style="padding:24px;text-align:center;color:var(--text-muted);">Tidak ada data detail</td></tr>';
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
