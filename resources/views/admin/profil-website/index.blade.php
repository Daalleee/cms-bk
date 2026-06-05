<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Profil Website') }}
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
                    <form action="{{ route('profil-website.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <x-input-label for="judul" :value="__('Judul Website')" />
                            <x-text-input id="judul" class="block mt-1 w-full" type="text" name="judul" :value="old('judul', $profil->judul ?? '')" required />
                            <x-input-error :messages="$errors->get('judul')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="profil" :value="__('Profil Singkat')" />
                            <textarea id="profil" name="profil" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4" required>{{ old('profil', $profil->profil ?? '') }}</textarea>
                            <x-input-error :messages="$errors->get('profil')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="visi" :value="__('Visi')" />
                            <textarea id="visi" name="visi" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="2" required>{{ old('visi', $profil->visi ?? '') }}</textarea>
                            <x-input-error :messages="$errors->get('visi')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="misi" :value="__('Misi')" />
                            <textarea id="misi" name="misi" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4" required>{{ old('misi', $profil->misi ?? '') }}</textarea>
                            <x-input-error :messages="$errors->get('misi')" class="mt-2" />
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
