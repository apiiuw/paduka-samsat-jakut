<?php

namespace App\Http\Controllers\UnitLaka;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\UnitLakaDataKendaraan;
use App\Models\AdminJrDataLaporan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Pagination\LengthAwarePaginator;

class ULSDataKendaraanController extends Controller
{
    public function index(Request $request)
    {
        $query = UnitLakaDataKendaraan::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('laporan_polisi', 'like', '%' . $request->search . '%')
                ->orWhere('nomor_polisi', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('tahun')) {
            $tahun = explode('/', $request->tahun)[0];
            $query->whereYear('tanggal_laporan', $tahun);
        }

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

        $query->orderBy('laporan_polisi', 'asc');

        // Ambil semua data
        $allData = $query->get();

        // Grouping by laporan_polisi
        $groupedData = $allData->groupBy('laporan_polisi');

        // Ambil semua grup sebagai array
        $groupArray = $groupedData->all();

        // Pagination setup
        $page = request('page', 1);
        $perPage = 10;
        $offset = ($page - 1) * $perPage;

        // Ambil slice per halaman
        $pagedGroup = array_slice($groupArray, $offset, $perPage, true);

        // Buat paginator
        $paginator = new LengthAwarePaginator(
            $pagedGroup,
            count($groupArray),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('unit-laka-samsat-jakut.pages.data-kendaraan.index', [
            'dataKendaraan' => collect($paginator->items()), // Koleksi data per halaman
            'paginator' => $paginator
        ]);
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

        $query->orderBy('laporan_polisi', 'asc');

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
    
        // Ambil data dari UnitLakaDataKendaraan berdasarkan id
        $unitLakaData = UnitLakaDataKendaraan::findOrFail($id);
    
        // Ambil laporan_polisi dari data yang ditemukan
        $laporanPolisi = $unitLakaData->laporan_polisi;
    
        // Update status_perkara pada UnitLakaDataKendaraan yang memiliki laporan_polisi yang sama
        UnitLakaDataKendaraan::where('laporan_polisi', $laporanPolisi)
            ->update(['status_perkara' => $request->status_perkara]);
    
        // Update status_perkara pada AdminJrDataLaporan yang memiliki laporan_polisi yang sama
        AdminJrDataLaporan::where('laporan_polisi', $laporanPolisi)
            ->update(['status_perkara' => $request->status_perkara]);
    
        return back()->with('success', 'Status perkara berhasil diperbarui di UnitLakaDataKendaraan dan AdminJrDataLaporan.');
    }

    public function updateStatusKendaraanTersangka(Request $request, $id)
    {
        $request->validate([
            'status_kendaraan_tersangka' => 'required|in:Sudah Dikembalikan,Belum Dikembalikan',
        ]);

        // Ambil data UnitLakaDataKendaraan berdasarkan id
        $data = UnitLakaDataKendaraan::findOrFail($id);

        // Ambil laporan_polisi dari data yang ditemukan
        $laporanPolisi = $data->laporan_polisi;

        // Update status_kendaraan_tersangka pada semua data UnitLakaDataKendaraan yang memiliki laporan_polisi yang sama
        UnitLakaDataKendaraan::where('laporan_polisi', $laporanPolisi)
            ->update(['status_kendaraan_tersangka' => $request->status_kendaraan_tersangka]);  // Update status kendaraan tersangka

        return back()->with('success', 'Status kendaraan tersangka berhasil diperbarui di seluruh laporan dengan Laporan Polisi yang sama.');
    }

    public function updateStatusKendaraanKorban(Request $request, $id)
    {
        $request->validate([
            'status_kendaraan_korban' => 'required|in:Sudah Dikembalikan,Belum Dikembalikan',
        ]);

        // Ambil data UnitLakaDataKendaraan berdasarkan id
        $data = UnitLakaDataKendaraan::findOrFail($id);

        // Update status_kendaraan_korban pada data kendaraan yang spesifik
        $data->update([
            'status_kendaraan_korban' => $request->status_kendaraan_korban,
        ]);

        return back()->with('success', 'Status kendaraan korban berhasil diperbarui.');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'laporan_polisi' => 'required|string',
            'tanggal_laporan' => 'required|date',
            'tanggal_kejadian' => 'required|date',
            'kode_penyidik' => 'required|string',
            'status_perkara' => 'required|string',

            // tambahan baru
            'nama_tersangka_global' => 'nullable|string',
            'nomor_polisi_tersangka' => 'nullable|string',
            'jenis_kendaraan_tersangka' => 'nullable|string',
            'masa_berlaku_pkb_sw_tersangka' => 'nullable|date',
            'foto_barang_bukti_tersangka' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'nama_korban' => 'required|array',
            'nama_korban.*' => 'required|string',

            'jenis_kendaraan' => 'required|array',
            'jenis_kendaraan.*' => 'required|string',

            'nomor_polisi' => 'required|array',
            'nomor_polisi.*' => 'required|string',

            'masa_berlaku_pkb_sw' => 'nullable|array',
            'masa_berlaku_pkb_sw.*' => 'nullable|date',

            'total_kerugian' => 'required|array',
            'total_kerugian.*' => 'required|numeric',

            'foto_barang_bukti' => 'nullable|array',
            'foto_barang_bukti.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'keterangan' => 'nullable|array',
            'keterangan.*' => 'nullable|string',
        ]);

