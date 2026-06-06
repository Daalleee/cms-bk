<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hero Section') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 font-medium text-sm text-green-600">{{ session('success') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.hero-section.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <x-input-label for="judul" :value="__('Judul Utama')" />
                            <x-text-input id="judul" class="block mt-1 w-full" type="text" name="judul" :value="old('judul', $hero->judul ?? '')" required />
                            <x-input-error :messages="$errors->get('judul')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="sub_judul" :value="__('Sub Judul')" />
                            <textarea id="sub_judul" name="sub_judul" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3">{{ old('sub_judul', $hero->sub_judul ?? '') }}</textarea>
                            <x-input-error :messages="$errors->get('sub_judul')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="whatsapp_tujuan" :value="__('Nomor WhatsApp Tujuan')" />
                            <x-text-input id="whatsapp_tujuan" class="block mt-1 w-full" type="text" name="whatsapp_tujuan" :value="old('whatsapp_tujuan', $hero->whatsapp_tujuan ?? '')" />
                            <x-input-error :messages="$errors->get('whatsapp_tujuan')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="gambar" :value="__('Gambar Ilustrasi')" />
                            <input type="file" id="gambar" name="gambar" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" accept="image/*" />
                            @if($hero && $hero->gambar)
                                <p class="text-sm text-gray-500 mt-1">Gambar saat ini: {{ $hero->gambar }}</p>
                            @endif
                            <x-input-error :messages="$errors->get('gambar')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>{{ __('Simpan Perubahan') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
