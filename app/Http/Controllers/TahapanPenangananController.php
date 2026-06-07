<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use App\Models\Pengaturan;
use App\Models\TahapanPenanganan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TahapanPenangananController extends Controller
{
    public function index()
    {
        $tahapans = TahapanPenanganan::orderBy('urutan')->get();
        $settings = Pengaturan::getAll();
        return view('admin.tahapan-penanganan.index', compact('tahapans', 'settings'));
    }

    public function create()
    {
        return view('admin.tahapan-penanganan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'urutan' => 'required|integer',
            'nama_tahap' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'ikon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'video_urls' => 'nullable|array',
            'video_urls.*' => 'nullable|string|max:500',
        ]);

        $validated = $request->only(['urutan', 'nama_tahap', 'deskripsi']);

        if ($request->hasFile('ikon')) {
            $validated['ikon'] = $request->file('ikon')->store('tahapans', 'public');
        }

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('tahapans', 'public');
        }

        $tahapan = TahapanPenanganan::create($validated);

        $this->syncVideoMedia($tahapan, $request->video_urls ?? []);

        LogAktivitas::create([
            'pengguna_id' => auth()->id(),
            'aktivitas' => 'Menambah tahapan: ' . $validated['nama_tahap'],
            'alamat_ip' => $request->ip(),
        ]);

        return redirect()->route('admin.tahapan-penanganan.index')->with('success', 'Tahapan penanganan berhasil ditambahkan.');
    }

    public function edit(TahapanPenanganan $tahapanPenanganan)
    {
        $tahapanPenanganan->load('media');
        $videoUrls = $tahapanPenanganan->media
            ->where('koleksi', 'video')
            ->pluck('url_media')
            ->filter()
            ->values()
            ->toArray();
        return view('admin.tahapan-penanganan.edit', [
            'tahapan' => $tahapanPenanganan,
            'videoUrls' => $videoUrls,
        ]);
    }

    public function update(Request $request, TahapanPenanganan $tahapanPenanganan)
    {
        $request->validate([
            'urutan' => 'required|integer',
            'nama_tahap' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'ikon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'video_urls' => 'nullable|array',
            'video_urls.*' => 'nullable|string|max:500',
        ]);

        $validated = $request->only(['urutan', 'nama_tahap', 'deskripsi']);

        if ($request->hasFile('ikon')) {
            if ($tahapanPenanganan->ikon) {
                Storage::disk('public')->delete($tahapanPenanganan->ikon);
            }
            $validated['ikon'] = $request->file('ikon')->store('tahapans', 'public');
        } elseif ($request->has('hapus_ikon')) {
            if ($tahapanPenanganan->ikon) {
                Storage::disk('public')->delete($tahapanPenanganan->ikon);
            }
            $validated['ikon'] = null;
        }

        if ($request->hasFile('gambar')) {
            if ($tahapanPenanganan->gambar) {
                Storage::disk('public')->delete($tahapanPenanganan->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('tahapans', 'public');
        }

        $tahapanPenanganan->update($validated);

        $this->syncVideoMedia($tahapanPenanganan, $request->video_urls ?? []);

        LogAktivitas::create([
            'pengguna_id' => auth()->id(),
            'aktivitas' => 'Memperbarui tahapan: ' . $validated['nama_tahap'],
            'alamat_ip' => $request->ip(),
        ]);

        return redirect()->route('admin.tahapan-penanganan.index')->with('success', 'Tahapan penanganan berhasil diperbarui.');
    }

    public function destroy(TahapanPenanganan $tahapanPenanganan)
    {
        $nama = $tahapanPenanganan->nama_tahap;
        if ($tahapanPenanganan->ikon) {
            Storage::disk('public')->delete($tahapanPenanganan->ikon);
        }
        $tahapanPenanganan->media()->delete();
        $tahapanPenanganan->delete();

        LogAktivitas::create([
            'pengguna_id' => auth()->id(),
            'aktivitas' => 'Menghapus tahapan: ' . $nama,
            'alamat_ip' => request()->ip(),
        ]);

        return redirect()->route('admin.tahapan-penanganan.index')->with('success', 'Tahapan penanganan berhasil dihapus.');
    }

    private function syncVideoMedia(TahapanPenanganan $tahapan, array $videoUrls): void
    {
        $tahapan->media()->where('koleksi', 'video')->delete();

        $urutan = 1;
        foreach ($videoUrls as $url) {
            if (empty($url)) continue;

            preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url, $matches);
            $youtubeId = $matches[1] ?? null;

            if (!$youtubeId) continue;

            $tahapan->media()->create([
                'koleksi' => 'video',
                'nama' => $tahapan->nama_tahap . ' - Video ' . $urutan,
                'sumber' => 'youtube',
                'youtube_id' => $youtubeId,
                'urutan' => $urutan,
            ]);

            $urutan++;
        }
    }
}
