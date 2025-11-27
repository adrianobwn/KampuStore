@php($title = 'KampuStore | Marketplace Mahasiswa UNDIP')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #1f2937;
            line-height: 1.6;
            overflow-x: hidden;
        }
        
        /* NAVBAR */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(102, 126, 234, 0.2);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }
        
        .navbar-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .logo {
            font-size: 28px;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .nav-links {
            display: flex;
            align-items: center;
            gap: 40px;
        }
        
        .nav-links a {
            color: #4b5563;
            font-size: 16px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s;
            position: relative;
        }
        
        .nav-links a:hover {
            color: #667eea;
        }
        
        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: #667eea;
            transition: width 0.3s;
        }
        
        .nav-links a:hover::after {
            width: 100%;
        }
        
        .nav-buttons {
            display: flex;
            gap: 12px;
        }
        
        .btn {
            padding: 12px 28px;
            border-radius: 50px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
            cursor: pointer;
        }
        
        .btn-outline {
            background: white;
            color: #667eea;
            border: 2px solid #667eea;
        }
        
        .btn-outline:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: 2px solid transparent;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.5);
        }
        
        /* HERO SECTION */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 120px 40px 80px;
            position: relative;
            overflow: hidden;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            border-radius: 50%;
            top: -200px;
            right: -200px;
            animation: float 20s infinite ease-in-out;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(10deg); }
        }
        
        .hero-container {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
            position: relative;
            z-index: 1;
        }
        
        .hero-content h1 {
            font-size: 64px;
            font-weight: 900;
            color: white;
            line-height: 1.1;
            margin-bottom: 24px;
            letter-spacing: -2px;
        }
        
        .hero-content h1 span {
            background: linear-gradient(135deg, #fbbf24 0%, #f97316 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .hero-badge {
            display: inline-block;
            padding: 8px 20px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 50px;
            color: white;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 24px;
        }
        
        .hero-description {
            font-size: 20px;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 36px;
            line-height: 1.7;
        }
        
        .hero-actions {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 32px;
        }
        
        .btn-hero-primary {
            padding: 18px 36px;
            background: white;
            color: #667eea;
            font-size: 18px;
            font-weight: 700;
            border-radius: 50px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transition: all 0.3s;
        }
        
        .btn-hero-primary:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }
        
        .btn-hero-secondary {
            padding: 18px 36px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            color: white;
            font-size: 18px;
            font-weight: 700;
            border-radius: 50px;
            text-decoration: none;
            border: 2px solid rgba(255, 255, 255, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s;
        }
        
        .btn-hero-secondary:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-3px);
        }
        
        .hero-note {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.8);
            font-weight: 500;
        }
        
        .hero-note strong {
            color: white;
            font-weight: 700;
        }
        
        /* HERO IMAGE */
        .hero-image {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .mockup-container {
            position: relative;
            animation: floatPhone 6s infinite ease-in-out;
        }
        
        @keyframes floatPhone {
            0%, 100% { transform: translateY(0) rotate(-2deg); }
            50% { transform: translateY(-20px) rotate(2deg); }
        }
        
        .phone-mockup {
            width: 320px;
            height: 640px;
            background: linear-gradient(135deg, #1e3a8a 0%, #1e293b 100%);
            border-radius: 40px;
            padding: 20px;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.4);
            position: relative;
        }
        
        .phone-screen {
            width: 100%;
            height: 100%;
            background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
            border-radius: 30px;
            padding: 30px 20px;
            overflow: hidden;
            position: relative;
        }
        
        .phone-content {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        
        .phone-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            background: #10b981;
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
        }
        
        .phone-title {
            font-size: 16px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 8px;
        }
        
        .phone-price {
            font-size: 20px;
            font-weight: 800;
            color: #667eea;
        }
        
        /* FEATURES SECTION */
        .features {
            padding: 100px 40px;
            background: white;
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
        }
        
        .section-header {
            text-align: center;
            margin-bottom: 80px;
        }
        
        .section-badge {
            display: inline-block;
            padding: 8px 20px;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            border: 2px solid #667eea;
            border-radius: 50px;
            color: #667eea;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }
        
        .section-title {
            font-size: 48px;
            font-weight: 900;
            color: #111827;
            margin-bottom: 16px;
            letter-spacing: -1px;
        }
        
        .section-description {
            font-size: 20px;
            color: #6b7280;
            max-width: 700px;
            margin: 0 auto;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
        }
        
        .feature-card {
            background: linear-gradient(135deg, #f9fafb 0%, #ffffff 100%);
            border-radius: 24px;
            padding: 40px;
            border: 2px solid #e5e7eb;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        
        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            transform: scaleX(0);
            transition: transform 0.4s;
        }
        
        .feature-card:hover {
            transform: translateY(-8px);
            border-color: #667eea;
            box-shadow: 0 20px 60px rgba(102, 126, 234, 0.2);
        }
        
        .feature-card:hover::before {
            transform: scaleX(1);
        }
        
        .feature-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
        }
        
        .feature-icon i {
            font-size: 32px;
            color: white;
        }
        
        .feature-title {
            font-size: 22px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 12px;
        }
        
        .feature-description {
            font-size: 16px;
            color: #6b7280;
            line-height: 1.7;
        }
        
        /* CTA SECTION */
        .cta {
            padding: 100px 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
        }
        
        .cta::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            border-radius: 50%;
            bottom: -250px;
            left: -250px;
        }
        
        .cta-container {
            max-width: 1000px;
            margin: 0 auto;
            text-align: center;
            position: relative;
            z-index: 1;
        }
        
        .cta-title {
            font-size: 48px;
            font-weight: 900;
            color: white;
            margin-bottom: 20px;
            letter-spacing: -1px;
        }
        
        .cta-description {
            font-size: 20px;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 40px;
            line-height: 1.7;
        }
        
        .cta-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        /* FOOTER */
        .footer {
            background: #1f2937;
            color: #9ca3af;
            padding: 60px 40px 30px;
        }
        
        .footer-container {
            max-width: 1400px;
            margin: 0 auto;
        }
        
        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 60px;
            margin-bottom: 40px;
        }
        
        .footer-brand h3 {
            font-size: 28px;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 16px;
        }
        
        .footer-brand p {
            font-size: 15px;
            line-height: 1.7;
            color: #9ca3af;
        }
        
        .footer-links h4 {
            font-size: 16px;
            font-weight: 700;
            color: white;
            margin-bottom: 20px;
        }
        
        .footer-links ul {
            list-style: none;
        }
        
        .footer-links ul li {
            margin-bottom: 12px;
        }
        
        .footer-links ul li a {
            color: #9ca3af;
            text-decoration: none;
            font-size: 15px;
            transition: color 0.3s;
        }
        
        .footer-links ul li a:hover {
            color: #667eea;
        }
        
        .footer-bottom {
            padding-top: 30px;
            border-top: 1px solid #374151;
            text-align: center;
            font-size: 14px;
        }
        
        /* RESPONSIVE */
        @media (max-width: 1024px) {
            .hero-container {
                grid-template-columns: 1fr;
                gap: 60px;
            }
            
            .hero-content h1 {
                font-size: 48px;
            }
            
            .features-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }
        }
        
        @media (max-width: 768px) {
            .navbar-container {
                padding: 16px 20px;
            }
            
            .nav-links {
                display: none;
            }
            
            .hero {
                padding: 100px 20px 60px;
            }
            
            .hero-content h1 {
                font-size: 36px;
            }
            
            .hero-description {
                font-size: 18px;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
            }
            
            .section-title {
                font-size: 36px;
            }
            
            .cta-title {
                font-size: 36px;
            }
            
            .footer-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="{{ route('home') }}" class="logo">
                <i class="uil uil-shop"></i>
                KampuStore
            </a>
            <div class="nav-links">
                <a href="{{ route('home') }}">Home</a>
                <a href="#features">Features</a>
                <a href="{{ route('products.index') }}">Market</a>
                <a href="#about">About</a>
            </div>
            <div class="nav-buttons">
                <a href="{{ route('login') }}" class="btn btn-outline">
                    <i class="uil uil-signin"></i>
                    Login Penjual
                </a>
                <a href="{{ route('register') }}" class="btn btn-primary">
                    <i class="uil uil-store-alt"></i>
                    Daftar Penjual
                </a>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="hero">
        <div class="hero-container">
            <div class="hero-content">
                <span class="hero-badge">Marketplace Kampus UNDIP</span>
                <h1>
                    Shopping <span>Online</span><br>
                    For Students
                </h1>
                <p class="hero-description">
                    Platform marketplace untuk mahasiswa UNDIP. Jual-beli kebutuhan kuliah seperti alat tulis, buku, elektronik, dan fashion kampus dalam satu tempat yang aman.
                </p>
                <div class="hero-actions">
                    <a href="{{ route('products.index') }}" class="btn-hero-primary">
                        <i class="uil uil-shopping-cart"></i>
                        Belanja Sekarang
                    </a>
                    <a href="{{ route('register') }}" class="btn-hero-secondary">
                        <i class="uil uil-store-alt"></i>
                        Daftar Jadi Penjual
                    </a>
                </div>
                <p class="hero-note">
                    <strong>Pembeli:</strong> Langsung belanja tanpa login | <strong>Penjual:</strong> Daftar untuk mulai jualan
                </p>
            </div>
            
            <div class="hero-image">
                <div class="mockup-container">
                    <div class="phone-mockup">
                        <div class="phone-screen">
                            <span class="phone-badge">HOT DEAL</span>
                            <div class="phone-content">
                                <div class="phone-title">Kalkulator Scientific</div>
                                <div style="color: #6b7280; font-size: 13px; margin-bottom: 12px;">Toko Elektronik</div>
                                <div class="phone-price">Rp 85.000</div>
                            </div>
                            <div class="phone-content">
                                <div class="phone-title">Sticky Notes Premium</div>
                                <div style="color: #6b7280; font-size: 13px; margin-bottom: 12px;">Alat Tulis Store</div>
                                <div class="phone-price">Rp 12.000</div>
                            </div>
                            <div class="phone-content">
                                <div class="phone-title">Buku Kalkulus</div>
                                <div style="color: #6b7280; font-size: 13px; margin-bottom: 12px;">Toko Buku Teknik</div>
                                <div class="phone-price">Rp 95.000</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURES SECTION -->
    <section class="features" id="features">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Kenapa KampuStore?</span>
                <h2 class="section-title">Keunggulan Platform</h2>
                <p class="section-description">
                    Solusi marketplace khusus untuk mahasiswa UNDIP dengan berbagai fitur yang memudahkan
                </p>
            </div>
            
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="uil uil-shield-check"></i>
                    </div>
                    <h3 class="feature-title">Aman & Terpercaya</h3>
                    <p class="feature-description">
                        Semua penjual terverifikasi dengan email @students.undip.ac.id. Transaksi lebih aman karena sesama civitas UNDIP.
                    </p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="uil uil-shopping-bag"></i>
                    </div>
                    <h3 class="feature-title">Belanja Tanpa Login</h3>
                    <p class="feature-description">
                        Pembeli bisa langsung browsing dan membeli produk tanpa perlu registrasi atau login. Simple dan cepat!
                    </p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="uil uil-box"></i>
                    </div>
                    <h3 class="feature-title">Produk Relevan</h3>
                    <p class="feature-description">
                        Semua produk dikurasi khusus untuk kebutuhan mahasiswa. Dari alat tulis, buku, elektronik, hingga fashion kampus.
                    </p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="uil uil-dashboard"></i>
                    </div>
                    <h3 class="feature-title">Dashboard Penjual</h3>
                    <p class="feature-description">
                        Kelola toko dengan mudah melalui dashboard yang intuitif. Monitor stok, produk, dan penjualan dalam satu tempat.
                    </p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="uil uil-map-marker"></i>
                    </div>
                    <h3 class="feature-title">Lokasi Dekat</h3>
                    <p class="feature-description">
                        Semua penjual dari area kampus UNDIP. Bisa COD atau janjian di titik terdekat. Hemat ongkir!
                    </p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="uil uil-star"></i>
                    </div>
                    <h3 class="feature-title">Rating & Review</h3>
                    <p class="feature-description">
                        Sistem rating dan review membantu kamu memilih penjual terpercaya dan produk berkualitas.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA SECTION -->
    <section class="cta" id="about">
        <div class="cta-container">
            <h2 class="cta-title">Siap Mulai Jualan?</h2>
            <p class="cta-description">
                Daftar sebagai penjual dan raih peluang bisnis di marketplace khusus mahasiswa UNDIP. 
                Proses verifikasi cepat dan mudah!
            </p>
            <div class="cta-buttons">
                <a href="{{ route('register') }}" class="btn-hero-primary">
                    <i class="uil uil-user-plus"></i>
                    Daftar Sebagai Penjual
                </a>
                <a href="{{ route('products.index') }}" class="btn-hero-secondary">
                    <i class="uil uil-shopping-cart"></i>
                    Lihat Produk
                </a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <h3>KampuStore</h3>
                    <p>
                        Platform marketplace khusus untuk mahasiswa UNDIP. Jual-beli kebutuhan kuliah 
                        dengan aman, mudah, dan terpercaya.
                    </p>
                </div>
                
                <div class="footer-links">
                    <h4>Platform</h4>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('products.index') }}">Market</a></li>
                        <li><a href="#features">Features</a></li>
                        <li><a href="#about">About</a></li>
                    </ul>
                </div>
                
                <div class="footer-links">
                    <h4>Penjual</h4>
                    <ul>
                        <li><a href="{{ route('register') }}">Daftar Penjual</a></li>
                        <li><a href="{{ route('login') }}">Login Penjual</a></li>
                        <li><a href="{{ route('seller.dashboard') }}">Dashboard</a></li>
                    </ul>
                </div>
                
                <div class="footer-links">
                    <h4>Bantuan</h4>
                    <ul>
                        <li><a href="#">Cara Belanja</a></li>
                        <li><a href="#">Cara Berjualan</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Kontak</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} KampuStore - Marketplace Mahasiswa UNDIP. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
