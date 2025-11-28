<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Peringkat Produk | kampuStore Admin</title>
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

        .filter-card { background:var(--card-bg);border:1px solid var(--card-border);border-radius:16px;padding:20px;margin-bottom:24px; }
        .filter-row { display:flex;flex-wrap:wrap;gap:16px;align-items:end; }
        .filter-group { flex:1;min-width:150px; }
        .filter-group.search { flex:2;min-width:250px; }
        .filter-label { font-size:13px;font-weight:600;color:var(--text-main);margin-bottom:6px;display:block; }
        .filter-input, .filter-select { width:100%;padding:10px 14px;background:rgba(0,0,0,0.2);border:1px solid var(--card-border);border-radius:8px;color:var(--text-main);font-size:14px; }
        body.theme-light .filter-input, body.theme-light .filter-select { background:rgba(0,0,0,0.05); }
        .filter-input:focus, .filter-select:focus { outline:none;border-color:var(--accent); }
        .filter-input::placeholder { color:var(--text-muted); }
        .search-box { position:relative; }
        .search-box i { position:absolute;left:14px;top:50%;transform:translateY(-50%);color:var(--text-muted); }
        .search-box input { padding-left:40px; }
        .filter-actions { display:flex;gap:8px;flex-wrap:wrap; }
        .btn-filter { padding:10px 16px;background:var(--accent);color:#111827;border:none;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;display:flex;align-items:center;gap:6px; }
        .btn-filter:hover { background:var(--accent-hover); }
        .btn-reset { padding:10px 16px;background:rgba(148,163,184,0.2);color:var(--text-main);border:none;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;text-decoration:none;display:flex;align-items:center;gap:6px; }
        .btn-reset:hover { background:rgba(148,163,184,0.3); }
        .btn-export { padding:10px 16px;background:#22c55e;color:white;border:none;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;text-decoration:none;display:flex;align-items:center;gap:6px; }
        .btn-export:hover { background:#16a34a; }
        .btn-print { padding:10px 14px;background:#3b82f6;color:white;border:none;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer; }
        .btn-print:hover { background:#2563eb; }

        .card { background:var(--card-bg);border:1px solid var(--card-border);border-radius:16px;overflow:hidden; }
        .card-header { padding:20px 24px;border-bottom:1px solid var(--card-border); }
        .card-title { font-size:18px;font-weight:700;color:var(--text-main);margin:0; }
        .card-subtitle { font-size:13px;color:var(--text-muted);margin-top:4px; }

        .table-wrap { overflow-x:auto; }
        table { width:100%;border-collapse:collapse; }
        th { text-align:left;padding:14px 20px;font-size:12px;font-weight:600;color:var(--text-muted);text-transform:uppercase;background:rgba(0,0,0,0.1); }
        body.theme-light th { background:rgba(0,0,0,0.03); }
        td { padding:14px 20px;border-bottom:1px solid var(--card-border);font-size:14px;color:var(--text-main); }
        tr:hover td { background:rgba(249,115,22,0.03); }

        .rank-badge { width:40px;height:40px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:18px; }
        .rank-badge.gold { background:rgba(234,179,8,0.2); }
        .rank-badge.silver { background:rgba(148,163,184,0.3); }
        .rank-badge.bronze { background:rgba(249,115,22,0.2); }

        .product-cell { display:flex;align-items:center;gap:12px; }
        .product-img { width:48px;height:48px;border-radius:10px;object-fit:cover;background:var(--card-border); }
        .product-name { font-weight:600; }
        .product-cat { font-size:12px;color:var(--text-muted); }

        .rating-cell { display:flex;align-items:center;gap:6px; }
        .rating-star { color:#eab308;font-size:18px; }
        .rating-value { font-size:18px;font-weight:700; }

        .badge { padding:4px 12px;border-radius:50px;font-size:12px;font-weight:600; }
        .badge.green { background:rgba(34,197,94,0.2);color:#22c55e; }
        .badge.yellow { background:rgba(234,179,8,0.2);color:#eab308; }
        .badge.red { background:rgba(239,68,68,0.2);color:#ef4444; }

        .empty-state { padding:60px 24px;text-align:center; }
        .empty-state i { font-size:48px;color:var(--text-muted);margin-bottom:12px; }
        .empty-state p { color:var(--text-muted); }

        .footer { background:var(--nav-bg);border-top:1px solid var(--card-border);padding:20px 32px;text-align:center;margin-top:auto; }
        .footer p { font-size:13px;color:var(--text-muted); }
        .footer span { color:var(--accent);font-weight:600; }

        @media print {
            body { background:white !important; }
            .nav, .sidebar, .filter-card, .footer { display:none !important; }
            .main-container { display:block !important;padding:0 !important; }
            .card { box-shadow:none !important;border:1px solid #ddd !important; }
            th, td { color:#111 !important; }
        }
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
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link"><i class="uil uil-dashboard"></i> Dashboard</a>
                <a href="{{ route('admin.sellers.index') }}" class="sidebar-link"><i class="uil uil-store"></i> Pengajuan Toko</a>
            </div>
        </div>
        <div class="sidebar-section">
            <div class="sidebar-title">Laporan</div>
            <div class="sidebar-menu">
                <a href="{{ route('admin.reports.sellers') }}" class="sidebar-link"><i class="uil uil-users-alt"></i> Daftar Penjual</a>
                <a href="{{ route('admin.reports.sellers-location') }}" class="sidebar-link"><i class="uil uil-map-marker"></i> Penjual per Lokasi</a>
                <a href="{{ route('admin.reports.product-ranking') }}" class="sidebar-link active"><i class="uil uil-trophy"></i> Peringkat Produk</a>
            </div>
        </div>
    </aside>

    <div class="content">
        <div class="page-header">
            <div>
                <h1 class="page-title">Peringkat Produk</h1>
                <p class="page-subtitle">Produk dengan rating tertinggi</p>
            </div>
            <div class="header-stats">
                <div class="header-date">{{ now()->format('d F Y') }}</div>
                <div class="header-total">{{ $products->count() }}</div>
                <div class="header-label">Produk Teratas</div>
            </div>
        </div>

        <div class="filter-card">
            <form method="GET" action="{{ route('admin.reports.product-ranking') }}">
                <div class="filter-row">
                    <div class="filter-group search">
                        <label class="filter-label">Cari Produk</label>
                        <div class="search-box">
                            <i class="uil uil-search"></i>
                            <input type="text" name="search" value="{{ request('search') }}" class="filter-input" placeholder="Cari nama produk atau toko...">
                        </div>
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Kategori</label>
                        <select name="category" class="filter-select">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ ucfirst(str_replace('-', ' ', $cat)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Limit</label>
                        <select name="limit" class="filter-select">
                            <option value="10" {{ request('limit', 50) == 10 ? 'selected' : '' }}>Top 10</option>
                            <option value="25" {{ request('limit', 50) == 25 ? 'selected' : '' }}>Top 25</option>
                            <option value="50" {{ request('limit', 50) == 50 ? 'selected' : '' }}>Top 50</option>
                            <option value="100" {{ request('limit', 50) == 100 ? 'selected' : '' }}>Top 100</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Urutan</label>
                        <select name="sort" class="filter-select">
                            <option value="rating_desc" {{ request('sort', 'rating_desc') == 'rating_desc' ? 'selected' : '' }}>Rating Tertinggi</option>
                            <option value="rating_asc" {{ request('sort') == 'rating_asc' ? 'selected' : '' }}>Rating Terendah</option>
                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama A-Z</option>
                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama Z-A</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                        </select>
                    </div>
                </div>
                <div class="filter-row" style="margin-top:16px;">
                    <div class="filter-actions">
                        <button type="submit" class="btn-filter"><i class="uil uil-filter"></i> Filter</button>
                        <a href="{{ route('admin.reports.product-ranking') }}" class="btn-reset"><i class="uil uil-redo"></i> Reset</a>
                        <a href="{{ route('admin.reports.product-ranking.export', request()->all()) }}" class="btn-export"><i class="uil uil-file-download-alt"></i> Excel</a>
                        <button type="button" onclick="window.print()" class="btn-print"><i class="uil uil-print"></i></button>
                    </div>
                </div>
            </form>
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Peringkat Produk</h2>
                <p class="card-subtitle">Urutan berdasarkan rating tertinggi | Total: {{ $products->count() }} produk</p>
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>Produk</th>
                            <th>Toko</th>
                            <th>Rating</th>
                            <th>Review</th>
                            <th>Stok</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $index => $product)
                        <tr>
                            <td>
                                @if($index < 3)
                                    <div class="rank-badge {{ $index == 0 ? 'gold' : ($index == 1 ? 'silver' : 'bronze') }}">
                                        {{ $index == 0 ? '🥇' : ($index == 1 ? '🥈' : '🥉') }}
                                    </div>
                                @else
                                    <div style="text-align:center;font-weight:600;">{{ $index + 1 }}</div>
                                @endif
                            </td>
                            <td>
                                <div class="product-cell">
                                    @if($product->image_url)
                                        <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="product-img">
                                    @else
                                        <div class="product-img" style="display:flex;align-items:center;justify-content:center;"><i class="uil uil-image" style="color:var(--text-muted);"></i></div>
                                    @endif
                                    <div>
                                        <div class="product-name">{{ $product->name }}</div>
                                        <div class="product-cat">{{ ucfirst(str_replace('-', ' ', $product->category_slug)) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $product->nama_toko }}</td>
                            <td>
                                <div class="rating-cell">
                                    <i class="uil uil-star rating-star"></i>
                                    <span class="rating-value">{{ number_format($product->avg_rating, 2) }}</span>
                                </div>
                            </td>
                            <td style="text-align:center;">{{ $product->review_count }}</td>
                            <td>
                                <span class="badge {{ $product->stock > 10 ? 'green' : ($product->stock > 0 ? 'yellow' : 'red') }}">{{ $product->stock }} unit</span>
                            </td>
                            <td style="font-weight:600;">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <i class="uil uil-box"></i>
                                    <p>Tidak ada data produk</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <p>© 2025 <span>kampuStore</span>. All rights reserved.</p>
</footer>

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
