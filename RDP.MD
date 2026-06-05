# REQUIREMENT DEFINITION PROJECT (RDP)

# SISTEM INFORMASI CONTENT MANAGEMENT SYSTEM (CMS) BIMBINGAN KONSELING DAN HYPNOCOUNSELING BERBASIS WEB

---

# 1. INFORMASI PROYEK

## Nama Proyek
Sistem Informasi Content Management System (CMS) Bimbingan Konseling dan Hypnocounseling Berbasis Web

## Jenis Proyek
Website Company Profile dan Content Management System (CMS)

## Platform
Website

## Target Pengguna
- Administrator
- Pengelola Bimbingan Konseling
- Konselor
- Masyarakat Umum
- Calon Konseli

## Tujuan Proyek

Membangun sistem informasi berbasis web yang berfungsi sebagai media informasi, edukasi, dan publikasi layanan Bimbingan Konseling dan Hypnocounseling. Sistem juga menyediakan panel administrasi untuk mengelola seluruh konten website secara mandiri tanpa memerlukan perubahan kode program.

---

# 2. LATAR BELAKANG

Perkembangan teknologi informasi memungkinkan penyebaran informasi layanan Bimbingan Konseling dilakukan secara lebih luas dan efisien. Saat ini informasi layanan konseling sering kali masih disampaikan secara konvensional sehingga sulit dijangkau oleh masyarakat yang membutuhkan.

Melalui website CMS ini, pengunjung dapat memperoleh informasi mengenai layanan Hypnocounseling, area penanganan, tahapan pelaksanaan terapi, testimoni, serta menghubungi pihak layanan dengan mudah. Administrator juga dapat mengelola seluruh konten website melalui dashboard khusus.

---

# 3. TUJUAN SISTEM

## Tujuan Umum

Menyediakan media informasi dan pengelolaan konten layanan Bimbingan Konseling dan Hypnocounseling secara digital.

## Tujuan Khusus

- Menyediakan informasi layanan Hypnocounseling.
- Menampilkan area permasalahan yang dapat ditangani.
- Menjelaskan tahapan pelaksanaan Hypnocounseling.
- Menampilkan testimoni klien.
- Mempermudah pengunjung menghubungi layanan konseling.
- Mempermudah administrator mengelola seluruh konten website.

---

# 4. RUANG LINGKUP SISTEM

Sistem mencakup:

- Halaman Beranda
- Halaman Tentang Kami
- Halaman Hypnocounseling
- Halaman Area Penanganan
- Halaman Tahapan Penanganan
- Halaman Testimoni
- Halaman Kontak
- Dashboard Administrator
- Manajemen Konten Website
- Manajemen Pesan Pengunjung

---

# 5. AKTOR SISTEM

## Administrator

Administrator memiliki hak akses penuh terhadap sistem.

### Hak Akses Administrator

- Login
- Logout
- Mengelola profil website
- Mengelola informasi hypnocounseling
- Mengelola area penanganan
- Mengelola tahapan penanganan
- Mengelola testimoni
- Mengelola kontak
- Melihat pesan masuk
- Menghapus pesan masuk

---

## Pengunjung

Pengunjung adalah pengguna umum yang mengakses website.

### Hak Akses Pengunjung

- Melihat seluruh informasi website
- Mengakses halaman hypnocounseling
- Mengakses area penanganan
- Mengakses tahapan penanganan
- Melihat testimoni
- Mengirim pesan melalui formulir kontak

---

# 6. KEBUTUHAN FUNGSIONAL

## F-01 Halaman Beranda

Sistem harus menyediakan halaman beranda yang menampilkan:

- Hero Section
- Profil singkat layanan
- Ringkasan hypnocounseling
- Ringkasan area penanganan
- Ringkasan tahapan penanganan
- Testimoni terbaru
- Informasi kontak

---

## F-02 Halaman Tentang Kami

Sistem harus menyediakan halaman yang berisi:

- Profil lembaga
- Sejarah
- Visi
- Misi
- Tujuan layanan

Administrator dapat mengubah seluruh informasi tersebut.

