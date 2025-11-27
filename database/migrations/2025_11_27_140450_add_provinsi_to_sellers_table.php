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
        Schema::table('sellers', function (Blueprint $table) {
            $table->string('provinsi')->nullable()->after('kelurahan');
            $table->dropColumn('foto_ktp');
            $table->dropColumn('kecamatan');
            $table->dropColumn('kode_pos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sellers', function (Blueprint $table) {
            $table->dropColumn('provinsi');
            $table->string('foto_ktp')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kode_pos')->nullable();
        });
    }
};
