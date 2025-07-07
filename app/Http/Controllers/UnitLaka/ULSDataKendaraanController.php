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

        // Pencarian berdasarkan kolom laporan_polisi atau nomor_polisi
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('laporan_polisi', 'like', '%' . $request->search . '%')
                ->orWhere('nomor_polisi', 'like', '%' . $request->search . '%');
            });
        }

        // Filter berdasarkan tahun
        if ($request->filled('tahun')) {
            $tahun = explode('/', $request->tahun)[0];
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

        // Ambil data yang sedang dipilih
        $data = UnitLakaDataKendaraan::findOrFail($id);

        // Ambil semua data dengan nomor laporan yang sama
        UnitLakaDataKendaraan::where('laporan_polisi', $data->laporan_polisi)
            ->update(['status_perkara' => $request->status_perkara]);

        return back()->with('success', 'Semua status perkara dengan nomor laporan yang sama berhasil diperbarui.');
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

            'nama_korban' => 'required|array',
            'nama_korban.*' => 'required|string',

            'nama_tersangka' => 'nullable|array',
            'nama_tersangka.*' => 'nullable|string',

            'jenis_kendaraan' => 'required|array',
            'jenis_kendaraan.*' => 'required|string',

            'nomor_polisi' => 'required|array',
            'nomor_polisi.*' => 'required|string',

            'masa_berlaku_pkb_sw' => 'required|array',
            'masa_berlaku_pkb_sw.*' => 'required|date',

            'total_kerugian' => 'required|array',
            'total_kerugian.*' => 'required|numeric',

            'foto_barang_bukti' => 'required|array',
            'foto_barang_bukti.*' => 'required|image|mimes:jpg,jpeg,png|max:2048',

            'keterangan' => 'nullable|array',
            'keterangan.*' => 'nullable|string',
        ]);

        $jumlahKendaraan = count($request->nama_korban);

        // Loop untuk menyimpan data kendaraan
        for ($i = 0; $i < $jumlahKendaraan; $i++) {
            // Cek apakah file tersedia
            if ($request->hasFile('foto_barang_bukti.' . $i)) {
                $file = $request->file('foto_barang_bukti')[$i];
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $path = 'data/unit-laka-samsat-jakut/data-kendaraan/';
                $file->move(public_path($path), $filename);
                $fotoPath = $path . $filename;
            } else {
                $fotoPath = null; // Jaga-jaga, tapi harusnya selalu ada
            }

            // Simpan data ke UnitLakaDataKendaraan
            UnitLakaDataKendaraan::create([
                'id' => Str::uuid(),
                'laporan_polisi' => $request->laporan_polisi,
                'tanggal_laporan' => $request->tanggal_laporan,
                'tanggal_kejadian' => $request->tanggal_kejadian,
                'kode_penyidik' => $request->kode_penyidik,
                'status_perkara' => $request->status_perkara,

                'nama_korban' => $request->nama_korban[$i],
                'nama_tersangka' => $request->nama_tersangka[$i] ?? null,
                'jenis_kendaraan' => $request->jenis_kendaraan[$i],
                'nomor_polisi' => $request->nomor_polisi[$i],
                'masa_berlaku_pkb_sw' => $request->masa_berlaku_pkb_sw[$i],
                'total_kerugian' => $request->total_kerugian[$i],
                'foto_barang_bukti' => $fotoPath,
                'keterangan' => $request->keterangan[$i] ?? null,
            ]);

            // Simpan data ke AdminJrDataLaporan
            AdminJrDataLaporan::create([
                'id' => Str::uuid(),
                'laporan_polisi' => $request->laporan_polisi,
                'tanggal_laporan' => $request->tanggal_laporan,
                'tanggal_kejadian' => $request->tanggal_kejadian,
                'jenis_kendaraan' => $request->jenis_kendaraan[$i],
                'masa_berlaku_pkb_sw' => $request->masa_berlaku_pkb_sw[$i],
                'nomor_polisi' => $request->nomor_polisi[$i],
                'foto_barang_bukti' => $fotoPath,
                'status_perkara' => $request->status_perkara,
                'estimasi_tunggakan' => null, // Kosongkan estimasi tunggakan, bisa diisi nanti
                'catatan_hasil_survei' => null, // Kosongkan catatan hasil survei, bisa diisi nanti
            ]);
        }

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Data kendaraan berhasil disimpan!');
    }


}