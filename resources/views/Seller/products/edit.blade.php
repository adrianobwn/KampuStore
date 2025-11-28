<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - {{ $seller->nama_toko }} | KampuStore</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <style>
        :root {
            --bg-main: radial-gradient(circle at top left,#1f3b8a 0,#020617 52%,#020617 100%);
            --nav-bg: rgba(2,6,23,0.95);
            --card-bg: rgba(15,23,42,0.96);
            --card-border: rgba(148,163,184,0.2);
            --text-main: #f9fafb;
            --text-muted: #9ca3af;
            --accent: #f97316;
        }
        body.theme-light {
            --bg-main: linear-gradient(135deg, #ffffff 0%, #e3e8ff 40%, #d5ddff 100%);
            --nav-bg: rgba(255,255,255,0.95);
            --card-bg: rgba(255,255,255,0.96);
            --card-border: #e5e7eb;
            --text-main: #111827;
            --text-muted: #6b7280;
        }
        body { background: var(--bg-main); }
        body.theme-light .bg-slate-900\/95 { background: var(--nav-bg) !important; }
        body.theme-light .bg-slate-800\/50 { background: rgba(255,255,255,0.8) !important; }
        body.theme-light .bg-slate-900\/50 { background: rgba(255,255,255,0.9) !important; }
        body.theme-light .border-blue-500\/30 { border-color: #e5e7eb !important; }
        body.theme-light .border-slate-700 { border-color: #d1d5db !important; }
        body.theme-light .text-white { color: var(--text-main) !important; }
        body.theme-light .text-gray-300 { color: var(--text-muted) !important; }
        body.theme-light .text-gray-400 { color: #6b7280 !important; }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in-up { animation: fadeInUp 0.6s ease-out forwards; }

        .theme-toggle-wrapper{display:flex;justify-content:center;align-items:center;}
        .toggle-switch{position:relative;display:inline-block;width:74px;height:36px;transform:scale(.95);transition:transform .2s;}
        .toggle-switch:hover{transform:scale(1);}
        .toggle-switch input{opacity:0;width:0;height:0;}
        .slider{position:absolute;cursor:pointer;inset:0;background:linear-gradient(145deg,#fbbf24,#f97316);transition:.4s;border-radius:34px;box-shadow:0 0 12px rgba(249,115,22,0.5);overflow:hidden;}
        .slider:before{position:absolute;content:"☀";height:28px;width:28px;left:4px;bottom:4px;background:white;transition:.4s;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:16px;box-shadow:0 0 10px rgba(0,0,0,.15);z-index:2;}
        .clouds{position:absolute;width:100%;height:100%;overflow:hidden;pointer-events:none;}
        .cloud{position:absolute;width:24px;height:24px;fill:rgba(255,255,255,0.9);filter:drop-shadow(0 2px 3px rgba(0,0,0,0.08));}
        .cloud1{top:6px;left:10px;animation:floatCloud1 8s infinite linear;}
        .cloud2{top:10px;left:38px;transform:scale(.85);animation:floatCloud2 12s infinite linear;}
        @keyframes floatCloud1{0%{transform:translateX(-20px);opacity:0;}20%{opacity:1;}80%{opacity:1;}100%{transform:translateX(80px);opacity:0;}}
        @keyframes floatCloud2{0%{transform:translateX(-20px) scale(.85);opacity:0;}20%{opacity:.7;}80%{opacity:.7;}100%{transform:translateX(80px) scale(.85);opacity:0;}}
        input.js-theme-toggle:checked + .slider{background:linear-gradient(145deg,#1f2937,#020617);box-shadow:0 0 14px rgba(15,23,42,0.8);}
        input.js-theme-toggle:checked + .slider:before{transform:translateX(38px);content:"🌙";}
        input.js-theme-toggle:checked + .slider .cloud{opacity:0;transform:translateY(-18px);}
    </style>
</head>
<body class="bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 min-h-screen flex flex-col">

{{-- NAVBAR --}}
<nav class="fixed top-0 left-0 right-0 z-50 bg-slate-900/95 backdrop-blur-xl border-b border-blue-500/30 shadow-lg">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            {{-- Logo --}}
            <a href="{{ route('seller.dashboard') }}" class="flex items-center gap-2">
                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-lg flex items-center justify-center">
                    <i class="uil uil-shop text-white text-lg"></i>
                </div>
                <span class="text-xl sm:text-2xl font-bold bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent">
                    kampuStore
                </span>
            </a>
            
            {{-- Center Menu --}}
            <div class="hidden md:flex items-center gap-6">
                <a href="{{ route('seller.dashboard') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium text-gray-300 hover:text-white hover:bg-slate-800/50 transition-all">
                    <i class="uil uil-dashboard text-base"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('seller.products.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium text-gray-300 hover:text-white hover:bg-slate-800/50 transition-all">
                    <i class="uil uil-box text-base"></i>
                    <span>Produk Saya</span>
                </a>
                <div class="relative" x-data="{ openReports: false }">
                    <button @click="openReports = !openReports" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium text-gray-300 hover:text-white hover:bg-slate-800/50 transition-all">
                        <i class="uil uil-chart-line text-base"></i>
                        <span>Laporan</span>
                        <i class="uil uil-angle-down ml-1"></i>
                    </button>
                    <div x-show="openReports" @click.away="openReports = false" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         class="absolute left-0 mt-2 w-56 rounded-lg shadow-lg bg-slate-800 border border-blue-500/30"
                         style="display: none;">
                        <div class="py-2">
                            <a href="{{ route('seller.reports.stock') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-slate-700">
                                <i class="uil uil-box mr-2"></i>Laporan Stok
                            </a>
                            <a href="{{ route('seller.reports.rating') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-slate-700">
                                <i class="uil uil-star mr-2"></i>Laporan Rating
                            </a>
                            <a href="{{ route('seller.reports.restock') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-slate-700">
                                <i class="uil uil-exclamation-triangle mr-2"></i>Restock Alert
                            </a>
                        </div>
                    </div>
                </div>
                <a href="{{ route('products.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium text-gray-300 hover:text-white hover:bg-slate-800/50 transition-all">
                    <i class="uil uil-store text-base"></i>
                    <span>Market</span>
                </a>
            </div>

            {{-- Right Menu --}}
            <div class="flex items-center gap-3">
                {{-- Theme Toggle --}}
                <div class="theme-toggle-wrapper">
                    <label class="toggle-switch">
                        <input type="checkbox" class="js-theme-toggle" />
                        <span class="slider">
                            <div class="clouds">
                                <svg viewBox="0 0 100 100" class="cloud cloud1"><path d="M30,45 Q35,25 50,25 Q65,25 70,45 Q80,45 85,50 Q90,55 85,60 Q80,65 75,60 Q65,60 60,65 Q55,70 50,65 Q45,70 40,65 Q35,60 25,60 Q20,65 15,60 Q10,55 15,50 Q20,45 30,45"></path></svg>
                                <svg viewBox="0 0 100 100" class="cloud cloud2"><path d="M30,45 Q35,25 50,25 Q65,25 70,45 Q80,45 85,50 Q90,55 85,60 Q80,65 75,60 Q65,60 60,65 Q55,70 50,65 Q45,70 40,65 Q35,60 25,60 Q20,65 15,60 Q10,55 15,50 Q20,45 30,45"></path></svg>
                            </div>
                        </span>
                    </label>
                </div>

                {{-- User Info --}}
                <div class="hidden sm:flex items-center gap-2 px-3 py-2 bg-slate-800/50 rounded-lg border border-slate-700/50">
                    <i class="uil uil-shop text-blue-400"></i>
                    <span class="text-sm text-gray-300">{{ $seller->nama_toko }}</span>
                </div>
                
                {{-- Logout --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium text-red-400 hover:text-red-300 hover:bg-red-500/10 transition-all">
                        <i class="uil uil-sign-out-alt text-base"></i>
                        <span class="hidden sm:inline">Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<main class="flex-1 pt-24 pb-12 px-4">
    <div class="container mx-auto max-w-4xl">
        
        {{-- HEADER --}}
        <div class="mb-6 fade-in-up">
            <a href="{{ route('seller.products.index') }}" class="inline-flex items-center gap-2 text-blue-400 hover:text-blue-300 transition-colors duration-200 mb-4">
                <i class="uil uil-arrow-left"></i>
                <span class="text-sm">Kembali ke Daftar Produk</span>
            </a>
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white mb-2">Edit Produk</h1>
            <p class="text-gray-400 text-sm sm:text-base">Perbarui informasi produk {{ $product->name }}</p>
        </div>

        {{-- FORM CARD --}}
        <div class="bg-slate-800/50 backdrop-blur-lg rounded-2xl shadow-2xl border border-blue-500/30 p-6 sm:p-8 fade-in-up">
            
            @if($errors->any())
            <div class="bg-gradient-to-r from-red-500/10 to-pink-500/10 border border-red-500/40 rounded-xl p-4 mb-6">
                <div class="flex items-start gap-3">
                    <i class="uil uil-exclamation-triangle text-2xl text-red-400"></i>
                    <div>
                        <h3 class="text-base font-semibold text-red-400 mb-2">Ada beberapa kesalahan:</h3>
                        <ul class="list-disc list-inside text-sm text-gray-300 space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif

            <form method="POST" action="{{ route('seller.products.update', $product) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Nama Produk --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-300 mb-2">
                        Nama Produk <span class="text-red-400">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name', $product->name) }}"
                        required
                        class="w-full px-4 py-3 bg-slate-900/50 border border-slate-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                        placeholder="Contoh: Buku Matematika Dasar"
                    >
                    @error('name')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kategori --}}
                <div>
                    <label for="category_slug" class="block text-sm font-medium text-gray-300 mb-2">
                        Kategori <span class="text-red-400">*</span>
                    </label>
                    <select 
                        id="category_slug" 
                        name="category_slug" 
                        required
                        class="w-full px-4 py-3 bg-slate-900/50 border border-slate-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                    >
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category['slug'] }}" {{ old('category_slug', $product->category_slug) == $category['slug'] ? 'selected' : '' }}>
                                {{ $category['name'] }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_slug')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kondisi dan Size dalam satu baris --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    {{-- Kondisi --}}
                    <div>
                        <label for="condition" class="block text-sm font-medium text-gray-300 mb-2">
                            Kondisi <span class="text-red-400">*</span>
                        </label>
                        <select 
                            id="condition" 
                            name="condition" 
                            required
                            class="w-full px-4 py-3 bg-slate-900/50 border border-slate-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                        >
                            <option value="">Pilih Kondisi</option>
                            <option value="baru" {{ old('condition', $product->condition) == 'baru' ? 'selected' : '' }}>Baru</option>
                            <option value="bekas" {{ old('condition', $product->condition) == 'bekas' ? 'selected' : '' }}>Bekas</option>
                        </select>
                        @error('condition')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Size (Optional) --}}
                    <div>
                        <label for="size" class="block text-sm font-medium text-gray-300 mb-2">
                            Ukuran (Opsional)
                        </label>
                        <input 
                            type="text" 
                            id="size" 
                            name="size" 
                            value="{{ old('size', $product->size) }}"
                            class="w-full px-4 py-3 bg-slate-900/50 border border-slate-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                            placeholder="Contoh: L, XL, atau 42"
                        >
                        @error('size')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Harga dan Stok dalam satu baris --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    {{-- Harga --}}
                    <div>
                        <label for="price_display" class="block text-sm font-medium text-gray-300 mb-2">
                            Harga (Rp) <span class="text-red-400">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="price_display" 
                            value="{{ old('price') ? number_format(old('price'), 0, ',', '.') : number_format($product->price, 0, ',', '.') }}"
                            required
                            class="w-full px-4 py-3 bg-slate-900/50 border border-slate-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                            placeholder="50.000"
                        >
                        <input type="hidden" id="price" name="price" value="{{ old('price', $product->price) }}">
                        <p class="mt-1 text-xs text-gray-500">Ketik angka, titik akan otomatis muncul</p>
                        @error('price')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Stok --}}
                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-300 mb-2">
                            Stok <span class="text-red-400">*</span>
                        </label>
                        <input 
                            type="number" 
                            id="stock" 
                            name="stock" 
                            value="{{ old('stock', $product->stock) }}"
                            required
                            min="0"
                            class="w-full px-4 py-3 bg-slate-900/50 border border-slate-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                            placeholder="10"
                        >
                        @error('stock')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-300 mb-2">
                        Deskripsi Produk <span class="text-red-400">*</span>
                    </label>
                    <textarea 
                        id="description" 
                        name="description" 
                        required
                        rows="5"
                        class="w-full px-4 py-3 bg-slate-900/50 border border-slate-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none"
                        placeholder="Jelaskan detail produk, kondisi, dan informasi penting lainnya..."
                    >{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Current Images --}}
                @if($product->images->count() > 0)
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Foto Saat Ini (Klik untuk pilih foto utama, centang untuk hapus)</label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4" id="existingImagesGrid">
                        @foreach($product->images as $image)
                        <div class="relative group">
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $product->name }}" 
                                class="w-full h-32 object-cover rounded-lg border-2 cursor-pointer transition-all duration-200 existing-image {{ $image->is_primary ? 'border-blue-500' : 'border-slate-700' }}"
                                data-id="{{ $image->id }}"
                                onclick="setPrimaryImage({{ $image->id }})"
                                onerror="this.src='{{ asset('images/no-image.png') }}';">
                            <span class="primary-badge absolute top-1 left-1 text-xs px-2 py-1 rounded-full font-semibold {{ $image->is_primary ? 'bg-blue-500 text-white' : 'bg-black/60 text-white' }}">
                                {{ $image->is_primary ? 'Utama' : $loop->iteration }}
                            </span>
                            <label class="absolute top-1 right-1 bg-red-500/80 hover:bg-red-500 text-white p-1 rounded cursor-pointer">
                                <input type="checkbox" name="delete_images[]" value="{{ $image->id }}" class="hidden delete-checkbox" onchange="toggleDeleteMark(this)">
                                <i class="uil uil-trash-alt text-sm"></i>
                            </label>
                        </div>
                        @endforeach
                    </div>
                    <input type="hidden" name="primary_image" id="primary_image" value="{{ $product->images->where('is_primary', true)->first()?->id }}">
                </div>
                @elseif($product->image_url)
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Foto Saat Ini</label>
                    <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="w-48 h-48 object-cover rounded-lg border-2 border-slate-700" onerror="this.src='{{ asset('images/no-image.png') }}';">
                </div>
                @endif

                {{-- Upload Gambar Baru --}}
                <div>
                    <label for="images" class="block text-sm font-medium text-gray-300 mb-2">
                        Tambah Foto Baru (Opsional, maksimal 5 gambar total)
                    </label>
                    <div class="relative">
                        <input 
                            type="file" 
                            id="images" 
                            name="images[]" 
                            accept=".jpg,.jpeg,.png"
                            multiple
                            class="w-full px-4 py-3 bg-slate-900/50 border border-slate-700 rounded-lg text-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600 file:cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                        >
                    </div>
                    <p class="mt-2 text-xs text-gray-500">Format: JPG, JPEG, PNG. Maksimal 2MB per gambar.</p>
                    @error('images')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                    @error('images.*')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Preview New Images --}}
                <div id="newImagePreview" class="hidden">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Preview Foto Baru</label>
                    <div id="newPreviewGrid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4"></div>
                </div>

                {{-- Buttons --}}
                <div class="flex flex-col sm:flex-row gap-4 pt-6">
                    <button 
                        type="submit"
                        class="flex-1 px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2"
                    >
                        <i class="uil uil-check"></i>
                        <span>Simpan Perubahan</span>
                    </button>
                    <a 
                        href="{{ route('seller.products.index') }}"
                        class="flex-1 px-6 py-3 bg-slate-700 hover:bg-slate-600 text-white font-semibold rounded-lg transition-all duration-300 flex items-center justify-center gap-2"
                    >
                        <i class="uil uil-times"></i>
                        <span>Batal</span>
                    </a>
                </div>
            </form>
        </div>

    </div>
