<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Tambah kolom baru hanya jika BELUM ada
            if (!Schema::hasColumn('products', 'category_slug')) {
                $table->string('category_slug')->nullable()->index();
            }

            // Kolom 'condition' sudah ada di DB kamu.
            // Kalau ingin pastikan enum-nya sesuai, cukup ubah TYPEnya (opsional).
            // Hati-hati: change() butuh doctrine/dbal. Skip kalau belum perlu.
            // if (Schema::hasColumn('products', 'condition')) {
            //     $table->enum('condition', ['baru','bekas'])->nullable()->change();
            // } else {
            //     $table->enum('condition', ['baru','bekas'])->nullable()->index();
            // }

            if (!Schema::hasColumn('products', 'stock')) {
                $table->unsignedInteger('stock')->default(0)->index();
            }

            if (!Schema::hasColumn('products', 'seller_name')) {
                $table->string('seller_name')->nullable();
            }

            if (!Schema::hasColumn('products', 'brand')) {
                $table->string('brand')->nullable();
            }

            // Kalau mau aman untuk price, biarkan saja jika sudah ada.
            // Ubah tipe kolom existing gunakan migrasi terpisah bila diperlukan.
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'category_slug')) {
                $table->dropColumn('category_slug');
            }
            // Jangan drop 'condition' karena sudah ada sebelum migrasi ini
            if (Schema::hasColumn('products', 'stock')) {
                $table->dropColumn('stock');
            }
            if (Schema::hasColumn('products', 'seller_name')) {
                $table->dropColumn('seller_name');
            }
            if (Schema::hasColumn('products', 'brand')) {
                $table->dropColumn('brand');
            }
        });
    }
};