        // Proses upload foto tersangka
        $fotoTersangkaPath = null;
        if ($request->hasFile('foto_barang_bukti_tersangka')) {
            $file = $request->file('foto_barang_bukti_tersangka');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $path = 'data/unit-laka-samsat-jakut/data-kendaraan/';
            $file->move(public_path($path), $filename);
            $fotoTersangkaPath = $path . $filename;
        }

        // Simpan data kendaraan
        $jumlahKendaraan = count($request->nama_korban);

        for ($i = 0; $i < $jumlahKendaraan; $i++) {
            // Cek apakah foto barang bukti tersedia untuk korban
            if ($request->hasFile('foto_barang_bukti.' . $i)) {
                $file = $request->file('foto_barang_bukti')[$i];
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $path = 'data/unit-laka-samsat-jakut/data-kendaraan/';
                $file->move(public_path($path), $filename);
                $fotoPath = $path . $filename;
            } else {
                $fotoPath = null;
            }

            // Simpan data kendaraan (untuk tabel UnitLakaDataKendaraan)
            UnitLakaDataKendaraan::create([
                'id' => Str::uuid(),
                'laporan_polisi' => $request->laporan_polisi,
                'tanggal_laporan' => $request->tanggal_laporan,
                'tanggal_kejadian' => $request->tanggal_kejadian,
                'kode_penyidik' => $request->kode_penyidik,
                'status_perkara' => $request->status_perkara,
                'status_kendaraan_korban' => 'Belum Dikembalikan', // Status kendaraan korban
                'status_kendaraan_tersangka' => 'Belum Dikembalikan', // Status kendaraan tersangka
                'nama_tersangka' => $request->nama_tersangka_global ?? null,
                'nomor_polisi_tersangka' => $request->nomor_polisi_tersangka,
                'jenis_kendaraan_tersangka' => $request->jenis_kendaraan_tersangka,
                'nama_korban' => $request->nama_korban[$i],
                'jenis_kendaraan' => $request->jenis_kendaraan[$i],
                'nomor_polisi' => $request->nomor_polisi[$i],
                'masa_berlaku_pkb_sw' => $request->masa_berlaku_pkb_sw[$i],
                'masa_berlaku_pkb_sw_tersangka' => $request->masa_berlaku_pkb_sw_tersangka,
                'total_kerugian' => $request->total_kerugian[$i],
                'foto_barang_bukti' => $fotoPath,
                'foto_barang_bukti_tersangka' => $fotoTersangkaPath,
                'keterangan' => $request->keterangan[$i] ?? null,
            ]);

            // Simpan data ke AdminJrDataLaporan (untuk data korban dan tersangka dalam 1 create)
            AdminJrDataLaporan::create([
                'id' => Str::uuid(),
                'laporan_polisi' => $request->laporan_polisi,
                'tanggal_laporan' => $request->tanggal_laporan,
                'tanggal_kejadian' => $request->tanggal_kejadian,
                'jenis_kendaraan' => $request->jenis_kendaraan[$i], // Data korban
                'masa_berlaku_pkb_sw' => $request->masa_berlaku_pkb_sw[$i], // Data korban
                'nomor_polisi' => $request->nomor_polisi[$i], // Data korban
                'foto_barang_bukti' => $fotoPath, // Data korban
                'status_perkara' => $request->status_perkara,
                'estimasi_tunggakan' => null,
                'catatan_hasil_survei' => null,

                // Data tersangka (sama di dalam 1 create)
                'jenis_kendaraan_tersangka' => $request->jenis_kendaraan_tersangka, // Data tersangka
                'masa_berlaku_pkb_sw_tersangka' => $request->masa_berlaku_pkb_sw_tersangka, // Data tersangka
                'nomor_polisi_tersangka' => $request->nomor_polisi_tersangka, // Data tersangka
                'foto_barang_bukti_tersangka' => $fotoTersangkaPath, // Data tersangka
            ]);
        }

        return redirect()->back()->with('success', 'Data kendaraan berhasil disimpan!');
    }


}