---

## F-03 Halaman Hypnocounseling

Sistem harus menyediakan halaman yang menjelaskan:

- Pengertian Hypnocounseling
- Tujuan
- Manfaat
- Proses pelaksanaan
- Informasi tambahan

Administrator dapat mengubah seluruh isi halaman.

---

## F-04 Halaman Area Penanganan

Sistem harus menyediakan daftar area penanganan.

Contoh area:

- Kecemasan
- Trauma
- Stres
- Kurang Percaya Diri
- Kesulitan Belajar
- Bullying
- Gangguan Emosi
- Motivasi Diri
- Hubungan Sosial
- Manajemen Diri

Administrator dapat:

- Menambah data
- Mengubah data
- Menghapus data

---

## F-05 Halaman Tahapan Penanganan

Sistem harus menampilkan tahapan layanan hypnocounseling.

Tahapan yang ditampilkan:

### Tahap 1
Pra Edukasi

### Tahap 2
Asesmen Komprehensif

### Tahap 3
Induksi

### Tahap 4
Deepening

### Tahap 5
Anchoring

### Tahap 6
Hypnotherapeutic

### Tahap 7
Anchoring Reinforcement

### Tahap 8
Terminating

### Tahap 9
Breaking Stages

### Tahap 10
Post Hypnosis

Administrator dapat:

- Menambah tahapan
- Mengubah tahapan
- Menghapus tahapan
- Mengatur urutan tahapan

---

## F-06 Halaman Testimoni

Sistem harus menampilkan testimoni klien.

Data yang ditampilkan:

- Nama
- Foto
- Pekerjaan
- Isi Testimoni
- Rating

Administrator dapat:

- Menambah testimoni
- Mengubah testimoni
- Menghapus testimoni

---

## F-07 Halaman Kontak

Sistem harus menampilkan:

- Alamat
- Nomor Telepon
- Nomor WhatsApp
- Email
- Jam Operasional
- Lokasi Google Maps

Administrator dapat memperbarui seluruh informasi kontak.

---

## F-08 Formulir Kontak

Pengunjung dapat mengirim pesan.

Data yang dikirim:

- Nama
- Email
- Nomor Telepon
- Subjek
- Pesan

Pesan akan disimpan dalam sistem.

---

## F-09 Dashboard Administrator

Dashboard harus menampilkan:

- Jumlah Area Penanganan
- Jumlah Tahapan Penanganan
- Jumlah Testimoni
- Jumlah Pesan Masuk
- Aktivitas Terbaru

---

# 7. KEBUTUHAN NON FUNGSIONAL

## NF-01 Keamanan

- Password disimpan menggunakan hashing.
- Hanya administrator yang dapat mengakses dashboard.
- Validasi seluruh input pengguna.
- Menggunakan proteksi CSRF Laravel.

---

## NF-02 Responsif

Website harus dapat digunakan pada:

- Desktop
- Laptop
- Tablet
- Smartphone

---

## NF-03 Kemudahan Penggunaan

- Tampilan sederhana dan modern.
- Mudah digunakan oleh administrator.
- Navigasi mudah dipahami.

---

## NF-04 Performa

- Halaman dapat dimuat dengan cepat.
- Optimasi gambar.
- Caching konfigurasi Laravel.

---

## NF-05 SEO Dasar

- Meta Title
- Meta Description
- Friendly URL
- Sitemap

---

# 8. STRUKTUR MENU WEBSITE

## Frontend

### Beranda

### Tentang Kami

### Hypnocounseling

### Area Penanganan

### Tahapan Penanganan

### Testimoni

### Kontak

---

## Backend Administrator

### Dashboard

### Profil Website

### Hypnocounseling

### Area Penanganan

### Tahapan Penanganan

### Testimoni

### Kontak

### Pesan Masuk

### Pengaturan Akun

---

# 9. STRUKTUR BASIS DATA

## Tabel pengguna

| Nama Field | Tipe Data |
|------------|------------|
| id | bigint |
| nama | varchar |
| email | varchar |
| kata_sandi | varchar |
| dibuat_pada | timestamp |
| diperbarui_pada | timestamp |

