<?php

namespace App\Http\Controllers\AdminJR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminJrDataLaporan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;


class AdminStatistikLaporanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil tahun dari dropdown jika ada, kalau tidak pakai tahun sekarang
        $tahun = $request->input('tahun', null); // jika null berarti tidak memilih tahun

        // Jika tidak ada tahun yang dipilih, ambil data keseluruhan
        if (!$tahun) {
            $data = AdminJrDataLaporan::query(); // Mengambil semua data jika tidak memilih tahun
        } else {
            // Jika tahun dipilih, filter berdasarkan tahun
            $data = AdminJrDataLaporan::whereYear('tanggal_laporan', $tahun);
        }

        // Total Laporan berdasarkan laporan_polisi yang unik
        $totalLaporan = $data->distinct('laporan_polisi')->count('laporan_polisi'); // Menggunakan distinct untuk laporan unik

        // Total Laporan dengan status_survei "Selesai Survei"
        $totalSelesai = AdminJrDataLaporan::when($tahun, fn($q) => $q->whereYear('tanggal_laporan', $tahun))
            ->where('status_survei', 'Selesai Survei')
            ->count();

        // Total Laporan dengan status_survei "Belum Survei"
        $totalBelumSurvei = AdminJrDataLaporan::when($tahun, fn($q) => $q->whereYear('tanggal_laporan', $tahun))
            ->where('status_survei', 'Belum Survei')
            ->count();

        // Data Grafik: Jumlah laporan per bulan untuk tahun yang dipilih atau seluruh data jika tidak memilih tahun
        $grafikData = AdminJrDataLaporan::selectRaw('MONTH(tanggal_laporan) as bulan, COUNT(DISTINCT laporan_polisi) as total')
            ->when($tahun, fn($q) => $q->whereYear('tanggal_laporan', $tahun)) // Filter tahun diterapkan disini
            ->groupByRaw('MONTH(tanggal_laporan)')
            ->orderBy('bulan')
            ->get();

        // Data Grafik "Selesai Survei"
        $grafikSelesai = AdminJrDataLaporan::selectRaw('MONTH(tanggal_laporan) as bulan, COUNT(laporan_polisi) as total')
            ->when($tahun, fn($q) => $q->whereYear('tanggal_laporan', $tahun)) // Filter tahun diterapkan disini
            ->where('status_survei', 'Selesai Survei')
            ->groupByRaw('MONTH(tanggal_laporan)')
            ->orderBy('bulan')
            ->get();

        // Data Grafik "Belum Survei"
        $grafikBelumSurvei = AdminJrDataLaporan::selectRaw('MONTH(tanggal_laporan) as bulan, COUNT(laporan_polisi) as total')
            ->when($tahun, fn($q) => $q->whereYear('tanggal_laporan', $tahun)) // Filter tahun diterapkan disini
            ->where('status_survei', 'Belum Survei')
            ->groupByRaw('MONTH(tanggal_laporan)')
            ->orderBy('bulan')
            ->get();

        // Buat array data bulan 1-12 dengan nilai default 0
        $dataGrafik = array_fill(1, 12, 0);
        $dataSelesai = array_fill(1, 12, 0);
        $dataBelumSurvei = array_fill(1, 12, 0);

        // Mengisi data untuk grafik
        foreach ($grafikData as $item) {
            $dataGrafik[$item->bulan] = $item->total;
        }
        foreach ($grafikSelesai as $item) {
            $dataSelesai[$item->bulan] = $item->total;
        }
        foreach ($grafikBelumSurvei as $item) {
            $dataBelumSurvei[$item->bulan] = $item->total;
        }

        // Ambil daftar tahun yang tersedia dari database
        $daftarTahun = AdminJrDataLaporan::selectRaw('YEAR(tanggal_laporan) as tahun')
            ->groupBy('tahun')
            ->orderByDesc('tahun')
            ->pluck('tahun');

        // Kirim data ke view
        return view('jasa-raharja.pages.statistik-laporan.index', [
            'tahun' => $tahun,
            'totalLaporan' => $totalLaporan,
            'totalSelesai' => $totalSelesai,
            'totalBelumSurvei' => $totalBelumSurvei,
            'dataGrafik' => array_values($dataGrafik),
            'dataSelesai' => array_values($dataSelesai),
            'dataBelumSurvei' => array_values($dataBelumSurvei),
            'daftarTahun' => $daftarTahun,
        ]);
    }

