<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengaturanController extends Controller
{
    public function index()
    {
        $settings = Pengaturan::getAll();
        return view('admin.pengaturan.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
            'settings.*' => 'nullable|string|max:65535',
        ]);

        $checkboxKeys = ['hero_tampilkan_tombol_1', 'hero_tampilkan_tombol_2'];

        $data = $request->settings;
        foreach ($checkboxKeys as $key) {
            if (!isset($data[$key])) {
                $data[$key] = '0';
            }
        }

        DB::transaction(function () use ($data) {
            foreach ($data as $key => $value) {
                Pengaturan::setValue($key, $value);
            }
        });

        return redirect()->route('admin.pengaturan.index')
            ->with('success', 'Pengaturan berhasil disimpan.');
    }

    public function updateSectionLabels(Request $request)
    {
        $allowed = [
            'tentang_label', 'tentang_sub_judul',
            'alur_label', 'alur_judul', 'alur_sub_judul',
            'area_label', 'area_judul', 'area_sub_judul',
            'testimoni_label', 'testimoni_judul', 'testimoni_sub_judul',
        ];

        $validated = $request->validate([
            'key' => 'required|string|in:' . implode(',', $allowed),
            'value' => 'nullable|string|max:65535',
        ]);

        Pengaturan::setValue($validated['key'], $validated['value'] ?? '');

        return response()->json(['success' => true]);
    }
}
