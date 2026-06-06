<?php

use App\Http\Controllers\AreaKecanduanController;
use App\Http\Controllers\HeroSectionController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\LogAktivitasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TahapanPenangananController;
use App\Http\Controllers\TentangKamiController;
use App\Http\Controllers\TentangSectionController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PesanKontakController;
use App\Http\Controllers\UserManagementController;
use App\Models\AreaKecanduan;
use App\Models\LogAktivitas;
use App\Models\TahapanPenanganan;
use App\Models\Testimoni;
use App\Models\PesanKontak;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'index'])->name('home');

Route::post('/testimoni', [FrontendController::class, 'storeTestimoni'])->name('frontend.testimoni.store');
Route::post('/kontak', [FrontendController::class, 'kirimPesan'])->name('frontend.kontak.store');

Route::get('/tentang', [FrontendController::class, 'tentang'])->name('frontend.tentang');
Route::get('/area/{areaKecanduan}', [FrontendController::class, 'areaDetail'])->name('frontend.area.detail');
Route::get('/tahapan/{tahapan}', [FrontendController::class, 'tahapanDetail'])->name('frontend.tahapan.detail');

Route::get('/dashboard', function () {
    $stats = [
        'areas' => AreaKecanduan::count(),
        'tahapans' => TahapanPenanganan::count(),
        'testimonis' => Testimoni::count(),
        'testimoni_pending' => Testimoni::where('status_publikasi', false)->count(),
        'pesan' => PesanKontak::count(),
    ];
    return view('dashboard', compact('stats'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['role:super_admin'])->group(function () {
        Route::get('hero-section', [HeroSectionController::class, 'index'])->name('hero-section.index');
        Route::post('hero-section', [HeroSectionController::class, 'store'])->name('hero-section.store');
        Route::get('tentang-kami', [TentangKamiController::class, 'index'])->name('tentang-kami.index');
        Route::post('tentang-kami', [TentangKamiController::class, 'store'])->name('tentang-kami.store');
        Route::resource('tahapan-penanganan', TahapanPenangananController::class)->except(['show']);
        Route::get('tentang-section', [TentangSectionController::class, 'index'])->name('tentang-section.index');
        Route::post('tentang-section', [TentangSectionController::class, 'store'])->name('tentang-section.store');
        Route::put('tentang-section/{tentangSection}', [TentangSectionController::class, 'update'])->name('tentang-section.update');
        Route::post('tentang-section/save-all', [TentangSectionController::class, 'saveAll'])->name('tentang-section.save-all');
        Route::delete('tentang-section/{tentangSection}', [TentangSectionController::class, 'destroy'])->name('tentang-section.destroy');
        Route::resource('log-aktivitas', LogAktivitasController::class)->only(['index']);
        Route::resource('pengguna', UserManagementController::class)->except(['show']);
    });

    Route::middleware(['role:admin,super_admin'])->group(function () {
        Route::resource('area-kecanduan', AreaKecanduanController::class)->except(['show']);
        Route::resource('testimoni', TestimoniController::class)->except(['show']);
        Route::patch('testimoni/{testimoni}/approve', [TestimoniController::class, 'approve'])->name('testimoni.approve');
        Route::get('kontak', [KontakController::class, 'index'])->name('kontak.index');
        Route::post('kontak', [KontakController::class, 'store'])->name('kontak.store');
        Route::resource('pesan-masuk', PesanKontakController::class)->only(['index', 'show', 'destroy']);

        Route::post('media/upload', [MediaController::class, 'upload'])->name('media.upload');
        Route::post('media/upload-chunk', [MediaController::class, 'uploadChunk'])->name('media.upload-chunk');
        Route::post('media/add-link', [MediaController::class, 'addLink'])->name('media.add-link');
        Route::post('media/reorder', [MediaController::class, 'reorder'])->name('media.reorder');
        Route::delete('media/{media}', [MediaController::class, 'destroy'])->name('media.destroy');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
