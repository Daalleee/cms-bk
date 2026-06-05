@extends('layouts.frontend')

@section('title', 'Tahapan Penanganan - CMS BK')

@section('content')
    <div class="bg-indigo-900 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold text-white">Tahapan Penanganan</h1>
            <p class="mt-4 text-indigo-100 max-w-2xl mx-auto">Proses terapi yang terstruktur untuk hasil yang optimal dan berkelanjutan.</p>
        </div>
    </div>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative">
                <!-- Vertical Line (Desktop) -->
                <div class="absolute left-1/2 transform -translate-x-1/2 w-1 h-full bg-indigo-100 hidden md:block"></div>

                <div class="space-y-12">
                    @forelse ($tahapans as $index => $tahapan)
                        <div class="relative flex items-center {{ $index % 2 == 0 ? 'md:flex-row' : 'md:flex-row-reverse' }}">
                            <!-- Circle Marker -->
                            <div class="absolute left-1/2 transform -translate-x-1/2 w-10 h-10 bg-indigo-600 rounded-full border-4 border-white z-10 hidden md:flex items-center justify-center text-white font-bold">
                                {{ $index + 1 }}
                            </div>

                            <!-- Content Card -->
                            <div class="md:w-1/2 w-full {{ $index % 2 == 0 ? 'md:pr-16' : 'md:pl-16' }}">
                                <div class="bg-gray-50 p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition">
                                    <div class="flex items-center mb-4 md:hidden">
                                        <span class="w-8 h-8 bg-indigo-600 text-white rounded-full flex items-center justify-center font-bold text-sm me-3">{{ $index + 1 }}</span>
                                        <h2 class="text-xl font-bold text-gray-900">Tahap {{ $tahapan->urutan }}: {{ $tahapan->nama_tahap }}</h2>
                                    </div>
                                    <h2 class="text-xl font-bold text-gray-900 mb-4 hidden md:block">Tahap {{ $tahapan->urutan }}: {{ $tahapan->nama_tahap }}</h2>
                                    <p class="text-gray-600 leading-relaxed">{{ $tahapan->deskripsi }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12 text-gray-500">Data tahapan penanganan belum tersedia.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection
