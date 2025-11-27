@php($title = $product->name)
@extends('layouts.app')

@section('content')
<style>
  .product-container {
    background: white;
    border-radius: 24px;
    padding: 40px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
    margin-bottom: 40px;
  }
  
  .product-image {
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
    aspect-ratio: 1;
    object-fit: cover;
  }
  
  .badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border-radius: 50px;
    font-size: 13px;
    font-weight: 600;
  }
  
  .badge-success {
    background: #d1fae5;
    color: #065f46;
  }
  
  .badge-warning {
    background: #fef3c7;
    color: #92400e;
  }
  
  .rating-stars {
    display: flex;
    align-items: center;
    gap: 4px;
  }
  
  .star {
    color: #fbbf24;
    font-size: 20px;
  }
  
  .star.empty {
    color: #d1d5db;
  }
  
  .price-tag {
    font-size: 36px;
    font-weight: 800;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }
  
  .btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 14px 32px;
    border-radius: 50px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    border: none;
    cursor: pointer;
    transition: all 0.3s;
    box-shadow: 0 4px 14px rgba(102, 126, 234, 0.4);
  }
  
  .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
  }
  
  .review-card {
    background: #f9fafb;
    border-radius: 16px;
    padding: 24px;
    margin-bottom: 16px;
    border: 1px solid #e5e7eb;
    transition: all 0.3s;
  }
  
  .review-card:hover {
    border-color: #667eea;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.1);
  }
  
  .form-card {
    background: white;
    border-radius: 16px;
    padding: 28px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    border: 1px solid #e5e7eb;
  }
  
  .form-group {
    margin-bottom: 20px;
  }
  
  .form-label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 8px;
  }
  
  .form-input, .form-textarea, .form-select {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 14px;
    transition: all 0.3s;
    font-family: inherit;
  }
  
  .form-input:focus, .form-textarea:focus, .form-select:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
  }
  
  .error-text {
    color: #dc2626;
    font-size: 13px;
    margin-top: 6px;
  }
  
  .info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin: 24px 0;
  }
  
  .info-item {
    background: #f9fafb;
    padding: 16px;
    border-radius: 12px;
    border: 1px solid #e5e7eb;
  }
  
  .info-label {
    font-size: 12px;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
    margin-bottom: 6px;
  }
  
  .info-value {
    font-size: 16px;
    color: #111827;
    font-weight: 600;
  }
  
  @media (max-width: 768px) {
    .product-container {
      padding: 24px;
    }
    
    .price-tag {
      font-size: 28px;
    }
  }
</style>

<div class="product-container">
  <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px;">
    <!-- Product Image -->
    <div>
      @if($product->image_url)
        <img src="{{ Storage::url($product->image_url) }}" alt="{{ $product->name }}" class="product-image" style="width: 100%;">
      @else
        <div class="product-image" style="width: 100%; background: linear-gradient(135deg, #667eea 20%, #764ba2 100%); display: flex; align-items: center; justify-content: center;">
          <i class="uil uil-image" style="font-size: 80px; color: rgba(255,255,255,0.5);"></i>
        </div>
      @endif
      
      <!-- Additional Product Info -->
      <div class="info-grid" style="margin-top: 24px;">
        <div class="info-item">
          <div class="info-label">Kategori</div>
          <div class="info-value">{{ ucfirst(str_replace('-', ' ', $product->category_slug ?? 'Umum')) }}</div>
        </div>
        <div class="info-item">
          <div class="info-label">Kondisi</div>
          <div class="info-value">{{ ucfirst($product->condition ?? 'Baru') }}</div>
        </div>
      </div>
    </div>
    
    <!-- Product Details -->
    <div>
      <div style="margin-bottom: 16px;">
        @if($product->stock > 0)
          <span class="badge badge-success">
            <i class="uil uil-check-circle"></i>
            Tersedia
          </span>
        @else
          <span class="badge badge-warning">
            <i class="uil uil-exclamation-triangle"></i>
            Stok Habis
          </span>
        @endif
      </div>
      
      <h1 style="font-size: 32px; font-weight: 800; color: #111827; margin-bottom: 16px; line-height: 1.2;">
        {{ $product->name }}
      </h1>
      
      <!-- Rating -->
      <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
        <div class="rating-stars">
          @for ($i=1; $i<=5; $i++)
            <span class="star {{ $i <= floor($avg) ? '' : 'empty' }}">★</span>
          @endfor
        </div>
        <span style="color: #6b7280; font-size: 14px; font-weight: 500;">
          {{ $avg }} dari 5 · {{ $count }} ulasan
        </span>
      </div>
      
      <!-- Price -->
      <div class="price-tag" style="margin-bottom: 8px;">
        Rp {{ number_format($product->price, 0, ',', '.') }}
      </div>
      
      <div style="color: #6b7280; font-size: 14px; margin-bottom: 28px;">
        <i class="uil uil-layers"></i>
        Stok: <strong style="color: #111827;">{{ $product->stock }}</strong> unit
      </div>
      
      <hr style="border: none; height: 1px; background: #e5e7eb; margin: 28px 0;">
      
      <!-- Description -->
      <div>
        <h3 style="font-size: 18px; font-weight: 700; color: #111827; margin-bottom: 12px;">
          <i class="uil uil-file-alt"></i> Deskripsi Produk
        </h3>
        <p style="color: #4b5563; line-height: 1.7; white-space: pre-wrap;">{{ $product->description }}</p>
      </div>
      
      <hr style="border: none; height: 1px; background: #e5e7eb; margin: 28px 0;">
      
      <!-- Seller Info -->
      <div>
        <h3 style="font-size: 18px; font-weight: 700; color: #111827; margin-bottom: 12px;">
          <i class="uil uil-shop"></i> Informasi Penjual
        </h3>
        <div style="background: #f9fafb; padding: 16px; border-radius: 12px; border: 1px solid #e5e7eb;">
          <div style="font-weight: 600; color: #111827; margin-bottom: 4px;">
            {{ $product->seller_name ?? $product->seller->nama_toko ?? 'Penjual' }}
          </div>
          @if($product->seller)
            <div style="font-size: 13px; color: #6b7280;">
              <i class="uil uil-map-marker"></i>
              {{ $product->seller->kota ?? 'Semarang' }}, {{ $product->seller->provinsi ?? 'Jawa Tengah' }}
            </div>
          @endif
        </div>
      </div>
      
      <div style="margin-top: 32px;">
        <a href="#review-form">
          <button class="btn-primary">
            <i class="uil uil-edit-alt"></i>
            Tulis Ulasan
          </button>
        </a>
      </div>
    </div>
  </div>
