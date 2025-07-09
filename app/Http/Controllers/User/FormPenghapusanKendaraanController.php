<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DataPengajuanPenghapusanKendaraan;
use Illuminate\Http\Request;
use PDF;

class FormPenghapusanKendaraanController extends Controller
{
    public function index()
    {
        // Memanggil view
        return view('user.pages.index');
    }

public function store(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        'nama_pemilik' => 'required|string',
        'alamat_sesuai_identitas' => 'required|string',
        'nik_tdp_nib_kitas_kitab' => 'required|string',
        'no_telp' => 'required|string',
        'email' => 'required|email',
        'nrkb_kendaraan' => 'required|string',
        'merek_kendaraan' => 'required|string',
        'tipe_kendaraan' => 'required|string',
        'jenis_kendaraan' => 'required|string',
        'model_kendaraan' => 'required|string',
        'tahun_pembuatan_kendaraan' => 'required|string',
        'isi_silinder_daya_listrik_kendaraan' => 'required|string',
        'nomor_rangka_kendaraan' => 'required|string',
        'nomor_mesin_kendaraan' => 'required|string',
        'warna_kendaraan' => 'required|string',
        'bahan_bakar_sumber_energi_kendaraan' => 'required|string',
        'warna_tnkb_kendaraan' => 'required|string',
        'nomor_bpkb_kendaraan' => 'required|string',
        'alasan_permohonan' => 'required|string',
    ]);

    // Simpan data ke database
    $data = DataPengajuanPenghapusanKendaraan::create($validated);

    // Mencetak PDF setelah data disimpan
    $pdf = PDF::loadView('user.pages.pdf', ['data' => $data]);

    // Tentukan path file PDF
    $pdfPath = 'pengajuan-penghapusan/Form Pengajuan Penghapusan Data Kendaraan (' . $data->nrkb_kendaraan . ').pdf';

    // Tentukan direktori penyimpanan
    $storagePath = storage_path('app/public/' . $pdfPath);

    // Pastikan folder tujuan ada
    if (!file_exists(dirname($storagePath))) {
        mkdir(dirname($storagePath), 0777, true);
    }

    // Simpan file PDF
    $pdf->save($storagePath);

    // Set file_pdf langsung saat menyimpan data
    $data->file_pdf = $pdfPath;
    $data->save(); // Simpan data termasuk file_pdf

    // Mengunduh file PDF secara langsung
    return response()->download($storagePath);
}


}
