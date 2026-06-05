<?php

namespace App\Http\Controllers;

use App\Models\AreaPenanganan;
use App\Models\Hypnocounseling;
use App\Models\Kontak;
use App\Models\PesanKontak;
use App\Models\ProfilWebsite;
use App\Models\TahapanPenanganan;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $profil = ProfilWebsite::first();
        $hypno = Hypnocounseling::first();
        $areas = AreaPenanganan::where('status', true)->take(6)->get();
        $tahapans = TahapanPenanganan::orderBy('urutan')->take(4)->get();
        $testimonis = Testimoni::where('status', true)->latest()->take(3)->get();
        $kontak = Kontak::first();

        return view('frontend.index', compact('profil', 'hypno', 'areas', 'tahapans', 'testimonis', 'kontak'));
    }

    public function tentangKami()
    {
        $profil = ProfilWebsite::first();
        $kontak = Kontak::first();
        return view('frontend.tentang-kami', compact('profil', 'kontak'));
    }

    public function hypnocounseling()
    {
        $hypno = Hypnocounseling::first();
        $kontak = Kontak::first();
        return view('frontend.hypnocounseling', compact('hypno', 'kontak'));
    }

    public function areaPenanganan()
    {
        $areas = AreaPenanganan::where('status', true)->get();
        $kontak = Kontak::first();
        return view('frontend.area-penanganan', compact('areas', 'kontak'));
    }

    public function tahapanPenanganan()
    {
        $tahapans = TahapanPenanganan::orderBy('urutan')->get();
        $kontak = Kontak::first();
        return view('frontend.tahapan-penanganan', compact('tahapans', 'kontak'));
    }

    public function testimoni()
    {
        $testimonis = Testimoni::where('status', true)->latest()->get();
        $kontak = Kontak::first();
        return view('frontend.testimoni', compact('testimonis', 'kontak'));
    }

    public function galeri()
    {
        $galeris = \App\Models\Galeri::latest()->get();
        $kontak = Kontak::first();
        $profil = ProfilWebsite::first();
        return view('frontend.galeri', compact('galeris', 'kontak', 'profil'));
    }

    public function kontak()
    {
        $kontak = Kontak::first();
        return view('frontend.kontak', compact('kontak'));
    }

    public function kirimPesan(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'subjek' => 'required|string|max:255',
            'pesan' => 'required|string',
        ]);

        PesanKontak::create($validated);

        return redirect()->back()->with('success', 'Pesan Anda telah berhasil dikirim. Terima kasih!');
    }
}
