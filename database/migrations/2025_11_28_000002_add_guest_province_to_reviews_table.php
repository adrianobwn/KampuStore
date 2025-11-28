<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * SRS-MartPlace-08: Tambah field guest_province untuk tracking lokasi reviewer
     */
    public function up(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            if (!Schema::hasColumn('reviews', 'guest_province')) {
                $table->string('guest_province')->nullable()->after('guest_email');
            }
            if (!Schema::hasColumn('reviews', 'guest_city')) {
                $table->string('guest_city')->nullable()->after('guest_province');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn(['guest_province', 'guest_city']);
        });
    }
};