---

## Tabel profil_website

| Nama Field | Tipe Data |
|------------|------------|
| id | bigint |
| judul | varchar |
| profil | longtext |
| visi | text |
| misi | longtext |
| gambar | varchar |
| dibuat_pada | timestamp |
| diperbarui_pada | timestamp |

---

## Tabel hypnocounseling

| Nama Field | Tipe Data |
|------------|------------|
| id | bigint |
| judul | varchar |
| deskripsi | longtext |
| manfaat | longtext |
| prosedur | longtext |
| gambar | varchar |
| dibuat_pada | timestamp |
| diperbarui_pada | timestamp |

---

## Tabel area_penanganan

| Nama Field | Tipe Data |
|------------|------------|
| id | bigint |
| nama_area | varchar |
| deskripsi | text |
| ikon | varchar |
| gambar | varchar |
| status | boolean |
| dibuat_pada | timestamp |
| diperbarui_pada | timestamp |

---

## Tabel tahapan_penanganan

| Nama Field | Tipe Data |
|------------|------------|
| id | bigint |
| urutan | integer |
| nama_tahap | varchar |
| deskripsi | longtext |
| gambar | varchar |
| dibuat_pada | timestamp |
| diperbarui_pada | timestamp |

---

## Tabel testimoni

| Nama Field | Tipe Data |
|------------|------------|
| id | bigint |
| nama | varchar |
| pekerjaan | varchar |
| foto | varchar |
| isi_testimoni | text |
| rating | integer |
| status | boolean |
| dibuat_pada | timestamp |
| diperbarui_pada | timestamp |

---

## Tabel kontak

| Nama Field | Tipe Data |
|------------|------------|
| id | bigint |
| alamat | text |
| telepon | varchar |
| whatsapp | varchar |
| email | varchar |
| google_maps | longtext |
| jam_operasional | varchar |
| dibuat_pada | timestamp |
| diperbarui_pada | timestamp |

---

## Tabel pesan_kontak

| Nama Field | Tipe Data |
|------------|------------|
| id | bigint |
| nama | varchar |
| email | varchar |
| nomor_telepon | varchar |
| subjek | varchar |
| pesan | text |
| status_baca | enum |
| dibuat_pada | timestamp |
| diperbarui_pada | timestamp |

Nilai status_baca:

- Belum Dibaca
- Sudah Dibaca

---

# 10. ARSITEKTUR TEKNOLOGI

## Backend

- Laravel 12

## Frontend

- Blade Template Engine
- Tailwind CSS
- Alpine.js
- Vite

## Basis Data

- MySQL

## Web Server

- Apache
atau
- Nginx

---

# 11. STRUKTUR MODUL SISTEM

## Modul Autentikasi

Fitur:

- Login
- Logout
- Middleware autentikasi

---

## Modul Profil Website

Fitur:

- Ubah profil
- Ubah visi
- Ubah misi
- Upload gambar

---

## Modul Hypnocounseling

Fitur:

- Tambah informasi
- Edit informasi
- Hapus informasi

---

## Modul Area Penanganan

Fitur:

- Tambah area
- Edit area
- Hapus area

---

## Modul Tahapan Penanganan

Fitur:

- Tambah tahap
- Edit tahap
- Hapus tahap
- Atur urutan tahap

---

## Modul Testimoni

Fitur:

- Tambah testimoni
- Edit testimoni
- Hapus testimoni

---

## Modul Kontak

Fitur:

- Kelola alamat
- Kelola nomor telepon
- Kelola email
- Kelola peta lokasi

---

## Modul Pesan Masuk

Fitur:

- Lihat pesan
- Tandai sudah dibaca
- Hapus pesan

---

# 12. OUTPUT SISTEM

Sistem menghasilkan website CMS Bimbingan Konseling dan Hypnocounseling yang:

- Informatif
- Responsif
- Mudah dikelola
- Mudah dikembangkan
- Mendukung publikasi layanan konseling secara profesional
- Mempermudah masyarakat memperoleh informasi layanan secara online