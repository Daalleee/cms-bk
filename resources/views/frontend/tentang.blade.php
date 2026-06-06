@extends('layouts.frontend')

@section('title', 'Tentang HypnoKonseling')

@section('content')
    <section class="pt-36 pb-20 bg-gradient-to-br from-indigo-50 via-white to-indigo-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-black text-gray-900 mb-4">{{ $tentang->judul ?? 'Tentang HypnoKonseling' }}</h1>
                @if($tentang && $tentang->pengantar)
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">{{ $tentang->pengantar }}</p>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @forelse($sections as $section)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden @if($sections->count() === 1) md:col-span-2 @endif">
                    @php $sectionVideos = $section->media->where('koleksi', 'video'); @endphp
                    @if($sectionVideos->isNotEmpty())
                        <div class="aspect-video w-full">
                            @php $v = $sectionVideos->first(); @endphp
                            @if($v->sumber === 'youtube' && $v->youtube_id)
                                <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $v->youtube_id }}" title="{{ $v->nama ?? $section->judul }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            @endif
                        </div>
                    @endif
                    <div class="p-6 md:p-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-3">{{ $section->judul }}</h2>
                        @if($section->deskripsi)
                            <p class="text-gray-600 leading-relaxed">{{ $section->deskripsi }}</p>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16">
                    <p class="text-gray-400 text-lg">Belum ada konten tentang. Admin akan segera mengisinya.</p>
                </div>
            @endforelse
            </div>
        </div>
    </section>
@endsection
