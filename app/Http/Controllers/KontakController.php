<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use App\Models\LogAktivitas;
use App\Models\Pengaturan;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        $kontak = Kontak::first();
        $settings = Pengaturan::getAll();
        return view('admin.kontak.index', compact('kontak', 'settings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:20',
            'whatsapp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'instagram' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'tampilkan_youtube' => 'nullable|boolean',
            'tampilkan_instagram' => 'nullable|boolean',
            'tampilkan_facebook' => 'nullable|boolean',
            'tampilkan_twitter' => 'nullable|boolean',
            'tampilkan_tiktok' => 'nullable|boolean',
        ]);

        $validated['tampilkan_youtube'] = $request->boolean('tampilkan_youtube');
        $validated['tampilkan_instagram'] = $request->boolean('tampilkan_instagram');
        $validated['tampilkan_facebook'] = $request->boolean('tampilkan_facebook');
        $validated['tampilkan_twitter'] = $request->boolean('tampilkan_twitter');
        $validated['tampilkan_tiktok'] = $request->boolean('tampilkan_tiktok');

        $kontak = Kontak::first();
        if ($kontak) {
            $kontak->update($validated);
        } else {
            Kontak::create($validated);
        }

        // save section labels
        $labelKeys = ['kontak_judul', 'kontak_sub_judul', 'kontak_btn_kirim'];
        foreach ($labelKeys as $key) {
            if ($request->has($key)) {
                Pengaturan::setValue($key, $request->input($key));
            }
        }

        LogAktivitas::create([
            'pengguna_id' => auth()->id(),
            'aktivitas' => 'Memperbarui informasi kontak',
            'alamat_ip' => $request->ip(),
        ]);

        return redirect()->back()->with('success', 'Informasi kontak berhasil diperbarui.');
    }
}
