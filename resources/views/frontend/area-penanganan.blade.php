@extends('layouts.frontend')

@section('title', 'Area Penanganan - CMS BK')

@section('content')
    <div class="bg-indigo-900 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold text-white">Area Penanganan</h1>
            <p class="mt-4 text-indigo-100 max-w-2xl mx-auto">Masalah dan kondisi yang dapat kami bantu atasi melalui pendekatan profesional.</p>
        </div>
    </div>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($areas as $area)
                    <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition group">
                        <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center mb-6 group-hover:bg-indigo-600 group-hover:text-white transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900 mb-4">{{ $area->nama_area }}</h2>
                        <p class="text-gray-600 leading-relaxed">{{ $area->deskripsi }}</p>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-500">Data area penanganan belum tersedia.</div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
