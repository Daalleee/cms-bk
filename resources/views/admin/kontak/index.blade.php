<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Informasi Kontak') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 font-medium text-sm text-green-600">{{ session('success') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.kontak.store') }}" method="POST">
                        @csrf

                        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                            <h3 class="text-sm font-bold text-gray-700 mb-3">Label Section (tampil di halaman depan)</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <x-input-label for="kontak_judul" :value="__('Label')" />
                                    <x-text-input id="kontak_judul" class="block mt-1 w-full" type="text" name="kontak_judul" :value="old('kontak_judul', $settings['kontak_judul'] ?? '')" />
                                </div>
                                <div>
                                    <x-input-label for="kontak_sub_judul" :value="__('Sub Judul')" />
                                    <x-text-input id="kontak_sub_judul" class="block mt-1 w-full" type="text" name="kontak_sub_judul" :value="old('kontak_sub_judul', $settings['kontak_sub_judul'] ?? '')" />
                                </div>
                                <div>
                                    <x-input-label for="kontak_btn_kirim" :value="__('Tombol Kirim')" />
                                    <x-text-input id="kontak_btn_kirim" class="block mt-1 w-full" type="text" name="kontak_btn_kirim" :value="old('kontak_btn_kirim', $settings['kontak_btn_kirim'] ?? '')" />
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="alamat" :value="__('Alamat')" />
                            <textarea id="alamat" name="alamat" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3" required>{{ old('alamat', $kontak->alamat ?? '') }}</textarea>
                            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $kontak->email ?? '')" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="mb-4">
                                <x-input-label for="telepon" :value="__('Nomor Telepon')" />
                                <x-text-input id="telepon" class="block mt-1 w-full" type="text" name="telepon" :value="old('telepon', $kontak->telepon ?? '')" required />
                                <x-input-error :messages="$errors->get('telepon')" class="mt-2" />
                            </div>
                            <div class="mb-4">
                                <x-input-label for="whatsapp" :value="__('Nomor WhatsApp')" />
                                <x-text-input id="whatsapp" class="block mt-1 w-full" type="text" name="whatsapp" :value="old('whatsapp', $kontak->whatsapp ?? '')" required />
                                <x-input-error :messages="$errors->get('whatsapp')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="instagram" :value="__('Instagram (username)')" />
                                <x-text-input id="instagram" class="block mt-1 w-full" type="text" name="instagram" :value="old('instagram', $kontak->instagram ?? '')" placeholder="@username" />
                                <x-input-error :messages="$errors->get('instagram')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="mb-4">
                                <x-input-label for="youtube" :value="__('YouTube (channel URL atau username)')" />
                                <x-text-input id="youtube" class="block mt-1 w-full" type="text" name="youtube" :value="old('youtube', $kontak->youtube ?? '')" placeholder="@channel" />
                                <x-input-error :messages="$errors->get('youtube')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="facebook" :value="__('Facebook (username)')" />
                                <x-text-input id="facebook" class="block mt-1 w-full" type="text" name="facebook" :value="old('facebook', $kontak->facebook ?? '')" placeholder="@username" />
                                <x-input-error :messages="$errors->get('facebook')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="mb-4">
                                <x-input-label for="twitter" :value="__('Twitter / X (username)')" />
                                <x-text-input id="twitter" class="block mt-1 w-full" type="text" name="twitter" :value="old('twitter', $kontak->twitter ?? '')" placeholder="@username" />
                                <x-input-error :messages="$errors->get('twitter')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="tiktok" :value="__('TikTok (username)')" />
                                <x-text-input id="tiktok" class="block mt-1 w-full" type="text" name="tiktok" :value="old('tiktok', $kontak->tiktok ?? '')" placeholder="@username" />
                                <x-input-error :messages="$errors->get('tiktok')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mt-6 pt-6 border-t">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Tampilkan Ikon Media Sosial</h3>
                            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="tampilkan_youtube" value="1" {{ old('tampilkan_youtube', $kontak->tampilkan_youtube ?? true) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <span class="text-sm font-medium text-gray-700">YouTube</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="tampilkan_instagram" value="1" {{ old('tampilkan_instagram', $kontak->tampilkan_instagram ?? true) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <span class="text-sm font-medium text-gray-700">Instagram</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="tampilkan_facebook" value="1" {{ old('tampilkan_facebook', $kontak->tampilkan_facebook ?? true) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <span class="text-sm font-medium text-gray-700">Facebook</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="tampilkan_twitter" value="1" {{ old('tampilkan_twitter', $kontak->tampilkan_twitter ?? true) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <span class="text-sm font-medium text-gray-700">Twitter / X</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="tampilkan_tiktok" value="1" {{ old('tampilkan_tiktok', $kontak->tampilkan_tiktok ?? true) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <span class="text-sm font-medium text-gray-700">TikTok</span>
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
