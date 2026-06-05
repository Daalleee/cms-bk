<?php

namespace App\Http\Controllers;

use App\Models\TahapanPenanganan;
use Illuminate\Http\Request;

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
            'gambar' => 'nullable|string',
        ]);

        TahapanPenanganan::create($validated);

        return redirect()->route('tahapan-penanganan.index')->with('success', 'Tahapan penanganan berhasil ditambahkan.');
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
            'gambar' => 'nullable|string',
        ]);

        $tahapanPenanganan->update($validated);

        return redirect()->route('tahapan-penanganan.index')->with('success', 'Tahapan penanganan berhasil diperbarui.');
    }

    public function destroy(TahapanPenanganan $tahapanPenanganan)
    {
        $tahapanPenanganan->delete();
        return redirect()->route('tahapan-penanganan.index')->with('success', 'Tahapan penanganan berhasil dihapus.');
    }
}