</div>

<!-- Reviews Section -->
<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 32px; align-items: start;">
  <!-- Reviews List -->
  <div>
    <h2 style="font-size: 24px; font-weight: 800; color: #111827; margin-bottom: 24px;">
      <i class="uil uil-comment-alt-lines"></i>
      Ulasan Pembeli
    </h2>
    
    @forelse ($product->reviews as $r)
      <div class="review-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
          <div>
            <div style="font-weight: 700; color: #111827; margin-bottom: 4px;">
              <i class="uil uil-user-circle"></i>
              {{ $r->user ? $r->user->name : $r->guest_name }}
            </div>
            <div style="font-size: 12px; color: #6b7280;">
              <i class="uil uil-clock"></i>
              {{ $r->created_at->diffForHumans() }}
            </div>
          </div>
          <div class="rating-stars">
            @for ($i=1; $i<=5; $i++)
              <span class="star {{ $i <= $r->rating ? '' : 'empty' }}">★</span>
            @endfor
          </div>
        </div>
        <p style="color: #4b5563; line-height: 1.6; white-space: pre-wrap;">{{ $r->body }}</p>
      </div>
    @empty
      <div style="text-align: center; padding: 60px 20px; background: white; border-radius: 16px; border: 2px dashed #e5e7eb;">
        <i class="uil uil-comment-alt-slash" style="font-size: 60px; color: #d1d5db; margin-bottom: 16px;"></i>
        <p style="color: #9ca3af; font-size: 15px;">Belum ada ulasan untuk produk ini</p>
        <p style="color: #d1d5db; font-size: 13px; margin-top: 8px;">Jadilah yang pertama memberikan ulasan!</p>
      </div>
    @endforelse
  </div>
  
  <!-- Review Form -->
  <div style="position: sticky; top: 120px;">
    <div id="review-form" class="form-card">
      <h3 style="font-size: 20px; font-weight: 700; color: #111827; margin-bottom: 20px;">
        <i class="uil uil-pen"></i>
        Tulis Ulasan
      </h3>
      
      <form method="POST" action="{{ route('reviews.store', $product) }}">
        @csrf
        
        @guest
        <div class="form-group">
          <label class="form-label">Nama Anda</label>
          <input type="text" name="guest_name" value="{{ old('guest_name') }}" class="form-input" placeholder="Masukkan nama Anda" required>
          @error('guest_name')<p class="error-text">{{ $message }}</p>@enderror
        </div>
        
        <div class="form-group">
          <label class="form-label">Nomor HP</label>
          <input type="text" name="guest_phone" value="{{ old('guest_phone') }}" class="form-input" placeholder="08xxxxxxxxxx" required>
          @error('guest_phone')<p class="error-text">{{ $message }}</p>@enderror
        </div>
        
        <div class="form-group">
          <label class="form-label">Email</label>
          <input type="email" name="guest_email" value="{{ old('guest_email') }}" class="form-input" placeholder="email@example.com" required>
          @error('guest_email')<p class="error-text">{{ $message }}</p>@enderror
        </div>
        @endguest
        
        <div class="form-group">
          <label class="form-label">Rating</label>
          <select name="rating" class="form-select" required>
            <option value="">Pilih rating...</option>
            @for ($i=5; $i>=1; $i--)
              <option value="{{ $i }}">{{ $i }} - {{ str_repeat('★', $i) }}</option>
            @endfor
          </select>
          @error('rating')<p class="error-text">{{ $message }}</p>@enderror
        </div>
        
        <div class="form-group">
          <label class="form-label">Ulasan Anda</label>
          <textarea name="body" rows="5" class="form-textarea" placeholder="Bagikan pengalaman Anda dengan produk ini..." required>{{ old('body') }}</textarea>
          @error('body')<p class="error-text">{{ $message }}</p>@enderror
        </div>
        
        <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;">
          <i class="uil uil-message"></i>
          Kirim Ulasan
        </button>
      </form>
    </div>
  </div>
</div>

<style>
  @media (max-width: 1024px) {
    .product-container > div {
      grid-template-columns: 1fr !important;
    }
    
    div[style*="grid-template-columns: 2fr 1fr"] {
      grid-template-columns: 1fr !important;
    }
    
    .form-card {
      position: static !important;
    }
  }
</style>
@endsection
