<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_penanganan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('area_kecanduan_id')->constrained('area_kecanduan')->onDelete('cascade');
            $table->string('link_youtube')->nullable();
            $table->longText('artikel_penanganan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_penanganan');
    }
};
