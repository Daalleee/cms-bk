<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Informasi Kontak') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('kontak.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <x-input-label for="alamat" :value="__('Alamat')" />
                            <textarea id="alamat" name="alamat" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3" required>{{ old('alamat', $kontak->alamat ?? '') }}</textarea>
                            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
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
                        </div>

                        <div class="mb-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $kontak->email ?? '')" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="jam_operasional" :value="__('Jam Operasional')" />
                            <x-text-input id="jam_operasional" class="block mt-1 w-full" type="text" name="jam_operasional" :value="old('jam_operasional', $kontak->jam_operasional ?? '')" />
                            <x-input-error :messages="$errors->get('jam_operasional')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="google_maps" :value="__('Embed Google Maps (Iframe/URL)')" />
                            <textarea id="google_maps" name="google_maps" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3">{{ old('google_maps', $kontak->google_maps ?? '') }}</textarea>
                            <x-input-error :messages="$errors->get('google_maps')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Simpan Perubahan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
