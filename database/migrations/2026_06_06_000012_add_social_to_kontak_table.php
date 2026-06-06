<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kontak', function (Blueprint $table) {
            $table->string('youtube')->nullable()->after('tiktok');
            $table->string('facebook')->nullable()->after('youtube');
            $table->string('twitter')->nullable()->after('facebook');
        });
    }

    public function down(): void
    {
        Schema::table('kontak', function (Blueprint $table) {
            $table->dropColumn(['youtube', 'facebook', 'twitter']);
        });
    }
};
