<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Testimoni') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.testimoni.update', $testimoni) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <x-input-label for="nama" :value="__('Nama')" />
                            <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama', $testimoni->nama)" required autofocus />
                            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="pekerjaan" :value="__('Pekerjaan')" />
                            <x-text-input id="pekerjaan" class="block mt-1 w-full" type="text" name="pekerjaan" :value="old('pekerjaan', $testimoni->pekerjaan)" />
                            <x-input-error :messages="$errors->get('pekerjaan')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="isi_testimoni" :value="__('Isi Testimoni')" />
                            <textarea id="isi_testimoni" name="isi_testimoni" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4" required>{{ old('isi_testimoni', $testimoni->isi_testimoni) }}</textarea>
                            <x-input-error :messages="$errors->get('isi_testimoni')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="rating" :value="__('Rating (1-5)')" />
                            <select id="rating" name="rating" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ old('rating', $testimoni->rating) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            <x-input-error :messages="$errors->get('rating')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="status_publikasi" :value="__('Status')" />
                            <select id="status_publikasi" name="status_publikasi" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="1" {{ old('status_publikasi', $testimoni->status_publikasi) == '1' ? 'selected' : '' }}>Ditampilkan</option>
                                <option value="0" {{ old('status_publikasi', $testimoni->status_publikasi) == '0' ? 'selected' : '' }}>Menunggu</option>
                            </select>
                            <x-input-error :messages="$errors->get('status_publikasi')" class="mt-2" />
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
