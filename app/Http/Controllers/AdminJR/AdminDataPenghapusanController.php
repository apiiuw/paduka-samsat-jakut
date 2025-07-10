<?php

namespace App\Http\Controllers\AdminJR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataPengajuanPenghapusanKendaraan;

class AdminDataPenghapusanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input dari filter
        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');
        $jenis_kendaraan = $request->input('jenis_kendaraan');
        $search = $request->input('search');

        // Query dasar
        $query = DataPengajuanPenghapusanKendaraan::query();

        // Menambahkan filter berdasarkan tahun
        if ($tahun) {
            $query->where('tanggal_form', 'like', '%' . $tahun . '%');
        }

        // Menambahkan filter berdasarkan bulan
        if ($bulan) {
            $query->where('tanggal_form', 'like', '%' . $bulan . '%');
        }

        // Menambahkan filter berdasarkan jenis kendaraan
        if ($jenis_kendaraan) {
            $query->where('jenis_kendaraan', $jenis_kendaraan);
        }

        // Menambahkan filter pencarian berdasarkan nama pemilik atau email
        if ($search) {
            $query->where('nama_pemilik', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
        }

        // Ambil data dengan pagination
        $dataLaporan = $query->paginate(10);

        // Kirim data ke view
        return view('jasa-raharja.pages.data-penghapusan.index', compact('dataLaporan'));
    }
}
