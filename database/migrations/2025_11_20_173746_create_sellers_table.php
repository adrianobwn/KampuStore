<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();

            // Relasi ke users.id
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->string('nama_toko');
            $table->string('deskripsi_singkat')->nullable();

            // PIC (penanggung jawab)
            $table->string('nama_pic');
            $table->string('no_hp_pic');
            $table->string('email_pic');
            $table->string('alamat_pic');

            // Alamat detail
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kota');
            $table->string('kode_pos');

            // Dokumen/Foto (nantinya file upload)
            $table->string('foto_ktp')->nullable();
            $table->string('foto_pic')->nullable();
            $table->string('file_ktp_pic')->nullable();

            // Status verifikasi penjual
            $table->enum('status', ['pending', 'approved', 'rejected'])
                  ->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sellers');
    }
};
