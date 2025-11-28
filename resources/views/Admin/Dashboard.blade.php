<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | kampuStore</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <style>
        :root {
            --bg-main: radial-gradient(circle at top left,#1f3b8a 0,#020617 52%,#020617 100%);
            --nav-bg: rgba(2,6,23,0.95);
            --card-bg: rgba(15,23,42,0.96);
            --card-border: rgba(148,163,184,0.2);
            --text-main: #f9fafb;
            --text-muted: #9ca3af;
            --sidebar-bg: rgba(15,23,42,0.96);
            --sidebar-border: rgba(148,163,184,0.2);
            --accent: #f97316;
            --accent-hover: #fb923c;
        }
        body.theme-light {
            --bg-main: linear-gradient(135deg, #ffffff 0%, #e3e8ff 40%, #d5ddff 100%);
            --nav-bg: rgba(255,255,255,0.95);
            --card-bg: rgba(255,255,255,0.96);
            --card-border: #e5e7eb;
            --text-main: #111827;
            --text-muted: #6b7280;
            --sidebar-bg: rgba(255,255,255,0.96);
            --sidebar-border: #e5e7eb;
        }
        * { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif; box-sizing: border-box; }
        body { margin:0; background: var(--bg-main); min-height:100vh; color: var(--text-main); }

        .nav { position:fixed;top:0;left:0;right:0;z-index:100;background:var(--nav-bg);backdrop-filter:blur(20px);border-bottom:1px solid rgba(249,115,22,0.3);padding:12px 32px;display:flex;align-items:center;justify-content:space-between; }
        .nav-left { display:flex;align-items:center;gap:32px; }
        .nav-logo { display:flex;align-items:center;gap:10px;text-decoration:none; }
        .nav-logo img { height:38px;width:38px; }
        .nav-logo span { font-size:22px;font-weight:700;color:var(--text-main); }
        .nav-menu { display:flex;gap:24px; }
        .nav-menu a { color:var(--text-muted);font-size:14px;font-weight:500;text-decoration:none;transition:color .2s; }
        .nav-menu a:hover, .nav-menu a.active { color:var(--accent); }
        .nav-actions { display:flex;align-items:center;gap:16px; }

        .theme-toggle-wrapper{display:flex;justify-content:center;align-items:center;}
        .toggle-switch{position:relative;display:inline-block;width:74px;height:36px;transform:scale(.95);transition:transform .2s;}
        .toggle-switch:hover{transform:scale(1);}
        .toggle-switch input{opacity:0;width:0;height:0;}
        .slider{position:absolute;cursor:pointer;inset:0;background:linear-gradient(145deg,#fbbf24,#f97316);transition:.4s;border-radius:34px;box-shadow:0 0 12px rgba(249,115,22,0.5);overflow:hidden;}
        .slider:before{position:absolute;content:"☀";height:28px;width:28px;left:4px;bottom:4px;background:white;transition:.4s;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:16px;box-shadow:0 0 10px rgba(0,0,0,.15);z-index:2;}
        .clouds{position:absolute;width:100%;height:100%;overflow:hidden;pointer-events:none;}
        .cloud{position:absolute;width:24px;height:24px;fill:rgba(255,255,255,0.9);filter:drop-shadow(0 2px 3px rgba(0,0,0,0.08));}
        .cloud1{top:6px;left:10px;animation:floatCloud1 8s infinite linear;}
        .cloud2{top:10px;left:38px;transform:scale(.85);animation:floatCloud2 12s infinite linear;}
        @keyframes floatCloud1{0%{transform:translateX(-20px);opacity:0;}20%{opacity:1;}80%{opacity:1;}100%{transform:translateX(80px);opacity:0;}}
        @keyframes floatCloud2{0%{transform:translateX(-20px) scale(.85);opacity:0;}20%{opacity:.7;}80%{opacity:.7;}100%{transform:translateX(80px) scale(.85);opacity:0;}}
        input.js-theme-toggle:checked + .slider{background:linear-gradient(145deg,#1f2937,#020617);box-shadow:0 0 14px rgba(15,23,42,0.8);}
        input.js-theme-toggle:checked + .slider:before{transform:translateX(38px);content:"🌙";}
        input.js-theme-toggle:checked + .slider .cloud{opacity:0;transform:translateY(-18px);}

        .btn-logout { border:none;background:rgba(239,68,68,0.1);color:#ef4444;cursor:pointer;padding:8px 16px;border-radius:50px;font-size:13px;font-weight:600;transition:all .3s;display:flex;align-items:center;gap:6px; }
        .btn-logout:hover{background:#ef4444;color:white;}

        .main-container { max-width:1400px;margin:0 auto;padding:90px 24px 40px;display:grid;grid-template-columns:260px 1fr;gap:28px; }
        @media(max-width:900px) { .main-container { grid-template-columns:1fr;padding-top:80px; } }

        .sidebar { background:var(--sidebar-bg);border-radius:16px;padding:24px;border:1px solid var(--sidebar-border);box-shadow:0 10px 40px rgba(0,0,0,0.2);position:sticky;top:90px;max-height:calc(100vh - 110px);overflow-y:auto; }
        .sidebar-section { margin-bottom:24px;padding-bottom:20px;border-bottom:1px solid var(--sidebar-border); }
        .sidebar-section:last-child { border-bottom:none;margin-bottom:0;padding-bottom:0; }
        .sidebar-title { font-size:13px;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:1px;margin-bottom:14px; }
        .sidebar-menu { display:flex;flex-direction:column;gap:6px; }
        .sidebar-link { display:flex;align-items:center;gap:12px;padding:12px 14px;border-radius:10px;font-size:14px;font-weight:500;color:var(--text-main);text-decoration:none;transition:all .2s; }
        .sidebar-link:hover { background:rgba(249,115,22,0.1);color:var(--accent); }
        .sidebar-link.active { background:rgba(249,115,22,0.15);color:var(--accent);font-weight:600; }
        .sidebar-link i { font-size:20px;width:24px;text-align:center; }

        .admin-badge { background:rgba(249,115,22,0.1);border:1px solid rgba(249,115,22,0.3);border-radius:12px;padding:16px;text-align:center; }
        .admin-name { font-size:16px;font-weight:700;color:var(--text-main);margin-bottom:4px; }
        .admin-role { display:inline-flex;align-items:center;gap:6px;padding:4px 12px;border-radius:50px;font-size:12px;font-weight:600;background:rgba(249,115,22,0.2);color:var(--accent); }

        .content { min-width:0; }
        .page-header { display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;flex-wrap:wrap;gap:16px; }
        .page-title { font-size:28px;font-weight:800;color:var(--text-main);margin:0; }
        .page-subtitle { font-size:14px;color:var(--text-muted);margin-top:4px; }
        .header-stats { text-align:right; }
        .header-date { font-size:13px;color:var(--text-muted); }
        .header-total { font-size:28px;font-weight:800;color:var(--accent); }
        .header-label { font-size:12px;color:var(--text-muted); }

        .stats-row { display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:24px; }
        @media(max-width:700px) { .stats-row { grid-template-columns:1fr; } }
        .stat-mini { background:var(--card-bg);border-radius:12px;padding:16px 20px;display:flex;align-items:center;justify-content:space-between;border-left:4px solid transparent;border:1px solid var(--card-border); }
        .stat-mini.yellow { border-left-color:#eab308; }
        .stat-mini.green { border-left-color:#22c55e; }
        .stat-mini.red { border-left-color:#ef4444; }
        .stat-mini-info {}
        .stat-mini-label { font-size:13px;color:var(--text-muted);margin-bottom:2px; }
        .stat-mini-value { font-size:24px;font-weight:800;color:var(--text-main); }
        .stat-mini-pct { font-size:12px;color:var(--text-muted);margin-top:2px; }
        .stat-mini-icon { width:44px;height:44px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:20px; }
        .stat-mini-icon.yellow { background:rgba(234,179,8,0.2);color:#eab308; }
        .stat-mini-icon.green { background:rgba(34,197,94,0.2);color:#22c55e; }
        .stat-mini-icon.red { background:rgba(239,68,68,0.2);color:#ef4444; }

        .card { background:var(--card-bg);border:1px solid var(--card-border);border-radius:16px;overflow:hidden; }
        .card-header { padding:20px 24px;border-bottom:1px solid var(--card-border); }
        .card-title { font-size:18px;font-weight:700;color:var(--text-main);margin:0; }
        .card-subtitle { font-size:13px;color:var(--text-muted);margin-top:4px; }
        .card-body { padding:24px; }

        .chart-container { height:220px;display:flex;align-items:flex-end;justify-content:center;gap:32px;padding:20px 0;border-bottom:1px solid var(--card-border); }
        .chart-bar { display:flex;flex-direction:column;align-items:center;gap:8px;width:80px; }
        .chart-bar-value { font-size:14px;font-weight:700;color:var(--text-main); }
        .chart-bar-fill { width:100%;border-radius:8px 8px 0 0;min-height:20px;transition:height .3s; }
        .chart-bar-fill.yellow { background:linear-gradient(to top, #eab308, #fbbf24); }
        .chart-bar-fill.green { background:linear-gradient(to top, #22c55e, #4ade80); }
        .chart-bar-fill.red { background:linear-gradient(to top, #ef4444, #f87171); }
        .chart-bar-label { font-size:12px;color:var(--text-muted);font-weight:500; }

        .progress-list { display:flex;flex-direction:column;gap:16px; }
        .progress-item {}
        .progress-header { display:flex;align-items:center;justify-content:space-between;margin-bottom:8px; }
        .progress-label { display:flex;align-items:center;gap:8px;font-size:14px;font-weight:500;color:var(--text-main); }
        .progress-dot { width:10px;height:10px;border-radius:50%; }
        .progress-dot.yellow { background:#eab308; }
        .progress-dot.green { background:#22c55e; }
        .progress-dot.red { background:#ef4444; }
        .progress-value { font-size:14px;font-weight:700;color:var(--text-main); }
        .progress-bar { width:100%;height:8px;background:rgba(0,0,0,0.2);border-radius:4px;overflow:hidden; }
        body.theme-light .progress-bar { background:rgba(0,0,0,0.1); }
        .progress-fill { height:100%;border-radius:4px;transition:width .3s; }
        .progress-fill.yellow { background:linear-gradient(to right, #eab308, #fbbf24); }
        .progress-fill.green { background:linear-gradient(to right, #22c55e, #4ade80); }
        .progress-fill.red { background:linear-gradient(to right, #ef4444, #f87171); }

        .quick-actions { display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-top:24px; }
        @media(max-width:700px) { .quick-actions { grid-template-columns:1fr; } }
        .action-card { display:flex;align-items:center;gap:16px;padding:20px;background:var(--card-bg);border:1px solid var(--card-border);border-radius:12px;text-decoration:none;transition:all .2s; }
        .action-card:hover { border-color:var(--accent);background:rgba(249,115,22,0.05); }
        .action-icon { width:48px;height:48px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:24px; }
        .action-icon.orange { background:rgba(249,115,22,0.2);color:var(--accent); }
        .action-icon.blue { background:rgba(59,130,246,0.2);color:#3b82f6; }
        .action-icon.green { background:rgba(34,197,94,0.2);color:#22c55e; }
        .action-info {}
        .action-title { font-size:14px;font-weight:600;color:var(--text-main);margin-bottom:2px; }
        .action-desc { font-size:12px;color:var(--text-muted); }

        .footer { background:var(--nav-bg);border-top:1px solid var(--card-border);padding:20px 32px;text-align:center;margin-top:auto; }
        .footer p { font-size:13px;color:var(--text-muted); }
        .footer span { color:var(--accent);font-weight:600; }

        @media(max-width:900px) {
            .nav { padding:12px 16px; }
            .nav-menu { display:none; }
            .sidebar { position:relative;top:0;max-height:none; }
            .main-container { padding:80px 16px 32px; }
        }
    </style>
</head>
<body class="theme-dark">

<nav class="nav">
    <div class="nav-left">
        <a href="{{ route('home') }}" class="nav-logo">
            <img src="{{ asset('images/logo.png') }}" alt="kampuStore">
            <span>kampuStore</span>
        </a>
        <div class="nav-menu">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('home') }}#features">Features</a>
            <a href="{{ route('products.index') }}">Market</a>
            <a href="{{ route('home') }}#about">About</a>
            <a href="{{ route('home') }}#contact">Contact</a>
        </div>
    </div>
    <div class="nav-actions">
        <div class="theme-toggle-wrapper">
            <label class="toggle-switch">
                <input type="checkbox" class="js-theme-toggle" />
                <span class="slider">
                    <div class="clouds">
                        <svg viewBox="0 0 100 100" class="cloud cloud1"><path d="M30,45 Q35,25 50,25 Q65,25 70,45 Q80,45 85,50 Q90,55 85,60 Q80,65 75,60 Q65,60 60,65 Q55,70 50,65 Q45,70 40,65 Q35,60 25,60 Q20,65 15,60 Q10,55 15,50 Q20,45 30,45"></path></svg>
                        <svg viewBox="0 0 100 100" class="cloud cloud2"><path d="M30,45 Q35,25 50,25 Q65,25 70,45 Q80,45 85,50 Q90,55 85,60 Q80,65 75,60 Q65,60 60,65 Q55,70 50,65 Q45,70 40,65 Q35,60 25,60 Q20,65 15,60 Q10,55 15,50 Q20,45 30,45"></path></svg>
                    </div>
                </span>
            </label>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout"><i class="uil uil-sign-out-alt"></i> Logout</button>
        </form>
    </div>
</nav>

<div class="main-container">
    <aside class="sidebar">
        <div class="sidebar-section">
            <div class="admin-badge">
                <div class="admin-name">{{ auth()->user()->name }}</div>
                <span class="admin-role"><i class="uil uil-shield-check"></i> Admin</span>
            </div>
        </div>
        <div class="sidebar-section">
            <div class="sidebar-title">Menu</div>
            <div class="sidebar-menu">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link active"><i class="uil uil-dashboard"></i> Dashboard</a>
                <a href="{{ route('admin.sellers.index') }}" class="sidebar-link"><i class="uil uil-store"></i> Pengajuan Toko</a>
            </div>
        </div>
        <div class="sidebar-section">
            <div class="sidebar-title">Laporan</div>
            <div class="sidebar-menu">
                <a href="{{ route('admin.reports.sellers') }}" class="sidebar-link"><i class="uil uil-users-alt"></i> Daftar Penjual</a>
                <a href="{{ route('admin.reports.sellers-location') }}" class="sidebar-link"><i class="uil uil-map-marker"></i> Penjual per Lokasi</a>
                <a href="{{ route('admin.reports.product-ranking') }}" class="sidebar-link"><i class="uil uil-trophy"></i> Peringkat Produk</a>
            </div>
        </div>
    </aside>

    <div class="content">
        <div class="page-header">
            <div>
                <h1 class="page-title">Dashboard Admin</h1>
                <p class="page-subtitle">Kelola pengajuan toko dan pantau aktivitas marketplace</p>
            </div>
            <div class="header-stats">
                <div class="header-date">{{ now()->format('d F Y') }}</div>
                <div class="header-total">{{ $total }}</div>
                <div class="header-label">Total Pengajuan</div>
            </div>
        </div>

        <div class="stats-row">
            <div class="stat-mini yellow">
                <div class="stat-mini-info">
                    <div class="stat-mini-label">Pending</div>
                    <div class="stat-mini-value">{{ $pending }}</div>
                    <div class="stat-mini-pct">{{ $pPct }}% dari total</div>
                </div>
                <div class="stat-mini-icon yellow"><i class="uil uil-clock"></i></div>
            </div>
            <div class="stat-mini green">
                <div class="stat-mini-info">
                    <div class="stat-mini-label">Disetujui</div>
                    <div class="stat-mini-value">{{ $approved }}</div>
                    <div class="stat-mini-pct">{{ $aPct }}% dari total</div>
                </div>
                <div class="stat-mini-icon green"><i class="uil uil-check-circle"></i></div>
            </div>
            <div class="stat-mini red">
                <div class="stat-mini-info">
                    <div class="stat-mini-label">Ditolak</div>
                    <div class="stat-mini-value">{{ $rejected }}</div>
                    <div class="stat-mini-pct">{{ $rPct }}% dari total</div>
                </div>
                <div class="stat-mini-icon red"><i class="uil uil-times-circle"></i></div>
            </div>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Statistik Pengajuan</h2>
                    <p class="card-subtitle">Distribusi status pengajuan toko</p>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <div class="chart-bar">
                            <div class="chart-bar-value">{{ $pending }}</div>
                            <div class="chart-bar-fill yellow" style="height: {{ max(20, $pPct * 1.8) }}px;"></div>
                            <div class="chart-bar-label">Pending</div>
                        </div>
                        <div class="chart-bar">
                            <div class="chart-bar-value">{{ $approved }}</div>
                            <div class="chart-bar-fill green" style="height: {{ max(20, $aPct * 1.8) }}px;"></div>
                            <div class="chart-bar-label">Approved</div>
                        </div>
                        <div class="chart-bar">
                            <div class="chart-bar-value">{{ $rejected }}</div>
                            <div class="chart-bar-fill red" style="height: {{ max(20, $rPct * 1.8) }}px;"></div>
                            <div class="chart-bar-label">Rejected</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Ringkasan Status</h2>
                    <p class="card-subtitle">Detail persentase setiap status</p>
                </div>
                <div class="card-body">
                    <div class="progress-list">
                        <div class="progress-item">
                            <div class="progress-header">
                                <div class="progress-label">
                                    <span class="progress-dot yellow"></span>
                                    Pending
                                </div>
                                <div class="progress-value">{{ $pending }} ({{ $pPct }}%)</div>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill yellow" style="width: {{ $pPct }}%;"></div>
                            </div>
                        </div>
                        <div class="progress-item">
                            <div class="progress-header">
                                <div class="progress-label">
                                    <span class="progress-dot green"></span>
                                    Disetujui
                                </div>
                                <div class="progress-value">{{ $approved }} ({{ $aPct }}%)</div>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill green" style="width: {{ $aPct }}%;"></div>
                            </div>
                        </div>
                        <div class="progress-item">
                            <div class="progress-header">
                                <div class="progress-label">
                                    <span class="progress-dot red"></span>
                                    Ditolak
                                </div>
                                <div class="progress-value">{{ $rejected }} ({{ $rPct }}%)</div>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill red" style="width: {{ $rPct }}%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="quick-actions">
            <a href="{{ route('admin.sellers.index') }}" class="action-card">
                <div class="action-icon orange"><i class="uil uil-folder-open"></i></div>
                <div class="action-info">
                    <div class="action-title">Lihat Semua Pengajuan</div>
                    <div class="action-desc">Kelola pengajuan toko</div>
                </div>
            </a>
            <a href="{{ route('products.index') }}" class="action-card">
                <div class="action-icon blue"><i class="uil uil-shopping-cart"></i></div>
                <div class="action-info">
                    <div class="action-title">Ke Market</div>
                    <div class="action-desc">Lihat produk marketplace</div>
                </div>
            </a>
            <a href="{{ route('home') }}" class="action-card">
                <div class="action-icon green"><i class="uil uil-home"></i></div>
                <div class="action-info">
                    <div class="action-title">Beranda</div>
                    <div class="action-desc">Kembali ke homepage</div>
                </div>
            </a>
        </div>
    </div>
</div>

<footer class="footer">
    <p>&copy; 2025 <span>kampuStore</span>. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
<script>Swal.fire({ icon: 'success', title: 'Berhasil!', text: '{{ session('success') }}', confirmButtonColor: '#f97316' });</script>
@endif
@if(session('error'))
<script>Swal.fire({ icon: 'error', title: 'Gagal!', text: '{{ session('error') }}', confirmButtonColor: '#f97316' });</script>
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
</body>
</html>
