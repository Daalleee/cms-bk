@extends('layouts.frontend')

@section('title', $profil->judul ?? 'Beranda - CMS Bimbingan Konseling')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-indigo-900 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32 relative z-10">
            <div class="text-center md:text-left md:w-2/3">
                <h1 class="text-4xl md:text-6xl font-extrabold text-white leading-tight">
                    {{ $profil->judul ?? 'Layanan Bimbingan Konseling & Hypnocounseling' }}
                </h1>
                <p class="mt-6 text-xl text-indigo-100 max-w-2xl">
                    Solusi profesional untuk kesehatan mental, pengembangan diri, dan penanganan trauma melalui pendekatan yang komprehensif.
                </p>
                <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                    <a href="{{ route('frontend.kontak') }}" class="px-8 py-4 bg-white text-indigo-600 font-bold rounded-lg shadow-lg hover:bg-gray-100 transition duration-300 text-center">
                        Konsultasi Sekarang
                    </a>
                    <a href="{{ route('frontend.hypnocounseling') }}" class="px-8 py-4 bg-indigo-700 text-white font-bold rounded-lg shadow-lg hover:bg-indigo-600 transition duration-300 border border-indigo-500 text-center">
                        Pelajari Layanan
                    </a>
                </div>
            </div>
        </div>
        <!-- Decorative Background -->
        <div class="absolute top-0 right-0 w-1/2 h-full hidden md:block">
            <div class="w-full h-full bg-indigo-800 transform skew-x-12 translate-x-1/4"></div>
        </div>
    </div>

    <!-- Profil Singkat -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Tentang Kami</h2>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        {{ Str::limit($profil->profil ?? 'Kami adalah lembaga yang berdedikasi untuk memberikan layanan bimbingan konseling dan hypnocounseling berkualitas bagi individu, kelompok, maupun instansi.', 400) }}
                    </p>
                    <a href="{{ route('tentang-kami') }}" class="text-indigo-600 font-semibold hover:text-indigo-800 inline-flex items-center">
                        Baca Selengkapnya
                        <svg class="w-4 h-4 ms-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
                <div class="bg-indigo-100 rounded-2xl p-8 flex items-center justify-center min-h-[300px]">
                    <div class="text-center">
                        <span class="text-5xl font-bold text-indigo-600 block mb-2">100%</span>
                        <span class="text-gray-700 font-medium">Profesional & Terpercaya</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Ringkasan Hypnocounseling -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900">{{ $hypno->judul ?? 'Hypnocounseling' }}</h2>
                <div class="w-24 h-1 bg-indigo-600 mx-auto mt-4"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition">
                    <div class="w-16 h-16 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-6 text-2xl font-bold">1</div>
                    <h3 class="text-xl font-bold mb-4 text-gray-900">Apa Itu?</h3>
                    <p class="text-gray-600">{{ Str::limit($hypno->deskripsi ?? 'Pendekatan konseling yang mengintegrasikan teknik hipnosis untuk mencapai hasil yang lebih efektif.', 150) }}</p>
                </div>
                <div class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition">
                    <div class="w-16 h-16 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-6 text-2xl font-bold">2</div>
                    <h3 class="text-xl font-bold mb-4 text-gray-900">Manfaat</h3>
                    <p class="text-gray-600">{{ Str::limit($hypno->manfaat ?? 'Membantu mengatasi berbagai hambatan mental dan emosional dengan cepat.', 150) }}</p>
                </div>
                <div class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition">
                    <div class="w-16 h-16 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-6 text-2xl font-bold">3</div>
                    <h3 class="text-xl font-bold mb-4 text-gray-900">Prosedur</h3>
                    <p class="text-gray-600">{{ Str::limit($hypno->prosedur ?? 'Dilakukan oleh tenaga ahli yang bersertifikat secara aman dan nyaman.', 150) }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Area Penanganan (Ringkasan) -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">Area Penanganan</h2>
                    <p class="text-gray-600 mt-2">Masalah yang dapat kami bantu tangani.</p>
                </div>
                <a href="{{ route('frontend.area-penanganan') }}" class="mt-4 md:mt-0 text-indigo-600 font-semibold hover:underline">Lihat Semua</a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($areas as $area)
                    <div class="p-6 border border-gray-100 rounded-xl hover:bg-indigo-50 hover:border-indigo-100 transition">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $area->nama_area }}</h3>
                        <p class="text-sm text-gray-600">{{ Str::limit($area->deskripsi, 100) }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Testimoni Terbaru -->
    <section class="py-20 bg-indigo-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-16">Apa Kata Mereka?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($testimonis as $testi)
                    <div class="bg-indigo-800 p-8 rounded-2xl border border-indigo-700">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-indigo-600 rounded-full flex items-center justify-center font-bold text-xl">
                                {{ substr($testi->nama, 0, 1) }}
                            </div>
                            <div class="ms-4">
                                <p class="font-bold">{{ $testi->nama }}</p>
                                <p class="text-indigo-300 text-sm">{{ $testi->pekerjaan }}</p>
                            </div>
                        </div>
                        <p class="text-indigo-100 italic leading-relaxed">"{{ $testi->isi_testimoni }}"</p>
                        <div class="mt-6 flex text-yellow-400">
                            @for ($i = 0; $i < $testi->rating; $i++)
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            @endfor
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-16 text-center">
                <a href="{{ route('frontend.testimoni') }}" class="inline-flex items-center px-6 py-3 border border-white rounded-lg font-semibold hover:bg-white hover:text-indigo-900 transition">
                    Lihat Testimoni Lainnya
                </a>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold text-gray-900 mb-8">Siap Memulai Perubahan Positif dalam Hidup Anda?</h2>
            <p class="text-xl text-gray-600 mb-10">Kami siap mendampingi setiap langkah Anda menuju kesejahteraan mental yang lebih baik.</p>
            <a href="{{ route('frontend.kontak') }}" class="px-10 py-5 bg-indigo-600 text-white font-extrabold rounded-xl shadow-xl hover:bg-indigo-700 transition duration-300">
                Hubungi Kami Sekarang
            </a>
        </div>
    </section>
@endsection
