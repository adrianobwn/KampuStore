@php
    $title = 'Toko Disetujui | kampuStore';
@endphp
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
            box-sizing: border-box
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif;
            background: radial-gradient(circle at top left, #1f3b8a 0, #020617 52%, #020617 100%);
            color: #e5e7eb;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .success-card {
            width: 100%;
            max-width: 480px;
            padding: 48px 40px;
            border-radius: 16px;
            background: rgba(15, 23, 42, 0.9);
            border: 1px solid rgba(30, 64, 175, 0.4);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
            text-align: center;
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
            color: #f9fafb;
            margin-bottom: 32px;
        }

        .title {
            font-size: 24px;
            font-weight: 700;
            color: #f9fafb;
            margin-bottom: 16px;
        }

        .message {
            font-size: 15px;
            color: #9ca3af;
            margin-bottom: 32px;
            line-height: 1.6;
        }

        .button {
            display: inline-block;
            padding: 14px 32px;
            background: linear-gradient(135deg, #1f3b8a 0%, #3b82f6 100%);
            color: #ffffff;
            font-size: 15px;
            font-weight: 600;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
        }

        .footer {
            margin-top: 32px;
            font-size: 12px;
            color: #6b7280;
        }
    </style>
</head>

<body>
    <div class="success-card">
        <div class="logo">kampuStore</div>

        <h1 class="title">Toko Anda Telah Disetujui!</h1>

        <p class="message">
            Selamat! Pengajuan toko Anda telah diverifikasi dan disetujui oleh Admin kampuStore. 
            Anda sekarang dapat login dan mulai mengelola toko serta mengunggah produk.
        </p>

        <a href="{{ route('login') }}" class="button">Login Sekarang</a>

        <p class="footer">
            &copy; {{ date('Y') }} kampuStore - Marketplace Kampus Undip
        </p>
    </div>
</body>

</html>
