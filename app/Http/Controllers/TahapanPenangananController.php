<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use App\Models\TahapanPenanganan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TahapanPenangananController extends Controller
{
    public function index()
    {
        $tahapans = TahapanPenanganan::orderBy('urutan')->get();
        return view('admin.tahapan-penanganan.index', compact('tahapans'));
    }

    public function create()
    {
        return view('admin.tahapan-penanganan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'urutan' => 'required|integer',
            'nama_tahap' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'ikon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'video_url' => 'nullable|url|max:500',
        ]);

        if ($request->hasFile('ikon')) {
            $validated['ikon'] = $request->file('ikon')->store('tahapans', 'public');
        }

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('tahapans', 'public');
        }

        TahapanPenanganan::create($validated);

        LogAktivitas::create([
            'pengguna_id' => auth()->id(),
            'aktivitas' => 'Menambah tahapan: ' . $validated['nama_tahap'],
            'alamat_ip' => $request->ip(),
        ]);

        return redirect()->route('admin.tahapan-penanganan.index')->with('success', 'Tahapan penanganan berhasil ditambahkan.');
    }

    public function edit(TahapanPenanganan $tahapanPenanganan)
    {
        return view('admin.tahapan-penanganan.edit', ['tahapan' => $tahapanPenanganan]);
    }

    public function update(Request $request, TahapanPenanganan $tahapanPenanganan)
    {
        $validated = $request->validate([
            'urutan' => 'required|integer',
            'nama_tahap' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'ikon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'video_url' => 'nullable|url|max:500',
        ]);

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
        $tahapanPenanganan->delete();

        LogAktivitas::create([
            'pengguna_id' => auth()->id(),
            'aktivitas' => 'Menghapus tahapan: ' . $nama,
            'alamat_ip' => request()->ip(),
        ]);

        return redirect()->route('admin.tahapan-penanganan.index')->with('success', 'Tahapan penanganan berhasil dihapus.');
    }
}
