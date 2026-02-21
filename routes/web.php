<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CSController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\UploadBuktiController;
use App\Http\Controllers\CS\DashboardController;
use App\Http\Controllers\DataAcController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\InventarisKondisiController;
use App\Http\Controllers\MitraAcController;
use App\Http\Controllers\PemeliharaanAcController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', [LaporanController::class, 'laporan']);
// Route::get('/home', [LaporanController::class, 'laporan'])->name('pages.home');

// logout
Route::get('/logout', [LogoutController::class, 'store'])->name('auth.logout');

// auth
Route::get('/', [LoginController::class, 'index'])->middleware('guest')->name('auth.login');
Route::post('/login', [LoginController::class, 'store'])->name('auth.login');

// halaman manajer
Route::prefix('manajer')->middleware(['manajer'])->group(function () {
    Route::get('/', [LaporanController::class, 'manajer'])->name('manajer.dashboard');
    Route::get('/ruang', [RuangController::class, 'index'])->name('manajer.ruang.index');
    Route::get('/cs', [CSController::class, 'index'])->name('manajer.cs.index');
    Route::post('/cs', [CSController::class, 'update']);
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('manajer.jadwal.index');
    Route::post('/jadwal', [JadwalController::class, 'index'])->name('manajer.jadwal.index');
    Route::get('/laporan', [LaporanController::class, 'indexMan'])->name('manajer.laporan.index');
    Route::post('/laporan', [LaporanController::class, 'indexMan'])->name('manajer.laporan.index');
    Route::get('/profil', [ProfileController::class, 'index'])->name('manajer.profil');
    Route::patch('/profil', [ProfileController::class, 'store']);
    Route::get('/inventaris', [InventarisController::class, 'index'])->name('inventaris.index');
    Route::get('/inventaris/{id_ruang}/create', [InventarisController::class, 'create_inventaris_sarana'])->name('manager.inventaris..sarana.create');
    Route::post('/inventaris/{id_ruang}/create', [InventarisController::class, 'store_inventaris_sarana'])->name('manager.inventaris..sarana.store');
    Route::get('/inventaris/{id}/{id_ruang}/edit', [InventarisController::class, 'edit_inventaris_sarana'])->name('manager.inventaris..sarana.edit');
    Route::put('/inventaris/{id}/{id_ruang}/edit', [InventarisController::class, 'update_inventaris_sarana'])->name('manager.inventaris..sarana.update');
    Route::delete('/inventaris/{id}/destroy', [InventarisController::class, 'destroy_inventaris_sarana'])->name('manager.inventaris..sarana.destroy');
    Route::get('/inventaris-sarana/{id_ruang}', [InventarisController::class, 'inventaris_sarana'])->name('inventaris.sarana');
    // Route::get('/pemeliharaan-ac/{id_ruang}', [PemeliharaanAcController::class, 'index'])->name('pemeliharaanAC.index');
    Route::get('/inventaris/{id_ruang}/{bulan}', [InventarisController::class, 'inventaris_bulan'])->name('inventaris.bulan');
    Route::post('/inventaris-kondisi/{id_sarana}/{bulan}', [InventarisKondisiController::class, 'manajer_store'])->name('manajer.inventaris.kondisi.store');
    Route::get('/mitra-ac', [MitraAcController::class, 'index_manajer'])->name('manajer.mitraac.index');
    Route::post('/mitra-ac', [MitraAcController::class, 'store'])->name('manajer.mitraac.store');
    Route::put('/mitra-ac/{id_user}', [MitraAcController::class, 'update'])->name('manajer.mitraac.update');
    Route::delete('/mitra-ac/{id_user}', [MitraAcController::class, 'destroy'])->name('manajer.mitraac.destroy');
    Route::get('/data-ac/{id_ruang}', [DataAcController::class, 'index'])->name('data.ac.index');
    Route::get('/data-ac/create/{id_ruang}', [DataAcController::class, 'create'])->name('data.ac.create');
    Route::post('/data-ac/create/{id_ruang}', [DataAcController::class, 'store'])->name('data.ac.store');
    Route::get('/data-ac/edit/{id_ac}/{id_ruang}', [DataAcController::class, 'edit'])->name('data.ac.edit');
    Route::put('/data-ac/edit/{id_ac}/{id_ruang}', [DataAcController::class, 'update'])->name('data.ac.update');
    // Route::resource('/mitra-ac', MitraAcController::class);
});

