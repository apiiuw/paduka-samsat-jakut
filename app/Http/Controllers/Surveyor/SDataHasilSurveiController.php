<?php

namespace App\Http\Controllers\Surveyor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminJrDataLaporan;
use PDF;

class SDataHasilSurveiController extends Controller
{
    public function index(Request $request)
    {
        // Ambil parameter pencarian
        $search = $request->input('search');
        
        // Ambil parameter filter
        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');
        $jenis_kendaraan = $request->input('jenis_kendaraan');
        $status_perkara = $request->input('status_perkara');

        // Dapatkan email user yang sedang login
        $userEmail = auth()->user()->email;

        // Tentukan status_validasi berdasarkan email yang sedang login
        $statusValidasi = '';
        if ($userEmail === 'surveyorjakartapusat@jr.com') {
            $statusValidasi = 'Jakarta Pusat';
        } elseif ($userEmail === 'surveyorjakartautara@jr.com') {
            $statusValidasi = 'Jakarta Utara';
        } elseif ($userEmail === 'surveyorjakartatimur@jr.com') {
            $statusValidasi = 'Jakarta Timur';
        } elseif ($userEmail === 'surveyorjakartabarat@jr.com') {
            $statusValidasi = 'Jakarta Barat';
        } elseif ($userEmail === 'surveyorjakartaselatan@jr.com') {
            $statusValidasi = 'Jakarta Selatan';
        }

        // Ambil data laporan dengan pencarian dan filter
        $dataLaporan = AdminJrDataLaporan::query();

        // Filter berdasarkan status_survei "Selesai Survei"
        $dataLaporan = $dataLaporan->where('status_survei', 'Selesai Survei');

        // Jika ada pencarian, filter berdasarkan laporan_polisi atau nomor_polisi
        if ($search) {
            $dataLaporan = $dataLaporan->where(function ($query) use ($search) {
                $query->where('laporan_polisi', 'like', '%' . $search . '%')
                    ->orWhere('nomor_polisi', 'like', '%' . $search . '%');
            });
        }

        // Jika ada filter tahun, filter berdasarkan tahun laporan
        if ($tahun) {
            $dataLaporan = $dataLaporan->whereYear('tanggal_laporan', $tahun); // Menyesuaikan dengan tahun laporan
        }

        // Jika ada filter bulan, filter berdasarkan bulan laporan
        if ($bulan) {
            $bulanArray = [
                'Januari' => 1,
                'Februari' => 2,
                'Maret' => 3,
                'April' => 4,
                'Mei' => 5,
                'Juni' => 6,
                'Juli' => 7,
                'Agustus' => 8,
                'September' => 9,
                'Oktober' => 10,
                'November' => 11,
                'Desember' => 12,
            ];

            $bulanAngka = $bulanArray[$bulan] ?? null;

            // Cek jika bulan valid
            if ($bulanAngka) {
                $dataLaporan = $dataLaporan->whereMonth('tanggal_laporan', $bulanAngka);
            }
        }


        // Jika ada filter jenis kendaraan
        if ($jenis_kendaraan) {
            $dataLaporan = $dataLaporan->where('jenis_kendaraan', $jenis_kendaraan);
        }

        // Jika ada filter status perkara
        if ($status_perkara) {
            $dataLaporan = $dataLaporan->where('status_perkara', $status_perkara);
        }

        // Menambahkan filter berdasarkan status_validasi sesuai dengan surveyor yang sedang login
        if ($statusValidasi) {
            $dataLaporan = $dataLaporan->where('status_validasi', $statusValidasi);
        }

        // Paginasi 10 data per halaman
        $dataLaporan = $dataLaporan->paginate(10);

        // Tahun sekarang
        $currentYear = now()->year;

        // Iterasi untuk menghitung estimasi tunggakan dan simpan hasilnya ke database
        foreach ($dataLaporan as $laporan) {
            // Menghitung selisih tahun antara tahun sekarang dan masa berlaku PKB/SW
            $yearsDifference = $currentYear - \Carbon\Carbon::parse($laporan->masa_berlaku_pkb_sw)->year;

            // Tentukan nominal berdasarkan jenis kendaraan
            switch ($laporan->jenis_kendaraan) {
                case 'Roda 2':
                case 'Roda 3':
                    $nominal = 35000;
                    break;
                case 'Roda 4':
                    $nominal = 143000;
                    break;
                default:
                    $nominal = 163000;  // Untuk kendaraan roda di atas 4
                    break;
            }

            // Hitung estimasi tunggakan
            $estimasiTunggakan = $yearsDifference * $nominal;

            // Simpan estimasi tunggakan ke database
            $laporan->estimasi_tunggakan = $estimasiTunggakan;
            $laporan->save(); // Menyimpan perubahan ke database
        }

        // Kirim data ke view
        return view('surveyor.pages.data-hasil-survei.index', compact('dataLaporan'));
    }

