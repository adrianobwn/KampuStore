@extends('layouts.seller')

@section('title', 'Tambah Produk')

@push('styles')
    @include('partials.seller-styles')
    <style>
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--accent);
            font-size: 14px;
            text-decoration: none;
            margin-bottom: 16px;
            transition: color .2s;
        }

        .back-link:hover {
            color: var(--accent-hover);
        }

        .form-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        @media(max-width:600px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 8px;
        }

        .form-label .required {
            color: #ef4444;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 12px 16px;
            background: var(--input-bg);
            border: 1px solid var(--input-border);
            border-radius: 10px;
            color: var(--text-main);
            font-size: 14px;
            transition: all .2s;
        }

        .form-input::placeholder,
        .form-textarea::placeholder {
            color: var(--text-muted);
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.15);
        }

        .form-textarea {
            resize: vertical;
            min-height: 120px;
        }

        .form-hint {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 6px;
        }

        .form-error {
            font-size: 12px;
            color: #ef4444;
            margin-top: 6px;
        }

        /* Drop Zone Styles */
        .drop-zone {
            border: 2px dashed var(--card-border);
            border-radius: 12px;
            padding: 32px;
            text-align: center;
            cursor: pointer;
            transition: all .3s;
            background: var(--input-bg);
        }

        .drop-zone:hover,
        .drop-zone.dragover {
            border-color: var(--accent);
            background: rgba(249, 115, 22, 0.05);
        }

        .drop-zone-icon {
            font-size: 48px;
            color: var(--accent);
            margin-bottom: 12px;
        }

        .drop-zone-text {
            font-size: 15px;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 8px;
        }

        .drop-zone-hint {
            font-size: 13px;
            color: var(--text-muted);
        }

        .drop-zone-btn {
            display: inline-block;
            margin-top: 16px;
            padding: 10px 24px;
            background: var(--accent);
            color: #111827;
            border: none;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s;
        }

        .drop-zone-btn:hover {
            background: #ea580c;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(249, 115, 22, 0.4);
        }

        .image-counter {
            display: inline-block;
            background: var(--accent);
            color: #111;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            margin-left: 8px;
        }

        .preview-container {
            margin-top: 20px;
            display: none;
        }

        .preview-container.active {
            display: block;
        }

        .preview-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .preview-title {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-main);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-add-more {
            padding: 8px 16px;
            background: rgba(249, 115, 22, 0.15);
            color: var(--accent);
            border: 1px solid var(--accent);
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s;
        }

        .btn-add-more:hover {
            background: var(--accent);
            color: #111;
        }

        .btn-add-more:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .preview-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 16px;
        }

        .preview-item {
            position: relative;
            display: flex;
            flex-direction: column;
            border-radius: 12px;
            background: var(--card-bg);
            border: 2px solid var(--card-border);
            padding: 8px;
            cursor: pointer;
            transition: all .2s;
        }

        .preview-item:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .preview-item.primary {
            border-color: var(--accent);
        }

        .preview-item img {
            width: 100%;
            height: 140px;
            object-fit: cover;
            border-radius: 8px;
        }

        .preview-item .badge-label {
            position: absolute;
            top: 12px;
            left: 12px;
            padding: 4px 10px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 700;
            z-index: 5;
        }

        .preview-item .btn-remove {
            position: absolute;
            top: 4px;
            right: 4px;
            width: 26px;
            height: 26px;
            background: #ef4444;
            color: #fff;
            border: none;
            border-radius: 50%;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.2s;
            z-index: 10;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
        }

        .preview-item:hover .btn-remove {
            opacity: 1;
        }

        .preview-item .btn-remove:hover {
            background: #dc2626;
            transform: scale(1.1);
        }

        /* Condition Toggle Buttons */
        .condition-options {
            display: flex;
            gap: 16px;
            margin-top: 8px;
        }

        .condition-option {
            flex: 1;
            position: relative;
        }

        .condition-option input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .condition-option label {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 14px 20px;
            background: var(--input-bg);
            border: 2px solid var(--card-border);
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-main);
        }

        .condition-option label:hover {
            border-color: var(--accent);
            background: rgba(249, 115, 22, 0.05);
        }

        .condition-option input:checked + label {
            border-color: var(--accent);
            background: rgba(249, 115, 22, 0.1);
            color: var(--accent);
        }

        .condition-option .check-icon {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            border: 2px solid var(--card-border);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            font-size: 12px;
            color: transparent;
        }

        .condition-option input:checked + label .check-icon {
            background: var(--accent);
            border-color: var(--accent);
            color: #111;
        }

        .condition-option .condition-icon {
            font-size: 20px;
        }

        .condition-option.baru .condition-icon {
            color: #22c55e;
        }

        .condition-option.bekas .condition-icon {
            color: #f59e0b;
        }

        .form-actions {
            display: flex;
            gap: 16px;
            margin-top: 32px;
        }

        .btn-submit {
            flex: 1;
            padding: 14px 24px;
            background: var(--accent);
            color: #111827;
            border: none;
            border-radius: 50px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all .3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-submit:hover {
            background: #ea580c;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(249, 115, 22, 0.4);
        }

        .btn-cancel {
            flex: 1;
            padding: 14px 24px;
            background: rgba(148, 163, 184, 0.2);
            color: var(--text-main);
            border: none;
            border-radius: 50px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s;
            text-decoration: none;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-cancel:hover {
            background: rgba(148, 163, 184, 0.3);
        }

        .section-divider {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-main);
            margin: 32px 0 16px 0;
            padding-bottom: 12px;
            border-bottom: 2px solid var(--card-border);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        @media(max-width:900px) {
            .form-card {
                padding: 24px;
            }

            .form-actions {
                flex-direction: column;
            }

            .preview-grid {
                grid-template-columns: repeat(auto-fill, minmax(110px, 1fr));
            }

            .preview-item img {
                height: 110px;
            }

            .drop-zone {
                padding: 24px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="content-wrapper" style="max-width:900px;margin:0 auto;">
        <a href="{{ route('seller.products.index') }}" class="back-link">
            <i class="uil uil-arrow-left"></i> Kembali ke Daftar Produk
        </a>

        <h1 class="page-title">Tambah Produk Baru</h1>
        <p class="page-subtitle">Isi formulir di bawah untuk menambahkan produk ke toko {{ $seller->nama_toko }}</p>

        @if($errors->any())
            <div class="alert alert-error">
                <i class="uil uil-exclamation-triangle"></i>
                <div class="alert-content">
                    <div class="alert-title">Terjadi Kesalahan</div>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="form-card">
            <form method="POST" action="{{ route('seller.products.store') }}" enctype="multipart/form-data" id="productForm">
                @csrf

                {{-- Section: Informasi Dasar --}}
                <div class="section-divider">
                    <i class="uil uil-info-circle"></i> Informasi Dasar Produk
                </div>

                <div class="form-group">
                    <label class="form-label">Nama Produk <span class="required">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-input"
                        placeholder="Contoh: Buku Matematika Dasar" required>
                    @error('name')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Kategori <span class="required">*</span></label>
                    <select name="category_slug" class="form-select" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category['slug'] }}" {{ old('category_slug') == $category['slug'] ? 'selected' : '' }}>{{ $category['name'] }}</option>
                        @endforeach
                    </select>
                    @error('category_slug')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Kondisi Produk <span class="required">*</span></label>
                    <div class="condition-options">
                        <div class="condition-option baru">
                            <input type="radio" name="condition" id="condition_baru" value="baru" {{ old('condition') == 'baru' ? 'checked' : '' }} required>
                            <label for="condition_baru">
                                <span class="check-icon"><i class="uil uil-check"></i></span>
                                <i class="uil uil-tag-alt condition-icon"></i>
                                <span>Baru</span>
                            </label>
                        </div>
                        <div class="condition-option bekas">
                            <input type="radio" name="condition" id="condition_bekas" value="bekas" {{ old('condition') == 'bekas' ? 'checked' : '' }}>
                            <label for="condition_bekas">
                                <span class="check-icon"><i class="uil uil-check"></i></span>
                                <i class="uil uil-history condition-icon"></i>
                                <span>Bekas</span>
                            </label>
                        </div>
                    </div>
                    @error('condition')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                {{-- Section: Harga & Stok --}}
                <div class="section-divider">
                    <i class="uil uil-money-bill"></i> Harga & Stok
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Harga (Rp) <span class="required">*</span></label>
                        <input type="text" id="price_display"
                            value="{{ old('price') ? number_format(old('price'), 0, ',', '.') : '' }}" class="form-input"
                            placeholder="50.000" required>
                        <input type="hidden" id="price" name="price" value="{{ old('price') }}">
                        <p class="form-hint">Ketik angka, titik akan otomatis muncul</p>
                        @error('price')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Stok <span class="required">*</span></label>
                        <input type="number" name="stock" value="{{ old('stock') }}" class="form-input" placeholder="10"
                            min="0" required>
                        @error('stock')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Deskripsi Produk <span class="required">*</span></label>
                    <textarea name="description" class="form-textarea"
                        placeholder="Jelaskan detail produk, kondisi, dan informasi penting lainnya..."
                        required>{{ old('description') }}</textarea>
                    @error('description')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                {{-- Section: Foto Produk --}}
                <div class="section-divider">
                    <i class="uil uil-images"></i> Foto Produk
                    <span class="image-counter" id="imageCounter">0/5</span>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="uil uil-image"></i> Foto Produk <span class="required">*</span>
                    </label>
                    
                    <!-- Hidden file input -->
                    <input type="file" name="images[]" id="images" accept=".jpg,.jpeg,.png" multiple style="display:none;">
                    <input type="hidden" name="primary_image_index" id="primary_image_index" value="0">
                    
                    <!-- Drop Zone -->
                    <div class="drop-zone" id="dropZone">
                        <i class="uil uil-cloud-upload drop-zone-icon"></i>
                        <p class="drop-zone-text">Drag & drop foto di sini</p>
                        <p class="drop-zone-hint">atau klik untuk memilih file (JPG, PNG • Maks 2MB per foto)</p>
                        <button type="button" class="drop-zone-btn" id="browseBtn">
                            <i class="uil uil-image-plus"></i> Pilih Foto
                        </button>
                    </div>
                    
                    @error('images')<p class="form-error">{{ $message }}</p>@enderror
                    @error('images.*')<p class="form-error">{{ $message }}</p>@enderror

                    <!-- Preview Container -->
                    <div class="preview-container" id="preview_container">
                        <div class="preview-header">
                            <span class="preview-title">
                                <i class="uil uil-eye"></i> Preview Foto (klik untuk set foto utama)
                            </span>
                            <button type="button" class="btn-add-more" id="addMoreBtn">
                                <i class="uil uil-plus"></i> Tambah Lagi
                            </button>
                        </div>
                        <div class="preview-grid" id="preview_grid"></div>
                    </div>
                </div>

                {{-- Form Actions --}}
                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <i class="uil uil-check"></i> Tambah Produk
                    </button>
                    <a href="{{ route('seller.products.index') }}" class="btn-cancel">
                        <i class="uil uil-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const imageInput = document.getElementById('images');
            const previewContainer = document.getElementById('preview_container');
            const previewGrid = document.getElementById('preview_grid');
            const primaryInput = document.getElementById('primary_image_index');
            const dropZone = document.getElementById('dropZone');
            const browseBtn = document.getElementById('browseBtn');
            const addMoreBtn = document.getElementById('addMoreBtn');
            const imageCounter = document.getElementById('imageCounter');
            const productForm = document.getElementById('productForm');

            const MAX_IMAGES = 5;
            let selectedFiles = [];

            // Browse button click
            browseBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                imageInput.click();
            });

            // Add more button click
            addMoreBtn.addEventListener('click', function(e) {
                e.preventDefault();
                if (selectedFiles.length < MAX_IMAGES) {
                    imageInput.click();
                }
            });

            // Drop zone click
            dropZone.addEventListener('click', function(e) {
                if (e.target === dropZone || e.target.classList.contains('drop-zone-icon') || 
                    e.target.classList.contains('drop-zone-text') || e.target.classList.contains('drop-zone-hint')) {
                    imageInput.click();
                }
            });

            // Drag and drop events
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, preventDefaults, false);
                document.body.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, () => dropZone.classList.add('dragover'), false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, () => dropZone.classList.remove('dragover'), false);
            });

            // Handle drop
            dropZone.addEventListener('drop', function(e) {
                const files = Array.from(e.dataTransfer.files).filter(file => 
                    file.type.startsWith('image/') && 
                    (file.type === 'image/jpeg' || file.type === 'image/png' || file.type === 'image/jpg')
                );
                addFiles(files);
            });

            // Handle file input change
            imageInput.addEventListener('change', function(e) {
                const files = Array.from(e.target.files);
                // Reset input first so same file can be selected again later
                e.target.value = '';
                // Then add files (this will call updateFileInput at the end)
                addFiles(files);
            });

            function addFiles(newFiles) {
                const remainingSlots = MAX_IMAGES - selectedFiles.length;
                
                if (remainingSlots <= 0) {
                    alert('Maksimal 5 foto. Hapus foto yang ada untuk menambah yang baru.');
                    return;
                }

                const filesToAdd = newFiles.slice(0, remainingSlots);
                
                if (newFiles.length > remainingSlots) {
                    alert(`Hanya ${remainingSlots} foto lagi yang bisa ditambahkan. ${filesToAdd.length} foto telah dipilih.`);
                }

                // Validate file sizes (max 2MB each)
                const validFiles = filesToAdd.filter(file => {
                    if (file.size > 2 * 1024 * 1024) {
                        alert(`File "${file.name}" terlalu besar. Maksimal 2MB per foto.`);
                        return false;
                    }
                    return true;
                });

                selectedFiles = [...selectedFiles, ...validFiles];
                renderPreviews();
                updateCounter();
                updateFileInput();
            }

            function updateCounter() {
                imageCounter.textContent = `${selectedFiles.length}/${MAX_IMAGES}`;
                addMoreBtn.disabled = selectedFiles.length >= MAX_IMAGES;
                
                // Show/hide drop zone based on files
                if (selectedFiles.length >= MAX_IMAGES) {
                    dropZone.style.display = 'none';
                } else {
                    dropZone.style.display = 'block';
                }
            }

            function renderPreviews() {
                previewGrid.innerHTML = '';

                if (selectedFiles.length > 0) {
                    previewContainer.classList.add('active');

                    // Create all containers first with placeholders
                    const containers = selectedFiles.map((file, index) => {
                        const imgContainer = document.createElement('div');
                        imgContainer.className = 'preview-item' + (index === parseInt(primaryInput.value) ? ' primary' : '');
                        imgContainer.dataset.index = index;
                        
                        const isPrimary = index === parseInt(primaryInput.value);
                        imgContainer.innerHTML = `
                            <span class="badge-label" style="background:${isPrimary ? 'var(--accent)' : 'rgba(0,0,0,0.6)'};color:${isPrimary ? '#111' : '#fff'};">${isPrimary ? 'Utama' : index + 1}</span>
                            <img src="" style="background:#1e293b;">
                            <button type="button" class="btn-remove" title="Hapus foto">×</button>
                        `;
                        
                        // Bind click event with captured index
                        const capturedIndex = index;
                        imgContainer.addEventListener('click', function(ev) {
                            if (ev.target.classList.contains('btn-remove')) return;
                            primaryInput.value = capturedIndex;
                            updatePrimarySelection(capturedIndex);
                        });

                        imgContainer.querySelector('.btn-remove').addEventListener('click', function(ev) {
                            ev.stopPropagation();
                            removeImage(capturedIndex);
                        });

                        previewGrid.appendChild(imgContainer);
                        return { container: imgContainer, file: file, index: index };
                    });

                    // Load images async but containers are already in correct order
                    containers.forEach(({ container, file }) => {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            container.querySelector('img').src = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    });
                } else {
                    previewContainer.classList.remove('active');
                    primaryInput.value = 0;
                }
            }

            function removeImage(index) {
                selectedFiles.splice(index, 1);

                if (parseInt(primaryInput.value) === index) {
                    primaryInput.value = 0;
                } else if (parseInt(primaryInput.value) > index) {
                    primaryInput.value = parseInt(primaryInput.value) - 1;
                }

                renderPreviews();
                updateCounter();
                updateFileInput();
            }

            function updateFileInput() {
                const dt = new DataTransfer();
                selectedFiles.forEach(file => dt.items.add(file));
                imageInput.files = dt.files;
            }

            function updatePrimarySelection(selectedIndex) {
                const containers = previewGrid.querySelectorAll('.preview-item');
                containers.forEach((container, idx) => {
                    const badge = container.querySelector('.badge-label');
                    if (idx === selectedIndex) {
                        container.classList.add('primary');
                        badge.style.background = 'var(--accent)';
                        badge.style.color = '#111';
                        badge.textContent = 'Utama';
                    } else {
                        container.classList.remove('primary');
                        badge.style.background = 'rgba(0,0,0,0.6)';
                        badge.style.color = '#fff';
                        badge.textContent = idx + 1;
                    }
                });
            }

            // Form validation
            productForm.addEventListener('submit', function(e) {
                if (selectedFiles.length === 0) {
                    e.preventDefault();
                    alert('Pilih minimal 1 foto produk.');
                    return false;
                }
            });

            // Price formatting
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

                // Format on load if has old value
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
@endpush