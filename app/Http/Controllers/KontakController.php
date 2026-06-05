<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
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
            'telepon' => 'required|string|max:20',
            'whatsapp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'google_maps' => 'nullable|string',
            'jam_operasional' => 'nullable|string|max:255',
        ]);

        $kontak = Kontak::first();
        if ($kontak) {
            $kontak->update($validated);
        } else {
            Kontak::create($validated);
        }

        return redirect()->back()->with('success', 'Informasi kontak berhasil diperbarui.');
    }
}
