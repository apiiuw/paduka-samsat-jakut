<?php

namespace App\Http\Controllers\UnitLaka;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\UnitLakaDataKendaraan;
use Barryvdh\DomPDF\Facade\Pdf;

class ULSDataKendaraanController extends Controller
{
    public function index(Request $request)
    {
        $query = UnitLakaDataKendaraan::query();

        // Pencarian berdasarkan kolom laporan_polisi
        if ($request->filled('search')) {
            $query->where('laporan_polisi', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan tahun (ambil dari tanggal_laporan)
        if ($request->filled('tahun')) {
            $tahun = explode('/', $request->tahun)[0]; // Misalnya 2025/2026 → ambil 2025
            $query->whereYear('tanggal_laporan', $tahun);
        }

        // Filter berdasarkan bulan
        if ($request->filled('bulan')) {
            $bulanMap = [
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

            $bulan = $bulanMap[$request->bulan] ?? null;
            if ($bulan) {
                $query->whereMonth('tanggal_laporan', $bulan);
            }
        }

        // Filter jenis kendaraan
        if ($request->filled('jenis_kendaraan')) {
            $query->where('jenis_kendaraan', $request->jenis_kendaraan);
        }

        // Filter status perkara
        if ($request->filled('status_perkara')) {
            $query->where('status_perkara', $request->status_perkara);
        }

        // Ambil data dengan pagination dan query string agar filter tetap terbawa
        $dataKendaraan = $query->paginate(10)->withQueryString();

        return view('unit-laka-samsat-jakut.pages.data-kendaraan.index', compact('dataKendaraan'));
    }

    public function unduh(Request $request)
    {
        $query = UnitLakaDataKendaraan::query();

        if ($request->filled('search')) {
            $query->where('laporan_polisi', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('tahun')) {
            $tahun = explode('/', $request->tahun)[0];
            $query->whereYear('tanggal_laporan', $tahun);
        }

        if ($request->filled('bulan')) {
            $bulanMap = [
                'Januari' => 1, 'Februari' => 2, 'Maret' => 3, 'April' => 4,
                'Mei' => 5, 'Juni' => 6, 'Juli' => 7, 'Agustus' => 8,
                'September' => 9, 'Oktober' => 10, 'November' => 11, 'Desember' => 12,
            ];
            $bulan = $bulanMap[$request->bulan] ?? null;
            if ($bulan) {
                $query->whereMonth('tanggal_laporan', $bulan);
            }
        }

        if ($request->filled('jenis_kendaraan')) {
            $query->where('jenis_kendaraan', $request->jenis_kendaraan);
        }

        if ($request->filled('status_perkara')) {
            $query->where('status_perkara', $request->status_perkara);
        }

        $data = $query->get(); // Tanpa pagination karena mau PDF full

        $pdf = Pdf::loadView('unit-laka-samsat-jakut.pages.data-kendaraan.pdf', compact('data'))
                ->setPaper('A4', 'landscape');

        return $pdf->download('data-kendaraan.pdf');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_perkara' => 'required|in:Selesai,Belum Selesai',
        ]);

        $data = UnitLakaDataKendaraan::findOrFail($id);
        $data->status_perkara = $request->status_perkara;
        $data->save();

        return back()->with('success', 'Status perkara berhasil diperbarui.');
    }


    public function store(Request $request)
    {
        $request->validate([
            'laporan_polisi' => 'required|string',
            'tanggal_laporan' => 'required|date',
            'nama_korban' => 'required|string',
            'nama_tersangka' => 'nullable|string',
            'jenis_kendaraan' => 'required|string',
            'nomor_polisi' => 'required|string',
            'masa_berlaku_pkb_sw' => 'required|date',
            'total_kerugian' => 'required|numeric',
            'kode_penyidik' => 'required|string',
            'foto_barang_bukti' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'keterangan' => 'nullable|string',
            'status_perkara' => 'required|string',
        ]);

        $file = $request->file('foto_barang_bukti');
        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $path = 'data/unit-laka-samsat-jakut/data-kendaraan/';
        $file->move(public_path($path), $filename);

        UnitLakaDataKendaraan::create([
            'id' => Str::uuid(),
            'laporan_polisi' => $request->laporan_polisi,
            'tanggal_laporan' => $request->tanggal_laporan,
            'nama_korban' => $request->nama_korban,
            'nama_tersangka' => $request->nama_tersangka,
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'nomor_polisi' => $request->nomor_polisi,
            'masa_berlaku_pkb_sw' => $request->masa_berlaku_pkb_sw,
            'total_kerugian' => $request->total_kerugian,
            'kode_penyidik' => $request->kode_penyidik,
            'foto_barang_bukti' => $path . $filename,
            'keterangan' => $request->keterangan,
            'status_perkara' => $request->status_perkara,
        ]);

        return redirect()->back()->with('success', 'Data kendaraan berhasil disimpan!');
    }
}
