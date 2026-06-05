<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pesan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('pesan-masuk.index') }}" class="text-indigo-600 hover:text-indigo-900 font-medium">
                    &larr; Kembali ke Daftar Pesan
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Dari</h3>
                            <p class="mt-1 text-lg font-semibold text-gray-900">{{ $pesan->nama }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Tanggal</h3>
                            <p class="mt-1 text-lg text-gray-900">{{ $pesan->created_at->format('d F Y H:i') }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Email</h3>
                            <p class="mt-1 text-gray-900">{{ $pesan->email }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Nomor Telepon</h3>
                            <p class="mt-1 text-gray-900">{{ $pesan->nomor_telepon }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <h3 class="text-sm font-medium text-gray-500">Subjek</h3>
                            <p class="mt-1 text-gray-900 font-medium">{{ $pesan->subjek }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <h3 class="text-sm font-medium text-gray-500">Pesan</h3>
                            <div class="mt-1 p-4 bg-gray-50 rounded-lg text-gray-900 whitespace-pre-wrap">
                                {{ $pesan->pesan }}
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <form action="{{ route('pesan-masuk.destroy', $pesan) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150" onclick="return confirm('Apakah Anda yakin?')">
                                Hapus Pesan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
