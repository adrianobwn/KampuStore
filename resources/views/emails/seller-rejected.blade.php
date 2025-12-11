<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Toko Ditolak - kampuStore</title>
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

        ul {
            margin: 0 0 16px 0;
            padding-left: 20px;
            color: #4b5563;
        }

        li {
            margin-bottom: 8px;
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

    <h1 class="title">Pembaruan Status Pengajuan Toko</h1>

    <p>Halo <strong>{{ $seller->nama_pic }}</strong>,</p>

    <p>Terima kasih telah mengajukan permohonan untuk membuka toko di kampuStore. Setelah melalui proses peninjauan, kami informasikan bahwa pengajuan Anda <strong>belum dapat kami setujui</strong> saat ini.</p>

    <p><strong>Kemungkinan alasan penolakan:</strong></p>
    <ul>
        <li>Data atau dokumen yang diberikan belum lengkap atau tidak valid</li>
        <li>Tidak memenuhi persyaratan verifikasi keamanan akun</li>
    </ul>

    <p>Kami menyarankan Anda untuk memperbaiki informasi atau melengkapi dokumen yang diperlukan, kemudian melakukan pengajuan ulang.</p>

    <a href="{{ route('register') }}" class="button">Daftar Ulang</a>

    <hr class="divider">

    <p class="footer-text">Butuh bantuan? <a href="mailto:support@kampustore.com" class="footer-link">Hubungi kami</a></p>

    <p class="signature">
        Salam,<br>
        ~ Tim kampuStore
    </p>
</body>

</html>
