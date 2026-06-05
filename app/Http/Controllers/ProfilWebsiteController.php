<?php

namespace App\Http\Controllers;

use App\Models\ProfilWebsite;
use Illuminate\Http\Request;

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
            'gambar' => 'nullable|string',
        ]);

        $profil = ProfilWebsite::first();
        if ($profil) {
            $profil->update($validated);
        } else {
            ProfilWebsite::create($validated);
        }

        return redirect()->back()->with('success', 'Profil website berhasil diperbarui.');
    }
}
