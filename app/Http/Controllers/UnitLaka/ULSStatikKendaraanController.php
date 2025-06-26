<?php

namespace App\Http\Controllers\UnitLaka;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UnitLakaDataKendaraan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;

class ULSStatikKendaraanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil tahun dari dropdown jika ada, kalau tidak pakai tahun sekarang
        $tahun = $request->input('tahun', date('Y'));

        $data = UnitLakaDataKendaraan::whereYear('created_at', $tahun);

        $totalData = $data->distinct('laporan_polisi')->count('laporan_polisi');

        $totalSelesai = UnitLakaDataKendaraan::whereYear('created_at', $tahun)
            ->where('status_perkara', 'Selesai')
            ->distinct('laporan_polisi')
            ->count('laporan_polisi');

        $totalBelumSelesai = UnitLakaDataKendaraan::whereYear('created_at', $tahun)
            ->where('status_perkara', 'Belum Selesai')
            ->distinct('laporan_polisi')
            ->count('laporan_polisi');

        // Grafik: jumlah data per bulan dalam tahun yang dipilih
        $grafikData = UnitLakaDataKendaraan::selectRaw('MONTH(created_at) as bulan, COUNT(DISTINCT laporan_polisi) as total')
            ->whereYear('created_at', $tahun)
            ->groupByRaw('MONTH(created_at)')
            ->orderBy('bulan')
            ->get();

        $grafikSelesai = UnitLakaDataKendaraan::selectRaw('MONTH(created_at) as bulan, COUNT(DISTINCT laporan_polisi) as total')
            ->whereYear('created_at', $tahun)
            ->where('status_perkara', 'Selesai')
            ->groupByRaw('MONTH(created_at)')
            ->orderBy('bulan')
            ->get();

        $grafikBelumSelesai = UnitLakaDataKendaraan::selectRaw('MONTH(created_at) as bulan, COUNT(DISTINCT laporan_polisi) as total')
            ->whereYear('created_at', $tahun)
            ->where('status_perkara', 'Belum Selesai')
            ->groupByRaw('MONTH(created_at)')
            ->orderBy('bulan')
            ->get();

        // Buat array data bulan 1-12 default ke 0
        $dataGrafik = array_fill(1, 12, 0);
        $dataSelesai = array_fill(1, 12, 0);
        $dataBelumSelesai = array_fill(1, 12, 0);

        foreach ($grafikData as $item) {
            $dataGrafik[$item->bulan] = $item->total;
        }
        foreach ($grafikSelesai as $item) {
            $dataSelesai[$item->bulan] = $item->total;
        }
        foreach ($grafikBelumSelesai as $item) {
            $dataBelumSelesai[$item->bulan] = $item->total;
        }

        // Ambil semua tahun tersedia dari database
        $daftarTahun = UnitLakaDataKendaraan::selectRaw('YEAR(created_at) as tahun')
            ->groupBy('tahun')
            ->orderByDesc('tahun')
            ->pluck('tahun');

        return view('unit-laka-samsat-jakut.pages.statistik-kendaraan.index', [
            'tahun' => $tahun,
            'totalData' => $totalData,
            'totalSelesai' => $totalSelesai,
            'totalBelumSelesai' => $totalBelumSelesai,
            'dataGrafik' => array_values($dataGrafik),
            'dataSelesai' => array_values($dataSelesai),
            'dataBelumSelesai' => array_values($dataBelumSelesai),
            'daftarTahun' => $daftarTahun,
        ]);
    }

    public function unduhPdf(Request $request)
    {
        \Carbon\Carbon::setLocale('id');
        setlocale(LC_TIME, 'id_ID.UTF-8');  
        
        $tahun = $request->input('tahun', date('Y'));

        $allData = UnitLakaDataKendaraan::whereYear('created_at', $tahun)->get();

        // Gabungkan data berdasarkan laporan_polisi
        $groupedData = $allData->groupBy('laporan_polisi')->values();

        $totalData = $groupedData->count();
        $totalSelesai = $groupedData->filter(fn($group) => $group->first()->status_perkara === 'Selesai')->count();
        $totalBelumSelesai = $groupedData->filter(fn($group) => $group->first()->status_perkara === 'Belum Selesai')->count();

        $grafikTotal = array_fill(1, 12, 0);
        $grafikSelesai = array_fill(1, 12, 0);
        $grafikBelumSelesai = array_fill(1, 12, 0);

        foreach ($groupedData as $group) {
            $item = $group->first();
            $bulan = (int)$item->created_at->format('n');
            $grafikTotal[$bulan]++;

            if ($item->status_perkara === 'Selesai') {
                $grafikSelesai[$bulan]++;
            } elseif ($item->status_perkara === 'Belum Selesai') {
                $grafikBelumSelesai[$bulan]++;
            }
        }

        $chartUrl = "https://quickchart.io/chart?c=" . urlencode(json_encode([
            'type' => 'line',
            'data' => [
                'labels' => ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
                'datasets' => [
                    [
                        'label' => 'Jumlah Laporan Unik',
                        'data' => array_values($grafikTotal),
                        'borderColor' => '#2563EB',
                        'backgroundColor' => 'rgba(37, 99, 235, 0.2)',
                        'fill' => true,
                    ],
                    [
                        'label' => 'Perkara Selesai',
                        'data' => array_values($grafikSelesai),
                        'borderColor' => '#16A34A', // green-600
                        'backgroundColor' => 'rgba(22, 163, 74, 0.1)',
                        'fill' => false,
                    ],
                    [
                        'label' => 'Belum Selesai',
                        'data' => array_values($grafikBelumSelesai),
                        'borderColor' => '#DC2626', // red-600
                        'backgroundColor' => 'rgba(220, 38, 38, 0.1)',
                        'fill' => false,
                    ]
                ]
            ]
        ]));
        $grafikBase64 = base64_encode(file_get_contents($chartUrl));

        $pdf = PDF::loadView('unit-laka-samsat-jakut.pages.statistik-kendaraan.pdf', [
            'tahun' => $tahun,
            'data' => $groupedData,
            'totalData' => $totalData,
            'totalSelesai' => $totalSelesai,
            'totalBelumSelesai' => $totalBelumSelesai,
            'grafikBase64' => $grafikBase64
        ])->setPaper('a4', 'landscape');

        return $pdf->download("laporan_kendaraan_{$tahun}.pdf");
    }

}
