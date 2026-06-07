<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use App\Models\Pengaturan;
use App\Models\TentangKami;
use App\Models\TentangSection;
use Illuminate\Http\Request;

class TentangSectionController extends Controller
{
    public function index()
    {
        $sections = TentangSection::orderBy('urutan')->get();
        $tentang = TentangKami::first();
        $settings = Pengaturan::getAll();
        return view('admin.tentang-section.index', compact('sections', 'tentang', 'settings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'video_url' => 'nullable|string|max:500',
        ]);

        if (empty($validated['video_url'])) {
            $validated['video_url'] = null;
        }

        $urutan = TentangSection::max('urutan') + 1;
        $validated['urutan'] = $urutan;

        $section = TentangSection::create($validated);

        $this->syncVideoMedia($section, $validated['video_url'], $section->judul);

        LogAktivitas::create([
            'pengguna_id' => auth()->id(),
            'aktivitas' => 'Menambah section tentang: ' . $section->judul,
            'alamat_ip' => $request->ip(),
        ]);

        $section->load('media');

        return response()->json(['success' => true, 'section' => $section]);
    }

    public function update(Request $request, TentangSection $tentangSection)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'video_url' => 'nullable|string|max:500',
        ]);

        if (empty($validated['video_url'])) {
            $validated['video_url'] = null;
        }

        $tentangSection->update($validated);

        $this->syncVideoMedia($tentangSection, $validated['video_url'], $validated['judul']);

        LogAktivitas::create([
            'pengguna_id' => auth()->id(),
            'aktivitas' => 'Memperbarui section tentang: ' . $tentangSection->judul,
            'alamat_ip' => $request->ip(),
        ]);

        return response()->json(['success' => true]);
    }

    public function destroy(TentangSection $tentangSection)
    {
        $nama = $tentangSection->judul;
        $tentangSection->delete();

        LogAktivitas::create([
            'pengguna_id' => auth()->id(),
            'aktivitas' => 'Menghapus section tentang: ' . $nama,
            'alamat_ip' => request()->ip(),
        ]);

        return response()->json(['success' => true]);
    }

    public function saveAll(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'pengantar' => 'nullable|string',
            'tentang_label' => 'nullable|string|max:255',
            'sections' => 'nullable|array',
            'sections.*.id' => 'required|exists:tentang_sections,id',
            'sections.*.judul' => 'required|string|max:255',
            'sections.*.deskripsi' => 'nullable|string',
            'sections.*.video_url' => 'nullable|string|max:500',
        ]);

        if (isset($data['tentang_label'])) {
            Pengaturan::setValue('tentang_label', $data['tentang_label']);
        }

        $tentang = TentangKami::first();
        if ($tentang) {
            $tentang->update([
                'judul' => $data['judul'],
                'pengantar' => $data['pengantar'] ?? null,
            ]);
        } else {
            TentangKami::create([
                'judul' => $data['judul'],
                'isi' => $data['pengantar'] ?? '',
                'pengantar' => $data['pengantar'] ?? null,
            ]);
        }

        foreach ($data['sections'] ?? [] as $sec) {
            $videoUrl = !empty($sec['video_url']) ? $sec['video_url'] : null;

            TentangSection::where('id', $sec['id'])->update([
                'judul' => $sec['judul'],
                'deskripsi' => $sec['deskripsi'] ?? null,
                'video_url' => $videoUrl,
            ]);

            $section = TentangSection::find($sec['id']);
            if ($section) {
                $this->syncVideoMedia($section, $videoUrl, $sec['judul']);
            }
        }

        LogAktivitas::create([
            'pengguna_id' => auth()->id(),
            'aktivitas' => 'Menyimpan semua perubahan tentang',
            'alamat_ip' => $request->ip(),
        ]);

        return response()->json(['success' => true]);
    }

    private function syncVideoMedia(TentangSection $section, ?string $videoUrl, string $judul): void
    {
        $existingMedia = $section->media()->where('koleksi', 'video')->first();

        if (!$videoUrl) {
            if ($existingMedia) {
                $existingMedia->delete();
            }
            return;
        }

        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $videoUrl, $matches);
        $youtubeId = $matches[1] ?? null;

        if (!$youtubeId) {
            return;
        }

        if ($existingMedia) {
            $existingMedia->update([
                'nama' => $judul,
                'youtube_id' => $youtubeId,
            ]);
        } else {
            $section->media()->create([
                'koleksi' => 'video',
                'nama' => $judul,
                'sumber' => 'youtube',
                'youtube_id' => $youtubeId,
                'urutan' => 1,
            ]);
        }
    }
}
