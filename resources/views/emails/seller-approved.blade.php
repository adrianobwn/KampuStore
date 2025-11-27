<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Toko Anda Disetujui</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
        }
        .content {
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            margin-top: 20px;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .footer {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🎉 Selamat! Toko Anda Disetujui</h1>
    </div>
    
    <div class="content">
        <p>Halo, <strong>{{ $seller->nama_pic }}</strong></p>
        
        <p>Selamat! Pendaftaran toko <strong>{{ $seller->nama_toko }}</strong> Anda telah disetujui oleh admin KampuStore.</p>
        
        <p>Anda sekarang dapat mulai mengelola toko dan mengunggah produk Anda.</p>
        
        <p style="text-align: center;">
            <a href="{{ $activationUrl }}" class="button">Aktifkan Akun & Kelola Toko</a>
        </p>
        
        <p><strong>Informasi Toko Anda:</strong></p>
        <ul>
            <li>Nama Toko: {{ $seller->nama_toko }}</li>
            <li>PIC: {{ $seller->nama_pic }}</li>
            <li>Email: {{ $seller->email_pic }}</li>
            <li>Lokasi: {{ $seller->kota }}</li>
        </ul>
        
        <p>Terima kasih telah bergabung dengan KampuStore!</p>
    </div>
    
    <div class="footer">
        <p>Email ini dikirim secara otomatis. Jangan membalas email ini.</p>
        <p>&copy; {{ date('Y') }} KampuStore - Marketplace Kampus Undip</p>
    </div>
</body>
</html>
