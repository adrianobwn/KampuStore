@php($title = 'kampuStore | Shopping Online')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>

    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body{
            font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Arial,sans-serif;
            background:#050816;
            color:#e5e7eb;
        }

        a{text-decoration:none;color:inherit;}

        /* ==== NAVBAR ==== */
        .nav{
            position:fixed;
            top:0;left:0;right:0;
            z-index:50;
            display:flex;
            align-items:center;
            justify-content:space-between;
            padding:18px 60px;
            background:linear-gradient(90deg,#111827,#1f2937);
        }
        .nav-logo{
            font-weight:700;
            font-size:22px;
            letter-spacing:0.04em;
            color:#f9fafb;
            text-decoration:none;   /* ilangin underline */
            cursor:pointer;          /* nunjukin bahwa clickable */
        }
        .nav-logo:hover{
            opacity:.85;             /* animasi kecil */
        }
        .nav-menu{
            display:flex;
            align-items:center;
            gap:28px;
            font-size:14px;
        }
        .nav-menu a{
            color:#e5e7eb;
            position:relative;
        }

        /* garis bawah animasi */
        .nav-menu a::after{
            content:'';
            position:absolute;
            left:0;
            bottom:-4px;
            height:2px;
            width:100%;
            background:#f97316;
            border-radius:999px;

            /* mulai dari 0 (tak terlihat) */
            transform:scaleX(0);
            transform-origin:left;
            opacity:0;

            transition:transform .25s ease-out, opacity .2s ease-out;
        }

        /* saat hover: garis muncul dari kiri ke kanan */
        .nav-menu a:hover{
            color:#f97316;
        }
        .nav-menu a:hover::after{
            transform:scaleX(1);
            opacity:1;
        }

        /* ==== HERO WRAPPER ==== */
        .hero{
            min-height:100vh;
            padding:120px 60px 80px; /* 120 because navbar fixed */
            display:flex;
            gap:40px;
            align-items:center;
            justify-content:space-between;
            background:radial-gradient(circle at top left,#312e81 0,#020617 55%);
            position:relative;
            overflow:hidden;
        }

        /* blob shapes */
        .hero::before,
        .hero::after{
            content:'';
            position:absolute;
            border-radius:999px;
            filter:blur(18px);
            opacity:0.45;
        }
        .hero::before{
            width:380px;height:380px;
            background:linear-gradient(135deg,#6366f1,#f97316);
            top:-120px;left:-80px;
        }
        .hero::after{
            width:320px;height:320px;
            background:linear-gradient(135deg,#0ea5e9,#22c55e);
            bottom:-140px;right:-60px;
        }

        .hero-left{
            position:relative;
            z-index:1;
            max-width:480px;
        }
        .hero-tag{
            display:inline-block;
            padding:6px 16px;
            border-radius:999px;
            background:rgba(15,23,42,0.6);
            border:1px solid rgba(148,163,184,0.6);
            font-size:11px;
            text-transform:uppercase;
            letter-spacing:0.12em;
            margin-bottom:10px;
        }
        .hero-title{
            font-size:42px;
            line-height:1.15;
            font-weight:800;
            margin-bottom:12px;
        }
        .hero-title span{
            color:#f97316;
        }
        .hero-text{
            font-size:14px;
            color:#cbd5f5;
            max-width:420px;
            margin-bottom:22px;
        }
        .hero-buttons{
            display:flex;
            gap:14px;
            margin-bottom:18px;
        }
        .btn-main{
            padding:10px 22px;
            border-radius:999px;
            border:none;
            background:#f97316;
            color:#111827;
            font-weight:600;
            cursor:pointer;
            font-size:14px;
        }
        .btn-main:hover{background:#fb923c;}
        .btn-ghost{
            padding:10px 22px;
            border-radius:999px;
            border:1px solid #e5e7eb;
            background:transparent;
            color:#e5e7eb;
            font-size:14px;
            cursor:pointer;
            /* biar animasinya halus */
            transition:
                background-color .25s ease,
                color .25s ease,
                box-shadow .25s ease,
                transform .15s ease;
        }

        .btn-ghost:hover{
            background:#ffffff;          /* jadi putih full */
            color:#111827;               /* teks jadi gelap */
            box-shadow:0 8px 20px rgba(0,0,0,.35);
            transform:translateY(-1px);  /* dikit naik biar kerasa interaktif */
        }
        .btn-ghost:active{
            transform:translateY(0);
            box-shadow:0 4px 10px rgba(0,0,0,.25);
        }
        .hero-bottom-text{
            font-size:11px;
            color:#9ca3af;
        }

        /* ==== HERO RIGHT (mockup HP) ==== */
        .hero-right{
            position:relative;
            z-index:1;
            flex:1;
            display:flex;
            justify-content:flex-end;
        }
        .phone{
            width:280px;
            height:520px;
            border-radius:48px;
            background:linear-gradient(180deg,#1d4ed8,#0f172a);
            padding:18px;
            box-shadow:0 20px 60px rgba(0,0,0,0.65);
            position:relative;
        }
        .phone-inner{
            width:100%;
            height:100%;
            border-radius:36px;
            background:radial-gradient(circle at top,#38bdf8,#020617 62%);
            padding:22px 16px;
            position:relative;
            overflow:hidden;
        }
        .phone-store{
            width:100%;
            height:130px;
            border-radius:22px;
            background:rgba(15,23,42,0.8);
            border:1px solid rgba(148,163,184,0.55);
            margin-bottom:18px;
            position:relative;
        }
        .phone-store::before{
            content:'';
            position:absolute;
            left:16px;right:16px;top:18px;
            height:22px;
            border-radius:999px 999px 6px 6px;
            background:linear-gradient(90deg,#6366f1,#f97316);
        }
        .phone-badge{
            position:absolute;
            top:14px;left:18px;
            padding:4px 10px;
            border-radius:999px;
            background:#22c55e;
            font-size:10px;
            font-weight:600;
            color:#022c22;
        }

        .phone-product{
            margin-bottom:16px;
        }
        .phone-product-title{
            font-size:13px;
            font-weight:600;
            margin-bottom:4px;
        }
        .phone-product-sub{
            font-size:11px;
            color:#cbd5f5;
            margin-bottom:8px;
        }
        .phone-price-row{
            display:flex;
            align-items:center;
            justify-content:space-between;
        }
        .phone-price{
            font-weight:700;
            color:#f97316;
            font-size:16px;
        }
        .phone-cart-btn{
            padding:6px 10px;
            border-radius:999px;
            border:none;
            font-size:11px;
            background:#f97316;
            color:#111827;
            cursor:pointer;
        }

        .phone-dots{
            position:absolute;
            bottom:18px;left:50%;
            transform:translateX(-50%);
            display:flex;
            gap:4px;
        }
        .phone-dots span{
            width:6px;height:6px;
            border-radius:999px;
            background:rgba(148,163,184,0.7);
        }
        .phone-dots span.active{
            width:14px;
            background:#f97316;
        }

        /* ==== SECTIONS (ABOUT & CONTACT) ==== */
        .section{
            padding:60px 60px 80px;
            background:#020617;
        }
        .section-title{
            font-size:24px;
            margin-bottom:16px;
            font-weight:700;
        }
        .section p{
            max-width:720px;
            font-size:14px;
            color:#cbd5f5;
            line-height:1.6;
        }

        .footer{
            padding:18px 60px;
            font-size:12px;
            background:#020617;
            color:#6b7280;
            text-align:center;
            border-top:1px solid #111827;
        }

        @media(max-width:900px){
            .nav{padding:14px 18px;}
            .hero{
                flex-direction:column;
                padding:100px 18px 60px;
            }
            .hero-right{
                justify-content:center;
            }
        }
    </style>
</head>
<body>

    {{-- NAVBAR --}}
    <nav class="nav">
        <a href="{{ route('home') }}" class="nav-logo">kampuStore</a>
        <div class="nav-menu">
            <a href="{{ route('home') }}" class="active">Home</a>
            <a href="#about">About</a>
            <a href="{{ route('products.index') }}">Market</a>
            <a href="#contact">Contact</a>
        </div>
    </nav>

    {{-- HERO / LANDING --}}
    <section class="hero" id="home">
        <div class="hero-left">
            <div class="hero-tag">Marketplace Kampus UNDIP</div>
            <h1 class="hero-title">
                SHOPPING <span>ONLINE</span> FOR STUDENTS
            </h1>
            <p class="hero-text">
                kampuStore membantu mahasiswa UNDIP jual–beli kebutuhan kuliah:
                alat tulis, buku, elektronik, dan fashion kampus dalam satu platform
                yang aman dan terkurasi.
            </p>
            <div class="hero-buttons">
                <a href="{{ route('products.index') }}">
                    <button class="btn-main" type="button">Start Shopping</button>
                </a>
                <a href="{{ route('register') }}">
                    <button class="btn-ghost" type="button">Register</button>
                </a>
                <a href="{{ route('login') }}">
                    <button class="btn-ghost" type="button">Login</button>
                </a>
            </div>
            <div class="hero-bottom-text">
                • Hanya untuk civitas UNDIP &nbsp; • &nbsp; Transaksi lebih aman &nbsp; • &nbsp; Barang relevan untuk kuliah
            </div>
        </div>

        <div class="hero-right">
            {{-- ilustrasi HP / market --}}
            <div class="phone">
                <div class="phone-inner">
                    <div class="phone-store">
                        <div class="phone-badge">HOT DEAL</div>
                    </div>

                    <div class="phone-product">
                        <div class="phone-product-title">Sticky Notes</div>
                        <div class="phone-product-sub">Arya – Informatika</div>
                        <div class="phone-price-row">
                            <div class="phone-price">Rp 5.000</div>
                            <button class="phone-cart-btn" type="button">Add to cart</button>
                        </div>
                    </div>

                    <div class="phone-dots">
                        <span class="active"></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ABOUT --}}
    <section class="section" id="about">
        <h2 class="section-title">About kampuStore</h2>
        <p>
            kampuStore adalah platform marketplace internal kampus UNDIP
            yang dirancang untuk memudahkan mahasiswa dalam mencari dan
            menjual kebutuhan kuliah. Mulai dari alat tulis, buku modul,
            merchandise himpunan, sampai perangkat elektronik ringan —
            semuanya dikurasi agar relevan dengan kehidupan mahasiswa.
        </p>
    </section>

    {{-- CONTACT --}}
    <section class="section" id="contact">
        <h2 class="section-title">Contact</h2>
        <p>
            Untuk pertanyaan lebih lanjut, saran, atau kerja sama,
            kamu dapat menghubungi tim kampuStore melalui:
            <br><br>
            • Email: kampustore@undip.ac.id (dummy) <br>
            • Instagram: @kampuStore.undip <br>
            • Lokasi: Sekretariat BEM / Himpunan terkait.
        </p>
    </section>

    <footer class="footer">
        © {{ date('Y') }} kampuStore – Marketplace Mahasiswa UNDIP.
    </footer>

</body>
</html>
