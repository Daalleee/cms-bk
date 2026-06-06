<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use App\Models\TentangKami;
use App\Models\TentangSection;
use Illuminate\Http\Request;

class TentangSectionController extends Controller
{
    public function index()
    {
        $sections = TentangSection::orderBy('urutan')->get();
        $tentang = TentangKami::first();
        return view('admin.tentang-section.index', compact('sections', 'tentang'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'video_url' => 'nullable|url|max:500',
        ]);

        $urutan = TentangSection::max('urutan') + 1;
        $validated['urutan'] = $urutan;

        $section = TentangSection::create($validated);

        LogAktivitas::create([
            'pengguna_id' => auth()->id(),
            'aktivitas' => 'Menambah section tentang: ' . $section->judul,
            'alamat_ip' => $request->ip(),
        ]);

        return response()->json(['success' => true, 'section' => $section]);
    }

    public function update(Request $request, TentangSection $tentangSection)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'video_url' => 'nullable|url|max:500',
        ]);

        $tentangSection->update($validated);

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
            'sections' => 'nullable|array',
            'sections.*.id' => 'required|exists:tentang_sections,id',
            'sections.*.judul' => 'required|string|max:255',
            'sections.*.deskripsi' => 'nullable|string',
            'sections.*.video_url' => 'nullable|url|max:500',
        ]);

        $tentang = TentangKami::first();
        if ($tentang) {
            $tentang->update(['judul' => $data['judul'], 'pengantar' => $data['pengantar'] ?? null]);
        } else {
            TentangKami::create(['judul' => $data['judul'], 'pengantar' => $data['pengantar'] ?? null]);
        }

        foreach ($data['sections'] ?? [] as $sec) {
            TentangSection::where('id', $sec['id'])->update([
                'judul' => $sec['judul'],
                'deskripsi' => $sec['deskripsi'] ?? null,
                'video_url' => $sec['video_url'] ?? null,
            ]);
        }

        LogAktivitas::create([
            'pengguna_id' => auth()->id(),
            'aktivitas' => 'Menyimpan semua perubahan tentang',
            'alamat_ip' => $request->ip(),
        ]);

        return response()->json(['success' => true]);
    }
}
