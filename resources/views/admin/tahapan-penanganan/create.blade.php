<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Tahapan Penanganan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.tahapan-penanganan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <x-input-label for="urutan" :value="__('Urutan')" />
                            <x-text-input id="urutan" class="block mt-1 w-full" type="number" name="urutan" :value="old('urutan')" required autofocus />
                            <x-input-error :messages="$errors->get('urutan')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="nama_tahap" :value="__('Nama Tahapan')" />
                            <x-text-input id="nama_tahap" class="block mt-1 w-full" type="text" name="nama_tahap" :value="old('nama_tahap')" required />
                            <x-input-error :messages="$errors->get('nama_tahap')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                            <textarea id="deskripsi" name="deskripsi" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4" required>{{ old('deskripsi') }}</textarea>
                            <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="ikon" :value="__('Ikon')" />
                            <input id="ikon" type="file" name="ikon" class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                            <x-input-error :messages="$errors->get('ikon')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="gambar" :value="__('Gambar (Foto)')" />
                            <input id="gambar" type="file" name="gambar" class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                            <x-input-error :messages="$errors->get('gambar')" class="mt-2" />
                        </div>

                        <div class="mb-4" id="video-container">
                            <div class="flex items-center justify-between mb-2">
                                <x-input-label :value="__('Link Video YouTube')" />
                                <button type="button" onclick="tambahVideo()" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">+ Tambah Video</button>
                            </div>
                            <div id="video-list">
                                <div class="flex items-center gap-2 mb-2 video-item">
                                    <input type="url" name="video_urls[]" class="flex-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm" placeholder="https://www.youtube.com/watch?v=..." />
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('video_urls.*')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>{{ __('Simpan') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function tambahVideo() {
            var list = document.getElementById('video-list');
            var div = document.createElement('div');
            div.className = 'flex items-center gap-2 mb-2 video-item';
            div.innerHTML = '<input type="url" name="video_urls[]" class="flex-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm" placeholder="https://www.youtube.com/watch?v=..." /> <button type="button" onclick="hapusVideo(this)" class="text-red-600 hover:text-red-800 shrink-0"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>';
            list.appendChild(div);
        }

        function hapusVideo(btn) {
            var item = btn.closest('.video-item');
            if (item) item.remove();
        }
    </script>
</x-app-layout>
