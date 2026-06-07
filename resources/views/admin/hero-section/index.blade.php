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

                        <div class="mt-6 pt-6 border-t">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Tombol CTA</h3>
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <x-input-label for="tombol_1_teks" :value="__('Teks Tombol 1')" />
                                    <x-text-input id="tombol_1_teks" class="block mt-1 w-full" type="text" name="tombol_1_teks" :value="old('tombol_1_teks', $settings['hero_tombol_1_teks'] ?? '')" />
                                </div>
                                <div>
                                    <x-input-label for="tombol_1_target" :value="__('Link Tombol 1 (WA)')" />
                                    <x-text-input id="tombol_1_target" class="block mt-1 w-full" type="text" name="tombol_1_target" :value="old('tombol_1_target', $settings['hero_tombol_1_target'] ?? '')" placeholder="https://wa.me/... atau kosongkan" />
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="tampilkan_tombol_1" value="1" {{ old('tampilkan_tombol_1', $settings['hero_tampilkan_tombol_1'] ?? '1') == '1' ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <span class="text-sm font-medium text-gray-700">Tampilkan Tombol 1</span>
                                </label>
                            </div>
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <x-input-label for="tombol_2_teks" :value="__('Teks Tombol 2')" />
                                    <x-text-input id="tombol_2_teks" class="block mt-1 w-full" type="text" name="tombol_2_teks" :value="old('tombol_2_teks', $settings['hero_tombol_2_teks'] ?? '')" />
                                </div>
                                <div>
                                    <x-input-label for="tombol_2_target" :value="__('Link Tombol 2')" />
                                    <x-text-input id="tombol_2_target" class="block mt-1 w-full" type="text" name="tombol_2_target" :value="old('tombol_2_target', $settings['hero_tombol_2_target'] ?? '')" placeholder="#tentang" />
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="tampilkan_tombol_2" value="1" {{ old('tampilkan_tombol_2', $settings['hero_tampilkan_tombol_2'] ?? '1') == '1' ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <span class="text-sm font-medium text-gray-700">Tampilkan Tombol 2</span>
                                </label>
                            </div>
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
