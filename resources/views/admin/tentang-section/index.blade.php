<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tentang HypnoKonseling') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="tentangManager()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 font-medium text-sm text-green-600">{{ session('success') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Pengantar &amp; Section Tentang</h3>
                    <p class="text-sm text-gray-500 mb-6">Teks pengantar tampil di atas, section tampil di bawahnya. Semua data halaman <a href="{{ url('/tentang') }}" target="_blank" class="text-indigo-600 underline">/tentang</a> dan halaman depan.</p>

                    <div class="mb-8 p-4 bg-gray-50 rounded-lg space-y-4">
                        <div>
                            <x-input-label for="tentang_label" :value="__('Label Section (muncul di badge)')" />
                            <x-text-input id="tentang_label" class="block mt-1 w-full" type="text" x-model="pengantar.label" />
                        </div>
                        <div>
                            <x-input-label for="judul" :value="__('Judul Halaman')" />
                            <x-text-input id="judul" class="block mt-1 w-full" type="text" x-model="pengantar.judul" required />
                        </div>
                        <div>
                            <x-input-label for="teks_pengantar" :value="__('Teks Pengantar')" />
                            <textarea id="teks_pengantar" x-model="pengantar.teks" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4" placeholder="Tulis pengantar singkat tentang HypnoKonseling..."></textarea>
                        </div>
                    </div>

                    <template x-if="sections.length === 0">
                        <p class="text-gray-400 text-center py-8">Belum ada section. Klik "Tambah Section Baru" untuk menambahkan.</p>
                    </template>
                    <template x-for="(sec, idx) in sections" :key="sec.id">
                        <div class="border border-gray-200 rounded-lg p-4 mb-4">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-xs font-semibold text-gray-400 uppercase">Section #<span x-text="idx + 1"></span></span>
                                <button @click="deleteSection(sec.id, idx)" class="text-red-600 hover:text-red-800 text-sm font-medium">Hapus</button>
                            </div>
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                                    <input type="text" x-model="sec.judul" class="w-full border-gray-300 rounded-md shadow-sm text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                                    <textarea x-model="sec.deskripsi" class="w-full border-gray-300 rounded-md shadow-sm text-sm" rows="2"></textarea>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Link Video YouTube</label>
                                    <input type="url" x-model="sec.video_url" class="w-full border-gray-300 rounded-md shadow-sm text-sm" placeholder="https://www.youtube.com/watch?v=...">
                                </div>
                            </div>
                        </div>
                    </template>

                    <div class="flex flex-wrap items-center justify-between gap-4 pt-4 border-t border-gray-200">
                        <button @click="addSection" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700 transition">+ Tambah Section Baru</button>
                        <div class="flex items-center gap-3">
                            <span x-text="saving ? 'Menyimpan...' : ''" class="text-sm text-gray-500"></span>
                            <button @click="saveAll" :disabled="saving" class="px-6 py-2.5 bg-indigo-600 text-white rounded-lg text-sm font-bold hover:bg-indigo-700 transition disabled:opacity-50">Simpan Perubahan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
function tentangManager() {
    return {
        pengantar: {
            judul: '{{ $tentang->judul ?? "Tentang HypnoKonseling" }}',
            teks: '{{ $tentang->pengantar ?? "" }}',
            label: '{{ $settings["tentang_label"] ?? "Edukasi Dasar" }}',
        },
        sections: @json($sections),
        nextId: -1,
        saving: false,

        addSection() {
            this.sections.push({
                id: this.nextId--,
                judul: '',
                deskripsi: '',
                video_url: '',
            });
        },

        deleteSection(id, idx) {
            if (!confirm('Hapus section ini?')) return;
            if (id > 0) {
                fetch('{{ url("admin/tentang-section") }}/' + id, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                });
            }
            this.sections.splice(idx, 1);
        },

        saveAll() {
            if (!this.pengantar.judul) return window.dispatchEvent(new CustomEvent('toast', { detail: { message: 'Judul harus diisi', type: 'warning' } }));
            this.saving = true;

            const existing = this.sections.filter(s => s.id > 0);
            const payload = {
                judul: this.pengantar.judul,
                pengantar: this.pengantar.teks,
                tentang_label: this.pengantar.label,
                sections: existing.map(s => ({
                    id: s.id,
                    judul: s.judul,
                    deskripsi: s.deskripsi,
                    video_url: s.video_url || null,
                })),
            };

            const newSections = this.sections.filter(s => s.id < 0 && s.judul);

            const savePengantar = fetch('{{ route("admin.tentang-section.save-all") }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify(payload),
            }).then(res => {
                if (!res.ok) throw new Error('Gagal menyimpan');
                return res.json();
            });

            const addPromises = newSections.map(sec =>
                fetch('{{ route("admin.tentang-section.store") }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({
                        judul: sec.judul,
                        deskripsi: sec.deskripsi,
                        video_url: sec.video_url || null,
                    }),
                }).then(res => {
                    if (!res.ok) throw new Error('Gagal menambah section');
                    return res.json();
                })
                .then(data => {
                    if (data.success) sec.id = data.section.id;
                })
            );

            Promise.all([savePengantar, ...addPromises])
                .then(() => { window.dispatchEvent(new CustomEvent('toast', { detail: { message: 'Semua perubahan berhasil disimpan', type: 'success' } })); })
                .catch(() => { window.dispatchEvent(new CustomEvent('toast', { detail: { message: 'Gagal menyimpan perubahan', type: 'error' } })); })
                .finally(() => { this.saving = false; });
        }
    };
}
</script>
