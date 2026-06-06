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
                        <div class="mb-4">
                            <x-input-label for="alamat" :value="__('Alamat')" />
                            <textarea id="alamat" name="alamat" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3" required>{{ old('alamat', $kontak->alamat ?? '') }}</textarea>
                            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>{{ __('Simpan Perubahan') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
