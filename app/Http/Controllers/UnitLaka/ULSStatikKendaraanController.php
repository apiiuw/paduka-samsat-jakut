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

        $totalData = $data->count();

        // Harus buat query baru, jangan pakai $data yang sudah dipakai di atas
        $totalSelesai = UnitLakaDataKendaraan::whereYear('created_at', $tahun)
            ->where('status_perkara', 'Selesai')
            ->count();

        $totalBelumSelesai = UnitLakaDataKendaraan::whereYear('created_at', $tahun)
            ->where('status_perkara', 'Belum Selesai')
            ->count();

        // Grafik: jumlah data per bulan dalam tahun yang dipilih
        $grafikData = UnitLakaDataKendaraan::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->whereYear('created_at', $tahun)
            ->groupByRaw('MONTH(created_at)')
            ->orderBy('bulan')
            ->get();

        // Buat array data bulan 1-12 default ke 0
        $dataGrafik = array_fill(1, 12, 0);
        foreach ($grafikData as $item) {
            $dataGrafik[$item->bulan] = $item->total;
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
            'dataGrafik' => array_values($dataGrafik), // untuk chart JS
            'daftarTahun' => $daftarTahun,
        ]);
    }

    public function downloadLaporan(Request $request)
    {
        $tahun = $request->input('tahun', date('Y'));

        $data = UnitLakaDataKendaraan::whereYear('created_at', $tahun)->get();

        $csvFileName = "laporan_kendaraan_{$tahun}.csv";

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$csvFileName\"",
        ];

        $callback = function () use ($data) {
            $handle = fopen('php://output', 'w');
            // Header CSV
            fputcsv($handle, ['ID', 'Tanggal', 'Status Perkara', 'Keterangan Lain']);

            foreach ($data as $item) {
                fputcsv($handle, [
                    $item->id,
                    $item->created_at->format('Y-m-d'),
                    $item->status_perkara,
                    $item->keterangan ?? '-'
                ]);
            }

            fclose($handle);
        };

        return Response::stream($callback, 200, $headers);
    }

    public function unduhPdf(Request $request)
    {
        \Carbon\Carbon::setLocale('id');
        setlocale(LC_TIME, 'id_ID.UTF-8');  
        
        $tahun = $request->input('tahun', date('Y'));

        $data = UnitLakaDataKendaraan::whereYear('created_at', $tahun)->get();
        $totalData = $data->count();
        $totalSelesai = $data->where('status_perkara', 'Selesai')->count();
        $totalBelumSelesai = $data->where('status_perkara', 'Belum Selesai')->count();

        // Grafik base64 (gunakan Chart.js via PHP)
        $grafikData = array_fill(1, 12, 0);
        foreach ($data as $item) {
            $bulan = (int)$item->created_at->format('n');
            $grafikData[$bulan]++;
        }

        // Generate chart image via QuickChart.io (tanpa headless browser)
        $chartUrl = "https://quickchart.io/chart?c=" . urlencode(json_encode([
            'type' => 'line',
            'data' => [
                'labels' => ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
                'datasets' => [[
                    'label' => 'Jumlah Data',
                    'data' => array_values($grafikData),
                    'borderColor' => '#2563EB',
                    'backgroundColor' => 'rgba(37, 99, 235, 0.2)',
                    'fill' => true,
                ]]
            ]
        ]));

        // Ambil grafik dari quickchart
        $grafikBase64 = base64_encode(file_get_contents($chartUrl));

        $pdf = PDF::loadView('unit-laka-samsat-jakut.pages.statistik-kendaraan.pdf', compact(
            'tahun', 'data', 'totalData', 'totalSelesai', 'totalBelumSelesai', 'grafikBase64'
        ))->setPaper('a4', 'landscape');

        return $pdf->download("laporan_kendaraan_{$tahun}.pdf");
    }
}
