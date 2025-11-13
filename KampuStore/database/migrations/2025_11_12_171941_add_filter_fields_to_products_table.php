<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Ukuran produk (S, M, L, XL)
            if (!Schema::hasColumn('products', 'size')) {
                $table->enum('size', ['S', 'M', 'L', 'XL'])->nullable()->index();
            }

            // Lokasi penjual (untuk filter lokasi)
            if (!Schema::hasColumn('products', 'seller_province')) {
                $table->string('seller_province')->nullable()->index();
            }

            if (!Schema::hasColumn('products', 'seller_city')) {
                $table->string('seller_city')->nullable()->index();
            }

            // Pastikan kolom stok sudah ada
            if (!Schema::hasColumn('products', 'stock')) {
                $table->unsignedInteger('stock')->default(0)->index();
            }

            // Kolom kategori kalau belum ada
            if (!Schema::hasColumn('products', 'category_slug')) {
                $table->string('category_slug')->nullable()->index();
            }

            // Kolom kondisi (baru/bekas) kalau belum ada
            if (!Schema::hasColumn('products', 'condition')) {
                $table->enum('condition', ['baru', 'bekas'])->nullable()->index();
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'size')) {
                $table->dropColumn('size');
            }
            if (Schema::hasColumn('products', 'seller_province')) {
                $table->dropColumn('seller_province');
            }
            if (Schema::hasColumn('products', 'seller_city')) {
                $table->dropColumn('seller_city');
            }
            if (Schema::hasColumn('products', 'category_slug')) {
                $table->dropColumn('category_slug');
            }
            // kolom stock & condition biarkan, karena mungkin dipakai kolom lama
        });
    }
};
