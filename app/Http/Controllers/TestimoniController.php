<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use App\Models\Pengaturan;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    public function index()
    {
        $testimonis = Testimoni::latest()->get();
        $settings = Pengaturan::getAll();
        return view('admin.testimoni.index', compact('testimonis', 'settings'));
    }

    public function create()
    {
        return view('admin.testimoni.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'isi_testimoni' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'status_publikasi' => 'boolean',
        ]);

        Testimoni::create($validated);

        LogAktivitas::create([
            'pengguna_id' => auth()->id(),
            'aktivitas' => 'Menambah testimoni dari: ' . $validated['nama'],
            'alamat_ip' => $request->ip(),
        ]);

        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil ditambahkan.');
    }

    public function edit(Testimoni $testimoni)
    {
        return view('admin.testimoni.edit', compact('testimoni'));
    }

    public function update(Request $request, Testimoni $testimoni)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'isi_testimoni' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'status_publikasi' => 'boolean',
        ]);

        $testimoni->update($validated);

        LogAktivitas::create([
            'pengguna_id' => auth()->id(),
            'aktivitas' => 'Memperbarui testimoni dari: ' . $validated['nama'],
            'alamat_ip' => $request->ip(),
        ]);

        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil diperbarui.');
    }

    public function destroy(Testimoni $testimoni)
    {
        $nama = $testimoni->nama;
        $testimoni->delete();

        LogAktivitas::create([
            'pengguna_id' => auth()->id(),
            'aktivitas' => 'Menghapus testimoni dari: ' . $nama,
            'alamat_ip' => request()->ip(),
        ]);

        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil dihapus.');
    }

    public function approve(Testimoni $testimoni)
    {
        $testimoni->update(['status_publikasi' => true]);

        LogAktivitas::create([
            'pengguna_id' => auth()->id(),
            'aktivitas' => 'Menyetujui testimoni dari: ' . $testimoni->nama,
            'alamat_ip' => request()->ip(),
        ]);

        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil disetujui dan sekarang tampil di website.');
    }
}
