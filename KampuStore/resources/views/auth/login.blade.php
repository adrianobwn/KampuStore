{{-- resources/views/auth/login.blade.php --}}
@php($title = 'Login | kampuStore')
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
            min-height:100vh;
            background:#050816;
            color:#e5e7eb;
        }

        a{text-decoration:none;color:inherit;}

        /* ===== NAVBAR (sama home) ===== */
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
        }
        .nav-logo:hover{opacity:.85;}

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
        .nav-menu a::after{
            content:'';
            position:absolute;
            left:0;
            bottom:-4px;
            height:2px;
            width:100%;
            background:#f97316;
            border-radius:999px;
            transform:scaleX(0);
            transform-origin:left;
            opacity:0;
            transition:transform .25s ease-out, opacity .2s ease-out;
        }
        .nav-menu a:hover{
            color:#f97316;
        }
        .nav-menu a:hover::after{
            transform:scaleX(1);
            opacity:1;
        }
        .nav-menu a.active{
            color:#f97316;
        }
        .nav-menu a.active::after{
            transform:scaleX(1);
            opacity:1;
        }

        /* ===== BACKGROUND + BLOBS ===== */
        .auth-bg{
            min-height:100vh;
            padding:120px 40px 60px;
            display:flex;
            align-items:center;
            justify-content:center;
            background:radial-gradient(circle at top left,#312e81 0,#020617 55%);
            position:relative;
            overflow:hidden;
        }
        .auth-bg::before,
        .auth-bg::after{
            content:'';
            position:absolute;
            border-radius:999px;
            filter:blur(24px);
            opacity:0.45;
        }
        .auth-bg::before{
            width:340px;height:340px;
            background:linear-gradient(135deg,#6366f1,#f97316);
            top:-120px;left:-80px;
        }
        .auth-bg::after{
            width:300px;height:300px;
            background:linear-gradient(135deg,#0ea5e9,#22c55e);
            bottom:-140px;right:-60px;
        }

        /* ===== CARD WRAPPER + ANIMASI ===== */
        .auth-shell{
            width:100%;
            max-width:960px;
            min-height:460px;
            background:#020617;
            border-radius:18px;
            overflow:hidden;
            box-shadow:0 18px 40px rgba(0,0,0,.6);
            display:flex;
            position:relative;
            z-index:1;

            /* animasi masuk / keluar */
            transform:translateY(24px);
            opacity:0;
            transition:
                transform .45s ease,
                opacity .45s ease;
        }
        .auth-shell.is-visible{
            transform:translateY(0);
            opacity:1;
        }
        .auth-shell.slide-out-left{
            transform:translateX(-40px);
            opacity:0;
        }
        .auth-shell.slide-out-right{
            transform:translateX(40px);
            opacity:0;
        }

        /* PANEL KIRI (visual + tagline) */
        .auth-left{
            flex:1.1;
            background:radial-gradient(circle at top left,#020617 0,#000 65%);
            color:#fff;
            display:flex;
            flex-direction:column;
            padding:22px 22px 26px;
        }
        .auth-hero{
            position:relative;
            width:100%;
            padding-top:60%;
            overflow:hidden;
            border-radius:10px;
            background:#020617;
            margin-bottom:20px;
        }
        .auth-hero img{
            position:absolute;
            inset:0;
            width:100%;
            height:100%;
            object-fit:cover;
        }
        .auth-left-title{
            font-size:22px;
            font-weight:700;
            line-height:1.25;
            margin-bottom:10px;
        }
        .auth-left-text{
            font-size:13px;
            line-height:1.5;
            color:#e5e5e5;
            max-width:320px;
        }

        /* PANEL KANAN (glass) */
        .auth-right{
            flex:1;
            padding:32px 34px;
            border-radius:0 18px 18px 0;

            background:rgba(255,255,255,0.17);
            border-left:1px solid rgba(255,255,255,0.24);
            backdrop-filter:blur(28px) saturate(150%);
            -webkit-backdrop-filter:blur(28px) saturate(150%);

            display:flex;
            flex-direction:column;
            color:#f9fafb;
        }
        .auth-heading{
            font-size:26px;
            font-weight:700;
            margin-bottom:24px;
            text-align:center;
        }

        .auth-group{
            margin-bottom:14px;
        }
        .auth-label{
            display:block;
            font-size:13px;
            margin-bottom:4px;
            color:#e2e8f0;
        }
        .auth-input{
            width:100%;
            padding:10px 12px;
            border-radius:10px;
            background:rgba(255,255,255,0.18);
            border:1px solid rgba(255,255,255,0.45);
            color:#0b1120;
            font-size:14px;
            outline:none;
        }
        .auth-input::placeholder{
            color:#1f2937;
        }
        .auth-input:focus{
            border-color:#f97316;
            background:rgba(255,255,255,0.26);
        }

        .auth-row{
            display:flex;
            align-items:center;
            justify-content:space-between;
            margin:6px 0 18px;
            font-size:12px;
            color:#e5e7eb;
        }
        .auth-row label{
            display:flex;
            align-items:center;
            gap:6px;
            cursor:pointer;
        }

        .auth-btn{
            width:100%;
            padding:12px 0;
            border-radius:12px;
            border:none;
            background:#f97316;
            color:#111827;
            font-weight:700;
            cursor:pointer;
            margin-top:4px;
            transition:background .2s ease, transform .15s ease;
        }
        .auth-btn:hover{
            background:#fb923c;
            transform:translateY(-1px);
        }

        .auth-bottom{
            font-size:13px;
            text-align:center;
            margin-top:12px;
            color:#e5e7eb;
        }
        .auth-bottom a{
            color:#f97316;
            font-weight:600;
            text-decoration:none;
        }

        .auth-error{
            background:rgba(248,113,113,0.12);
            border:1px solid rgba(248,113,113,0.7);
            color:#fee2e2;
            border-radius:8px;
            padding:6px 10px;
            font-size:12px;
            margin-bottom:10px;
        }

        @media (max-width:830px){
            .auth-shell{
                flex-direction:column;
                max-width:520px;
            }
            .auth-right{
                border-radius:0 0 18px 18px;
            }
        }
    </style>
</head>
<body>

    {{-- NAVBAR --}}
    <nav class="nav">
        <a href="{{ route('home') }}" class="nav-logo">kampuStore</a>
        <div class="nav-menu">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('home') }}#about">About</a>
            <a href="{{ route('products.index') }}">Market</a>
            <a href="{{ route('home') }}#contact">Contact</a>
        </div>
    </nav>

    {{-- BACKGROUND + CARD LOGIN --}}
    <main class="auth-bg">
        <div class="auth-shell">
            {{-- PANEL KIRI --}}
            <div class="auth-left">
                <div class="auth-hero">
                    <img src="/images/auth/login-hero.jpg" alt="kampuStore seller">
                </div>

                <div class="auth-left-title">
                    Register Store. Manage Products.<br>
                    Reach Customers.
                </div>
                <div class="auth-left-text">
                    Log in to your seller account to start uploading products,
                    viewing analytics, and downloading sales reports.
                </div>
            </div>

            {{-- PANEL KANAN --}}
            <div class="auth-right">
                <h1 class="auth-heading">Welcome Back</h1>

                @if ($errors->any())
                    <div class="auth-error">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="auth-group">
                        <label class="auth-label" for="email">Email</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            class="auth-input"
                            placeholder="input your UNDIP email"
                        >
                    </div>

                    <div class="auth-group">
                        <label class="auth-label" for="password">Password</label>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            class="auth-input"
                            placeholder="input your password"
                        >
                    </div>

                    <div class="auth-row">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span>Remember me</span>
                        </label>
                    </div>

                    <button type="submit" class="auth-btn">
                        Login
                    </button>

                    <div class="auth-bottom">
                        Don’t have an account?
                        <a href="{{ route('register') }}" id="goRegister">Sign up here</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- animasi masuk + geser ke register --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const shell = document.querySelector('.auth-shell');
            if (shell) {
                // animasi fade-in / slide-up
                requestAnimationFrame(() => {
                    shell.classList.add('is-visible');
                });
            }

            const goRegister = document.getElementById('goRegister');
            if (shell && goRegister) {
                goRegister.addEventListener('click', function (e) {
                    e.preventDefault();
                    // animasi geser kiri dulu
                    shell.classList.remove('is-visible');
                    shell.classList.add('slide-out-left');
                    setTimeout(() => {
                        window.location.href = goRegister.href;
                    }, 400); // cocok dengan transition .45s
                });
            }
        });
    </script>

    @if (session('status'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Registrasi Berhasil',
                text: @json(session('status')),
                confirmButtonColor: '#f97316'
            });
        </script>
    @endif

</body>
</html>
