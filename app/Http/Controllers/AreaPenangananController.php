<?php

namespace App\Http\Controllers;

use App\Models\AreaPenanganan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AreaPenangananController extends Controller
{
    public function index()
    {
        $areas = AreaPenanganan::latest()->get();
        return view('admin.area-penanganan.index', compact('areas'));
    }

    public function create()
    {
        return view('admin.area-penanganan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_area' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'video_url' => 'nullable|string|max:255',
            'artikel' => 'nullable|string',
            'ikon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'boolean',
        ]);

        if ($request->hasFile('ikon')) {
            $validated['ikon'] = $request->file('ikon')->store('areas/icons', 'public');
        }

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('areas/images', 'public');
        }

        AreaPenanganan::create($validated);

        return redirect()->route('area-penanganan.index')->with('success', 'Area penanganan berhasil ditambahkan.');
    }

    public function edit(AreaPenanganan $areaPenanganan)
    {
        return view('admin.area-penanganan.edit', ['area' => $areaPenanganan]);
    }

    public function update(Request $request, AreaPenanganan $areaPenanganan)
    {
        $validated = $request->validate([
            'nama_area' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'video_url' => 'nullable|string|max:255',
            'artikel' => 'nullable|string',
            'ikon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'boolean',
        ]);

        if ($request->hasFile('ikon')) {
            if ($areaPenanganan->ikon) {
                Storage::disk('public')->delete($areaPenanganan->ikon);
            }
            $validated['ikon'] = $request->file('ikon')->store('areas/icons', 'public');
        }

        if ($request->hasFile('gambar')) {
            if ($areaPenanganan->gambar) {
                Storage::disk('public')->delete($areaPenanganan->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('areas/images', 'public');
        }

        $areaPenanganan->update($validated);

        return redirect()->route('area-penanganan.index')->with('success', 'Area penanganan berhasil diperbarui.');
    }

    public function destroy(AreaPenanganan $areaPenanganan)
    {
        if ($areaPenanganan->ikon) {
            Storage::disk('public')->delete($areaPenanganan->ikon);
        }
        if ($areaPenanganan->gambar) {
            Storage::disk('public')->delete($areaPenanganan->gambar);
        }
        $areaPenanganan->delete();
        return redirect()->route('area-penanganan.index')->with('success', 'Area penanganan berhasil dihapus.');
    }
}
