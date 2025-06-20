<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\UnitLaka\ULSDataKendaraanController;
use App\Http\Controllers\UnitLaka\ULSStatikKendaraanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// AUTH
Route::get('/sign-in', [SignInController::class, 'showSignInForm'])->name('signIn');
Route::post('/sign-in', [SignInController::class, 'signIn']);
Route::post('/sign-out', [SignInController::class, 'signOut'])->name('signOut');

// ==========================
// JR Kanwil DKI Jakarta
// ==========================
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/jr/statistik-laporan', fn () => view('jasa-raharja.pages.statistik-laporan.index'));
    Route::get('/jr/data-laporan', fn () => view('jasa-raharja.pages.data-laporan.index'));
    Route::get('/jr/data-hasil-survei', fn () => view('jasa-raharja.pages.data-hasil-survei.index'));
});

// ==========================
// Petugas Surveyor
// ==========================
Route::middleware(['auth', 'role:surveyor'])->group(function () {
    Route::get('/surveyor/data-survei', fn () => view('surveyor.pages.data-survei.index'));
    Route::get('/surveyor/data-hasil-survei', fn () => view('surveyor.pages.data-hasil-survei.index'));
    Route::get('/surveyor/input-data-survei', fn () => view('surveyor.pages.input-data-survei.index'));
});

// ==========================
// Unit Laka Samsat Jakut
// ==========================
Route::middleware(['auth', 'role:unit laka'])->group(function () {

    Route::get('/unit-laka/statistik-kendaraan', [ULSStatikKendaraanController::class, 'index'])->name('statistik-kendaraan.index');
    Route::get('/unit-laka/statistik-kendaraan/download', [ULSStatikKendaraanController::class, 'unduhPdf'])->name('statistik-kendaraan.download');

    Route::get('/unit-laka/data-kendaraan', [ULSDataKendaraanController::class, 'index'])->name('data-kendaraan.index');
    Route::get('/unit-laka/data-kendaraan/unduh', [ULSDataKendaraanController::class, 'unduh'])->name('data-kendaraan.unduh');
    Route::put('/unit-laka/data-kendaraan/status-perkara/{id}', [ULSDataKendaraanController::class, 'updateStatus'])->name('data-kendaraan-status.update');
    Route::get('/unit-laka/input-data-kendaraan', fn () => view('unit-laka-samsat-jakut.pages.input-data-kendaraan.index'));
    Route::post('/unit-laka/input-data-kendaraan/store', [ULSDataKendaraanController::class, 'store'])->name('data-kendaraan.store');
});