    public function unduhLaporan(Request $request)
    {
        // Ambil parameter pencarian
        $search = $request->input('search');
        
        // Ambil parameter filter
        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');
        $jenis_kendaraan = $request->input('jenis_kendaraan');
        $status_perkara = $request->input('status_perkara');

        // Dapatkan email user yang sedang login
        $userEmail = auth()->user()->email;

        // Tentukan status_validasi berdasarkan email yang sedang login
        $statusValidasi = '';
        if ($userEmail === 'surveyorjakartapusat@jr.com') {
            $statusValidasi = 'Jakarta Pusat';
        } elseif ($userEmail === 'surveyorjakartautara@jr.com') {
            $statusValidasi = 'Jakarta Utara';
        } elseif ($userEmail === 'surveyorjakartatimur@jr.com') {
            $statusValidasi = 'Jakarta Timur';
        } elseif ($userEmail === 'surveyorjakartabarat@jr.com') {
            $statusValidasi = 'Jakarta Barat';
        } elseif ($userEmail === 'surveyorjakartaselatan@jr.com') {
            $statusValidasi = 'Jakarta Selatan';
        }

        // Ambil data laporan dengan pencarian dan filter yang sesuai
        $dataLaporan = AdminJrDataLaporan::query();

        // Filter berdasarkan status_survei "Selesai Survei"
        $dataLaporan = $dataLaporan->where('status_survei', 'Selesai Survei');

        // Jika ada pencarian, filter berdasarkan laporan_polisi atau nomor_polisi
        if ($search) {
            $dataLaporan = $dataLaporan->where('laporan_polisi', 'like', '%' . $search . '%')
                                        ->orWhere('nomor_polisi', 'like', '%' . $search . '%');
        }

        // Jika ada filter tahun, filter berdasarkan tahun laporan
        if ($tahun) {
            $dataLaporan = $dataLaporan->whereYear('tanggal_laporan', $tahun);
        }

        // Jika ada filter bulan, filter berdasarkan bulan laporan
        if ($bulan) {
            $bulanArray = [
                'Januari' => 1,
                'Februari' => 2,
                'Maret' => 3,
                'April' => 4,
                'Mei' => 5,
                'Juni' => 6,
                'Juli' => 7,
                'Agustus' => 8,
                'September' => 9,
                'Oktober' => 10,
                'November' => 11,
                'Desember' => 12,
            ];

            $bulanAngka = $bulanArray[$bulan] ?? null;

            // Cek jika bulan valid
            if ($bulanAngka) {
                $dataLaporan = $dataLaporan->whereMonth('tanggal_laporan', $bulanAngka);
            }
        }

        // Jika ada filter jenis kendaraan
        if ($jenis_kendaraan) {
            $dataLaporan = $dataLaporan->where('jenis_kendaraan', $jenis_kendaraan);
        }

        // Jika ada filter status perkara
        if ($status_perkara) {
            $dataLaporan = $dataLaporan->where('status_perkara', $status_perkara);
        }

        // Menambahkan filter berdasarkan status_validasi sesuai dengan surveyor yang sedang login
        if ($statusValidasi) {
            $dataLaporan = $dataLaporan->where('status_validasi', $statusValidasi);
        }

        // Ambil data laporan yang sudah difilter (tanpa pagination karena akan diunduh dalam PDF)
        $dataLaporan = $dataLaporan->get();

        // Tahun sekarang
        $currentYear = now()->year;

        // Iterasi untuk menghitung estimasi tunggakan dan simpan hasilnya ke database
        foreach ($dataLaporan as $laporan) {
            // Menghitung selisih tahun antara tahun sekarang dan masa berlaku PKB/SW
            $yearsDifference = $currentYear - \Carbon\Carbon::parse($laporan->masa_berlaku_pkb_sw)->year;

            // Tentukan nominal berdasarkan jenis kendaraan
            switch ($laporan->jenis_kendaraan) {
                case 'Roda 2':
                case 'Roda 3':
                    $nominal = 35000;
                    break;
                case 'Roda 4':
                    $nominal = 143000;
                    break;
                default:
                    $nominal = 163000;  // Untuk kendaraan roda di atas 4
                    break;
            }

            // Hitung estimasi tunggakan
            $estimasiTunggakan = $yearsDifference * $nominal;

            // Simpan estimasi tunggakan ke database
            $laporan->estimasi_tunggakan = $estimasiTunggakan;
            $laporan->save(); // Menyimpan perubahan ke database
        }

        // Mengenerate PDF dari view dan data yang sudah difilter
        $pdf = PDF::loadView('surveyor.pages.data-hasil-survei.pdf', compact('dataLaporan'));

        // Unduh PDF
        return $pdf->download('laporan_data_kendaraan.pdf');
    }

}
