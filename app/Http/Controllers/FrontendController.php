<?php

namespace App\Http\Controllers;

use App\Models\AreaKecanduan;
use App\Models\DetailPenanganan;
use App\Models\HeroSection;
use App\Models\Kontak;
use App\Models\PesanKontak;
use App\Models\TahapanPenanganan;
use App\Models\TentangKami;
use App\Models\TentangSection;
use App\Models\Pengaturan;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $hero = HeroSection::first();
        $tentang = TentangKami::first();
        $sections = TentangSection::orderBy('urutan')->get();
        $tahapans = TahapanPenanganan::orderBy('urutan')->get();
        $areas = AreaKecanduan::where('status', true)->orderBy('urutan')->with('detailPenanganan.media')->get();
        $testimonis = Testimoni::where('status_publikasi', true)->latest()->take(10)->get();
        $kontak = Kontak::first();
        $settings = Pengaturan::getAll();

        return view('frontend.index', compact('hero', 'tentang', 'sections', 'tahapans', 'areas', 'testimonis', 'kontak', 'settings'));
    }

    public function storeTestimoni(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'isi_testimoni' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $validated['status_publikasi'] = false;

        Testimoni::create($validated);

        return redirect()->back()->with('success', 'Testimoni Anda telah terkirim dan akan ditinjau oleh tim kami. Terima kasih!');
    }

    public function tentang()
    {
        $hero = HeroSection::first();
        $kontak = Kontak::first();
        $tentang = TentangKami::first();
        $sections = TentangSection::orderBy('urutan')->get();
        return view('frontend.tentang', compact('hero', 'kontak', 'tentang', 'sections'));
    }

    public function areaDetail(AreaKecanduan $areaKecanduan)
    {
        $hero = HeroSection::first();
        $kontak = Kontak::first();
        $areaKecanduan->load('detailPenanganan.media');
        $areas = AreaKecanduan::where('status', true)->orderBy('urutan')->get();
        return view('frontend.area-detail', compact('hero', 'kontak', 'areaKecanduan', 'areas'));
    }

    public function tahapanDetail(TahapanPenanganan $tahapan)
    {
        $tahapans = TahapanPenanganan::orderBy('urutan')->get();
        $hero = HeroSection::first();
        $kontak = Kontak::first();
        return view('frontend.tahapan-detail', compact('tahapan', 'tahapans', 'hero', 'kontak'));
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

        return redirect()->back()->with('success_pesan', 'Pesan Anda telah berhasil dikirim. Terima kasih!');
    }
}
