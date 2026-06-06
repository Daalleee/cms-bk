<?php

namespace App\Http\Controllers;

use App\Models\PesanKontak;
use Illuminate\Http\Request;

class PesanKontakController extends Controller
{
    public function index()
    {
        $pesans = PesanKontak::latest()->get();
        return view('admin.pesan-masuk.index', compact('pesans'));
    }

    public function show(PesanKontak $pesanMasuk)
    {
        $pesanMasuk->update(['status_baca' => 'Sudah Dibaca']);
        return view('admin.pesan-masuk.show', ['pesan' => $pesanMasuk]);
    }

    public function destroy(PesanKontak $pesanMasuk)
    {
        $pesanMasuk->delete();
        return redirect()->route('admin.pesan-masuk.index')->with('success', 'Pesan berhasil dihapus.');
    }
}
