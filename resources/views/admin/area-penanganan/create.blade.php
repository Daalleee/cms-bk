<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Area Penanganan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('area-penanganan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <x-input-label for="nama_area" :value="__('Nama Area')" />
                            <x-text-input id="nama_area" class="block mt-1 w-full" type="text" name="nama_area" :value="old('nama_area')" required autofocus />
                            <x-input-error :messages="$errors->get('nama_area')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                            <textarea id="deskripsi" name="deskripsi" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4">{{ old('deskripsi') }}</textarea>
                            <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="ikon" :value="__('Ikon (Image)')" />
                            <input id="ikon" name="ikon" type="file" class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm" accept="image/*" />
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, SVG (Max 2MB)</p>
                            <x-input-error :messages="$errors->get('ikon')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="gambar" :value="__('Gambar Utama')" />
                            <input id="gambar" name="gambar" type="file" class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm" accept="image/*" />
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, WEBP (Max 2MB)</p>
                            <x-input-error :messages="$errors->get('gambar')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="video_url" :value="__('Video YouTube URL')" />
                            <x-text-input id="video_url" class="block mt-1 w-full" type="text" name="video_url" :value="old('video_url')" placeholder="https://www.youtube.com/watch?v=..." />
                            <p class="text-xs text-gray-500 mt-1">Masukkan link video YouTube untuk ditampilkan di pop-up.</p>
                            <x-input-error :messages="$errors->get('video_url')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="artikel" :value="__('Artikel Detail')" />
                            <textarea id="artikel" name="artikel" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="10">{{ old('artikel') }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Artikel penjelasan panjang yang akan muncul di bawah video.</p>
                            <x-input-error :messages="$errors->get('artikel')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" name="status" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Non-aktif</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('area-penanganan.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 me-3">
                                {{ __('Batal') }}
                            </a>
                            <x-primary-button>
                                {{ __('Simpan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
