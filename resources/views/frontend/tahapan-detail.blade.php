@extends('layouts.frontend')

@section('title', 'Tahap ' . $tahapan->urutan . ': ' . $tahapan->nama_tahap . ' - CMS BK')

@section('content')
    <div class="bg-indigo-900 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-block px-4 py-1 bg-indigo-800 text-indigo-200 rounded-full text-sm font-semibold mb-3">Tahap {{ $tahapan->urutan }}</span>
            <h1 class="text-4xl font-bold text-white">{{ $tahapan->nama_tahap }}</h1>
            <p class="mt-4 text-indigo-100 max-w-2xl mx-auto">{{ $tahapan->deskripsi }}</p>
        </div>
    </div>

    <section class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div data-reveal class="max-w-3xl mx-auto text-center mb-12">
                <h2 class="text-2xl font-black text-gray-900 mb-4">Tentang Tahap {{ $tahapan->urutan }}</h2>
                <p class="text-lg text-gray-600 leading-relaxed">{{ $tahapan->deskripsi }}</p>
            </div>

            @if($tahapan->gambar)
                <div data-reveal class="mb-12 rounded-2xl overflow-hidden shadow-lg max-w-3xl mx-auto">
                    <img src="{{ asset('storage/' . $tahapan->gambar) }}" alt="{{ $tahapan->nama_tahap }}" class="w-full h-auto">
                </div>
            @endif

            @php $tahapVideos = $tahapan->media->where('koleksi', 'video'); @endphp
            @if($tahapVideos->isNotEmpty())
                <h3 data-reveal class="text-xl font-bold text-gray-900 mb-6">Video Panduan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach($tahapVideos as $vid)
                        <div data-reveal class="bg-gray-50 rounded-2xl overflow-hidden shadow-lg card-hover">
                            <div class="aspect-video bg-black">
                                @if($vid->sumber === 'youtube' && $vid->youtube_id)
                                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/{{ $vid->youtube_id }}" title="{{ $vid->nama ?? $tahapan->nama_tahap }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="w-full h-full"></iframe>
                                @elseif($vid->sumber === 'unggah')
                                    <video class="w-full h-full" controls preload="metadata">
                                        <source src="{{ $vid->url_media }}" type="{{ $vid->tipe_mime }}">
                                    </video>
                                @else
                                    <a href="{{ $vid->url_media ?? $vid->url }}" target="_blank" class="block w-full h-full flex items-center justify-center bg-gray-100 text-indigo-600 hover:text-indigo-800 transition">
                                        <div class="text-center">
                                            <svg class="w-12 h-12 mx-auto mb-2" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                            <span class="text-sm font-semibold">{{ $vid->nama ?? 'Tonton Video' }}</span>
                                        </div>
                                    </a>
                                @endif
                            </div>
                            @if($vid->nama)
                                <div class="p-4">
                                    <p class="text-sm font-semibold text-gray-800">{{ $vid->nama }}</p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @elseif($tahapan->video_url)
                <h3 class="text-xl font-bold text-gray-900 mb-6">Video Panduan</h3>
                <div class="max-w-2xl mx-auto">
                    <div class="aspect-video rounded-2xl overflow-hidden shadow-lg bg-black">
                    @php
                        $videoId = '';
                        if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]+)/', $tahapan->video_url, $matches)) {
                            $videoId = $matches[1];
                        }
                    @endphp
                    @if($videoId)
                        <iframe width="100%" height="100%" src="https://www.youtube.com/embed/{{ $videoId }}" title="{{ $tahapan->nama_tahap }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="w-full h-full"></iframe>
                    @else
                        <a href="{{ $tahapan->video_url }}" target="_blank" class="block w-full h-full flex items-center justify-center bg-gray-100 text-indigo-600 hover:text-indigo-800 transition">
                            <div class="text-center">
                                <svg class="w-16 h-16 mx-auto mb-3" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                <span class="text-lg font-semibold">Tonton Video</span>
                            </div>
                        </a>
                    @endif
                        </div>
                    </div>
                </div>
            @endif

            <div data-reveal class="mt-12 pt-8 border-t border-gray-200">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    @php
                        $prev = $tahapans->where('urutan', $tahapan->urutan - 1)->first();
                        $next = $tahapans->where('urutan', $tahapan->urutan + 1)->first();
                    @endphp
                    <div>
                        @if($prev)
                            <a href="{{ route('frontend.tahapan.detail', $prev) }}" class="group inline-flex items-center gap-2 px-5 py-3 bg-indigo-50 text-indigo-700 rounded-xl font-semibold hover:bg-indigo-100 transition-all duration-300">
                                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                                <span class="hidden sm:inline">Tahap {{ $prev->urutan }}: {{ $prev->nama_tahap }}</span>
                                <span class="sm:hidden">Sebelumnya</span>
                            </a>
                        @endif
                    </div>
                    <div>
                        @if($next)
                            <a href="{{ route('frontend.tahapan.detail', $next) }}" class="group inline-flex items-center gap-2 px-5 py-3 bg-indigo-600 text-white rounded-xl font-semibold hover:bg-indigo-700 transition-all duration-300 shadow-lg">
                                <span class="hidden sm:inline">Tahap {{ $next->urutan }}: {{ $next->nama_tahap }}</span>
                                <span class="sm:hidden">Selanjutnya</span>
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-8 text-center">
                <a href="{{ route('home') }}#alur" class="text-gray-500 hover:text-indigo-600 font-medium transition">&larr; Kembali ke Alur Penanganan</a>
            </div>
        </div>
    </section>
@endsection
