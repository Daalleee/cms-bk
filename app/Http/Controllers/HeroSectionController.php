<?php

namespace App\Http\Controllers;

use App\Models\HeroSection;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSectionController extends Controller
{
    public function index()
    {
        $hero = HeroSection::first();
        return view('admin.hero-section.index', compact('hero'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'sub_judul' => 'nullable|string',
            'whatsapp_tujuan' => 'nullable|string|max:20',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $hero = HeroSection::first();

        if ($request->hasFile('gambar')) {
            if ($hero && $hero->gambar) {
                Storage::disk('public')->delete($hero->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('hero', 'public');
        }

        if ($hero) {
            $hero->update($validated);
        } else {
            HeroSection::create($validated);
        }

        LogAktivitas::create([
            'pengguna_id' => auth()->id(),
            'aktivitas' => 'Memperbarui Hero Section',
            'alamat_ip' => $request->ip(),
        ]);

        return redirect()->back()->with('success', 'Hero Section berhasil diperbarui.');
    }
}
