<?php

namespace App\Http\Controllers;

use App\Models\AreaKecanduan;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AreaKecanduanController extends Controller
{
    public function index()
    {
        $areas = AreaKecanduan::with('detailPenanganan')->orderBy('urutan')->get();
        return view('admin.area-kecanduan.index', compact('areas'));
    }

    public function create()
    {
        return view('admin.area-kecanduan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kecanduan' => 'required|string|max:255',
            'urutan' => 'required|integer',
            'status' => 'boolean',
            'ikon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'link_youtube' => 'nullable|string|max:255',
            'artikel_penanganan' => 'nullable|string',
        ]);

        if ($request->hasFile('ikon')) {
            $validated['ikon'] = $request->file('ikon')->store('areas/icons', 'public');
        }

        $detailData = [
            'link_youtube' => $validated['link_youtube'] ?? null,
            'artikel_penanganan' => $validated['artikel_penanganan'] ?? null,
        ];
        unset($validated['link_youtube'], $validated['artikel_penanganan']);

        $area = AreaKecanduan::create($validated);

        if ($detailData['link_youtube'] || $detailData['artikel_penanganan']) {
            $area->detailPenanganan()->create($detailData);
        }

        LogAktivitas::create([
            'pengguna_id' => auth()->id(),
            'aktivitas' => 'Menambah area kecanduan: ' . $validated['nama_kecanduan'],
            'alamat_ip' => $request->ip(),
        ]);

        return redirect()->route('admin.area-kecanduan.index')->with('success', 'Area kecanduan berhasil ditambahkan.');
    }

    public function edit(AreaKecanduan $areaKecanduan)
    {
        return view('admin.area-kecanduan.edit', compact('areaKecanduan'));
    }

    public function update(Request $request, AreaKecanduan $areaKecanduan)
    {
        $validated = $request->validate([
            'nama_kecanduan' => 'required|string|max:255',
            'urutan' => 'required|integer',
            'status' => 'boolean',
            'ikon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'link_youtube' => 'nullable|string|max:255',
            'artikel_penanganan' => 'nullable|string',
        ]);

        if ($request->hasFile('ikon')) {
            if ($areaKecanduan->ikon) {
                Storage::disk('public')->delete($areaKecanduan->ikon);
            }
            $validated['ikon'] = $request->file('ikon')->store('areas/icons', 'public');
        }

        $detailData = [
            'link_youtube' => $validated['link_youtube'] ?? null,
            'artikel_penanganan' => $validated['artikel_penanganan'] ?? null,
        ];
        unset($validated['link_youtube'], $validated['artikel_penanganan']);

        $areaKecanduan->update($validated);

        if ($areaKecanduan->detailPenanganan) {
            $areaKecanduan->detailPenanganan->update($detailData);
        } elseif ($detailData['link_youtube'] || $detailData['artikel_penanganan']) {
            $areaKecanduan->detailPenanganan()->create($detailData);
        }

        LogAktivitas::create([
            'pengguna_id' => auth()->id(),
            'aktivitas' => 'Memperbarui area kecanduan: ' . $validated['nama_kecanduan'],
            'alamat_ip' => $request->ip(),
        ]);

        return redirect()->route('admin.area-kecanduan.index')->with('success', 'Area kecanduan berhasil diperbarui.');
    }

    public function destroy(AreaKecanduan $areaKecanduan)
    {
        $nama = $areaKecanduan->nama_kecanduan;
        if ($areaKecanduan->ikon) {
            Storage::disk('public')->delete($areaKecanduan->ikon);
        }
        $areaKecanduan->delete();

        LogAktivitas::create([
            'pengguna_id' => auth()->id(),
            'aktivitas' => 'Menghapus area kecanduan: ' . $nama,
            'alamat_ip' => request()->ip(),
        ]);

        return redirect()->route('admin.area-kecanduan.index')->with('success', 'Area kecanduan berhasil dihapus.');
    }
}
