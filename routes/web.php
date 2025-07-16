<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\User\FormPenghapusanKendaraanController;
use App\Http\Controllers\UnitLaka\ULSDataKendaraanController;
use App\Http\Controllers\UnitLaka\ULSStatikKendaraanController;
use App\Http\Controllers\AdminJR\AdminDataLaporanController;
use App\Http\Controllers\AdminJR\AdminDataHasilSurveiController;
use App\Http\Controllers\AdminJR\AdminStatistikLaporanController;
use App\Http\Controllers\AdminJR\AdminDataPenghapusanController;
use App\Http\Controllers\Surveyor\SDataWajibSurveiController;
use App\Http\Controllers\Surveyor\SDataHasilSurveiController;

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

// Redirect from "/" to "/sign-in"
Route::get('/', function () {
    return redirect()->route('signIn');
});

// ==========================
// User Tanpa Login
// ==========================
Route::get('/form-penghapusan-data-kendaraan', [FormPenghapusanKendaraanController::class, 'index'])->name('form-penghapusan-kendaraan');
Route::post('/form-penghapusan-data-kendaraan', [FormPenghapusanKendaraanController::class, 'store']);

// ==========================
// Auth
// ==========================
Route::get('/sign-in', [SignInController::class, 'showSignInForm'])->name('signIn');
Route::post('/sign-in', [SignInController::class, 'signIn']);
Route::post('/sign-out', [SignInController::class, 'signOut'])->name('signOut');

// ==========================
// JR Kanwil DKI Jakarta
// ==========================
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/jr/statistik-laporan', [AdminStatistikLaporanController::class, 'index'])->name('jr.statistik-laporan.index');
    Route::get('/jr/statistik-laporan/unduh', [AdminStatistikLaporanController::class, 'unduhPdf'])->name('jr.statistik-laporan.unduh');
    Route::get('/jr/data-laporan', [AdminDataLaporanController::class, 'index'])->name('jr.data-laporan.index');
    Route::put('/jr/data-laporan/{id}/update-status', [AdminDataLaporanController::class, 'updateStatus'])->name('jr.updateStatus');
    Route::put('/jr/data-laporan/{id}/update-status-tersangka', [AdminDataLaporanController::class, 'updateStatusTersangka'])->name('jr.updateStatusTersangka');
    Route::get('jr/data-laporan/unduh', [AdminDataLaporanController::class, 'unduhLaporan'])->name('jr.laporan.download');
    Route::get('/jr/data-hasil-survei', fn () => view('jasa-raharja.pages.data-hasil-survei.index'));
    Route::get('/jr/data-hasil-survei', [AdminDataHasilSurveiController::class, 'index'])->name('jr.data-hasil-survei.index');
    Route::get('/jr/data-hasil-survei/unduh', [AdminDataHasilSurveiController::class, 'unduhLaporan'])->name('jr.hasil-survei.download');
    Route::get('/jr/data-penghapusan', [AdminDataPenghapusanController::class, 'index'])->name('data-penghapusan.index');
});

// ==========================
// Petugas Surveyor
// ==========================
Route::middleware(['auth', 'role:surveyor'])->group(function () {
    Route::get('/surveyor/data-survei', [SDataWajibSurveiController::class, 'index'])->name('surveyor.data-survei.index');
    Route::put('/surveyor/data-survei/updateStatusSurvei/{id}', [SDataWajibSurveiController::class, 'updateStatusSurvei'])->name('surveyor.updateStatusSurvei');
    Route::put('surveyor/data-survei/updateCatatan/{id}', [SDataWajibSurveiController::class, 'updateCatatan'])->name('surveyor.updateCatatan');
    Route::get('/surveyor/data-survei/unduh', [SDataWajibSurveiController::class, 'unduhLaporan'])->name('surveyor.data-survei.download');
    Route::get('/surveyor/data-survei/input-hasil-survei/{id}', [SDataWajibSurveiController::class, 'input'])->name('surveyor.data-survei.input');
    Route::get('/surveyor/data-survei/input-hasil-survei/tersangka/{id}', [SDataWajibSurveiController::class, 'inputTersangka'])->name('surveyor.data-survei.input.tersangka');
    Route::post('/surveyor/data-survei/input-hasil-survei/store', [SDataWajibSurveiController::class, 'store'])->name('surveyor.hasil-survei.store');
    Route::post('/surveyor/data-survei/input-hasil-survei/storeTersangka', [SDataWajibSurveiController::class, 'storeTersangka'])->name('surveyor.hasil-survei.store.tersangka');

    Route::get('/surveyor/data-hasil-survei', [SDataHasilSurveiController::class, 'index'])->name('surveyor.data-hasil-survei.index');
    Route::get('/surveyor/data-hasil-survei/unduh', [SDataHasilSurveiController::class, 'unduhLaporan'])->name('surveyor.data-hasil-survei.download');
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
    Route::put('/data-kendaraan/update-status-kendaraan-tersangka/{id}', [ULSDataKendaraanController::class, 'updateStatusKendaraanTersangka'])->name('data-kendaraan.update-status-kendaraan-tersangka');
    Route::put('/data-kendaraan/update-status-kendaraan-korban/{id}', [ULSDataKendaraanController::class, 'updateStatusKendaraanKorban'])->name('data-kendaraan.update-status-kendaraan-korban');
    Route::get('/unit-laka/input-data-kendaraan', fn () => view('unit-laka-samsat-jakut.pages.input-data-kendaraan.index'));
    Route::post('/unit-laka/input-data-kendaraan/store', [ULSDataKendaraanController::class, 'store'])->name('data-kendaraan.store');
});