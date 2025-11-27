<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pendaftaran Toko Ditolak</title>
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
            background-color: #f44336;
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
        .reason-box {
            background-color: #fff;
            border-left: 4px solid #f44336;
            padding: 15px;
            margin: 15px 0;
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
        <h1>Pendaftaran Toko Ditolak</h1>
    </div>
    
    <div class="content">
        <p>Halo, <strong>{{ $seller->nama_pic }}</strong></p>
        
        <p>Mohon maaf, pendaftaran toko <strong>{{ $seller->nama_toko }}</strong> Anda belum dapat disetujui oleh admin KampuStore.</p>
        
        <div class="reason-box">
            <strong>Alasan Penolakan:</strong>
            <p>{{ $rejectionReason }}</p>
        </div>
        
        <p>Anda dapat memperbaiki data pendaftaran dan mengirimkan kembali permohonan pendaftaran toko setelah memenuhi persyaratan yang disebutkan di atas.</p>
        
        <p>Jika Anda memiliki pertanyaan, silakan hubungi admin KampuStore.</p>
        
        <p>Terima kasih atas pengertian Anda.</p>
    </div>
    
    <div class="footer">
        <p>Email ini dikirim secara otomatis. Jangan membalas email ini.</p>
        <p>&copy; {{ date('Y') }} KampuStore - Marketplace Kampus Undip</p>
    </div>
</body>
</html>
