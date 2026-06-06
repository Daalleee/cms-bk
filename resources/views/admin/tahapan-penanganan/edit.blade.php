<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tahapan Penanganan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.tahapan-penanganan.update', $tahapan) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <x-input-label for="urutan" :value="__('Urutan')" />
                            <x-text-input id="urutan" class="block mt-1 w-full" type="number" name="urutan" :value="old('urutan', $tahapan->urutan)" required autofocus />
                            <x-input-error :messages="$errors->get('urutan')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="nama_tahap" :value="__('Nama Tahapan')" />
                            <x-text-input id="nama_tahap" class="block mt-1 w-full" type="text" name="nama_tahap" :value="old('nama_tahap', $tahapan->nama_tahap)" required />
                            <x-input-error :messages="$errors->get('nama_tahap')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                            <textarea id="deskripsi" name="deskripsi" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4" required>{{ old('deskripsi', $tahapan->deskripsi) }}</textarea>
                            <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="ikon" :value="__('Ikon')" />
                            @if($tahapan->ikon)
                                <div class="mt-2 mb-2 flex items-start gap-4">
                                    <img src="{{ Storage::url($tahapan->ikon) }}" alt="Preview Ikon" class="h-20 w-20 object-cover rounded-md">
                                    <label class="inline-flex items-center gap-2 mt-1 cursor-pointer">
                                        <input type="checkbox" name="hapus_ikon" value="1" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                                        <span class="text-sm text-red-600 font-medium">Hapus ikon</span>
                                    </label>
                                </div>
                            @endif
                            <input id="ikon" type="file" name="ikon" class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                            <x-input-error :messages="$errors->get('ikon')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="gambar" :value="__('Gambar (Foto)')" />
                            @if($tahapan->gambar)
                                <div class="mt-2 mb-2">
                                    <img src="{{ Storage::url($tahapan->gambar) }}" alt="Preview Gambar" class="h-32 w-auto object-cover rounded-md">
                                </div>
                            @endif
                            <input id="gambar" type="file" name="gambar" class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                            <x-input-error :messages="$errors->get('gambar')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="video_url" :value="__('Link Video (YouTube)')" />
                            <x-text-input id="video_url" class="block mt-1 w-full" type="url" name="video_url" :value="old('video_url', $tahapan->video_url)" placeholder="https://www.youtube.com/watch?v=..." />
                            <x-input-error :messages="$errors->get('video_url')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>{{ __('Perbarui') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
