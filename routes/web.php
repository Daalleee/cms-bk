<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilWebsiteController;
use App\Http\Controllers\HypnocounselingController;
use App\Http\Controllers\AreaPenangananController;
use App\Http\Controllers\TahapanPenangananController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\PesanKontakController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GaleriController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/tentang-kami', [FrontendController::class, 'tentangKami'])->name('tentang-kami');
Route::get('/hypnocounseling', [FrontendController::class, 'hypnocounseling'])->name('frontend.hypnocounseling');
Route::get('/area-penanganan', [FrontendController::class, 'areaPenanganan'])->name('frontend.area-penanganan');
Route::get('/tahapan-penanganan', [FrontendController::class, 'tahapanPenanganan'])->name('frontend.tahapan-penanganan');
Route::get('/testimoni', [FrontendController::class, 'testimoni'])->name('frontend.testimoni');
Route::get('/galeri', [FrontendController::class, 'galeri'])->name('frontend.galeri');
Route::get('/kontak', [FrontendController::class, 'kontak'])->name('frontend.kontak');
Route::post('/kontak', [FrontendController::class, 'kirimPesan'])->name('frontend.kontak.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::resource('profil-website', ProfilWebsiteController::class);
    Route::resource('hypnocounseling', HypnocounselingController::class);
    Route::resource('area-penanganan', AreaPenangananController::class);
    Route::resource('tahapan-penanganan', TahapanPenangananController::class);
    Route::resource('testimoni', TestimoniController::class);
    Route::resource('kontak', KontakController::class);
    Route::resource('pesan-masuk', PesanKontakController::class);
    Route::resource('galeri', GaleriController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