Route::resource('ruang', RuangController::class);
Route::resource('cs', CSController::class);
Route::resource('jadwal', JadwalController::class);
Route::resource('laporan', LaporanController::class);

// halaman cs
Route::prefix('cs')->middleware(['cs'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('cs.dashboard');
    Route::get('/{id_ruang}/upload', [UploadBuktiController::class, 'index'])->name('cs.bukti');
    Route::post('/upload', [UploadBuktiController::class, 'store'])->name('cs.bukti.upload');
    Route::get('/profil', [ProfileController::class, 'index'])->name('cs.profil');
    Route::get('/inventaris/show', [InventarisController::class, 'index_cs_inventaris'])->name('cs.inventaris.index');
    Route::get('/inventaris-sarana/{id_ruang}', [InventarisController::class, 'cs_inventaris_sarana'])->name('cs.inventaris.sarana');
    Route::get('/inventaris/{id_ruang}/create', [InventarisController::class, 'cs_create_inventaris_sarana'])->name('cs.inventaris..sarana.create');
    Route::post('/inventaris/{id_ruang}/create', [InventarisController::class, 'cs_store_inventaris_sarana'])->name('cs.inventaris..sarana.store');
    Route::get('/inventaris/{id}/{id_ruang}/edit', [InventarisController::class, 'cs_edit_inventaris_sarana'])->name('cs.inventaris..sarana.edit');
    Route::put('/inventaris/{id}/{id_ruang}/edit', [InventarisController::class, 'cs_update_inventaris_sarana'])->name('cs.inventaris..sarana.update');
    Route::delete('/inventaris/{id}/destroy', [InventarisController::class, 'cs_destroy_inventaris_sarana'])->name('cs.inventaris..sarana.destroy');
    Route::get('/inventaris/{id_ruang}/{bulan}', [InventarisKondisiController::class, 'cs_index'])->name('cs.inventaris.bulan');
    Route::post('/inventaris-kondisi/{id_sarana}/{bulan}', [InventarisKondisiController::class, 'cs_store'])->name('cs.inventaris.kondisi.store');
});

// Halaman Mitra
Route::prefix('mitra')->middleware(['mitra'])->group(function () {
    Route::get('/', [MitraAcController::class, 'index'])->name('mitra.dashboard');
    Route::get('/pemeliharaan-ac/{id_ruang}', [PemeliharaanAcController::class, 'index'])->name('mitra.pemeliharaan.index');
    Route::get('/pemeliharaan-ac/{id_ruang}/{id_ac}/create', [PemeliharaanAcController::class, 'create'])->name('mitra.pemeliharaan.create');
    Route::post('/pemeliharaan-ac/{id_ruang}/{id_ac}/create', [PemeliharaanAcController::class, 'store'])->name('mitra.pemeliharaan.store');
    Route::get('/pemeliharaan-ac/{id_ruang}/{id_pemeliharaan}/{id_ac}/edit', [PemeliharaanAcController::class, 'edit'])->name('mitra.pemeliharaan.edit');
    Route::put('/pemeliharaan-ac/{id_ruang}/{id_pemeliharaan}/{id_ac}/edit', [PemeliharaanAcController::class, 'update'])->name('mitra.pemeliharaan.update');
    Route::get('/scan/{token}', [PemeliharaanAcController::class, 'scanByToken'])
        ->middleware(['auth', 'mitra'])
        ->name('scan.token');
});

Route::prefix('manajerread')->middleware(['manajerread'])->group(function () {
    Route::get('/', [LaporanController::class, 'manajer'])->name('manajerread.dashboard');
    Route::get('/laporan', [LaporanController::class, 'indexMan'])->name('manajerread.laporan.index');
    Route::post('/laporan', [LaporanController::class, 'indexMan']);
    Route::get('/inventaris', [InventarisController::class, 'index'])->name('manajerread.inventaris.index');
    Route::get('/inventaris-sarana/{id_ruang}', [InventarisController::class, 'inventaris_sarana'])->name('manajerread.inventaris.sarana');
    Route::get('/inventaris/{id_ruang}/{bulan}', [InventarisController::class, 'inventaris_bulan'])->name('manajerread.inventaris.bulan');
});
Route::get('akun', [ProfileController::class, 'index'])->name('akun');
Route::patch('/update-akun', [ProfileController::class, 'store'])->name('update-akun');
