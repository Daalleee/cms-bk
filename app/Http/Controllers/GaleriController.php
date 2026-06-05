<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::latest()->get();
        return view('admin.galeri.index', compact('galeris'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tipe' => 'required|in:foto,video',
            'sumber' => 'required|in:file,link',
            'file_media' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov,avi|max:20480', // Max 20MB
            'link_media' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);

        $path_atau_link = '';

        if ($request->sumber === 'file' && $request->hasFile('file_media')) {
            $path_atau_link = $request->file('file_media')->store('galeri', 'public');
        } else {
            $path_atau_link = $request->link_media;
        }

        Galeri::create([
            'judul' => $request->judul,
            'tipe' => $request->tipe,
            'sumber' => $request->sumber,
            'path_atau_link' => $path_atau_link,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('galeri.index')->with('success', 'Media berhasil ditambahkan ke galeri.');
    }

    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tipe' => 'required|in:foto,video',
            'sumber' => 'required|in:file,link',
            'file_media' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov,avi|max:20480',
            'link_media' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);

        $path_atau_link = $galeri->path_atau_link;

        if ($request->sumber === 'file') {
            if ($request->hasFile('file_media')) {
                // Hapus file lama jika ada
                if ($galeri->sumber === 'file') {
                    Storage::disk('public')->delete($galeri->path_atau_link);
                }
                $path_atau_link = $request->file('file_media')->store('galeri', 'public');
            }
        } else {
            $path_atau_link = $request->link_media;
        }

        $galeri->update([
            'judul' => $request->judul,
            'tipe' => $request->tipe,
            'sumber' => $request->sumber,
            'path_atau_link' => $path_atau_link,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(Galeri $galeri)
    {
        if ($galeri->sumber === 'file') {
            Storage::disk('public')->delete($galeri->path_atau_link);
        }
        $galeri->delete();
        return redirect()->route('galeri.index')->with('success', 'Media berhasil dihapus.');
    }
}
