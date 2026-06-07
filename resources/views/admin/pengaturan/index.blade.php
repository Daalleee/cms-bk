<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengaturan Konten Halaman Depan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 font-medium text-sm text-green-600">{{ session('success') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.pengaturan.update') }}" method="POST">
                        @csrf

                        <h3 class="text-lg font-bold text-indigo-700 mb-4 border-b pb-2">Hero Section</h3>
                        <div class="mb-4">
                            <x-input-label for="hero_judul" :value="__('Judul Utama')" />
                            <textarea id="hero_judul" name="settings[hero_judul]" rows="2" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('settings.hero_judul', $settings['hero_judul'] ?? '') }}</textarea>
                        </div>
                        <div class="mb-4">
                            <x-input-label for="hero_sub_judul" :value="__('Sub Judul')" />
                            <textarea id="hero_sub_judul" name="settings[hero_sub_judul]" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('settings.hero_sub_judul', $settings['hero_sub_judul'] ?? '') }}</textarea>
                        </div>
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="hero_tombol_1_teks" :value="__('Tombol 1 (teks)')" />
                                <x-text-input id="hero_tombol_1_teks" class="block mt-1 w-full" type="text" name="settings[hero_tombol_1_teks]" :value="old('settings.hero_tombol_1_teks', $settings['hero_tombol_1_teks'] ?? '')" />
                            </div>
                            <div>
                                <x-input-label for="hero_tombol_2_teks" :value="__('Tombol 2 (teks)')" />
                                <x-text-input id="hero_tombol_2_teks" class="block mt-1 w-full" type="text" name="settings[hero_tombol_2_teks]" :value="old('settings.hero_tombol_2_teks', $settings['hero_tombol_2_teks'] ?? '')" />
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="hero_tombol_1_target" :value="__('Target Tombol 1 (link WA / URL)')" />
                                <x-text-input id="hero_tombol_1_target" class="block mt-1 w-full" type="text" name="settings[hero_tombol_1_target]" :value="old('settings.hero_tombol_1_target', $settings['hero_tombol_1_target'] ?? '')" placeholder="https://wa.me/... atau biarkan kosong" />
                                <p class="text-xs text-gray-500 mt-1">Kosongkan jika ingin pakai nomor WA dari data kontak</p>
                            </div>
                            <div>
                                <x-input-label for="hero_tombol_2_target" :value="__('Target Tombol 2 (anchor/URL)')" />
                                <x-text-input id="hero_tombol_2_target" class="block mt-1 w-full" type="text" name="settings[hero_tombol_2_target]" :value="old('settings.hero_tombol_2_target', $settings['hero_tombol_2_target'] ?? '')" placeholder="#tentang" />
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="settings[hero_tampilkan_tombol_1]" value="1" {{ old('settings.hero_tampilkan_tombol_1', $settings['hero_tampilkan_tombol_1'] ?? '1') ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                <span class="text-sm font-medium text-gray-700">Tampilkan Tombol 1</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="settings[hero_tampilkan_tombol_2]" value="1" {{ old('settings.hero_tampilkan_tombol_2', $settings['hero_tampilkan_tombol_2'] ?? '1') ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                <span class="text-sm font-medium text-gray-700">Tampilkan Tombol 2</span>
                            </label>
                        </div>

                        <h3 class="text-lg font-bold text-indigo-700 mt-8 mb-4 border-b pb-2">Section Tentang</h3>
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="tentang_label" :value="__('Label')" />
                                <x-text-input id="tentang_label" class="block mt-1 w-full" type="text" name="settings[tentang_label]" :value="old('settings.tentang_label', $settings['tentang_label'] ?? '')" />
                            </div>
                            <div>
                                <x-input-label for="tentang_sub_judul" :value="__('Sub Judul')" />
                                <x-text-input id="tentang_sub_judul" class="block mt-1 w-full" type="text" name="settings[tentang_sub_judul]" :value="old('settings.tentang_sub_judul', $settings['tentang_sub_judul'] ?? '')" />
                            </div>
                        </div>

                        <h3 class="text-lg font-bold text-indigo-700 mt-8 mb-4 border-b pb-2">Section Alur</h3>
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="alur_label" :value="__('Label')" />
                                <x-text-input id="alur_label" class="block mt-1 w-full" type="text" name="settings[alur_label]" :value="old('settings.alur_label', $settings['alur_label'] ?? '')" />
                            </div>
                            <div>
                                <x-input-label for="alur_judul" :value="__('Judul')" />
                                <x-text-input id="alur_judul" class="block mt-1 w-full" type="text" name="settings[alur_judul]" :value="old('settings.alur_judul', $settings['alur_judul'] ?? '')" />
                            </div>
                        </div>
                        <div class="mb-4">
                            <x-input-label for="alur_sub_judul" :value="__('Sub Judul')" />
                            <textarea id="alur_sub_judul" name="settings[alur_sub_judul]" rows="2" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('settings.alur_sub_judul', $settings['alur_sub_judul'] ?? '') }}</textarea>
                        </div>

                        <h3 class="text-lg font-bold text-indigo-700 mt-8 mb-4 border-b pb-2">Section Area Kecanduan</h3>
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="area_label" :value="__('Label')" />
                                <x-text-input id="area_label" class="block mt-1 w-full" type="text" name="settings[area_label]" :value="old('settings.area_label', $settings['area_label'] ?? '')" />
                            </div>
                            <div>
                                <x-input-label for="area_judul" :value="__('Judul')" />
                                <x-text-input id="area_judul" class="block mt-1 w-full" type="text" name="settings[area_judul]" :value="old('settings.area_judul', $settings['area_judul'] ?? '')" />
                            </div>
                        </div>
                        <div class="mb-4">
                            <x-input-label for="area_sub_judul" :value="__('Sub Judul')" />
                            <textarea id="area_sub_judul" name="settings[area_sub_judul]" rows="2" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('settings.area_sub_judul', $settings['area_sub_judul'] ?? '') }}</textarea>
                        </div>

                        <h3 class="text-lg font-bold text-indigo-700 mt-8 mb-4 border-b pb-2">Section Testimoni</h3>
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="testimoni_label" :value="__('Label')" />
                                <x-text-input id="testimoni_label" class="block mt-1 w-full" type="text" name="settings[testimoni_label]" :value="old('settings.testimoni_label', $settings['testimoni_label'] ?? '')" />
                            </div>
                            <div>
                                <x-input-label for="testimoni_judul" :value="__('Judul')" />
                                <x-text-input id="testimoni_judul" class="block mt-1 w-full" type="text" name="settings[testimoni_judul]" :value="old('settings.testimoni_judul', $settings['testimoni_judul'] ?? '')" />
                            </div>
                        </div>
                        <div class="mb-4">
                            <x-input-label for="testimoni_sub_judul" :value="__('Sub Judul')" />
                            <textarea id="testimoni_sub_judul" name="settings[testimoni_sub_judul]" rows="2" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('settings.testimoni_sub_judul', $settings['testimoni_sub_judul'] ?? '') }}</textarea>
                        </div>

                        <h3 class="text-lg font-bold text-indigo-700 mt-8 mb-4 border-b pb-2">Section Kontak</h3>
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="kontak_judul" :value="__('Judul')" />
                                <x-text-input id="kontak_judul" class="block mt-1 w-full" type="text" name="settings[kontak_judul]" :value="old('settings.kontak_judul', $settings['kontak_judul'] ?? '')" />
                            </div>
                            <div>
                                <x-input-label for="kontak_sub_judul" :value="__('Sub Judul')" />
                                <x-text-input id="kontak_sub_judul" class="block mt-1 w-full" type="text" name="settings[kontak_sub_judul]" :value="old('settings.kontak_sub_judul', $settings['kontak_sub_judul'] ?? '')" />
                            </div>
                        </div>
                        <div class="mb-4">
                            <x-input-label for="kontak_btn_kirim" :value="__('Tombol Kirim')" />
                            <x-text-input id="kontak_btn_kirim" class="block mt-1 w-full" type="text" name="settings[kontak_btn_kirim]" :value="old('settings.kontak_btn_kirim', $settings['kontak_btn_kirim'] ?? '')" />
                        </div>

                        <div class="flex items-center justify-end mt-8 pt-4 border-t">
                            <x-primary-button>{{ __('Simpan Perubahan') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
