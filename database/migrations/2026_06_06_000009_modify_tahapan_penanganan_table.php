<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tahapan_penanganan', function (Blueprint $table) {
            $table->dropColumn('gambar');
            $table->string('ikon')->nullable()->after('deskripsi');
        });
    }

    public function down(): void
    {
        Schema::table('tahapan_penanganan', function (Blueprint $table) {
            $table->dropColumn('ikon');
            $table->string('gambar')->nullable();
        });
    }
};
