<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Anda Disetujui - kampuStore</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif;
            line-height: 1.6;
            color: #374151;
            max-width: 600px;
            margin: 0 auto;
            padding: 40px 20px;
            background-color: #ffffff;
        }

        .logo {
            font-size: 22px;
            font-weight: 700;
            color: #1a2550;
            margin-bottom: 32px;
        }

        .title {
            font-size: 28px;
            font-weight: 600;
            color: #111827;
            margin: 0 0 24px 0;
        }

        p {
            margin: 0 0 16px 0;
            color: #4b5563;
            font-size: 15px;
        }

        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #1f3b8a;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 14px;
            margin: 16px 0 32px 0;
        }

        .divider {
            border: none;
            border-top: 1px solid #e5e7eb;
            margin: 32px 0;
        }

        .footer-text {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 24px;
        }

        .footer-link {
            color: #1f3b8a;
            text-decoration: underline;
        }

        .signature {
            font-size: 14px;
            color: #6b7280;
        }
    </style>
</head>

<body>
    <div class="logo">kampuStore</div>

    <h1 class="title">Toko Anda Telah Disetujui!</h1>

    <p>Halo <strong>{{ $seller->nama_pic }}</strong>,</p>

    <p>Selamat! Pendaftaran toko <strong>{{ $seller->nama_toko }}</strong> Anda telah disetujui oleh Admin kampuStore. Anda sekarang dapat mulai mengelola toko dan mengunggah produk Anda.</p>

    <p><strong>Informasi Toko:</strong></p>
    <p>
        Nama Toko: {{ $seller->nama_toko }}<br>
        PIC: {{ $seller->nama_pic }}<br>
        Email: {{ $seller->email_pic }}<br>
        Lokasi: {{ $seller->kota }}
    </p>

    <a href="{{ $activationUrl }}" class="button">Aktifkan Akun & Kelola Toko</a>

    <hr class="divider">

    <p class="footer-text">Ada pertanyaan? <a href="mailto:support@kampustore.com" class="footer-link">Hubungi kami</a></p>

    <p class="signature">
        Salam,<br>
        ~ Tim kampuStore
    </p>
</body>

</html>
