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
        Schema::table('reviews', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->change();
            
            if (!\Illuminate\Support\Facades\Schema::hasColumn('reviews', 'guest_name')) {
                $table->string('guest_name')->nullable()->after('user_id');
            }
            if (!\Illuminate\Support\Facades\Schema::hasColumn('reviews', 'guest_phone')) {
                $table->string('guest_phone')->nullable()->after('guest_name');
            }
            if (!\Illuminate\Support\Facades\Schema::hasColumn('reviews', 'guest_email')) {
                $table->string('guest_email')->nullable()->after('guest_phone');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
            $table->dropColumn(['guest_name', 'guest_phone', 'guest_email']);
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->unique(['user_id', 'product_id']);
        });
    }
};
