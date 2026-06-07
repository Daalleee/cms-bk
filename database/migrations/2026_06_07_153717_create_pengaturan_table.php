<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaturan', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        $defaults = [
            // Hero
            'hero_judul' => 'HypnoKonseling',
            'hero_sub_judul' => '',
            'hero_tombol_1_teks' => 'Mulai Konsultasi',
            'hero_tombol_1_target' => '',
            'hero_tampilkan_tombol_1' => '1',
            'hero_tombol_2_teks' => 'Pelajari Metode',
            'hero_tombol_2_target' => '#tentang',
            'hero_tampilkan_tombol_2' => '1',

            // Tentang
            'tentang_label' => 'Edukasi Dasar',
            'tentang_sub_judul' => 'Tentang HypnoKonseling',

            // Alur
            'alur_label' => 'Metode Terstruktur',
            'alur_judul' => 'Langkah Menuju Pemulihan',
            'alur_sub_judul' => 'Setiap sesi dirancang secara sistematis untuk hasil yang optimal dan berkelanjutan.',

            // Area Kecanduan
            'area_label' => 'Yang Kami Tangani',
            'area_judul' => 'Area Pemulihan Kecanduan',
            'area_sub_judul' => 'Klik pada setiap kategori untuk melihat video penanganan dan panduan lengkapnya.',

            // Testimoni
            'testimoni_label' => 'Social Proof',
            'testimoni_judul' => 'Testimoni',
            'testimoni_sub_judul' => '',

            // Kontak
            'kontak_judul' => 'Hubungi Kami',
            'kontak_sub_judul' => 'Ada pertanyaan atau ingin konsultasi? Jangan ragu untuk menghubungi kami.',
            'kontak_btn_kirim' => 'Kirim Pesan',
        ];

        foreach ($defaults as $key => $value) {
            DB::table('pengaturan')->insert(['key' => $key, 'value' => $value]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaturan');
    }
};
