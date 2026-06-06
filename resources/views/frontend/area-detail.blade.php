@extends('layouts.frontend')

@section('title', $areaKecanduan->nama_kecanduan . ' - HypnoKonseling')

@section('content')
    <div class="bg-indigo-900 pt-28 pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-block px-4 py-1 bg-indigo-800 text-indigo-200 rounded-full text-sm font-semibold mb-3">Area Pemulihan</span>
            <div class="flex items-center justify-center gap-4 mb-4">
                <h1 class="text-4xl font-bold text-white">{{ $areaKecanduan->nama_kecanduan }}</h1>
            </div>
            <div class="flex flex-wrap items-center justify-center gap-2 mt-4">
                @foreach($areas as $a)
                    <a href="{{ route('frontend.area.detail', $a) }}" class="px-3 py-1.5 rounded-full text-sm font-medium transition @if($a->id === $areaKecanduan->id) bg-indigo-600 text-white @else bg-indigo-800 text-indigo-200 hover:bg-indigo-700 @endif">{{ $a->nama_kecanduan }}</a>
                @endforeach
            </div>
        </div>
    </div>

    @php $detail = $areaKecanduan->detailPenanganan; @endphp

    <section class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($detail)
                @php
                    $videos = $detail->media->where('koleksi', 'video');
                    $fotos = $detail->media->where('koleksi', 'foto');
                @endphp

                @if($videos->isNotEmpty())
                    <h2 data-reveal class="text-2xl font-bold text-gray-900 mb-8">Video Panduan</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
                        @foreach($videos as $vid)
                            <div data-reveal class="bg-gray-50 rounded-2xl overflow-hidden shadow-lg card-hover">
                                <div class="aspect-video bg-black">
                                    @if($vid->sumber === 'youtube' && $vid->youtube_id)
                                        <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $vid->youtube_id }}" title="{{ $vid->nama ?? $areaKecanduan->nama_kecanduan }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    @elseif($vid->sumber === 'unggah')
                                        <video class="w-full h-full" controls preload="metadata">
                                            <source src="{{ $vid->url_media }}" type="{{ $vid->tipe_mime }}">
                                        </video>
                                    @else
                                        <a href="{{ $vid->url_media ?? $vid->url }}" target="_blank" class="block w-full h-full flex items-center justify-center bg-gray-100 text-indigo-600 hover:text-indigo-800">
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
                @endif

                @if($fotos->isNotEmpty())
                    <h2 data-reveal class="text-2xl font-bold text-gray-900 mb-8">Galeri Foto</h2>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mb-16">
                        @foreach($fotos as $f)
                            <div data-reveal class="aspect-square rounded-2xl overflow-hidden bg-gray-100 shadow-lg card-hover">
                                <img src="{{ $f->url_media }}" class="w-full h-full object-cover" alt="{{ $f->nama ?? 'Foto' }}">
                            </div>
                        @endforeach
                    </div>
                @endif

                @if($detail->artikel_penanganan)
                    <h2 data-reveal class="text-2xl font-bold text-gray-900 mb-8">Panduan Penanganan</h2>
                    <div data-reveal class="bg-gray-50 rounded-2xl p-8 shadow-lg card-hover">
                        <div class="prose prose-indigo max-w-none text-gray-700 leading-relaxed">
                            {!! nl2br(e($detail->artikel_penanganan)) !!}
                        </div>
                    </div>
                @endif
            @else
                <div class="text-center py-16 text-gray-400">
                    <p class="text-lg">Belum ada panduan penanganan untuk area ini.</p>
                </div>
            @endif

            <div class="mt-12 text-center">
                <a href="{{ route('home') }}#area" class="text-gray-500 hover:text-indigo-600 font-medium transition">&larr; Kembali ke Area Pemulihan</a>
            </div>
        </div>
    </section>
@endsection
