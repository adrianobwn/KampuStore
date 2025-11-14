<?php ($title = 'Login | kampuStore'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($title); ?></title>

    <style>
        *{margin:0;padding:0;box-sizing:border-box}

        body{
            font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Arial,sans-serif;
            background:#070b1f;
            color:#e5e7eb;
            min-height:100vh;
        }
        body.theme-light{
            background:#f3f4ff;
            color:#111827;
        }

        a{text-decoration:none;color:inherit;}

        /* NAVBAR */
        .nav{
            position:fixed;
            top:0;left:0;right:0;
            z-index:50;
            display:flex;
            align-items:center;
            justify-content:space-between;
            padding:18px 60px;
            background:linear-gradient(90deg,#111827,#111827);
        }
        body.theme-light .nav{
            background:#ffffff;
            border-bottom:1px solid #e5e7eb;
        }
        .nav-left{
            display:flex;
            align-items:center;
            gap:28px;
        }
        .nav-logo{
            display:flex;
            align-items:center;
            font-weight:700;
            font-size:22px;
            letter-spacing:0.04em;
            color:#f9fafb;
            cursor:pointer;
        }
        .nav-logo img{
            height:40px;
            display:block;
        }
        body.theme-light .nav-logo{
            color:#111827;
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
        body.theme-light .nav-menu a{color:#111827;}
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

        .nav-actions{
            display:flex;
            align-items:center;
            gap:12px;
        }

        /* THEME TOGGLE */
        .theme-toggle-wrapper{
            display:flex;
            justify-content:center;
            align-items:center;
        }
        .toggle-switch{
            position:relative;
            display:inline-block;
            width:74px;
            height:36px;
            transform:scale(.95);
            transition:transform .2s;
        }
        .toggle-switch:hover{transform:scale(1);}
        .toggle-switch input{
            opacity:0;
            width:0;
            height:0;
        }
        .slider{
            position:absolute;
            cursor:pointer;
            inset:0;
            background:linear-gradient(145deg,#fbbf24,#f97316);
            transition:.4s;
            border-radius:34px;
            box-shadow:0 0 12px rgba(249,115,22,0.5);
            overflow:hidden;
        }
        .slider:before{
            position:absolute;
            content:"☀️";
            height:28px;
            width:28px;
            left:4px;
            bottom:4px;
            background:white;
            transition:.4s;
            border-radius:50%;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:16px;
            box-shadow:0 0 10px rgba(0,0,0,.15);
            z-index:2;
        }
        .clouds{
            position:absolute;
            width:100%;
            height:100%;
            overflow:hidden;
            pointer-events:none;
        }
        .cloud{
            position:absolute;
            width:24px;
            height:24px;
            fill:rgba(255,255,255,0.9);
            filter:drop-shadow(0 2px 3px rgba(0,0,0,0.08));
        }
        .cloud1{
            top:6px;
            left:10px;
            animation:floatCloud1 8s infinite linear;
        }
        .cloud2{
            top:10px;
            left:38px;
            transform:scale(.85);
            animation:floatCloud2 12s infinite linear;
        }
        @keyframes floatCloud1{
            0%{transform:translateX(-20px);opacity:0;}
            20%{opacity:1;}
            80%{opacity:1;}
            100%{transform:translateX(80px);opacity:0;}
        }
        @keyframes floatCloud2{
            0%{transform:translateX(-20px) scale(.85);opacity:0;}
            20%{opacity:.7;}
            80%{opacity:.7;}
            100%{transform:translateX(80px) scale(.85);opacity:0;}
        }
        input.js-theme-toggle:checked + .slider{
            background:linear-gradient(145deg,#1f2937,#020617);
            box-shadow:0 0 14px rgba(15,23,42,0.8);
        }
        input.js-theme-toggle:checked + .slider:before{
            transform:translateX(38px);
            content:"🌙";
        }
        input.js-theme-toggle:checked + .slider .cloud{
            opacity:0;
            transform:translateY(-18px);
        }

        /* BACKGROUND */
        .auth-bg{
            min-height:100vh;
            padding:120px 40px 60px;
            display:flex;
            align-items:center;
            justify-content:center;
            background:radial-gradient(circle at top left,#3b4ad4 0,#030616 55%);
            position:relative;
            overflow:hidden;
        }
        body.theme-light .auth-bg{
            background:radial-gradient(circle at top left,#e5e7ff 0,#f9fafb 65%);
        }
        .auth-bg::before,
        .auth-bg::after{
            content:'';
            position:absolute;
            border-radius:999px;
            filter:blur(26px);
            opacity:.5;
        }
        .auth-bg::before{
            width:360px;height:360px;
            background:linear-gradient(135deg,#6366f1,#f97316);
            top:-130px;left:-80px;
        }
        .auth-bg::after{
            width:320px;height:320px;
            background:linear-gradient(135deg,#0ea5e9,#22c55e);
            bottom:-150px;right:-70px;
        }

        /* CARD WRAPPER */
        .auth-shell{
            width:100%;
            max-width:1100px;
            min-height:520px;
            background:#020617;
            border-radius:28px;
            overflow:hidden;
            box-shadow:0 22px 50px rgba(0,0,0,.75);
            display:flex;
            position:relative;
            z-index:1;
        }
        body.theme-light .auth-shell{background:#ffffff;}

        .auth-panel,
        .auth-visual{
            transition:
                transform .6s cubic-bezier(0.25,0.8,0.25,1),
                opacity   .6s cubic-bezier(0.25,0.8,0.25,1);
        }
        .auth-shell.pre-enter .auth-panel{
            transform:translate3d(60px,0,0);
            opacity:0;
        }
        .auth-shell.pre-enter .auth-visual{
            transform:translate3d(-60px,0,0);
            opacity:0;
        }
        .auth-shell.is-visible .auth-panel,
        .auth-shell.is-visible .auth-visual{
            transform:translate3d(0,0,0);
            opacity:1;
        }
        .auth-shell.exit .auth-panel{
            transform:translate3d(60px,0,0);
            opacity:0;
        }
        .auth-shell.exit .auth-visual{
            transform:translate3d(-60px,0,0);
            opacity:0;
        }

        /* FOTO (KIRI) */
        .auth-visual{
            flex: 1.1;
            background: radial-gradient(circle at top,#0f172a 0,#020617 55%,#000 100%);
            display:flex;
            justify-content:center;
            align-items:center;
            padding:32px 28px;
            position:relative;
        }
        body.theme-light .auth-visual{
            background:radial-gradient(circle at top,#dbeafe 0,#1e293b 70%);
        }
        .auth-visual img{
            max-width: 100%;
            max-height: 260px;
            width: auto;
            height: auto;
            object-fit: contain;
            border-radius: 24px;
            box-shadow: 0 18px 40px rgba(0,0,0,.8);
        }

        /* FORM (KANAN) */
        .auth-panel{
            flex:1.05;
            padding:34px 46px 34px;
            background:linear-gradient(135deg,rgba(15,23,42,0.96),rgba(15,23,42,0.98));
            display:flex;
            flex-direction:column;
            color:#f9fafb;
        }
        body.theme-light .auth-panel{
            background:linear-gradient(135deg,#f9fafb,#e5e7eb);
            color:#111827;
        }
        .auth-panel-inner{
            max-width:380px;
            margin:auto 0;
        }
        .auth-eyebrow{
            font-size:12px;
            letter-spacing:.18em;
            text-transform:uppercase;
            color:#9ca3af;
            margin-bottom:4px;
        }
        body.theme-light .auth-eyebrow{color:#6b7280;}
        .auth-title{
            font-size:28px;
            font-weight:800;
            margin-bottom:6px;
        }
        .auth-subtitle{
            font-size:13px;
            color:#9ca3af;
            margin-bottom:20px;
        }
        body.theme-light .auth-subtitle{color:#6b7280;}

        .field-group{margin-bottom:18px;width:100%;}

        /* FLOATING INPUT */
        .group{position:relative;}
        .group .auth-input{
            font-size:14px;
            padding:10px 10px 10px 5px;
            display:block;
            width:100%;
            border:none;
            border-bottom:1px solid #515151;
            border-radius:0;
            background:transparent;
            color:#f9fafb;
        }
        body.theme-light .group .auth-input{
            color:#111827;
            border-bottom-color:#9ca3af;
        }
        .group .auth-input:focus{outline:none;}

        .group label{
            color:#999;
            font-size:13px;
            font-weight:500;
            position:absolute;
            pointer-events:none;
            left:5px;
            top:10px;
            transition:.2s ease all;
        }
        body.theme-light .group label{color:#6b7280;}

        .group .auth-input:focus ~ label,
        .group .auth-input:not(:placeholder-shown) ~ label{
            top:-12px;
            font-size:11px;
            color:#f97316;
        }

        .group .bar{
            position:relative;
            display:block;
            width:100%;
            height:2px;
        }
        .group .bar:before,
        .group .bar:after{
            content:'';
            height:2px;
            width:0;
            bottom:0;
            position:absolute;
            background:#f97316;
            transition:.2s ease all;
        }
        .group .bar:before{left:50%;}
        .group .bar:after{right:50%;}
        .group .auth-input:focus ~ .bar:before,
        .group .auth-input:focus ~ .bar:after{
            width:50%;
        }
        .group .highlight{
            position:absolute;
            height:60%;
            width:100px;
            top:25%;
            left:0;
            pointer-events:none;
            opacity:.5;
        }
        .group .auth-input:focus ~ .highlight{
            animation:inputHighlighter .3s ease;
        }
        @keyframes inputHighlighter{
            from{background:#f97316;}
            to{width:0;background:transparent;}
        }

        /* REMEMBER + FORGOT */
        .auth-checkbox-row{
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:12px;
            margin:4px 0 18px;
            font-size:13px;
            color:#e5e7eb;
        }
        body.theme-light .auth-checkbox-row{color:#111827;}

        .auth-checkbox-row-left{
            display:flex;
            align-items:center;
            gap:8px;
        }

        .remember-label-text{
            font-size:13px;
        }

        /* animated checkbox remember me – ORANGE */
        .check{
            cursor:pointer;
            position:relative;
            width:18px;
            height:18px;
            -webkit-tap-highlight-color:transparent;
            transform:translate3d(0,0,0);
        }
        .check:before{
            content:"";
            position:absolute;
            top:-15px;
            left:-15px;
            width:48px;
            height:48px;
            border-radius:50%;
            background:rgba(34,50,84,0.03);
            opacity:0;
            transition:opacity .2s ease;
        }
        .check svg{
            position:relative;
            z-index:1;
            fill:none;
            stroke-linecap:round;
            stroke-linejoin:round;
            stroke:#c8ccd4;
            stroke-width:1.5;
            transform:translate3d(0,0,0);
            transition:all .2s ease;
        }
        .check svg path{
            stroke-dasharray:60;
            stroke-dashoffset:0;
        }
        .check svg polyline{
            stroke-dasharray:22;
            stroke-dashoffset:66;
        }
        .check:hover:before{opacity:1;}
        .check:hover svg{stroke:#f97316;}       /* ORANGE hover */

        #remember_cbx:checked + .check svg{
            stroke:#f97316;                     /* ORANGE checked */
        }
        #remember_cbx:checked + .check svg path{
            stroke-dashoffset:60;
            transition:all .3s linear;
        }
        #remember_cbx:checked + .check svg polyline{
            stroke-dashoffset:42;
            transition:all .2s linear;
            transition-delay:.15s;
        }

        /* FORGOT PASSWORD – ANIMASI ORANGE */
        .auth-forgot{
            position:relative;
            font-size:12px;
            font-weight:500;
            color:#9ca3af;
            text-decoration:none;
            cursor:pointer;
            display:inline-flex;
            align-items:center;
            padding:4px 0;
            transition:color .2s ease, transform .2s ease;
        }
        body.theme-light .auth-forgot{color:#4b5563;}

        .auth-forgot::after{
            content:'';
            position:absolute;
            left:0;
            bottom:0;
            width:100%;
            height:2px;
            background:#f97316;
            transform:scaleX(0);
            transform-origin:right;
            opacity:.95;
            transition:transform .25s ease-out;
        }

        .auth-forgot:hover{
            color:#f97316;
            transform:translateX(2px);
        }
        .auth-forgot:hover::after{
            transform:scaleX(1);
            transform-origin:left;
        }

        /* BUTTON */
        .auth-btn-primary{
            width:100%;
            border:none;
            border-radius:999px;
            padding:11px 18px;
            font-size:14px;
            font-weight:700;
            cursor:pointer;
            background:#f97316;
            color:#111827;
            margin-top:4px;
            transition:background .2s ease, transform .15s ease, box-shadow .15s ease;
            box-shadow:0 12px 25px rgba(248,113,22,.45);
        }
        .auth-btn-primary:hover{
            background:#fb923c;
            transform:translateY(-1px);
        }
        .auth-btn-primary:active{
            transform:translateY(0);
            box-shadow:0 6px 16px rgba(248,113,22,.5);
        }

        .auth-bottom-text{
            margin-top:14px;
            font-size:13px;
            text-align:center;
            color:#e5e7eb;
        }
        body.theme-light .auth-bottom-text{color:#111827;}
        .auth-bottom-text a{
            color:#f97316;
            font-weight:600;
        }

        .auth-error{
            font-size:12px;
            color:#fecaca;
            margin-top:4px;
        }

        @media(max-width:900px){
            .nav{padding:14px 20px;}
            .auth-bg{padding:110px 18px 40px;}
            .auth-shell{
                max-width:520px;
                flex-direction:column;
                border-radius:24px;
            }
            .auth-panel{padding:26px 22px 24px;}
            .auth-panel-inner{max-width:100%;}
            .auth-visual{padding:12px 16px 4px;}
            .auth-visual img{
                max-height:220px;
                border-radius:20px;
            }
        }
    </style>
</head>
<body class="theme-dark">

<nav class="nav">
    <div class="nav-left">
        <a href="<?php echo e(route('home')); ?>" class="nav-logo">
            <img src="<?php echo e(asset('images/logo.png')); ?>" alt="kampuStore logo">
            <span>kampuStore</span>
        </a>
        <div class="nav-menu">
            <a href="<?php echo e(route('home')); ?>">Home</a>
            <a href="<?php echo e(route('home')); ?>#about">About</a>
            <a href="<?php echo e(route('products.index')); ?>">Market</a>
            <a href="<?php echo e(route('home')); ?>#contact">Contact</a>
        </div>
    </div>
    <div class="nav-actions">
        <div class="theme-toggle-wrapper">
            <label class="toggle-switch">
                <input type="checkbox" class="js-theme-toggle" />
                <span class="slider">
                    <div class="clouds">
                        <svg viewBox="0 0 100 100" class="cloud cloud1">
                            <path d="M30,45 Q35,25 50,25 Q65,25 70,45 Q80,45 85,50 Q90,55 85,60 Q80,65 75,60 Q65,60 60,65 Q55,70 50,65 Q45,70 40,65 Q35,60 25,60 Q20,65 15,60 Q10,55 15,50 Q20,45 30,45"></path>
                        </svg>
                        <svg viewBox="0 0 100 100" class="cloud cloud2">
                            <path d="M30,45 Q35,25 50,25 Q65,25 70,45 Q80,45 85,50 Q90,55 85,60 Q80,65 75,60 Q65,60 60,65 Q55,70 50,65 Q45,70 40,65 Q35,60 25,60 Q20,65 15,60 Q10,55 15,50 Q20,45 30,45"></path>
                        </svg>
                    </div>
                </span>
            </label>
        </div>
    </div>
</nav>

<main class="auth-bg">
    <div class="auth-shell pre-enter">

        <div class="auth-visual">
            <img src="<?php echo e(asset('images/pc.png')); ?>" alt="kampuStore hero">
        </div>

        <div class="auth-panel">
            <div class="auth-panel-inner">
                <div class="auth-eyebrow">WELCOME BACK</div>
                <h1 class="auth-title">Login</h1>
                <p class="auth-subtitle">
                    Masuk dengan email kampus UNDIP untuk melanjutkan transaksi di kampuStore.
                </p>

                <form method="POST" action="<?php echo e(route('login')); ?>">
                    <?php echo csrf_field(); ?>

                    <div class="field-group group">
                        <input
                            id="email"
                            type="email"
                            name="email"
                            class="auth-input"
                            value="<?php echo e(old('email')); ?>"
                            required
                            autofocus
                            placeholder=" "
                        >
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label for="email">Email Address</label>
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="auth-error"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="field-group group">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            class="auth-input"
                            required
                            autocomplete="current-password"
                            placeholder=" "
                        >
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label for="password">Password</label>
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="auth-error"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="auth-checkbox-row">
                        <div class="auth-checkbox-row-left">
                            
                            <input
                                id="remember_cbx"
                                type="checkbox"
                                name="remember"
                                style="display:none"
                            >
                            
                            <label for="remember_cbx" class="check">
                                <svg width="18px" height="18px" viewBox="0 0 18 18">
                                    <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                    <polyline points="1 9 7 14 15 4"></polyline>
                                </svg>
                            </label>
                            <span class="remember-label-text">Remember me</span>
                        </div>

                        <?php if(Route::has('password.request')): ?>
                            <a href="<?php echo e(route('password.request')); ?>" class="auth-forgot">
                                Forgot password?
                            </a>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="auth-btn-primary">
                        Log In
                    </button>
                </form>

                <div class="auth-bottom-text">
                    Don't have an account yet?
                    <a href="<?php echo e(route('register')); ?>" id="goRegister">Create account</a>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    // THEME TOGGLE (sinkron dengan home/register)
    (function(){
        const KEY = 'kampuStoreTheme';
        const body = document.body;
        const toggle = document.querySelector('.js-theme-toggle');

        function apply(mode){
            if(mode === 'light'){
                body.classList.add('theme-light');
            }else{
                body.classList.remove('theme-light');
            }
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

    // animasi card masuk + keluar ke register
    document.addEventListener('DOMContentLoaded', function () {
        const shell = document.querySelector('.auth-shell');
        const goRegister = document.getElementById('goRegister');

        if(shell){
            requestAnimationFrame(() => {
                shell.classList.remove('pre-enter');
                shell.classList.add('is-visible');
            });
        }

        if(shell && goRegister){
            goRegister.addEventListener('click', function(e){
                e.preventDefault();
                shell.classList.remove('is-visible');
                shell.classList.add('exit');
                setTimeout(() => {
                    window.location.href = goRegister.href;
                }, 600);
            });
        }
    });
</script>

</body>
</html>
<?php /**PATH E:\laragon\www\KampuStore\KampuStore\resources\views/auth/login.blade.php ENDPATH**/ ?>