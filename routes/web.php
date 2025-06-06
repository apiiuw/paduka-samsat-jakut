<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// JR Kanwil DKI Jakarta
Route::get('/jr-statistik-laporan', function () {
    return view('jasa-raharja.pages.statistik-laporan.index');
});

Route::get('/jr-data-laporan', function () {
    return view('jasa-raharja.pages.data-laporan.index');
});

Route::get('/jr-data-hasil-survei', function () {
    return view('jasa-raharja.pages.data-hasil-survei.index');
});

// Unit Laka Samsat Jakut
Route::get('/unit-laka-statistik-kendaraan', function () {
    return view('unit-laka-samsat-jakut.pages.statistik-kendaraan.index');
});

Route::get('/unit-laka-data-kendaraan', function () {
    return view('unit-laka-samsat-jakut.pages.data-kendaraan.index');
});

Route::get('/unit-laka-input-data-kendaraan', function () {
    return view('unit-laka-samsat-jakut.pages.input-data-kendaraan.index');
});