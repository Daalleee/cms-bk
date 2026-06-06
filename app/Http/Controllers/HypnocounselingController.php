<?php

namespace App\Http\Controllers;

use App\Models\Hypnocounseling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HypnocounselingController extends Controller
{
    public function index()
    {
        $data = Hypnocounseling::first();
        return view('admin.hypnocounseling.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'manfaat' => 'required|string',
            'prosedur' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = Hypnocounseling::first();

        if ($request->hasFile('gambar')) {
            if ($data && $data->gambar) {
                Storage::disk('public')->delete($data->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('hypnocounseling', 'public');
        }

        if ($data) {
            $data->update($validated);
        } else {
            Hypnocounseling::create($validated);
        }

        return redirect()->back()->with('success', 'Informasi hypnocounseling berhasil diperbarui.');
    }
}
