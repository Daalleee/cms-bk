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
                    <form action="{{ route('tahapan-penanganan.store') }}" method="POST">
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
