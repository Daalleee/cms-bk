<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kontak', function (Blueprint $table) {
            $table->dropColumn(['google_maps', 'jam_operasional']);
            $table->string('instagram')->nullable()->after('email');
            $table->string('tiktok')->nullable()->after('instagram');
        });
    }

    public function down(): void
    {
        Schema::table('kontak', function (Blueprint $table) {
            $table->dropColumn(['instagram', 'tiktok']);
            $table->longText('google_maps')->nullable();
            $table->string('jam_operasional')->nullable();
        });
    }
};
