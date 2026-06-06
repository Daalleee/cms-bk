<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-indigo-500">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 uppercase">Area Kecanduan</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $stats['areas'] }}</p>
                            </div>
                            <div class="p-3 bg-indigo-100 rounded-full text-indigo-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('admin.area-kecanduan.index') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-500">Lihat Detail &rarr;</a>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-green-500">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 uppercase">Tahapan</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $stats['tahapans'] }}</p>
                            </div>
                            <div class="p-3 bg-green-100 rounded-full text-green-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('admin.tahapan-penanganan.index') }}" class="text-sm font-semibold text-green-600 hover:text-green-500">Lihat Detail &rarr;</a>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-yellow-500">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 uppercase">Testimoni</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $stats['testimonis'] }}</p>
                                @if($stats['testimoni_pending'] > 0)
                                    <p class="text-xs font-semibold text-yellow-600 mt-1">{{ $stats['testimoni_pending'] }} menunggu persetujuan</p>
                                @endif
                            </div>
                            <div class="p-3 bg-yellow-100 rounded-full text-yellow-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('admin.testimoni.index') }}" class="text-sm font-semibold text-yellow-600 hover:text-yellow-500">Lihat Detail &rarr;</a>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-red-500">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 uppercase">Pesan Masuk</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $stats['pesan'] }}</p>
                            </div>
                            <div class="p-3 bg-red-100 rounded-full text-red-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('admin.pesan-masuk.index') }}" class="text-sm font-semibold text-red-600 hover:text-red-500">Lihat Detail &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Selamat Datang, {{ Auth::user()->nama }}!</h3>
                    <p class="text-gray-600">Melalui dashboard ini, Anda dapat mengelola seluruh konten website HypnoKonseling. Silakan pilih menu di samping atau klik pada kartu statistik di atas untuk mulai mengelola konten.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
