<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Media ke Galeri') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data" x-data="{ sumber: 'file', tipe: 'foto' }">
                        @csrf
                        
                        <div class="mb-4">
                            <x-input-label for="judul" :value="__('Judul Media')" />
                            <x-text-input id="judul" class="block mt-1 w-full" type="text" name="judul" :value="old('judul')" required autofocus />
                            <x-input-error :messages="$errors->get('judul')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="tipe" :value="__('Tipe Media')" />
                                <select id="tipe" name="tipe" x-model="tipe" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="foto">Foto</option>
                                    <option value="video">Video</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="sumber" :value="__('Sumber Media')" />
                                <select id="sumber" name="sumber" x-model="sumber" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="file">Upload File</option>
                                    <option value="link">Link (URL)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Input File -->
                        <div class="mb-4" x-show="sumber === 'file'">
                            <x-input-label for="file_media" :value="__('Pilih File')" />
                            <input id="file_media" type="file" name="file_media" class="block mt-1 w-full border border-gray-300 rounded-md p-2">
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, MP4. Max: 20MB</p>
                            <x-input-error :messages="$errors->get('file_media')" class="mt-2" />
                        </div>

                        <!-- Input Link -->
                        <div class="mb-4" x-show="sumber === 'link'">
                            <x-input-label for="link_media" :value="__('Link URL')" />
                            <x-text-input id="link_media" class="block mt-1 w-full" type="text" name="link_media" :value="old('link_media')" placeholder="https://..." />
                            <p class="text-xs text-gray-500 mt-1">Masukkan URL foto atau link video YouTube/Google.</p>
                            <x-input-error :messages="$errors->get('link_media')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="keterangan" :value="__('Keterangan')" />
                            <textarea id="keterangan" name="keterangan" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3">{{ old('keterangan') }}</textarea>
                            <x-input-error :messages="$errors->get('keterangan')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
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
