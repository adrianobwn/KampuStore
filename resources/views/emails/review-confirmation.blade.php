<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light dark">
    <meta name="supported-color-schemes" content="light dark">
    <title>Terima Kasih Atas Ulasan Anda</title>
    <style>
        :root {
            color-scheme: light dark;
            supported-color-schemes: light dark;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
        }

        .header {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(249, 115, 22, 0.2);
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }

        .content {
            padding: 30px;
            background-color: #f9fafb;
            border-radius: 10px;
            margin-top: 20px;
            border: 1px solid #e5e7eb;
        }

        .review-box {
            background-color: #ffffff;
            border-left: 4px solid #f97316;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .review-box strong {
            color: #f97316;
            font-size: 16px;
        }

        .review-box p {
            margin: 10px 0 0 0;
            color: #4b5563;
            line-height: 1.8;
        }

        .stars {
            color: #eab308;
            font-size: 18px;
            letter-spacing: 2px;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            font-size: 12px;
            color: #6b7280;
            text-align: center;
        }

        /* Dark mode styles */
        @media (prefers-color-scheme: dark) {
            body {
                background-color: #111827;
                color: #f9fafb;
            }

            .content {
                background-color: #1f2937;
                border-color: #374151;
            }

            .review-box {
                background-color: #111827;
                border-color: #f97316;
            }

            .review-box p {
                color: #d1d5db;
            }

            .footer {
                border-top-color: #374151;
                color: #9ca3af;
            }

            p,
            strong {
                color: #f9fafb;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Terima Kasih Atas Ulasan Anda! 🎉</h1>
    </div>

    <div class="content">
        <p>Halo, <strong>{{ $reviewerName }}</strong> 👋</p>

        <p>Terima kasih telah memberikan ulasan untuk produk <strong>{{ $productName }}</strong> di KampuStore!</p>

        <div class="review-box">
            <strong>📝 Ulasan Anda:</strong>
            <p class="stars">
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= $review->rating)
                        ★
                    @else
                        ☆
                    @endif
                @endfor
                ({{ $review->rating }}/5)
            </p>
            <p>{{ $review->body }}</p>
        </div>

        <p>Ulasan Anda sangat berarti bagi penjual dan membantu pembeli lain dalam membuat keputusan yang tepat.</p>

        <p>Terima kasih telah menjadi bagian dari komunitas KampuStore! 🙏</p>
    </div>

    <div class="footer">
        <p>Email ini dikirim secara otomatis. Jangan membalas email ini.</p>
        <p>&copy; {{ date('Y') }} KampuStore - Marketplace Kampus Undip</p>
    </div>
</body>

</html>