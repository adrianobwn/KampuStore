@php($title = 'Market - KampuStore')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .market-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 100px 24px 40px;
        }
        
        .sidebar {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 100px;
            max-height: calc(100vh - 120px);
            overflow-y: auto;
        }
        
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }
        
        .sidebar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        .sidebar::-webkit-scrollbar-thumb {
            background: #667eea;
            border-radius: 10px;
        }
        
        .filter-section {
            margin-bottom: 28px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .filter-section:last-child {
            border-bottom: none;
        }
        
        .filter-title {
            font-size: 15px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .filter-option {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 0;
            cursor: pointer;
            font-size: 14px;
            color: #4b5563;
            transition: color 0.2s;
        }
        
        .filter-option:hover {
            color: #667eea;
        }
        
        .filter-option input[type="checkbox"] {
            width: 18px;
            height: 18px;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .filter-input {
            width: 100%;
            padding: 10px 14px;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s;
        }
        
        .filter-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }
        
        .btn-reset {
            width: 100%;
            padding: 12px;
            background: #fee2e2;
            color: #dc2626;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 14px;
        }
        
        .btn-reset:hover {
            background: #dc2626;
            color: white;
        }
        
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 24px;
        }
        
        .product-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
        }
        
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        
        .product-image {
            position: relative;
            aspect-ratio: 1;
            overflow: hidden;
            background: linear-gradient(135deg, #667eea 20%, #764ba2 100%);
        }
        
        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }
        
        .product-card:hover .product-image img {
            transform: scale(1.1);
        }
        
        .product-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: rgba(255, 255, 255, 0.95);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            color: #667eea;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .product-info {
            padding: 18px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        .product-name {
            font-size: 16px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 8px;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .product-seller {
            font-size: 13px;
            color: #6b7280;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        
        .product-price {
            font-size: 20px;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-top: auto;
        }
        
        .product-stock {
            font-size: 12px;
            color: #059669;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        
        .product-stock.low {
            color: #dc2626;
        }
        
        .welcome-banner {
            background: white;
            border-radius: 16px;
            padding: 28px;
            margin-bottom: 32px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }
        
        .welcome-title {
            font-size: 28px;
            font-weight: 800;
            color: #111827;
            margin-bottom: 8px;
        }
        
        .welcome-subtitle {
            font-size: 15px;
            color: #6b7280;
        }
        
        .info-box {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            border: 2px solid rgba(102, 126, 234, 0.3);
            border-radius: 12px;
            padding: 16px;
            margin-top: 16px;
        }
        
        .info-box-title {
            font-weight: 700;
            color: #667eea;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .info-box-text {
            font-size: 14px;
            color: #4b5563;
            margin-bottom: 12px;
        }
        
        .btn-cta {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .btn-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }
        
        .no-products {
            background: white;
            border-radius: 16px;
            padding: 80px 40px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }
        
        .no-products i {
            font-size: 80px;
            color: #d1d5db;
            margin-bottom: 20px;
        }
        
        @media (max-width: 1024px) {
            .market-container {
                padding: 140px 16px 40px;
            }
            
            .sidebar {
                position: static;
                margin-bottom: 24px;
                max-height: none;
            }
            
            .product-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 16px;
            }
        }
        
        @media (max-width: 640px) {
            .product-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
    {{-- Navbar dari layouts/app.blade.php --}}
    <nav style="position: fixed; top: 0; left: 0; right: 0; z-index: 1000; display: flex; align-items: center; justify-content: space-between; padding: 16px 40px; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-bottom: 1px solid rgba(102, 126, 234, 0.2); box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);">
        <a href="{{ route('home') }}" style="font-weight: 800; font-size: 24px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; text-decoration: none;">
            KampuStore
        </a>

        <form action="{{ route('products.index') }}" method="GET" style="flex: 1; max-width: 500px; margin: 0 40px; position: relative;">
            <input type="text" name="q" placeholder="Cari produk, penjual, kategori..." value="{{ request('q') }}" style="width: 100%; padding: 12px 44px 12px 20px; border: 2px solid #e5e7eb; border-radius: 50px; font-size: 14px; transition: all 0.3s;">
            <button type="submit" style="position: absolute; right: 8px; top: 50%; transform: translateY(-50%); background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; width: 36px; height: 36px; border-radius: 50%; color: white; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                <i class="uil uil-search"></i>
            </button>
        </form>

        <div style="display: flex; align-items: center; gap: 20px;">
            @auth
                <div style="display: flex; align-items: center; gap: 12px; padding: 8px 16px; background: #f3f4f6; border-radius: 50px; font-size: 14px; font-weight: 500; color: #374151;">
                    <i class="uil uil-user-circle"></i>
                    <span>{{ auth()->user()->name }}</span>
                </div>
                @if(auth()->user()->seller)
                    <a href="{{ route('seller.dashboard') }}" style="padding: 10px 24px; border-radius: 50px; font-size: 14px; font-weight: 600; background: white; color: #667eea; border: 2px solid #667eea; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                        <i class="uil uil-dashboard"></i>
                        Dashboard
                    </a>
                @endif
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" style="border: none; background: #fee2e2; color: #dc2626; cursor: pointer; padding: 8px 16px; border-radius: 50px; font-size: 13px; font-weight: 600;">
                        <i class="uil uil-sign-out-alt"></i> Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" style="padding: 10px 24px; border-radius: 50px; font-size: 14px; font-weight: 600; background: white; color: #667eea; border: 2px solid #667eea; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                    <i class="uil uil-shop"></i>
                    Login Penjual
                </a>
                <a href="{{ route('register') }}" style="padding: 10px 24px; border-radius: 50px; font-size: 14px; font-weight: 600; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: 2px solid transparent; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                    <i class="uil uil-store-alt"></i>
                    Daftar Penjual
                </a>
            @endauth
        </div>
    </nav>

    <div class="market-container">
        {{-- Welcome Banner --}}
        <div class="welcome-banner">
            @auth
                <div class="welcome-title">Selamat datang, {{ auth()->user()->name }}!</div>
                <div class="welcome-subtitle">Temukan kebutuhan kampus dari sesama mahasiswa UNDIP</div>
            @else
                <div class="welcome-title">Selamat datang di KampuStore!</div>
                <div class="welcome-subtitle">Belanja perlengkapan kampus dari mahasiswa UNDIP — langsung beli tanpa perlu login!</div>
                
                <div class="info-box">
                    <div class="info-box-title">
                        <i class="uil uil-info-circle"></i>
                        Ingin Berjualan?
                    </div>
                    <div class="info-box-text">
                        Daftar sebagai penjual untuk mulai jualan di KampuStore!
                    </div>
                    <a href="{{ route('register') }}" class="btn-cta">
                        Daftar Sekarang
                        <i class="uil uil-arrow-right"></i>
                    </a>
                </div>
            @endauth
        </div>

        {{-- Main Grid: Sidebar + Products --}}
        <div style="display: grid; grid-template-columns: 280px 1fr; gap: 32px; align-items: start;">
            {{-- Sidebar Filter --}}
            <aside class="sidebar">
                <form method="GET" action="{{ route('products.index') }}" id="filterForm">
                    {{-- Search Query (hidden) --}}
                    @if($q)
                        <input type="hidden" name="q" value="{{ $q }}">
                    @endif
                    
                    {{-- Kategori --}}
                    <div class="filter-section">
                        <div class="filter-title">
                            <i class="uil uil-apps"></i>
                            Kategori
                        </div>
                        @foreach($allCats as $c)
                            <label class="filter-option">
                                <input type="checkbox" name="cat[]" value="{{ $c['slug'] }}" 
                                    {{ in_array($c['slug'], $cats) ? 'checked' : '' }}
                                    onchange="document.getElementById('filterForm').submit()">
                                <span>{{ $c['name'] }}</span>
                            </label>
                        @endforeach
                    </div>
                    
                    {{-- Harga --}}
                    <div class="filter-section">
                        <div class="filter-title">
                            <i class="uil uil-money-bill"></i>
                            Harga
                        </div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px; margin-bottom: 10px;">
                            <input type="number" name="pmin" placeholder="Min" value="{{ $priceMin }}" class="filter-input" min="0">
                            <input type="number" name="pmax" placeholder="Max" value="{{ $priceMax }}" class="filter-input" min="0">
                        </div>
                        <button type="submit" style="width: 100%; padding: 8px; background: #667eea; color: white; border: none; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer;">
                            Terapkan
                        </button>
                    </div>
                    
                    {{-- Kondisi --}}
                    <div class="filter-section">
                        <div class="filter-title">
                            <i class="uil uil-tag-alt"></i>
                            Kondisi
                        </div>
                        <label class="filter-option">
                            <input type="checkbox" name="cond[]" value="baru" 
                                {{ in_array('baru', $cond) ? 'checked' : '' }}
                                onchange="document.getElementById('filterForm').submit()">
                            <span>Baru</span>
                        </label>
                        <label class="filter-option">
                            <input type="checkbox" name="cond[]" value="bekas" 
                                {{ in_array('bekas', $cond) ? 'checked' : '' }}
                                onchange="document.getElementById('filterForm').submit()">
                            <span>Bekas</span>
                        </label>
                    </div>
                    
                    {{-- Stok --}}
                    <div class="filter-section">
                        <div class="filter-title">
                            <i class="uil uil-layers"></i>
                            Ketersediaan
                        </div>
                        <label class="filter-option">
                            <input type="checkbox" name="in_stock" value="1" 
                                {{ $inStock ? 'checked' : '' }}
                                onchange="document.getElementById('filterForm').submit()">
                            <span>Stok Tersedia</span>
                        </label>
                    </div>
                    
                    {{-- Reset --}}
                    <a href="{{ route('products.index') }}" class="btn-reset" style="display: block; text-align: center; text-decoration: none;">
                        <i class="uil uil-redo"></i>
                        Reset Filter
                    </a>
                </form>
            </aside>

            {{-- Products Grid --}}
            <main>
                @if($products->isEmpty())
                    <div class="no-products">
                        <i class="uil uil-shopping-bag"></i>
                        <h3 style="font-size: 22px; font-weight: 700; color: #111827; margin-bottom: 8px;">
                            Tidak ada produk ditemukan
                        </h3>
                        <p style="color: #6b7280; font-size: 14px; margin-bottom: 20px;">
                            Coba ubah filter atau kata kunci pencarian Anda
                        </p>
                        <a href="{{ route('products.index') }}" style="display: inline-block; padding: 12px 24px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 50px; font-weight: 600; text-decoration: none;">
                            Lihat Semua Produk
                        </a>
                    </div>
                @else
                    <div style="margin-bottom: 20px; color: #6b7280; font-size: 14px;">
                        Menampilkan <strong style="color: #111827;">{{ $products->count() }}</strong> dari <strong style="color: #111827;">{{ $products->total() }}</strong> produk
                    </div>
                    
                    <div class="product-grid">
                        @foreach($products as $p)
                            <a href="{{ route('products.show', $p->slug) }}" class="product-card">
                                <div class="product-image">
                                    @if($p->image_url)
                                        <img src="{{ Storage::url($p->image_url) }}" alt="{{ $p->name }}">
                                    @else
                                        <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                                            <i class="uil uil-image" style="font-size: 60px; color: rgba(255,255,255,0.5);"></i>
                                        </div>
                                    @endif
                                    @if($p->condition)
                                        <span class="product-badge">{{ ucfirst($p->condition) }}</span>
                                    @endif
                                </div>
                                <div class="product-info">
                                    <div class="product-name">{{ $p->name }}</div>
                                    <div class="product-seller">
                                        <i class="uil uil-shop"></i>
                                        {{ $p->seller_name ?? $p->seller->nama_toko ?? 'Toko' }}
                                    </div>
                                    <div class="product-price">
                                        Rp {{ number_format($p->price, 0, ',', '.') }}
                                    </div>
                                    <div class="product-stock {{ $p->stock < 10 ? 'low' : '' }}">
                                        <i class="uil uil-layers"></i>
                                        Stok: {{ $p->stock }}
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    
                    {{-- Pagination --}}
                    <div style="margin-top: 40px; display: flex; justify-content: center;">
                        {{ $products->withQueryString()->links() }}
                    </div>
                @endif
            </main>
        </div>
    </div>

    <footer style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-top: 1px solid rgba(102, 126, 234, 0.2); padding: 24px 0; text-align: center; font-size: 14px; color: #6b7280; margin-top: 80px;">
        &copy; {{ date('Y') }} <strong style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; font-weight: 700;">KampuStore</strong> - Marketplace Mahasiswa UNDIP
    </footer>
</body>
</html>
