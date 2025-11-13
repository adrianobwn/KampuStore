<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // basic info
            $table->string('name');
            $table->string('slug')->unique();

            // kategori untuk filter
            $table->string('category_slug');        // 'fashion', 'alat-kuliah', 'buku-alat-tulis', 'elektronik'

            // kondisi barang
            $table->string('condition')->nullable(); // 'baru' / 'bekas'

            // ukuran (kalau relevan, misal fashion)
            $table->string('size')->nullable();     // 'S','M','L','XL', dll

            // harga & stok
            $table->unsignedInteger('price');       // dalam rupiah
            $table->unsignedInteger('stock')->default(0);

            // info penjual & lokasi
            $table->string('seller_name')->nullable();
            $table->string('seller_province')->nullable();
            $table->string('seller_city')->nullable();

            // gambar
            $table->string('image_url')->nullable();

            // deskripsi
            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
