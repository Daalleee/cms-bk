@extends('layouts.frontend')

@section('title', ($hypno->judul ?? 'Hypnocounseling') . ' - CMS BK')

@section('content')
    <div class="bg-indigo-900 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold text-white">{{ $hypno->judul ?? 'Hypnocounseling' }}</h1>
            <p class="mt-4 text-indigo-100 max-w-2xl mx-auto">Solusi modern untuk pemulihan emosional dan pemberdayaan diri.</p>
        </div>
    </div>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="md:col-span-2">
                    <div class="mb-12">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6 border-b pb-2">Pengertian</h2>
                        <div class="text-gray-600 text-lg leading-relaxed whitespace-pre-wrap">
                            {{ $hypno->deskripsi ?? 'Informasi deskripsi belum tersedia.' }}
                        </div>
                    </div>

                    <div class="mb-12">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6 border-b pb-2">Manfaat</h2>
                        <div class="text-gray-600 text-lg leading-relaxed whitespace-pre-wrap">
                            {{ $hypno->manfaat ?? 'Informasi manfaat belum tersedia.' }}
                        </div>
                    </div>

                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-6 border-b pb-2">Prosedur Pelaksanaan</h2>
                        <div class="text-gray-600 text-lg leading-relaxed whitespace-pre-wrap">
                            {{ $hypno->prosedur ?? 'Informasi prosedur belum tersedia.' }}
                        </div>
                    </div>
                </div>

                <div class="md:col-span-1">
                    <div class="bg-gray-50 p-8 rounded-2xl sticky top-24 border border-gray-100 shadow-sm">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Konsultasi Layanan</h3>
                        <p class="text-gray-600 mb-8 text-sm">Tertarik dengan layanan Hypnocounseling? Hubungi kami untuk informasi lebih lanjut atau jadwalkan sesi Anda.</p>
                        <a href="{{ route('frontend.kontak') }}" class="block w-full text-center py-3 bg-indigo-600 text-white font-bold rounded-lg hover:bg-indigo-700 transition">
                            Jadwalkan Sesi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
