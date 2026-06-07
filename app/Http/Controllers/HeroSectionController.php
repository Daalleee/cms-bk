<?php

namespace App\Http\Controllers;

use App\Models\HeroSection;
use App\Models\LogAktivitas;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSectionController extends Controller
{
    public function index()
    {
        $hero = HeroSection::first();
        $settings = Pengaturan::getAll();
        return view('admin.hero-section.index', compact('hero', 'settings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'sub_judul' => 'nullable|string',
            'whatsapp_tujuan' => 'nullable|string|max:20',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tombol_1_teks' => 'nullable|string|max:255',
            'tombol_1_target' => 'nullable|string|max:255',
            'tombol_2_teks' => 'nullable|string|max:255',
            'tombol_2_target' => 'nullable|string|max:255',
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

        // save button settings to pengaturan
        $pengaturanData = [
            'hero_tombol_1_teks' => $request->input('tombol_1_teks'),
            'hero_tombol_1_target' => $request->input('tombol_1_target'),
            'hero_tampilkan_tombol_1' => $request->boolean('tampilkan_tombol_1') ? '1' : '0',
            'hero_tombol_2_teks' => $request->input('tombol_2_teks'),
            'hero_tombol_2_target' => $request->input('tombol_2_target'),
            'hero_tampilkan_tombol_2' => $request->boolean('tampilkan_tombol_2') ? '1' : '0',
        ];
        foreach ($pengaturanData as $key => $value) {
            Pengaturan::setValue($key, $value);
        }

        LogAktivitas::create([
            'pengguna_id' => auth()->id(),
            'aktivitas' => 'Memperbarui Hero Section',
            'alamat_ip' => $request->ip(),
        ]);

        return redirect()->back()->with('success', 'Hero Section berhasil diperbarui.');
    }
}
