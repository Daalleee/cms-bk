<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Area Kecanduan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.area-kecanduan.update', $areaKecanduan) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="mb-4">
                                <x-input-label for="nama_kecanduan" :value="__('Nama Kecanduan')" />
                                <x-text-input id="nama_kecanduan" class="block mt-1 w-full" type="text" name="nama_kecanduan" :value="old('nama_kecanduan', $areaKecanduan->nama_kecanduan)" required />
                                <x-input-error :messages="$errors->get('nama_kecanduan')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="urutan" :value="__('Urutan')" />
                                <x-text-input id="urutan" class="block mt-1 w-full" type="number" name="urutan" :value="old('urutan', $areaKecanduan->urutan)" required />
                                <x-input-error :messages="$errors->get('urutan')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="ikon" :value="__('Ikon (krop persegi untuk hasil terbaik)')" />
                            <input type="file" id="ikon" name="ikon" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" accept="image/*" />
                            <p class="text-xs text-gray-400 mt-1">Klik gambar untuk menyesuaikan area yang diinginkan</p>
                            @if($areaKecanduan->ikon)
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500 mb-1">Ikon saat ini:</p>
                                    <img src="{{ asset('storage/' . $areaKecanduan->ikon) }}" class="w-20 h-20 rounded-full object-cover border">
                                </div>
                            @endif
                            <x-input-error :messages="$errors->get('ikon')" class="mt-2" />
                        </div>

                        <div id="cropModal" class="fixed inset-0 z-50 bg-black bg-opacity-75 hidden items-center justify-center p-4">
                            <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] flex flex-col">
                                <div class="p-4 border-b border-gray-200">
                                    <h3 class="text-lg font-bold">Krop Ikon</h3>
                                    <p class="text-sm text-gray-500">Seret atau atur area yang ingin dijadikan ikon</p>
                                </div>
                                <div class="flex-1 p-4 overflow-hidden">
                                    <img id="cropPreview" class="max-w-full max-h-[50vh] mx-auto">
                                </div>
                                <div class="p-4 border-t border-gray-200 flex justify-end gap-3">
                                    <button type="button" id="cropCancel" class="px-6 py-2 bg-gray-200 rounded-lg font-medium text-gray-700 hover:bg-gray-300 transition">Batal</button>
                                    <button type="button" id="cropConfirm" class="px-6 py-2 bg-indigo-600 rounded-lg font-medium text-white hover:bg-indigo-700 transition">Simpan Krop</button>
                                </div>
                            </div>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                window.initImageCropper('ikon', 'cropPreview', 'cropModal', 'cropConfirm', 'cropCancel');
                            });
                        </script>

                        <div class="mb-4">
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" name="status" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="1" {{ $areaKecanduan->status ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ !$areaKecanduan->status ? 'selected' : '' }}>Non-aktif</option>
                            </select>
                        </div>

                        <hr class="my-6">

                        <h3 class="text-lg font-semibold mb-4">Detail Penanganan</h3>

                        <div class="mb-4">
                            <x-input-label for="link_youtube" :value="__('Link YouTube')" />
                            <x-text-input id="link_youtube" class="block mt-1 w-full" type="text" name="link_youtube" :value="old('link_youtube', $areaKecanduan->detailPenanganan->link_youtube ?? '')" placeholder="https://www.youtube.com/watch?v=..." />
                            <x-input-error :messages="$errors->get('link_youtube')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="artikel_penanganan" :value="__('Artikel Penanganan')" />
                            <textarea id="artikel_penanganan" name="artikel_penanganan" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="8">{{ old('artikel_penanganan', $areaKecanduan->detailPenanganan->artikel_penanganan ?? '') }}</textarea>
                            <x-input-error :messages="$errors->get('artikel_penanganan')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.area-kecanduan.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 mr-2">Batal</a>
                            <x-primary-button>{{ __('Simpan Perubahan') }}</x-primary-button>
                        </div>
                    </form>

                    @if($areaKecanduan->detailPenanganan)
                    <hr class="my-8">

                    <div class="mt-6" x-data="mediaManager({{ $areaKecanduan->detailPenanganan->id }})">
                        <h3 class="text-xl font-bold mb-4">Media (Foto & Video)</h3>

                        <div class="flex gap-4 mb-6">
                            <button @click="tab = 'unggah'" :class="tab === 'unggah' ? 'bg-indigo-600 text-white' : 'bg-gray-200'" class="px-4 py-2 rounded-lg text-sm font-medium transition">Upload Foto</button>
                            <button @click="tab = 'tautan'" :class="tab === 'tautan' ? 'bg-indigo-600 text-white' : 'bg-gray-200'" class="px-4 py-2 rounded-lg text-sm font-medium transition">Tambah Video YouTube</button>
                        </div>

                        <div x-show="tab === 'unggah'">
                            <div
                                class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center cursor-pointer hover:border-indigo-400 transition"
                                x-on:dragover.prevent="$el.classList.add('border-indigo-400', 'bg-indigo-50')"
                                x-on:dragleave.prevent="$el.classList.remove('border-indigo-400', 'bg-indigo-50')"
                                x-on:drop.prevent="handleDrop($event)"
                                x-on:click="document.getElementById('fileInput').click()"
                            >
                                <p class="text-gray-500">Seret foto ke sini atau klik untuk pilih</p>
                                <p class="text-xs text-gray-400 mt-1">Foto (JPG, PNG, GIF, WEBP) - Maks 10MB</p>
                                <input type="file" id="fileInput" multiple accept="image/*" class="hidden" x-on:change="handleFiles($event.target.files)">
                            </div>

                            <div class="mt-4 space-y-2">
                                <template x-for="(item, idx) in uploadQueue" :key="idx">
                                    <div class="flex items-center gap-3 bg-gray-50 p-3 rounded-lg">
                                        <span class="text-sm truncate flex-1" x-text="item.file.name"></span>
                                        <span class="text-xs text-gray-500" x-text="item.progress + '%'"></span>
                                        <div class="w-24 h-2 bg-gray-200 rounded-full overflow-hidden">
                                            <div class="h-full bg-indigo-500 rounded-full transition-all" :style="'width:' + item.progress + '%'"></div>
                                        </div>
                                        <span x-text="item.status" class="text-xs font-medium" :class="item.status === 'Selesai' ? 'text-green-600' : item.status === 'Gagal' ? 'text-red-600' : 'text-indigo-600'"></span>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <div x-show="tab === 'tautan'">
                            <div class="bg-gray-50 p-4 rounded-xl">
                                <div class="mb-3">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Link Video YouTube</label>
                                    <input type="url" x-model="linkUrl" class="w-full border-gray-300 rounded-lg text-sm" placeholder="https://www.youtube.com/watch?v=...">
                                </div>
                                <div class="mb-3">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Label (optional)</label>
                                    <input type="text" x-model="linkNama" class="w-full border-gray-300 rounded-lg text-sm" placeholder="Nama video">
                                </div>
                                <button @click="addLinkYoutube" :disabled="!linkUrl" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700 disabled:opacity-50">
                                    Tambahkan Video
                                </button>
                            </div>
                        </div>

                        <hr class="my-6">

                        <h4 class="font-semibold mb-3">Semua Media</h4>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4" id="mediaGrid">
                            <template x-for="(item, idx) in mediaList" :key="item.id">
                                <div class="relative group bg-gray-100 rounded-lg overflow-hidden border hover:shadow-md transition">
                                    <template x-if="item.koleksi === 'foto' && item.sumber === 'unggah'">
                                        <img :src="item.url" class="w-full h-32 object-cover" :alt="item.nama">
                                    </template>
                                    <template x-if="item.koleksi === 'foto' && item.sumber === 'tautan'">
                                        <img :src="item.url" class="w-full h-32 object-cover" :alt="item.nama">
                                    </template>
                                    <template x-if="item.koleksi === 'video'">
                                        <div class="relative w-full h-32 bg-black">
                                            <img :src="item.thumbnail" class="w-full h-full object-cover opacity-80">
                                            <div class="absolute inset-0 flex items-center justify-center">
                                                <svg class="w-10 h-10 text-white opacity-80" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                            </div>
                                        </div>
                                    </template>
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100">
                                        <button @click="deleteMedia(item.id, idx)" class="p-1.5 bg-red-600 text-white rounded-full hover:bg-red-700 text-xs">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </div>
                                    <div class="p-1.5 text-xs text-gray-600 truncate" x-text="item.nama"></div>
                                </div>
                            </template>
                            <template x-if="mediaList.length === 0">
                                <div class="col-span-full text-center py-8 text-gray-400">
                                    Belum ada media. Upload file atau tambah link di atas.
                                </div>
                            </template>
                        </div>

                        <div class="mt-3 text-xs text-gray-400" x-show="mediaList.length > 0">
                            * Seret untuk mengurutkan (drag & drop)
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
function mediaManager(detailId) {
    return {
        detailId: detailId,
        tab: 'unggah',
        mediaList: @json($areaKecanduan->detailPenanganan?->media ?? []),
        uploadQueue: [],
        linkUrl: '',
        linkNama: '',

        handleDrop(event) {
            event.currentTarget.classList.remove('border-indigo-400', 'bg-indigo-50');
            this.handleFiles(event.dataTransfer.files);
        },

        handleFiles(files) {
            for (const file of files) {
                const CHUNK_SIZE = 5 * 1024 * 1024;
                const totalChunks = Math.ceil(file.size / CHUNK_SIZE);
                const uploadId = 'chunk_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);

                const queueItem = {
                    file: file,
                    progress: 0,
                    status: 'Mengupload...',
                    uploadId: uploadId,
                    totalChunks: totalChunks,
                };
                this.uploadQueue.push(queueItem);

                if (totalChunks <= 1 && file.size < CHUNK_SIZE) {
                    this.uploadDirect(file, queueItem);
                } else {
                    this.uploadChunked(file, queueItem);
                }
            }
        },

        uploadDirect(file, queueItem) {
            const formData = new FormData();
            formData.append('file', file);
            formData.append('detail_id', this.detailId);
            formData.append('koleksi', 'foto');

            const xhr = new XMLHttpRequest();
            xhr.upload.onprogress = (e) => {
                if (e.lengthComputable) {
                    queueItem.progress = Math.round((e.loaded / e.total) * 100);
                }
            };
            xhr.onload = () => {
                if (xhr.status === 200) {
                    const resp = JSON.parse(xhr.responseText);
                    queueItem.progress = 100;
                    queueItem.status = 'Selesai';
                    this.mediaList.push(resp.media);
                } else {
                    queueItem.status = 'Gagal';
                }
            };
            xhr.onerror = () => { queueItem.status = 'Gagal'; };
            xhr.open('POST', '{{ route("admin.media.upload") }}');
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            xhr.send(formData);
        },

        uploadChunked(file, queueItem) {
            const CHUNK_SIZE = 5 * 1024 * 1024;
            const totalChunks = queueItem.totalChunks;
            const uploadId = queueItem.uploadId;
            let currentChunk = 0;

            const sendNext = () => {
                const start = currentChunk * CHUNK_SIZE;
                const end = Math.min(start + CHUNK_SIZE, file.size);
                const chunk = file.slice(start, end);

                const formData = new FormData();
                formData.append('file', chunk);
                formData.append('detail_id', this.detailId);
                formData.append('koleksi', 'foto');
                formData.append('chunk_index', currentChunk);
                formData.append('total_chunks', totalChunks);
                formData.append('upload_id', uploadId);
                formData.append('original_name', file.name);

                fetch('{{ route("admin.media.upload-chunk") }}', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    currentChunk++;
                    queueItem.progress = Math.round((currentChunk / totalChunks) * 100);
                    if (data.complete) {
                        queueItem.status = 'Selesai';
                        this.mediaList.push(data.media);
                    } else if (currentChunk < totalChunks) {
                        sendNext();
                    }
                })
                .catch(() => { queueItem.status = 'Gagal'; });
            };

            sendNext();
        },

        addLinkYoutube() {
            if (!this.linkUrl) return;

            fetch('{{ route("admin.media.add-link") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    detail_id: this.detailId,
                    koleksi: 'video',
                    tipe: 'youtube',
                    url: this.linkUrl,
                    nama: this.linkNama,
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    this.mediaList.push(data.media);
                    this.linkUrl = '';
                    this.linkNama = '';
                } else {
                    alert(data.message || 'Gagal menambahkan link');
                }
            });
        },

        deleteMedia(id, idx) {
            if (!confirm('Hapus media ini?')) return;
            fetch('/admin/media/' + id, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    this.mediaList.splice(idx, 1);
                }
            });
        }
    };
}
</script>
