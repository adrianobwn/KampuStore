<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Terima Kasih atas Ulasan Anda</title>
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
        .rating {
            color: #FFC107;
            font-size: 20px;
        }
        .product-info {
            background-color: #fff;
            padding: 15px;
            margin: 15px 0;
            border-left: 4px solid #4CAF50;
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
        <h1>✨ Terima Kasih atas Ulasan Anda!</h1>
    </div>
    
    <div class="content">
        <p>Halo, <strong>{{ $reviewerName }}</strong></p>
        
        <p>Terima kasih telah memberikan ulasan untuk produk di KampuStore!</p>
        
        <div class="product-info">
            <strong>Produk:</strong> {{ $product->name }}<br>
            <strong>Rating Anda:</strong> 
            <span class="rating">
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= $review->rating)
                        ★
                    @else
                        ☆
                    @endif
                @endfor
            </span> ({{ $review->rating }}/5)<br>
            <strong>Komentar Anda:</strong><br>
            <em>"{{ $review->body }}"</em>
        </div>
        
        <p>Ulasan Anda sangat membantu pembeli lain dalam membuat keputusan pembelian yang tepat. Kami menghargai waktu dan masukan Anda!</p>
        
        <p>Jangan lupa untuk terus mengunjungi KampuStore untuk menemukan produk-produk menarik lainnya dari kampus.</p>
    </div>
    
    <div class="footer">
        <p>Email ini dikirim secara otomatis. Jangan membalas email ini.</p>
        <p>&copy; {{ date('Y') }} KampuStore - Marketplace Kampus Undip</p>
    </div>
</body>
</html>
