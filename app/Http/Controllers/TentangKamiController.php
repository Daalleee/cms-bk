<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use App\Models\TentangKami;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TentangKamiController extends Controller
{
    public function index()
    {
        $tentang = TentangKami::first();
        return view('admin.tentang-kami.index', compact('tentang'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'nullable|string',
            'pengantar' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $tentang = TentangKami::first();

        if ($request->hasFile('gambar')) {
            if ($tentang && $tentang->gambar) {
                Storage::disk('public')->delete($tentang->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('tentang', 'public');
        }

        if ($tentang) {
            $tentang->update($validated);
        } else {
            TentangKami::create($validated);
        }

        LogAktivitas::create([
            'pengguna_id' => auth()->id(),
            'aktivitas' => 'Memperbarui Tentang Kami',
            'alamat_ip' => $request->ip(),
        ]);

        return redirect()->back()->with('success', 'Tentang Kami berhasil diperbarui.');
    }
}
