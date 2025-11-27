@php($title = 'Login Penjual | kampuStore')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }
        
        .login-container {
            background: white;
            border-radius: 24px;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            max-width: 1000px;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            animation: fadeInUp 0.6s ease-out;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .login-visual {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        
        .login-visual::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 70%);
            border-radius: 50%;
            top: -100px;
            right: -100px;
        }
        
        .visual-content {
            position: relative;
            z-index: 1;
            text-align: center;
        }
        
        .visual-icon {
            width: 120px;
            height: 120px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            backdrop-filter: blur(10px);
        }
        
        .visual-icon i {
            font-size: 60px;
            color: white;
        }
        
        .visual-title {
            color: white;
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 16px;
        }
        
        .visual-text {
            color: rgba(255, 255, 255, 0.9);
            font-size: 15px;
            line-height: 1.6;
            max-width: 300px;
            margin: 0 auto;
        }
        
        .login-form {
            padding: 60px 50px;
        }
        
        .form-header {
            margin-bottom: 40px;
        }
        
        .form-title {
            font-size: 32px;
            font-weight: 800;
            color: #111827;
            margin-bottom: 12px;
        }
        
        .form-subtitle {
            color: #6b7280;
            font-size: 15px;
            line-height: 1.5;
        }
        
        .info-box {
            background: rgba(102, 126, 234, 0.1);
            border: 1px solid rgba(102, 126, 234, 0.3);
            border-radius: 12px;
            padding: 14px;
            margin-top: 16px;
            font-size: 13px;
            color: #4b5563;
            text-align: center;
        }
        
        .info-box strong {
            color: #667eea;
        }
        
        .info-box a {
            color: #667eea;
            text-decoration: underline;
        }
        
        .form-group {
            margin-bottom: 24px;
        }
        
        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }
        
        .form-input {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s;
            font-family: inherit;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }
        
        .form-error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
        }
        
        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #6b7280;
            cursor: pointer;
        }
        
        .checkbox-wrapper input {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }
        
        .forgot-link {
            color: #667eea;
            font-size: 14px;
            text-decoration: none;
            font-weight: 600;
        }
        
        .forgot-link:hover {
            text-decoration: underline;
        }
        
        .btn-submit {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        }
        
        .form-footer {
            text-align: center;
            margin-top: 32px;
            padding-top: 28px;
            border-top: 1px solid #e5e7eb;
            color: #6b7280;
            font-size: 14px;
        }
        
        .form-footer a {
            color: #667eea;
            font-weight: 600;
            text-decoration: none;
        }
        
        .form-footer a:hover {
            text-decoration: underline;
        }
        
        .back-home {
            position: fixed;
            top: 24px;
            left: 24px;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 50px;
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s;
        }
        
        .back-home:hover {
            background: white;
            transform: translateX(-4px);
        }
        
        @media (max-width: 768px) {
            .login-container {
                grid-template-columns: 1fr;
                max-width: 450px;
            }
            
            .login-visual {
                padding: 40px 30px;
            }
            
            .visual-title {
                font-size: 24px;
            }
            
            .login-form {
                padding: 40px 30px;
            }
            
            .form-title {
                font-size: 26px;
            }
            
            .back-home {
                position: static;
                margin-bottom: 20px;
                width: fit-content;
            }
        }
    </style>
</head>
<body>
    <a href="{{ route('home') }}" class="back-home">
        <i class="uil uil-arrow-left"></i>
        Kembali ke Home
    </a>

    <div class="login-container">
        {{-- Visual Side --}}
        <div class="login-visual">
            <div class="visual-content">
                <div class="visual-icon">
                    <i class="uil uil-shop"></i>
                </div>
                <h2 class="visual-title">Login Penjual</h2>
                <p class="visual-text">
                    Kelola toko dan produk Anda dengan mudah melalui dashboard penjual KampuStore
                </p>
            </div>
        </div>

        {{-- Form Side --}}
        <div class="login-form">
            <div class="form-header">
                <h1 class="form-title">Selamat Datang!</h1>
                <p class="form-subtitle">
                    Masuk dengan akun penjual Anda untuk mengelola toko
                </p>
                <div class="info-box">
                    <strong><i class="uil uil-info-circle"></i> Info:</strong> Login ini khusus untuk penjual. 
                    Pembeli bisa langsung belanja tanpa login di <a href="{{ route('products.index') }}">halaman market</a>.
                </div>
            </div>

            <form method="POST" action="{{ route('login.perform') }}">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        class="form-input"
                        value="{{ old('email') }}"
                        placeholder="nama@students.undip.ac.id"
                        required
                        autofocus
                    >
                    @error('email')
                        <div class="form-error">
                            <i class="uil uil-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        class="form-input"
                        placeholder="Masukkan password Anda"
                        required
                    >
                    @error('password')
                        <div class="form-error">
                            <i class="uil uil-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-options">
                    <label class="checkbox-wrapper">
                        <input type="checkbox" name="remember" id="remember">
                        <span>Ingat saya</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="forgot-link">
                        Lupa password?
                    </a>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="uil uil-signin"></i>
                    Login
                </button>
            </form>

            <div class="form-footer">
                Belum terdaftar sebagai penjual?
                <a href="{{ route('register') }}">Daftar sekarang</a>
            </div>
        </div>
    </div>

    @if(session('status'))
    <script>
        alert('{{ session('status') }}');
    </script>
    @endif
</body>
</html>
