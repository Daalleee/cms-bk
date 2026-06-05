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
                                <h3 class="text-lg font-bold text-gray-900">Telepon / WhatsApp</h3>
                                <p class="text-gray-600 mt-1">Telp: {{ $kontak->telepon ?? '-' }}</p>
                                <p class="text-gray-600">WA: {{ $kontak->whatsapp ?? '-' }}</p>
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

                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div class="ms-4">
                                <h3 class="text-lg font-bold text-gray-900">Jam Operasional</h3>
                                <p class="text-gray-600 mt-1">{{ $kontak->jam_operasional ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    @if ($kontak && $kontak->google_maps)
                        <div class="mt-12 rounded-2xl overflow-hidden h-64 shadow-sm border border-gray-100">
                            {!! $kontak->google_maps !!}
                        </div>
                    @endif
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
