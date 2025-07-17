<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DataPengajuanPenghapusanKendaraan;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;

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

        // Menambahkan tanggal_form secara otomatis dengan format tanggal-bulan-tahun (Indonesia)
        $validated['tanggal_form'] = Carbon::now()->locale('id')->isoFormat('D MMMM YYYY'); // Format: 10 Juli 2025

        // Simpan data ke database termasuk tanggal_form
        $data = DataPengajuanPenghapusanKendaraan::create($validated);

        // Mencetak PDF setelah data disimpan
        $pdf = PDF::loadView('user.pages.pdf', ['data' => $data]);

        // Tentukan nama file PDF sesuai format yang diminta
        $pdfFileName = $data->id . '_' . $data->nama_pemilik . '_' . $data->nik_tdp_nib_kitas_kitab . '.pdf';

        // Tentukan path file PDF
        $pdfPath = 'pengajuan-penghapusan/' . $pdfFileName;

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
        $data->save(); // Simpan data termasuk file_pdf dan tanggal_form

        // Mengunduh file PDF secara langsung
        return response()->download($storagePath);
    }




}
