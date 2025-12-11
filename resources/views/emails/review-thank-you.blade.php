<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terima Kasih atas Ulasan Anda - kampuStore</title>
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

        .stars {
            color: #f59e0b;
            font-size: 18px;
            letter-spacing: 2px;
        }

        .review-text {
            font-style: italic;
            color: #6b7280;
            margin-top: 8px;
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

    <h1 class="title">Terima Kasih atas Ulasan Anda!</h1>

    <p>Halo <strong>{{ $reviewerName }}</strong>,</p>

    <p>Terima kasih telah memberikan ulasan untuk produk <strong>{{ $product->name }}</strong> di kampuStore.</p>

    <p><strong>Ulasan Anda:</strong></p>
    <p>
        <span class="stars">
            @for($i = 1; $i <= 5; $i++)
                @if($i <= $review->rating)★@else☆@endif
            @endfor
        </span>
        ({{ $review->rating }}/5)
    </p>
    <p class="review-text">"{{ $review->body }}"</p>

    <p>Ulasan Anda sangat membantu pembeli lain dalam membuat keputusan pembelian. Kami menghargai waktu dan masukan Anda.</p>

    <hr class="divider">

    <p class="footer-text">Ada pertanyaan? <a href="mailto:support@kampustore.com" class="footer-link">Hubungi kami</a></p>

    <p class="signature">
        Salam,<br>
        ~ Tim kampuStore
    </p>
</body>

</html>
