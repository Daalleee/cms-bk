<?php

namespace App\Http\Controllers;

use App\Models\ProfilWebsite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilWebsiteController extends Controller
{
    public function index()
    {
        $profil = ProfilWebsite::first();
        return view('admin.profil-website.index', compact('profil'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'profil' => 'required|string',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $profil = ProfilWebsite::first();

        if ($request->hasFile('gambar')) {
            if ($profil && $profil->gambar) {
                Storage::disk('public')->delete($profil->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('profil', 'public');
        }

        if ($profil) {
            $profil->update($validated);
        } else {
            ProfilWebsite::create($validated);
        }

        return redirect()->back()->with('success', 'Profil website berhasil diperbarui.');
    }
}
