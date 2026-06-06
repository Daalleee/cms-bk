<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        $kontak = Kontak::first();
        return view('admin.kontak.index', compact('kontak'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'alamat' => 'required|string',
            'telepon' => 'nullable|string|max:20',
            'whatsapp' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'instagram' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
        ]);

        $kontak = Kontak::first();
        if ($kontak) {
            $kontak->update($validated);
        } else {
            Kontak::create($validated);
        }

        LogAktivitas::create([
            'pengguna_id' => auth()->id(),
            'aktivitas' => 'Memperbarui informasi kontak',
            'alamat_ip' => $request->ip(),
        ]);

        return redirect()->back()->with('success', 'Informasi kontak berhasil diperbarui.');
    }
}
