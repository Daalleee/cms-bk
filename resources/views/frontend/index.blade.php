@extends('layouts.frontend')

@section('title', 'HypnoKonseling - Pulihkan Diri, Raih Kembali Kendali Hidupmu')

@auth
    @php
        $role = Auth::user()->peran;
        $isSuperAdmin = $role === 'super_admin';
        $isAdmin = $role === 'admin' || $isSuperAdmin;
    @endphp
@endauth

@section('content')
    <!-- HERO -->
    <section id="hero" class="relative bg-gradient-to-br from-indigo-50 via-white to-purple-50 overflow-hidden min-h-[90vh] flex items-center pt-28">
        @auth @if($isSuperAdmin)
            <a href="{{ route('admin.hero-section.index') }}" class="absolute top-24 right-4 z-20 bg-indigo-600 text-white px-3 py-1.5 rounded-full text-xs font-bold shadow-lg hover:bg-indigo-700 transition flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Edit Hero
            </a>
        @endif @endauth

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div data-reveal class="text-center lg:text-left">
                    <h1 class="text-4xl sm:text-5xl lg:text-7xl font-black text-gray-900 leading-tight mb-6">
                        {{ $hero->judul ?? 'Pulihkan Diri dari Kecanduan, Raih Kembali Kendali Hidupmu' }}
                    </h1>
                    <p class="text-lg sm:text-xl text-gray-600 mb-10 leading-relaxed max-w-xl mx-auto lg:mx-0">
                        {{ $hero->sub_judul ?? 'Metode HypnoKonseling membantu Anda menjangkau akar masalah di pikiran bawah sadar untuk transformasi hidup yang nyata dan permanen.' }}
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $hero->whatsapp_tujuan ?? $kontak->whatsapp ?? '') }}" target="_blank" class="group px-10 py-5 bg-indigo-600 text-white font-extrabold rounded-2xl shadow-2xl shadow-indigo-200 hover:bg-indigo-700 hover:-translate-y-1 transition-all duration-300 text-lg text-center inline-flex items-center justify-center gap-2">
                            Mulai Konsultasi
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </a>
                        <a href="#tentang" class="group px-10 py-5 bg-white text-gray-900 font-extrabold rounded-2xl border-2 border-gray-200 hover:bg-gray-50 hover:-translate-y-1 transition-all duration-300 text-lg text-center inline-flex items-center justify-center gap-2 shadow-sm">
                            Pelajari Metode
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </a>
                    </div>
                    @if($testimonis->count() > 0)
                        <div class="flex items-center gap-3 mt-10 justify-center lg:justify-start text-sm text-gray-500">
                            <div class="flex -space-x-2">
                                @foreach($testimonis->take(4) as $t)
                                    <div class="w-8 h-8 rounded-full bg-indigo-600 border-2 border-white flex items-center justify-center text-white font-bold text-xs shadow-sm">{{ substr($t->nama, 0, 1) }}</div>
                                @endforeach
                            </div>
                            <span>Didukung oleh <strong class="text-gray-900">{{ $testimonis->count() }}+</strong> klien</span>
                        </div>
                    @endif
                </div>
                <div class="relative hidden lg:block">
                    <div class="absolute -top-20 -right-20 w-96 h-96 bg-indigo-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70"></div>
                    <div class="absolute -bottom-20 -left-20 w-96 h-96 bg-purple-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70"></div>
                    <div class="relative">
                        @if($hero && $hero->gambar)
                            <img src="{{ asset('storage/' . $hero->gambar) }}" alt="Hero Illustration" class="w-full h-auto rounded-3xl shadow-2xl">
                        @else
                            <div class="w-full aspect-square bg-gradient-to-br from-indigo-500 to-purple-600 rounded-3xl shadow-2xl flex items-center justify-center p-16">
                                <svg class="w-full h-full text-white/20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/></svg>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TENTANG -->
    <section id="tentang" class="py-16 bg-white relative">
        @auth @if($isSuperAdmin)
            <a href="{{ route('admin.tentang-section.index') }}" class="absolute top-4 right-4 z-20 bg-indigo-600 text-white px-3 py-1.5 rounded-full text-xs font-bold shadow-lg hover:bg-indigo-700 transition flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Edit
            </a>
        @endif @endauth
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div data-reveal class="text-center mb-16">
                <span class="inline-block px-4 py-1.5 bg-indigo-100 text-indigo-700 rounded-full text-sm font-semibold mb-4">Edukasi Dasar</span>
                <h2 class="text-4xl sm:text-5xl font-black text-gray-900 mb-4">{{ $tentang->judul ?? 'Tentang HypnoKonseling' }}</h2>
                @if($tentang && $tentang->pengantar)
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed mb-10">{{ $tentang->pengantar }}</p>
                @else
                    <div class="w-24 h-1.5 bg-indigo-600 mx-auto rounded-full mb-10"></div>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @forelse($sections as $section)
                    <div data-reveal class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 card-hover @if($sections->count() === 1) md:col-span-2 @endif">
                        @php $sectionVideos = $section->media->where('koleksi', 'video'); @endphp
                        @if($sectionVideos->isNotEmpty())
                            @php $v = $sectionVideos->first(); @endphp
                            @if($v->sumber === 'youtube' && $v->youtube_id)
                                <div class="aspect-video w-full">
                                    <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $v->youtube_id }}" title="{{ $v->nama ?? $section->judul }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            @endif
                        @endif
                        <div class="p-6 md:p-8">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $section->judul }}</h3>
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

    <!-- ALUR -->
    <section id="alur" class="py-16 bg-gray-50 relative">
        @auth @if($isSuperAdmin)
            <a href="{{ route('admin.tahapan-penanganan.index') }}" class="absolute top-4 right-4 z-20 bg-indigo-600 text-white px-3 py-1.5 rounded-full text-xs font-bold shadow-lg hover:bg-indigo-700 transition flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Edit
            </a>
        @endif @endauth
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div data-reveal>
                <span class="inline-block px-4 py-1.5 bg-indigo-100 text-indigo-700 rounded-full text-sm font-semibold mb-4">Metode Terstruktur</span>
                <h2 class="text-4xl sm:text-5xl font-black text-gray-900 mb-4">Langkah Menuju Pemulihan</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-16">Setiap sesi dirancang secara sistematis untuk hasil yang optimal dan berkelanjutan.</p>
            </div>
            <div class="relative">
                <div class="absolute top-16 left-[40px] md:left-1/2 w-0.5 bg-indigo-200 -translate-x-1/2 hidden md:block pointer-events-none" style="bottom:4rem"></div>
                <div class="space-y-12 relative">
                    @foreach($tahapans as $index => $tahap)
                        <a href="{{ route('frontend.tahapan.detail', $tahap) }}" data-reveal class="flex flex-col md:flex-row items-center gap-8 {{ $index % 2 == 0 ? 'md:flex-row' : 'md:flex-row-reverse' }} group">
                            <div class="flex-1 {{ $index % 2 == 0 ? 'md:text-right' : 'md:text-left' }}">
                                <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 inline-block max-w-md group-hover:shadow-xl group-hover:border-indigo-300 transition-all duration-300 card-hover">
                                    <span class="text-xs font-bold text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full">Tahap {{ $index + 1 }}</span>
                                    <h4 class="text-xl font-bold text-gray-900 mt-3 mb-2 group-hover:text-indigo-600 transition">{{ $tahap->nama_tahap }}</h4>
                                    <p class="text-gray-600 text-sm leading-relaxed">{{ Str::limit($tahap->deskripsi, 120) }}</p>
                                    <span class="inline-flex items-center gap-1 text-indigo-600 font-semibold text-sm mt-3 opacity-0 group-hover:opacity-100 transition">
                                        Selengkapnya
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </span>
                                </div>
                            </div>
                            <div class="shrink-0 relative z-10">
                                <div class="w-24 h-24 bg-white border-4 border-indigo-600 rounded-2xl flex items-center justify-center shadow-xl group-hover:shadow-2xl group-hover:border-indigo-400 transition-all duration-300">
                                    @if($tahap->ikon)
                                        <img src="{{ asset('storage/' . $tahap->ikon) }}" class="w-10 h-10 object-contain" alt="{{ $tahap->nama_tahap }}">
                                    @else
                                        <span class="text-3xl font-black text-indigo-600">{{ $index + 1 }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex-1 hidden md:block"></div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- AREA KECANDUAN -->
    <section id="area" class="py-16 bg-white text-gray-900 relative">
        @auth @if($isAdmin)
            <a href="{{ route('admin.area-kecanduan.index') }}" class="absolute top-4 right-4 z-20 bg-indigo-600 text-white px-3 py-1.5 rounded-full text-xs font-bold shadow-lg hover:bg-indigo-700 transition flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Edit
            </a>
        @endif @endauth
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div data-reveal class="text-center mb-16">
                <span class="inline-block px-4 py-1.5 bg-indigo-100 text-indigo-700 rounded-full text-sm font-semibold mb-4">Yang Kami Tangani</span>
                <h2 class="text-4xl sm:text-5xl font-black mb-4">Area Pemulihan Kecanduan</h2>
                <p class="text-lg text-gray-500 max-w-2xl mx-auto">Klik pada setiap kategori untuk melihat video penanganan dan panduan lengkapnya.</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                @forelse($areas as $area)
                    <a href="{{ route('frontend.area.detail', $area) }}" data-reveal class="flex flex-col items-center group transition p-4 rounded-2xl hover:bg-indigo-50 hover:shadow-lg card-hover">
                        <div class="w-28 h-28 rounded-full bg-gray-100 border-2 border-gray-200 flex items-center justify-center mb-4 group-hover:bg-indigo-600 group-hover:border-indigo-500 transition duration-300 shadow-xl overflow-hidden">
                            @if($area->ikon)
                                <img src="{{ asset('storage/' . $area->ikon) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300" alt="{{ $area->nama_kecanduan }}">
                            @else
                                <span class="text-4xl font-black text-gray-500 group-hover:text-white transition">{{ substr($area->nama_kecanduan, 0, 1) }}</span>
                            @endif
                        </div>
                        <h4 class="text-base font-bold group-hover:text-indigo-600 transition text-center">{{ $area->nama_kecanduan }}</h4>
                    </a>
                @empty
                    <div class="col-span-full text-center text-gray-400 py-16">
                        <p class="text-xl mb-2">Belum ada data area kecanduan.</p>
                        @auth @if($isAdmin)
                            <a href="{{ route('admin.area-kecanduan.create') }}" class="text-indigo-600 hover:text-indigo-800 underline">Tambah sekarang</a>
                        @endauth @endif
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- TESTIMONI -->
    <section id="testimoni" class="py-16 bg-white relative">
        @auth @if($isAdmin)
            <a href="{{ route('admin.testimoni.index') }}" class="absolute top-4 right-4 z-20 bg-indigo-600 text-white px-3 py-1.5 rounded-full text-xs font-bold shadow-lg hover:bg-indigo-700 transition flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Edit
            </a>
        @endif @endauth
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div data-reveal class="text-center mb-16">
                <span class="inline-block px-4 py-1.5 bg-indigo-100 text-indigo-700 rounded-full text-sm font-semibold mb-4">Social Proof</span>
                <h2 class="text-4xl sm:text-5xl font-black text-gray-900 mb-4">Cerita Mereka yang Pulih</h2>
                <div class="w-24 h-1.5 bg-indigo-600 mx-auto rounded-full mb-8"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">Pengalaman nyata dari klien yang telah berhasil melalui proses HypnoKonseling.</p>
            </div>

            @if($testimonis->count() > 0)
                <div x-data="{ currentSlide: 0, slides: {{ $testimonis->count() }}, timer: null, init() { this.start(); }, start() { this.timer = setInterval(() => { this.next(); }, 4000); }, stop() { clearInterval(this.timer); this.timer = null; }, next() { this.currentSlide = this.currentSlide < this.slides - 1 ? this.currentSlide + 1 : 0; }, prev() { this.currentSlide = this.currentSlide > 0 ? this.currentSlide - 1 : this.slides - 1; }, goto(i) { this.currentSlide = i; } }" @mouseenter="stop()" @mouseleave="start()" data-reveal class="relative max-w-4xl mx-auto">
                    <div class="overflow-hidden rounded-3xl">
                        <div class="flex transition-transform duration-500 ease-in-out" :style="'transform: translateX(-' + (currentSlide * 100) + '%)'">
                            @foreach($testimonis as $testi)
                                <div class="min-w-full px-4">
                                    <div class="bg-gray-50 p-8 md:p-12 rounded-3xl border border-gray-100 text-center">
                                        <div class="w-16 h-16 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-2xl mx-auto mb-6 shadow-lg">{{ substr($testi->nama, 0, 1) }}</div>
                                        <p class="text-gray-700 text-lg md:text-xl italic leading-relaxed mb-8 max-w-2xl mx-auto">"{{ $testi->isi_testimoni }}"</p>
                                        <div class="flex justify-center mb-4">
                                            @for($i = 0; $i < 5; $i++)
                                                <svg class="w-5 h-5 {{ $i < $testi->rating ? 'text-yellow-400' : 'text-gray-300' }} fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                            @endfor
                                        </div>
                                        <h5 class="font-bold text-gray-900 text-lg">{{ $testi->nama }}</h5>
                                        <p class="text-sm text-indigo-600">{{ $testi->pekerjaan ?? 'Klien' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @if($testimonis->count() > 1)
                        <button @click="stop(); prev(); start()" class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 w-12 h-12 bg-white rounded-full shadow-xl flex items-center justify-center text-gray-600 hover:text-indigo-600 transition border border-gray-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        </button>
                        <button @click="stop(); next(); start()" class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 w-12 h-12 bg-white rounded-full shadow-xl flex items-center justify-center text-gray-600 hover:text-indigo-600 transition border border-gray-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </button>
                        <div class="flex justify-center gap-2 mt-8">
                            @foreach($testimonis as $i => $testi)
                                <button @click="stop(); goto({{ $i }}); start()" :class="currentSlide === {{ $i }} ? 'bg-indigo-600 w-8' : 'bg-gray-300 w-3'" class="h-3 rounded-full transition-all duration-300"></button>
                            @endforeach
                        </div>
                    @endif
                </div>
            @else
                <div class="text-center text-gray-500 py-16">
                    <p class="text-xl mb-4">Belum ada testimoni.</p>
                </div>
            @endif

            <!-- FORM -->
            <div data-reveal class="max-w-2xl mx-auto mt-20 bg-white rounded-[3rem] p-8 md:p-12 text-gray-900 shadow-2xl border border-gray-100 card-hover" id="form-testimoni">
                <h4 class="text-2xl font-bold mb-8 text-center">Bagikan Pengalaman Anda</h4>
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 p-4 rounded-xl mb-6 text-center font-medium">{{ session('success') }}</div>
                @endif
                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded-xl mb-6">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('frontend.testimoni.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">Nama Lengkap</label>
                            <input type="text" name="nama" value="{{ old('nama') }}" required class="w-full bg-gray-50 border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 text-gray-900 px-4 py-3">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">Pekerjaan/Status</label>
                            <input type="text" name="pekerjaan" value="{{ old('pekerjaan') }}" class="w-full bg-gray-50 border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 text-gray-900 px-4 py-3">
                        </div>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-600 mb-2">Rating</label>
                        <select name="rating" required class="w-full bg-gray-50 border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 text-gray-900 px-4 py-3">
                            <option value="5">Sangat Puas (5 Bintang)</option>
                            <option value="4">Puas (4 Bintang)</option>
                            <option value="3">Cukup (3 Bintang)</option>
                            <option value="2" {{ old('rating') == '2' ? 'selected' : '' }}>Kurang (2 Bintang)</option>
                            <option value="1" {{ old('rating') == '1' ? 'selected' : '' }}>Sangat Kurang (1 Bintang)</option>
                        </select>
                    </div>
                    <div class="mb-8">
                        <label class="block text-sm font-medium text-gray-600 mb-2">Ulasan Anda</label>
                        <textarea name="isi_testimoni" required rows="4" class="w-full bg-gray-50 border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 text-gray-900 px-4 py-3" placeholder="Bagaimana metode ini membantu Anda?">{{ old('isi_testimoni') }}</textarea>
                    </div>
                    <button type="submit" class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 rounded-2xl font-black text-lg text-white transition duration-300 shadow-xl">
                        Kirim Testimoni
                    </button>
                    <p class="text-xs text-gray-400 mt-4 text-center italic">Setiap testimoni akan ditinjau oleh tim kami sebelum ditayangkan.</p>
                </form>
            </div>
        </div>
    </section>

    <!-- KONTAK -->
    <section id="kontak" class="py-16 bg-gray-50 relative">
        @auth @if($isAdmin)
            <a href="{{ route('admin.kontak.index') }}" class="absolute top-4 right-4 z-20 bg-indigo-600 text-white px-3 py-1.5 rounded-full text-xs font-bold shadow-lg hover:bg-indigo-700 transition flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Edit Kontak
            </a>
        @endif @endauth
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div data-reveal class="text-center mb-16">
                <span class="inline-block px-4 py-1.5 bg-indigo-100 text-indigo-700 rounded-full text-sm font-semibold mb-4">Hubungi Kami</span>
                <h2 class="text-4xl sm:text-5xl font-black text-gray-900 mb-4">Mulai Perubahan Hidup Anda</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Ada pertanyaan atau ingin menjadwalkan konsultasi? Kami siap melayani Anda.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-12 max-w-5xl mx-auto">
                <div class="space-y-8">
                    <div data-reveal class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 card-hover">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Informasi Kontak</h3>
                        <div class="space-y-5">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center text-indigo-600 shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">Alamat</p>
                                    <p class="text-gray-600">{{ $kontak->alamat ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center text-indigo-600 shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">Telepon</p>
                                    <p class="text-gray-600">{{ $kontak->telepon ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center text-indigo-600 shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">Email</p>
                                    <p class="text-gray-600">{{ $kontak->email ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center text-green-600 shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">WhatsApp</p>
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $kontak->whatsapp ?? '') }}" target="_blank" class="text-indigo-600 hover:text-indigo-700 font-medium">{{ $kontak->whatsapp ?? '-' }}</a>
                                </div>
                            </div>
                            <div class="pt-4 border-t border-gray-100">
                                <p class="font-semibold text-gray-900 mb-3">Ikuti Kami</p>
                                <div class="flex flex-wrap gap-4">
                                    @if($kontak && $kontak->youtube)
                                        <a href="https://youtube.com/@{{ $kontak->youtube }}" target="_blank" class="text-red-600 hover:text-red-500 transition">
                                            <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                                        </a>
                                    @endif
                                    @if($kontak && $kontak->instagram)
                                        <a href="https://instagram.com/{{ $kontak->instagram }}" target="_blank" class="text-pink-600 hover:text-pink-500 transition">
                                            <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0c-3.254 0-3.662.014-4.94.072-2.766.127-4.648 1.181-5.593 2.665-.78 1.225-1.023 2.705-1.062 4.191-.025.905-.025 1.185-.025 3.072s0 2.167.025 3.072c.039 1.486.282 2.966 1.062 4.191.945 1.484 2.828 2.538 5.593 2.665 1.278.057 1.686.072 4.94.072 3.254 0 3.662-.015 4.94-.072 2.766-.127 4.648-1.181 5.593-2.665.78-1.225 1.023-2.705 1.062-4.191.025-.905.025-1.185.025-3.072s0-2.167-.025-3.072c-.039-1.486-.282-2.966-1.062-4.191-.945-1.484-2.828-2.538-5.593-2.665C15.662.014 15.254 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.405-10.405a1.44 1.44 0 1 0 0 2.88 1.44 1.44 0 0 0 0-2.88z"/></svg>
                                        </a>
                                    @endif
                                    @if($kontak && $kontak->facebook)
                                        <a href="https://facebook.com/{{ $kontak->facebook }}" target="_blank" class="text-blue-600 hover:text-blue-500 transition">
                                            <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                        </a>
                                    @endif
                                    @if($kontak && $kontak->twitter)
                                        <a href="https://twitter.com/{{ $kontak->twitter }}" target="_blank" class="text-sky-500 hover:text-sky-400 transition">
                                            <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Kirim Pesan</h3>
                    @if(session('success_pesan'))
                        <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-xl font-medium">{{ session('success_pesan') }}</div>
                    @endif
                    <form action="{{ route('frontend.kontak.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" name="nama" required class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" required class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Nomor Telepon</label>
                                <input type="text" name="nomor_telepon" required class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Subjek</label>
                                <input type="text" name="subjek" required class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Pesan</label>
                            <textarea name="pesan" rows="4" required class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                        </div>
                        <button type="submit" class="w-full py-4 bg-indigo-600 text-white font-bold rounded-xl shadow-lg hover:bg-indigo-700 transition duration-300 text-lg">
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