</main>

{{-- FOOTER --}}
<footer class="bg-slate-900/80 border-t border-slate-800 py-6 mt-auto">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-gray-400 text-sm text-center sm:text-left">
                © 2025 <span class="font-semibold text-blue-400">KampuStore</span>. All rights reserved.
            </p>
        </div>
    </div>
</footer>

<script>
function setPrimaryImage(imageId) {
    document.getElementById('primary_image').value = imageId;
    
    document.querySelectorAll('.existing-image').forEach(img => {
        img.classList.remove('border-blue-500');
        img.classList.add('border-slate-700');
    });
    document.querySelectorAll('.primary-badge').forEach((badge, idx) => {
        badge.classList.remove('bg-blue-500');
        badge.classList.add('bg-black/60');
        badge.textContent = idx + 1;
    });
    
    const selectedImg = document.querySelector(`.existing-image[data-id="${imageId}"]`);
    if (selectedImg) {
        selectedImg.classList.remove('border-slate-700');
        selectedImg.classList.add('border-blue-500');
        const badge = selectedImg.parentElement.querySelector('.primary-badge');
        if (badge) {
            badge.classList.remove('bg-black/60');
            badge.classList.add('bg-blue-500');
            badge.textContent = 'Utama';
        }
    }
}

function toggleDeleteMark(checkbox) {
    const img = checkbox.closest('.relative').querySelector('img');
    if (checkbox.checked) {
        img.style.opacity = '0.3';
        img.style.filter = 'grayscale(100%)';
    } else {
        img.style.opacity = '1';
        img.style.filter = 'none';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('images');
    const previewContainer = document.getElementById('newImagePreview');
    const previewGrid = document.getElementById('newPreviewGrid');
    let selectedFiles = [];

    if (imageInput) {
        imageInput.addEventListener('change', function(e) {
            const files = Array.from(e.target.files);
            selectedFiles = files.slice(0, 5);
            renderNewPreviews();
        });
    }

    function renderNewPreviews() {
        previewGrid.innerHTML = '';
        
        if (selectedFiles.length > 0) {
            previewContainer.classList.remove('hidden');
            
            selectedFiles.forEach((file, index) => {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const imgContainer = document.createElement('div');
                    imgContainer.className = 'relative group';
                    imgContainer.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-32 object-cover rounded-lg border-2 border-slate-700">
                        <span class="absolute top-1 left-1 bg-green-500 text-white text-xs px-2 py-1 rounded-full font-semibold">Baru</span>
                        <button type="button" class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity shadow-lg" onclick="removeNewImage(${index})" title="Hapus gambar">
                            <i class="uil uil-times text-sm"></i>
                        </button>
                    `;
                    previewGrid.appendChild(imgContainer);
                };
                
                reader.readAsDataURL(file);
            });
        } else {
            previewContainer.classList.add('hidden');
        }
        
        updateNewFileInput();
    }

    function updateNewFileInput() {
        const dt = new DataTransfer();
        selectedFiles.forEach(file => dt.items.add(file));
        imageInput.files = dt.files;
    }

    window.removeNewImage = function(index) {
        selectedFiles.splice(index, 1);
        renderNewPreviews();
    };

    const priceDisplay = document.getElementById('price_display');
    const priceHidden = document.getElementById('price');

    if (priceDisplay && priceHidden) {
        priceDisplay.addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^\d]/g, '');
            priceHidden.value = value;
            if (value) {
                e.target.value = parseInt(value).toLocaleString('id-ID');
            } else {
                e.target.value = '';
            }
        });

        if (priceDisplay.value) {
            let value = priceDisplay.value.replace(/[^\d]/g, '');
            if (value) {
                priceDisplay.value = parseInt(value).toLocaleString('id-ID');
                priceHidden.value = value;
            }
        }
    }
});
</script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
(function(){
    const KEY = 'kampuStoreTheme';
    const body = document.body;
    const toggle = document.querySelector('.js-theme-toggle');
    function apply(mode){
        if(mode === 'light'){ body.classList.add('theme-light'); body.classList.remove('theme-dark'); }
        else{ body.classList.remove('theme-light'); body.classList.add('theme-dark'); }
    }
    const saved = localStorage.getItem(KEY) || 'dark';
    apply(saved);
    if(toggle){
        toggle.checked = (saved !== 'light');
        toggle.addEventListener('change', () => {
            const mode = toggle.checked ? 'dark' : 'light';
            apply(mode);
            localStorage.setItem(KEY, mode);
        });
    }
})();
</script>

</body>
</html>
