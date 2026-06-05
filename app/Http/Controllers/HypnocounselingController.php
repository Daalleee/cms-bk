<?php

namespace App\Http\Controllers;

use App\Models\Hypnocounseling;
use Illuminate\Http\Request;

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
            'gambar' => 'nullable|string',
        ]);

        $data = Hypnocounseling::first();
        if ($data) {
            $data->update($validated);
        } else {
            Hypnocounseling::create($validated);
        }

        return redirect()->back()->with('success', 'Informasi hypnocounseling berhasil diperbarui.');
    }
}
