<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->morphs('model');
            $table->string('koleksi'); // 'foto', 'video'
            $table->string('nama');
            $table->enum('sumber', ['unggah', 'youtube', 'tautan'])->default('unggah');
            $table->string('path')->nullable();
            $table->string('url')->nullable();
            $table->string('youtube_id')->nullable();
            $table->string('tipe_mime')->nullable();
            $table->unsignedBigInteger('ukuran')->nullable();
            $table->unsignedInteger('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
