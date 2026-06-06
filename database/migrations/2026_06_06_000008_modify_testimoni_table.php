<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('testimoni', function (Blueprint $table) {
            $table->dropColumn('foto');
            $table->renameColumn('status', 'status_publikasi');
        });
    }

    public function down(): void
    {
        Schema::table('testimoni', function (Blueprint $table) {
            $table->renameColumn('status_publikasi', 'status');
            $table->string('foto')->nullable();
        });
    }
};
