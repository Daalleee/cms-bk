<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Area Kecanduan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.area-kecanduan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="nama_kecanduan" :value="__('Nama Kecanduan')" />
                            <x-text-input id="nama_kecanduan" class="block mt-1 w-full" type="text" name="nama_kecanduan" :value="old('nama_kecanduan')" required />
                            <x-input-error :messages="$errors->get('nama_kecanduan')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="urutan" :value="__('Urutan')" />
                            <x-text-input id="urutan" class="block mt-1 w-full" type="number" name="urutan" :value="old('urutan', 0)" required />
                            <x-input-error :messages="$errors->get('urutan')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="ikon" :value="__('Ikon (krop persegi untuk hasil terbaik)')" />
                            <input type="file" id="ikon" name="ikon" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" accept="image/*" />
                            <p class="text-xs text-gray-400 mt-1">Klik gambar untuk menyesuaikan area yang diinginkan</p>
                            <x-input-error :messages="$errors->get('ikon')" class="mt-2" />
                        </div>

                        <div id="cropModal" class="fixed inset-0 z-50 bg-black bg-opacity-75 hidden items-center justify-center p-4">
                            <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] flex flex-col">
                                <div class="p-4 border-b border-gray-200">
                                    <h3 class="text-lg font-bold">Krop Ikon</h3>
                                    <p class="text-sm text-gray-500">Seret atau atur area yang ingin dijadikan ikon</p>
                                </div>
                                <div class="flex-1 p-4 overflow-hidden">
                                    <img id="cropPreview" class="max-w-full max-h-[50vh] mx-auto">
                                </div>
                                <div class="p-4 border-t border-gray-200 flex justify-end gap-3">
                                    <button type="button" id="cropCancel" class="px-6 py-2 bg-gray-200 rounded-lg font-medium text-gray-700 hover:bg-gray-300 transition">Batal</button>
                                    <button type="button" id="cropConfirm" class="px-6 py-2 bg-indigo-600 rounded-lg font-medium text-white hover:bg-indigo-700 transition">Simpan Krop</button>
                                </div>
                            </div>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                window.initImageCropper('ikon', 'cropPreview', 'cropModal', 'cropConfirm', 'cropCancel');
                            });
                        </script>

                        <div class="mb-4">
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" name="status" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="1">Aktif</option>
                                <option value="0">Non-aktif</option>
                            </select>
                        </div>

                        <hr class="my-6">

                        <h3 class="text-lg font-semibold mb-4">Detail Penanganan</h3>

                        <div class="mb-4">
                            <x-input-label for="link_youtube" :value="__('Link YouTube')" />
                            <x-text-input id="link_youtube" class="block mt-1 w-full" type="text" name="link_youtube" :value="old('link_youtube')" placeholder="https://www.youtube.com/watch?v=..." />
                            <x-input-error :messages="$errors->get('link_youtube')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="artikel_penanganan" :value="__('Artikel Penanganan')" />
                            <textarea id="artikel_penanganan" name="artikel_penanganan" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="8">{{ old('artikel_penanganan') }}</textarea>
                            <x-input-error :messages="$errors->get('artikel_penanganan')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.area-kecanduan.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 mr-2">Batal</a>
                            <x-primary-button>{{ __('Simpan') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
