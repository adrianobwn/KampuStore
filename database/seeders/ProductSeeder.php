<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // matikan foreign key check sementara
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // kosongkan dulu reviews & products biar bersih
        DB::table('reviews')->truncate();
        DB::table('products')->truncate();

        // nyalakan lagi foreign key check
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $items = [
        // ===== ALAT KULIAH =====
        [
            'name'           => 'Sticky Notes',
            'category_slug'  => 'alat-kuliah',
            'condition'      => 'baru',
            'size'           => null,
            'price'          => 5000,
            'stock'          => 30,
            'seller_name'    => 'Arya - Informatika',
            'seller_province'=> 'Jawa Tengah',
            'seller_city'    => 'Kota Semarang',
            'image_url'      => '/images/Alat kuliah/stickyNotes.jpg',
            'description'    => 'Sticky notes warna-warni untuk catatan kuliah.',
        ],
        [
            'name'           => 'Kalkulator Scientific',
            'category_slug'  => 'alat-kuliah',
            'condition'      => 'baru',
            'size'           => null,
            'price'          => 5000,
            'stock'          => 30,
            'seller_name'    => 'Cindy - Statistika',
            'seller_province'=> 'Jawa Tengah',
            'seller_city'    => 'Kota Semarang',
            'image_url'      => '/images/Alat kuliah/kalkuScientifikBekas.jpg',
            'description'    => 'Kalkulator scientific bekas dengan kondisi 90% mulus.',
        ],
        [
            'name'           => 'Binder A5 Bekas',
            'category_slug'  => 'alat-kuliah',
            'condition'      => 'bekas',
            'size'           => null,
            'price'          => 15000,
            'stock'          => 10,
            'seller_name'    => 'Dina - Fisika',
            'seller_province'=> 'Jawa Tengah',
            'seller_city'    => 'Kota Semarang',
            'image_url'      => '/images/Alat kuliah/binderA5Bekas.jpg',
            'description'    => 'Binder A5 kondisi 90%, masih mulus.',
        ],

        // ===== BUKU & ALAT TULIS =====
        [
            'name'           => 'Pulpen Hitam 0.5',
            'category_slug'  => 'buku-alat-tulis',
            'condition'      => 'baru',
            'size'           => null,
            'price'          => 3500,
            'stock'          => 100,
            'seller_name'    => 'Nana - Sekre lt 3',
            'seller_province'=> 'Jawa Tengah',
            'seller_city'    => 'Kota Semarang',
            'image_url'      => '/images/Buku & Alat Tulis/PulpenHitam.jpg',
            'description'    => 'Pulpen gel hitam untuk menulis catatan rapi.',
        ],
        [
            'name'           => 'Buku Catatan Grid A5 Bekas',
            'category_slug'  => 'buku-alat-tulis',
            'condition'      => 'bekas',
            'size'           => null,
            'price'          => 7000,
            'stock'          => 5,
            'seller_name'    => 'Bima - Statistika',
            'seller_province'=> 'Jawa Tengah',
            'seller_city'    => 'Kota Semarang',
            'image_url'      => '/images/Buku & Alat Tulis/BukuCatatanGridA5Bekas.jpg',
            'description'    => 'Buku catatan bekas, beberapa halaman terpakai.',
        ],

        // ===== FASHION =====
        [
            'name'           => 'Hoodie Kampus Unisex',
            'category_slug'  => 'fashion',
            'condition'      => 'baru',
            'size'           => 'L',
            'price'          => 120000,
            'stock'          => 12,
            'seller_name'    => 'Official Merchandise',
            'seller_province'=> 'Jawa Tengah',
            'seller_city'    => 'Kota Semarang',
            'image_url'      => '/images/Buku & Alat Tulis/HoodieKampusUnisex.jpg',
            'description'    => 'Hoodie kampus nyaman untuk dipakai kuliah.',
        ],
        [
            'name'           => 'Jaket Himpunan (HMIF)',
            'category_slug'  => 'fashion',
            'condition'      => 'bekas',
            'size'           => 'M',
            'price'          => 85000,
            'stock'          => 3,
            'seller_name'    => 'Ale - Informatika',
            'seller_province'=> 'Jawa Tengah',
            'seller_city'    => 'Kota Semarang',
            'image_url'      => '/images/Buku & Alat Tulis/JaketHimpunan(HMIF).jpg',
            'description'    => 'Jaket jeans oversize untuk OOTD ke kampus.',
        ],

        // ===== ELEKTRONIK =====
        [
            'name'           => 'Mouse Wireless',
            'category_slug'  => 'elektronik',
            'condition'      => 'baru',
            'size'           => null,
            'price'          => 65000,
            'stock'          => 20,
            'seller_name'    => 'Angel - Matematika',
            'seller_province'=> 'Jawa Tengah',
            'seller_city'    => 'Kota Semarang',
            'image_url'      => '/images/Elektronik/MouseWireless.jpg',
            'description'    => 'Mouse wireless hemat baterai, cocok untuk laptop.',
        ],
        [
            'name'           => 'Headphone Bekas',
            'category_slug'  => 'elektronik',
            'condition'      => 'bekas',
            'size'           => null,
            'price'          => 90000,
            'stock'          => 4,
            'seller_name'    => 'Fajar - Statistika',
            'seller_province'=> 'Jawa Tengah',
            'seller_city'    => 'Kota Semarang',
            'image_url'      => '/images/Elektronik/HeadphoneBekas.jpg',
            'description'    => 'Headphone over-ear, kondisi 80%.',
        ],
    ];

        foreach ($items as $item) {
            $item['slug'] = Str::slug($item['name']).'-'.uniqid();
            Product::create($item);
        }
    }
}
