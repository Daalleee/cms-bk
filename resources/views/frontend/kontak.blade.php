@extends('layouts.frontend')

@section('title', 'Hubungi Kami - CMS BK')

@section('content')
    <div class="bg-indigo-900 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold text-white">Hubungi Kami</h1>
            <p class="mt-4 text-indigo-100 max-w-2xl mx-auto">Ada pertanyaan atau ingin menjadwalkan konsultasi? Kami siap melayani Anda.</p>
        </div>
    </div>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                <!-- Informasi Kontak -->
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-8">Informasi Kontak</h2>
                    <div class="space-y-8">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div class="ms-4">
                                <h3 class="text-lg font-bold text-gray-900">Alamat</h3>
                                <p class="text-gray-600 mt-1">{{ $kontak->alamat ?? 'Alamat belum tersedia.' }}</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <div class="ms-4">
                                <h3 class="text-lg font-bold text-gray-900">Telepon</h3>
                                <p class="text-gray-600 mt-1">{{ $kontak->telepon ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div class="ms-4">
                                <h3 class="text-lg font-bold text-gray-900">Email</h3>
                                <p class="text-gray-600 mt-1">{{ $kontak->email ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-12">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Ikuti Kami</h3>
                        <div class="flex flex-wrap gap-4">
                            @if($kontak && $kontak->youtube && $kontak->tampilkan_youtube)
                                <a href="https://youtube.com/@{{ $kontak->youtube }}" target="_blank" class="text-red-600 hover:text-red-500 transition">
                                    <svg class="w-10 h-10 fill-current" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                                </a>
                            @endif
                            @if($kontak && $kontak->instagram && $kontak->tampilkan_instagram)
                                <a href="https://instagram.com/{{ $kontak->instagram }}" target="_blank" class="text-pink-600 hover:text-pink-500 transition">
                                    <svg class="w-10 h-10 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0c-3.254 0-3.662.014-4.94.072-2.766.127-4.648 1.181-5.593 2.665-.78 1.225-1.023 2.705-1.062 4.191-.025.905-.025 1.185-.025 3.072s0 2.167.025 3.072c.039 1.486.282 2.966 1.062 4.191.945 1.484 2.828 2.538 5.593 2.665 1.278.057 1.686.072 4.94.072 3.254 0 3.662-.015 4.94-.072 2.766-.127 4.648-1.181 5.593-2.665.78-1.225 1.023-2.705 1.062-4.191.025-.905.025-1.185.025-3.072s0-2.167-.025-3.072c-.039-1.486-.282-2.966-1.062-4.191-.945-1.484-2.828-2.538-5.593-2.665C15.662.014 15.254 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.405-10.405a1.44 1.44 0 1 0 0 2.88 1.44 1.44 0 0 0 0-2.88z"/></svg>
                                </a>
                            @endif
                            @if($kontak && $kontak->facebook && $kontak->tampilkan_facebook)
                                <a href="https://facebook.com/{{ $kontak->facebook }}" target="_blank" class="text-blue-600 hover:text-blue-500 transition">
                                    <svg class="w-10 h-10 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                </a>
                            @endif
                            @if($kontak && $kontak->twitter && $kontak->tampilkan_twitter)
                                <a href="https://twitter.com/{{ $kontak->twitter }}" target="_blank" class="text-gray-900 hover:text-black transition">
                                    <svg class="w-10 h-10 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                </a>
                            @endif
                            @if($kontak && $kontak->tiktok && $kontak->tampilkan_tiktok)
                                <a href="https://tiktok.com/@{{ $kontak->tiktok }}" target="_blank" class="text-gray-900 hover:text-black transition">
                                    <svg class="w-10 h-10 fill-current" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Formulir Kontak -->
                <div class="bg-gray-50 p-8 md:p-12 rounded-3xl border border-gray-100 shadow-sm">
                    <h2 class="text-3xl font-bold text-gray-900 mb-8">Kirim Pesan</h2>

                    @if (session('success'))
                        <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-xl font-medium">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('frontend.kontak.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                                <input type="text" id="nama" name="nama" class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500" required>
                                @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Alamat Email</label>
                                <input type="email" id="email" name="email" class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500" required>
                                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="nomor_telepon" class="block text-sm font-semibold text-gray-700 mb-2">Nomor Telepon</label>
                                <input type="text" id="nomor_telepon" name="nomor_telepon" class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500" required>
                                @error('nomor_telepon') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="subjek" class="block text-sm font-semibold text-gray-700 mb-2">Subjek</label>
                                <input type="text" id="subjek" name="subjek" class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500" required>
                                @error('subjek') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="mb-8">
                            <label for="pesan" class="block text-sm font-semibold text-gray-700 mb-2">Pesan Anda</label>
                            <textarea id="pesan" name="pesan" rows="5" class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500" required></textarea>
                            @error('pesan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <button type="submit" class="w-full py-4 bg-indigo-600 text-white font-bold rounded-xl shadow-lg hover:bg-indigo-700 transition duration-300">
                            Kirim Pesan Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
