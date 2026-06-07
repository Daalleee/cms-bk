<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Alur Penanganan (Tahapan)') }}
            </h2>
            <a href="{{ route('admin.tahapan-penanganan.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Tambah Tahapan
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 font-medium text-sm text-green-600">{{ session('success') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-4 flex items-end gap-4 flex-wrap">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Label Section</label>
                        <input type="text" value="{{ $settings['alur_label'] ?? 'Metode Terstruktur' }}" data-key="alur_label" class="section-label-input w-40 border-gray-300 rounded-md text-sm shadow-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Judul</label>
                        <input type="text" value="{{ $settings['alur_judul'] ?? 'Langkah Menuju Pemulihan' }}" data-key="alur_judul" class="section-label-input w-48 border-gray-300 rounded-md text-sm shadow-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Sub Judul</label>
                        <input type="text" value="{{ $settings['alur_sub_judul'] ?? '' }}" data-key="alur_sub_judul" class="section-label-input w-64 border-gray-300 rounded-md text-sm shadow-sm">
                    </div>
                    <div class="ml-auto">
                        <button onclick="saveSectionLabels(this)" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-xs font-bold hover:bg-indigo-700 whitespace-nowrap self-end">Simpan Label</button>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Urutan</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Tahapan</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($tahapans as $tahapan)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $tahapan->urutan }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $tahapan->nama_tahap }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('admin.tahapan-penanganan.edit', $tahapan) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                        <form action="{{ route('admin.tahapan-penanganan.destroy', $tahapan) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
function saveSectionLabels(btn) {
    const inputs = document.querySelectorAll('.section-label-input');
    const promises = [];
    inputs.forEach(inp => {
        const key = inp.dataset.key;
        const value = inp.value;
        promises.push(
            fetch('{{ route("admin.pengaturan.section-labels") }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ key, value }),
            })
        );
    });
    Promise.all(promises).then(() => {
        window.dispatchEvent(new CustomEvent('toast', { detail: { message: 'Label berhasil disimpan', type: 'success' } }));
    }).catch(() => {
        window.dispatchEvent(new CustomEvent('toast', { detail: { message: 'Gagal menyimpan label', type: 'error' } }));
    });
}
</script>
