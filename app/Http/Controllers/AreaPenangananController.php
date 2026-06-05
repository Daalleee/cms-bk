<?php

namespace App\Http\Controllers;

use App\Models\AreaPenanganan;
use Illuminate\Http\Request;

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
            'ikon' => 'nullable|string',
            'gambar' => 'nullable|string',
            'status' => 'boolean',
        ]);

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
            'ikon' => 'nullable|string',
            'gambar' => 'nullable|string',
            'status' => 'boolean',
        ]);

        $areaPenanganan->update($validated);

        return redirect()->route('area-penanganan.index')->with('success', 'Area penanganan berhasil diperbarui.');
    }

    public function destroy(AreaPenanganan $areaPenanganan)
    {
        $areaPenanganan->delete();
        return redirect()->route('area-penanganan.index')->with('success', 'Area penanganan berhasil dihapus.');
    }
}