public function unduhPdf(Request $request)
{
    \Carbon\Carbon::setLocale('id');
    setlocale(LC_TIME, 'id_ID.UTF-8');  

    // Ambil tahun dari dropdown jika ada, kalau tidak pakai tahun sekarang
    $tahun = $request->input('tahun', null); // jika null berarti tidak memilih tahun

    // Jika tidak ada tahun yang dipilih, ambil data keseluruhan
    if (!$tahun) {
        $data = AdminJrDataLaporan::query(); // Mengambil semua data jika tidak memilih tahun
    } else {
        // Jika tahun dipilih, filter berdasarkan tahun
        $data = AdminJrDataLaporan::whereYear('tanggal_laporan', $tahun);
    }

    // Total Laporan berdasarkan laporan_polisi yang unik
    $totalLaporan = $data->distinct('laporan_polisi')->count('laporan_polisi'); // Menggunakan distinct untuk laporan unik

    // Total Laporan dengan status_survei "Selesai Survei"
    $totalSelesai = AdminJrDataLaporan::when($tahun, fn($q) => $q->whereYear('tanggal_laporan', $tahun))
        ->where('status_survei', 'Selesai Survei')
        ->count();

    // Total Laporan dengan status_survei "Belum Survei"
    $totalBelumSurvei = AdminJrDataLaporan::when($tahun, fn($q) => $q->whereYear('tanggal_laporan', $tahun))
        ->where('status_survei', 'Belum Survei')
        ->count();

    // Data Grafik: Jumlah laporan per bulan untuk tahun yang dipilih atau seluruh data jika tidak memilih tahun
    $grafikData = AdminJrDataLaporan::selectRaw('MONTH(tanggal_laporan) as bulan, COUNT(DISTINCT laporan_polisi) as total')
        ->when($tahun, fn($q) => $q->whereYear('tanggal_laporan', $tahun)) // Filter tahun diterapkan disini
        ->groupByRaw('MONTH(tanggal_laporan)')
        ->orderBy('bulan')
        ->get();

    // Data Grafik "Selesai Survei"
    $grafikSelesai = AdminJrDataLaporan::selectRaw('MONTH(tanggal_laporan) as bulan, COUNT(laporan_polisi) as total')
        ->when($tahun, fn($q) => $q->whereYear('tanggal_laporan', $tahun)) // Filter tahun diterapkan disini
        ->where('status_survei', 'Selesai Survei')
        ->groupByRaw('MONTH(tanggal_laporan)')
        ->orderBy('bulan')
        ->get();

    // Data Grafik "Belum Survei"
    $grafikBelumSurvei = AdminJrDataLaporan::selectRaw('MONTH(tanggal_laporan) as bulan, COUNT(laporan_polisi) as total')
        ->when($tahun, fn($q) => $q->whereYear('tanggal_laporan', $tahun)) // Filter tahun diterapkan disini
        ->where('status_survei', 'Belum Survei')
        ->groupByRaw('MONTH(tanggal_laporan)')
        ->orderBy('bulan')
        ->get();

    // Buat array data bulan 1-12 dengan nilai default 0
    $dataGrafik = array_fill(1, 12, 0);
    $dataSelesai = array_fill(1, 12, 0);
    $dataBelumSurvei = array_fill(1, 12, 0);

    // Mengisi data untuk grafik
    foreach ($grafikData as $item) {
        $dataGrafik[$item->bulan] = $item->total;
    }
    foreach ($grafikSelesai as $item) {
        $dataSelesai[$item->bulan] = $item->total;
    }
    foreach ($grafikBelumSurvei as $item) {
        $dataBelumSurvei[$item->bulan] = $item->total;
    }

    // Ambil daftar tahun yang tersedia dari database
    $daftarTahun = AdminJrDataLaporan::selectRaw('YEAR(tanggal_laporan) as tahun')
        ->groupBy('tahun')
        ->orderByDesc('tahun')
        ->pluck('tahun');

    // Membuat grafik (pastikan ini sesuai dengan format grafik yang Anda ingin tampilkan)
    $chartUrl = "https://quickchart.io/chart?c=" . urlencode(json_encode([ 
        'type' => 'line',
        'data' => [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            'datasets' => [
                [
                    'label' => 'Jumlah Laporan Unik',
                    'data' => array_values($dataGrafik),
                    'borderColor' => '#2563EB',
                    'backgroundColor' => 'rgba(37, 99, 235, 0.2)',
                    'fill' => true,
                ],
                [
                    'label' => 'Perkara Selesai',
                    'data' => array_values($dataSelesai),
                    'borderColor' => '#16A34A', // green-600
                    'backgroundColor' => 'rgba(22, 163, 74, 0.1)',
                    'fill' => false,
                ],
                [
                    'label' => 'Belum Selesai',
                    'data' => array_values($dataBelumSurvei),
                    'borderColor' => '#DC2626', // red-600
                    'backgroundColor' => 'rgba(220, 38, 38, 0.1)',
                    'fill' => false,
                ]
            ]
        ]
    ]));
    $grafikBase64 = base64_encode(file_get_contents($chartUrl));

    // Menghasilkan PDF dari view yang sesuai
    $pdf = PDF::loadView('jasa-raharja.pages.statistik-laporan.pdf', [
        'tahun' => $tahun,
        'totalLaporan' => $totalLaporan,
        'totalSelesai' => $totalSelesai,
        'totalBelumSurvei' => $totalBelumSurvei,
        'grafikBase64' => $grafikBase64,
        'data' => $data,  // Menggunakan koleksi langsung tanpa memanggil get()
    ])->setPaper('a4', 'landscape');

    return $pdf->download("laporan_statistik_{$tahun}.pdf");
}

}

