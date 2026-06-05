@extends('layouts.frontend')

@section('title', 'Galeri - CMS BK')

@section('content')
    <div class="bg-indigo-900 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold text-white">Galeri Foto & Video</h1>
            <p class="mt-4 text-indigo-100 max-w-2xl mx-auto">Dokumentasi kegiatan dan materi edukasi bimbingan konseling.</p>
        </div>
    </div>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($galeris as $item)
                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 group">
                        <div class="aspect-video bg-gray-100 overflow-hidden relative">
                            @if ($item->tipe === 'foto')
                                <img src="{{ $item->sumber === 'file' ? asset('storage/' . $item->path_atau_link) : $item->path_atau_link }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" alt="{{ $item->judul }}">
                            @else
                                @if (str_contains($item->path_atau_link, 'youtube.com') || str_contains($item->path_atau_link, 'youtu.be'))
                                    @php
                                        $videoId = '';
                                        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $item->path_atau_link, $match)) {
                                            $videoId = $match[1];
                                        }
                                    @endphp
                                    @if ($videoId)
                                        <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allowfullscreen></iframe>
                                    @else
                                        <div class="flex items-center justify-center h-full text-gray-500 italic">Video Link</div>
                                    @endif
                                @else
                                    <video class="w-full h-full object-cover" controls>
                                        <source src="{{ $item->sumber === 'file' ? asset('storage/' . $item->path_atau_link) : $item->path_atau_link }}">
                                        Browser Anda tidak mendukung tag video.
                                    </video>
                                @endif
                            @endif
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $item->judul }}</h3>
                            <p class="text-gray-600 text-sm">{{ $item->keterangan }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-500">Belum ada konten galeri.</div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
