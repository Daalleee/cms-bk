<?php

namespace Database\Seeders;

use App\Models\AreaKecanduan;
use App\Models\DetailPenanganan;
use App\Models\HeroSection;
use App\Models\Kontak;
use App\Models\Media;
use App\Models\TahapanPenanganan;
use App\Models\TentangKami;
use App\Models\TentangSection;
use App\Models\Testimoni;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    private string $ytId = 'kMONNDIFkCw';

    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $tables = [
            'media', 'detail_penanganan', 'area_kecanduan',
            'tahapan_penanganan', 'tentang_sections',
            'testimoni', 'log_aktivitas', 'pesan_kontak',
        ];
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'nama' => 'Super Administrator',
                'kata_sandi' => Hash::make('password123'),
                'peran' => 'super_admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin2@gmail.com'],
            [
                'nama' => 'Admin Kontributor',
                'kata_sandi' => Hash::make('password123'),
                'peran' => 'admin',
            ]
        );

        HeroSection::updateOrCreate(
            ['id' => 1],
            [
                'judul' => 'Pulihkan Diri dari Kecanduan, Raih Kembali Kendali Hidupmu',
                'sub_judul' => 'Metode HypnoKonseling membantu Anda menjangkau akar masalah di pikiran bawah sadar untuk transformasi hidup yang nyata dan permanen.',
                'gambar' => null,
                'whatsapp_tujuan' => '081234567890',
            ]
        );

        TentangKami::updateOrCreate(
            ['id' => 1],
            [
                'judul' => 'Tentang HypnoKonseling',
                'pengantar' => 'HypnoKonseling adalah metode terapi inovatif yang menggabungkan teknik konseling modern dengan hipnoterapi klinis. Kami membantu Anda mengatasi kecanduan dengan menjangkau akar masalah di pikiran bawah sadar.',
                'isi' => 'HypnoKonseling adalah metode terapi inovatif yang menggabungkan teknik konseling modern dengan hipnoterapi klinis.',
                'gambar' => null,
            ]
        );

        $tentangSections = [
            ['judul' => 'Apa itu HypnoKonseling?', 'deskripsi' => 'HypnoKonseling adalah pendekatan terapi yang mengintegrasikan konseling psikologis dengan teknik hipnoterapi. Metode ini bekerja langsung pada pikiran bawah sadar tempat tersimpannya kebiasaan, trauma, dan pola pikir yang membentuk perilaku adiktif.', 'urutan' => 1],
            ['judul' => 'Bagaimana Cara Kerjanya?', 'deskripsi' => 'Proses terapi dimulai dengan asesmen mendalam untuk mengidentifikasi pemicu kecanduan. Kemudian klien dibimbing ke kondisi rileks di mana pikiran bawah sadar lebih reseptif terhadap sugesti positif.', 'urutan' => 2],
            ['judul' => 'Apa Manfaatnya?', 'deskripsi' => 'HypnoKonseling efektif untuk berbagai jenis kecanduan seperti rokok, alkohol, judi online, dan kecanduan gadget. Manfaatnya adalah perubahan permanen karena bekerja pada akar masalah.', 'urutan' => 3],
            ['judul' => 'Siapa yang Membutuhkan?', 'deskripsi' => 'HypnoKonseling cocok bagi siapa saja yang ingin mengatasi kecanduan, mengubah kebiasaan buruk, atau meningkatkan kualitas hidup. Pendekatan kami humanis dan nyaman untuk semua kalangan.', 'urutan' => 4],
        ];

        foreach ($tentangSections as $ts) {
            $section = TentangSection::create($ts);
            $section->media()->create([
                'koleksi' => 'video',
                'nama' => $ts['judul'],
                'sumber' => 'youtube',
                'youtube_id' => $this->ytId,
                'urutan' => 1,
            ]);
        }

        $tahapans = [
            ['urutan' => 1, 'nama_tahap' => 'Pra Edukasi', 'deskripsi' => 'Penjelasan awal mengenai metode HypnoKonseling, membangun rapport, dan kesepahaman antara konselor dan klien tentang tujuan terapi.'],
            ['urutan' => 2, 'nama_tahap' => 'Asesmen Komprehensif', 'deskripsi' => 'Identifikasi masalah secara mendalam melalui wawancara klinis, observasi perilaku, dan alat bantu asesmen psikologis untuk memahami akar kecanduan.'],
            ['urutan' => 3, 'nama_tahap' => 'Induksi', 'deskripsi' => 'Teknik membimbing klien memasuki kondisi relaksasi pikiran yang lebih dalam dan reseptif terhadap sugesti terapeutik.'],
            ['urutan' => 4, 'nama_tahap' => 'Deepening', 'deskripsi' => 'Memperdalam kondisi hipnosis agar klien mencapai level relaksasi optimal untuk efektivitas terapi yang maksimal.'],
            ['urutan' => 5, 'nama_tahap' => 'Anchoring', 'deskripsi' => 'Memasang pemicu (anchor) positif yang dapat diakses klien kapan saja untuk mengaktifkan kondisi sumber daya internal.'],
            ['urutan' => 6, 'nama_tahap' => 'Hypnotherapeutic', 'deskripsi' => 'Pemberian sugesti terapeutik dan restrukturisasi kognitif pada pikiran bawah sadar klien untuk mengubah pola adiktif.'],
            ['urutan' => 7, 'nama_tahap' => 'Anchoring Reinforcement', 'deskripsi' => 'Memperkuat anchor positif yang telah dipasang agar lebih tahan lama, mudah diakses, dan menjadi kebiasaan baru.'],
            ['urutan' => 8, 'nama_tahap' => 'Terminating', 'deskripsi' => 'Mengakhiri sesi hipnosis dengan membawa klien kembali ke kesadaran penuh secara bertahap dan nyaman.'],
            ['urutan' => 9, 'nama_tahap' => 'Breaking Stages', 'deskripsi' => 'Teknik pemecahan hambatan mental dan blokade psikologis yang mungkin muncul pasca sesi hipnosis utama.'],
            ['urutan' => 10, 'nama_tahap' => 'Post Hypnosis', 'deskripsi' => 'Evaluasi pasca sesi, pemberian tugas rumah (homework), dan rencana tindak lanjut untuk memastikan hasil optimal dan berkelanjutan.'],
        ];

        $videoLabels = ['Penjelasan', 'Demo', 'Praktik', 'Studi Kasus', 'Tips'];

        foreach ($tahapans as $tahap) {
            $t = TahapanPenanganan::create($tahap);
            for ($i = 1; $i <= 5; $i++) {
                $t->media()->create([
                    'koleksi' => 'video',
                    'nama' => $tahap['nama_tahap'] . ' - ' . $videoLabels[$i - 1],
                    'sumber' => 'youtube',
                    'youtube_id' => $this->ytId,
                    'urutan' => $i,
                ]);
            }
        }

        $areas = [
            [
                'nama_kecanduan' => 'Rokok',
                'urutan' => 1,
                'artikel' => "Berhenti merokok membutuhkan komitmen dan pendekatan yang tepat. HypnoKonseling dapat membantu mengubah pola pikir bawah sadar yang memicu kebiasaan merokok.\n\nLangkah-langkah penanganan:\n1. Identifikasi pemicu kebiasaan merokok\n2. Restrukturisasi pikiran bawah sadar\n3. Penguatan motivasi internal untuk berhenti\n4. Dukungan dan monitoring berkala\n5. Pencegahan kekambuhan (relapse prevention)",
            ],
            [
                'nama_kecanduan' => 'Gadget',
                'urutan' => 2,
                'artikel' => "Kecanduan gadget dan smartphone dapat mengganggu produktivitas dan hubungan sosial.\n\nLangkah-langkah penanganan:\n1. Detoksifikasi digital bertahap\n2. Membangun kesadaran diri akan dampak negatif\n3. Mengganti kebiasaan dengan aktivitas positif\n4. Menetapkan batasan penggunaan yang sehat\n5. Penguatan kontrol diri melalui sugesti bawah sadar",
            ],
            [
                'nama_kecanduan' => 'Alkohol',
                'urutan' => 3,
                'artikel' => "Kecanduan alkohol adalah kondisi serius yang memerlukan penanganan profesional. HypnoKonseling dapat menjadi bagian dari program pemulihan komprehensif.\n\nLangkah-langkah penanganan:\n1. Detoksifikasi medis jika diperlukan\n2. Terapi kognitif untuk mengubah pola pikir\n3. Penguatan motivasi internal untuk pulih\n4. Dukungan keluarga dan lingkungan\n5. Program pencegahan kekambuhan jangka panjang",
            ],
            [
                'nama_kecanduan' => 'Belanja',
                'urutan' => 4,
                'artikel' => "Belanja kompulsif (shopaholic) seringkali terkait dengan kondisi emosional yang tidak stabil.\n\nLangkah-langkah penanganan:\n1. Identifikasi pemicu emosional belanja\n2. Pengelolaan kecemasan dan stres\n3. Membangun kepuasan dari sumber non-materi\n4. Perencanaan keuangan yang sehat\n5. Penguatan nilai diri di luar kepemilikan barang",
            ],
            [
                'nama_kecanduan' => 'Judi Online',
                'urutan' => 5,
                'artikel' => "Kecanduan judi online dapat menghancurkan keuangan dan hubungan sosial.\n\nLangkah-langkah penanganan:\n1. Pemblokiran akses ke situs judi\n2. Terapi kognitif untuk ilusi kemenangan\n3. Pengelolaan utang dan keuangan\n4. Dukungan keluarga dan komunitas\n5. Pengembangan hobi dan aktivitas produktif pengganti",
            ],
        ];

        foreach ($areas as $areaData) {
            $area = AreaKecanduan::create([
                'nama_kecanduan' => $areaData['nama_kecanduan'],
                'urutan' => $areaData['urutan'],
                'status' => true,
            ]);

            DetailPenanganan::create([
                'area_kecanduan_id' => $area->id,
                'link_youtube' => 'https://www.youtube.com/watch?v=' . $this->ytId,
                'artikel_penanganan' => $areaData['artikel'],
            ]);
        }

        $testimonis = [
            ['nama' => 'Budi Santoso', 'pekerjaan' => 'Karyawan Swasta', 'isi_testimoni' => 'Sangat membantu saya mengatasi kecanduan rokok. Setelah 3 sesi, saya berhasil berhenti total. Terima kasih HypnoKonseling!', 'rating' => 5, 'status_publikasi' => true],
            ['nama' => 'Siti Aminah', 'pekerjaan' => 'Mahasiswa', 'isi_testimoni' => 'Kecanduan gadget saya sudah jauh berkurang. Sekarang saya bisa fokus belajar dan produktif. Metodenya nyaman dan tidak menakutkan.', 'rating' => 5, 'status_publikasi' => true],
            ['nama' => 'Andi Wijaya', 'pekerjaan' => 'Wirausaha', 'isi_testimoni' => 'Sudah 6 bulan bebas dari judi online berkat HypnoKonseling. Bisnis saya sekarang jauh lebih maju karena fokus dan energi saya kembali.', 'rating' => 5, 'status_publikasi' => true],
            ['nama' => 'Dian Permata', 'pekerjaan' => 'Ibu Rumah Tangga', 'isi_testimoni' => 'Terima kasih sudah membantu saya mengatasi kebiasaan belanja impulsif. Sekarang keuangan keluarga lebih terkendali dan saya lebih bahagia.', 'rating' => 5, 'status_publikasi' => true],
            ['nama' => 'Rudi Hermawan', 'pekerjaan' => 'Mahasiswa', 'isi_testimoni' => 'Awalnya ragu, tapi setelah mencoba 2 sesi saya merasakan perubahan besar. Kecanduan game online saya berkurang drastis.', 'rating' => 4, 'status_publikasi' => true],
            ['nama' => 'Maya Saragih', 'pekerjaan' => 'Guru', 'isi_testimoni' => 'HypnoKonseling membantu saya mengatasi stres yang memicu kebiasaan merokok. Sekarang saya bebas rokok dan lebih sehat.', 'rating' => 5, 'status_publikasi' => false],
        ];

        foreach ($testimonis as $testi) {
            Testimoni::create($testi);
        }

        Kontak::updateOrCreate(
            ['id' => 1],
            [
                'alamat' => 'Jl. Pendidikan No. 123, Kota Bahagia, Indonesia',
                'telepon' => '021-1234567',
                'whatsapp' => '081234567890',
                'email' => 'info@hypnokonseling.com',
                'instagram' => 'hypnokonseling',
                'youtube' => 'hypnokonseling',
                'facebook' => 'hypnokonseling',
                'twitter' => 'hypnokonseling',
            ]
        );
    }
}
