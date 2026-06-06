<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tahapan_penanganan', function (Blueprint $table) {
            $table->string('gambar')->nullable()->after('deskripsi');
            $table->string('video_url')->nullable()->after('gambar');
        });
    }

    public function down(): void
    {
        Schema::table('tahapan_penanganan', function (Blueprint $table) {
            $table->dropColumn(['gambar', 'video_url']);
        });
    }
};
