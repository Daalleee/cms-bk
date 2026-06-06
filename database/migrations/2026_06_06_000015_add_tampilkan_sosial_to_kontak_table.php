<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kontak', function (Blueprint $table) {
            $table->boolean('tampilkan_youtube')->default(true)->after('youtube');
            $table->boolean('tampilkan_instagram')->default(true)->after('instagram');
            $table->boolean('tampilkan_facebook')->default(true)->after('facebook');
            $table->boolean('tampilkan_twitter')->default(true)->after('twitter');
            $table->boolean('tampilkan_tiktok')->default(true)->after('tiktok');
        });
    }

    public function down(): void
    {
        Schema::table('kontak', function (Blueprint $table) {
            $table->dropColumn(['tampilkan_youtube', 'tampilkan_instagram', 'tampilkan_facebook', 'tampilkan_twitter', 'tampilkan_tiktok']);
        });
    }
};
