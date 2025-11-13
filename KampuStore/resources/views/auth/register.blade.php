@php($title = 'Sign Up | kampuStore')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>

    <style>
        *{margin:0;padding:0;box-sizing:border-box}

        body{
            font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Arial,sans-serif;
            background:#050816;
            color:#e5e7eb;
            min-height:100vh;
        }

        a{text-decoration:none;color:inherit;}

        /* ===== NAVBAR (sama home & login) ===== */
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
            max-width:1000px;
            min-height:480px;
            background:#020617;
            border-radius:18px;
            overflow:hidden;
            box-shadow:0 18px 40px rgba(0,0,0,.6);
            display:flex;
            position:relative;
            z-index:1;

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

        /* kiri gambar */
        .auth-visual{
            flex:1.05;
            background:radial-gradient(circle at top left,#020617 0,#000 70%);
            display:flex;
            justify-content:center;
            align-items:center;
            padding:22px;
        }
        .auth-visual img{
            width:100%;
            height:100%;
            max-height:360px;
            object-fit:cover;
            border-radius:10px;
        }

        /* kanan form – glass putih transparan */
        .auth-panel{
            flex:1;
            padding:32px 38px 30px;

            background:rgba(255,255,255,0.17);
            border-left:1px solid rgba(255,255,255,0.24);
            backdrop-filter:blur(28px) saturate(150%);
            -webkit-backdrop-filter:blur(28px) saturate(150%);
            border-radius:0 18px 18px 0;

            display:flex;
            flex-direction:column;
            color:#f9fafb;
        }
        .auth-panel-inner{
            max-width:360px;
            margin:0 auto;
            width:100%;
        }

        .auth-title{
            font-size:28px;
            font-weight:800;
            margin-bottom:22px;
            text-align:center;
        }

        .field-row-2{
            display:flex;
            gap:12px;
        }
        .field-group{
            margin-bottom:14px;
            width:100%;
        }
        .auth-label{
            font-size:13px;
            font-weight:600;
            margin-bottom:6px;
            display:block;
            color:#e5e7eb;
        }

        .auth-input{
            width:100%;
            border-radius:12px;
            border:1px solid rgba(255,255,255,0.45);
            padding:10px 14px;
            font-size:14px;
            outline:none;
            background:rgba(255,255,255,0.18);
            color:#0b1120;
        }
        .auth-input::placeholder{
            color:#1f2937;
        }
        .auth-input:focus{
            border-color:#f97316;
            background:rgba(255,255,255,0.26);
        }

        .auth-checkbox-row{
            display:flex;
            align-items:center;
            gap:8px;
            margin:4px 0 18px;
            font-size:13px;
            color:#e5e7eb;
        }
        .auth-checkbox{
            width:16px;
            height:16px;
        }

        .auth-btn-primary{
            width:100%;
            border:none;
            border-radius:12px;
            padding:11px 16px;
            font-size:14px;
            font-weight:700;
            cursor:pointer;
            background:#f97316;
            color:#111827;
            margin-top:4px;
            transition:background .2s ease, transform .15s ease;
        }
        .auth-btn-primary:hover{
            background:#fb923c;
            transform:translateY(-1px);
        }

        .auth-divider{
            display:flex;
            align-items:center;
            justify-content:center;
            gap:8px;
            font-size:12px;
            color:#e5e7eb;
            margin:18px 0 8px;
        }
        .auth-divider span{
            flex:1;
            height:1px;
            background:rgba(148,163,184,0.6);
        }

        .auth-bottom-text{
            margin-top:6px;
            font-size:13px;
            text-align:center;
            color:#e5e7eb;
        }
        .auth-bottom-text a{
            color:#f97316;
            font-weight:600;
        }

        .auth-error{
            font-size:12px;
            color:#fed7d7;
            margin-top:4px;
        }

        @media(max-width:900px){
            .auth-shell{
                max-width:520px;
                flex-direction:column;
            }
            .auth-visual{
                display:none;
            }
            .auth-panel{
                border-radius:18px;
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

    <main class="auth-bg">
        <div class="auth-shell">

            {{-- SIDE IMAGE --}}
            <div class="auth-visual">
                <img src="{{ asset('images/auth/hero.jpg') }}" alt="kampuStore hero">
            </div>

            {{-- FORM PANEL --}}
            <div class="auth-panel">
                <div class="auth-panel-inner">
                    <h1 class="auth-title">Sign Up</h1>

                    <form id="registerForm" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="field-row-2">
                            <div class="field-group">
                                <label class="auth-label" for="first_name">First Name</label>
                                <input
                                    id="first_name"
                                    type="text"
                                    class="auth-input"
                                    placeholder="First Name"
                                    value="{{ old('first_name') }}"
                                    required
                                >
                            </div>
                            <div class="field-group">
                                <label class="auth-label" for="last_name">Last Name</label>
                                <input
                                    id="last_name"
                                    type="text"
                                    class="auth-input"
                                    placeholder="Last Name"
                                    value="{{ old('last_name') }}"
                                    required
                                >
                            </div>
                        </div>

                        <input type="hidden" name="name" id="nameHidden">

                        <div class="field-group">
                            <label class="auth-label" for="email">Email Address (email UNDIP)</label>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                class="auth-input"
                                placeholder="example@students.undip.ac.id"
                                value="{{ old('email') }}"
                                required
                            >
                            @error('email')
                                <div class="auth-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="field-group">
                            <label class="auth-label" for="password">Password</label>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                class="auth-input"
                                placeholder="Password"
                                required
                                autocomplete="new-password"
                            >
                            @error('password')
                                <div class="auth-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="field-group">
                            <label class="auth-label" for="password_confirmation">Confirm Password</label>
                            <input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                class="auth-input"
                                placeholder="Confirm Password"
                                required
                            >
                        </div>

                        <div class="auth-checkbox-row">
                            <input
                                id="terms"
                                type="checkbox"
                                class="auth-checkbox"
                                required
                            >
                            <label for="terms">
                                Accept Terms &amp; Conditions <strong>kampuStore</strong>
                            </label>
                        </div>

                        <button type="submit" class="auth-btn-primary">
                            Sign Up
                        </button>
                    </form>

                    <div class="auth-divider">
                        <span></span><div>or</div><span></span>
                    </div>

                    <div class="auth-bottom-text">
                        Already have an account?
                        <a href="{{ route('login') }}" id="goLogin">Login here</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const form = document.getElementById('registerForm');
        const emailInput = document.getElementById('email');
        const firstNameInput = document.getElementById('first_name');
        const lastNameInput = document.getElementById('last_name');
        const hiddenName = document.getElementById('nameHidden');

        form.addEventListener('submit', function (e) {
            const f = firstNameInput.value.trim();
            const l = lastNameInput.value.trim();
            hiddenName.value = (f + ' ' + l).trim();

            const email = emailInput.value.trim();
            const undipRegex = /@(students\.)?undip\.ac\.id$/i;

            if (!undipRegex.test(email)) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Email tidak valid',
                    text: 'Registrasi hanya bisa menggunakan email kampus UNDIP (…@students.undip.ac.id atau …@undip.ac.id).',
                    confirmButtonColor: '#f97316'
                });
            }
        });

        // animasi masuk + geser ke login
        document.addEventListener('DOMContentLoaded', function () {
            const shell = document.querySelector('.auth-shell');
            if (shell) {
                requestAnimationFrame(() => {
                    shell.classList.add('is-visible');
                });
            }

            const goLogin = document.getElementById('goLogin');
            if (shell && goLogin) {
                goLogin.addEventListener('click', function (e) {
                    e.preventDefault();
                    // geser ke kanan dulu
                    shell.classList.remove('is-visible');
                    shell.classList.add('slide-out-right');
                    setTimeout(() => {
                        window.location.href = goLogin.href;
                    }, 400);
                });
            }
        });
    </script>

    @if ($errors->has('email'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Email tidak valid',
                text: @json($errors->first('email')),
                confirmButtonColor: '#f97316'
            });
        </script>
    @endif

</body>
</html>
