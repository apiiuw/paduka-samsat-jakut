<?php

namespace App\Http\Controllers\Surveyor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminJrDataLaporan;
use App\Models\SurveyorHasilSurvei;
use PDF;

class SDataWajibSurveiController extends Controller
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
        return view('surveyor.pages.data-survei.index', compact('dataLaporan'));
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
        $pdf = PDF::loadView('surveyor.pages.data-survei.pdf', compact('dataLaporan'));

        // Unduh PDF
        return $pdf->download('laporan_data_kendaraan.pdf');
    }


    public function updateStatusSurvei(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'status_survei' => 'nullable|string|in:Selesai Survei,Belum Survei',
        ]);

        // Cari laporan berdasarkan ID
        $laporan = AdminJrDataLaporan::findOrFail($id);

        // Update status survei
        $laporan->status_survei = $request->input('status_survei', $laporan->status_survei);

        // Simpan perubahan
        $laporan->save();

        // Kembali ke halaman sebelumnya
        return redirect()->back()->with('success', 'Status Survei berhasil diperbarui.');
    }

    public function updateCatatan(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'catatan_hasil_survei' => 'required|string',
        ]);

        // Cari laporan berdasarkan ID
        $laporan = AdminJrDataLaporan::find($id);
        
        // Update catatan
        $laporan->catatan_hasil_survei = $validated['catatan_hasil_survei'];
        $laporan->status_survei = 'Selesai Survei';
        $laporan->save();

        // Kembali ke halaman sebelumnya
        return redirect()->back()->with('success', 'Catatan berhasil disimpan dan status survei diperbarui');
    }

    public function input($id)
    {
        $data = AdminJrDataLaporan::findOrFail($id); // cari data berdasarkan ID, error kalau tidak ditemukan

        return view('surveyor.pages.data-survei.input-hasil-survei.index', compact('data'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'laporan_id' => 'required|exists:admin_jr_data_laporan,id',
            'nama_surveyor' => 'required|string',
            'loket_surveyor' => 'required|string',
            'nama_pemilik_kbm' => 'required|string',
            'nopol_kbm' => 'required|string',
            'jenis_kbm' => 'required|string',
            'pertanyaan_1' => 'required|string',
            'pertanyaan_2' => 'required|string',
            'pertanyaan_3' => 'nullable|string',
            'foto_pemilik_kbm' => 'nullable|image|max:2048',
        ]);

        // Simpan foto jika ada
        $fotoPath = null;
        if ($request->hasFile('foto_pemilik_kbm')) {
            $fotoPath = $request->file('foto_pemilik_kbm')->store('foto-kbm', 'public');
        }

        // Simpan data hasil survei ke tabel surveyor_hasil_survei
        $hasilSurvei = SurveyorHasilSurvei::create([
            'laporan_id' => $validated['laporan_id'],
            'nama_surveyor' => $validated['nama_surveyor'],
            'loket_surveyor' => $validated['loket_surveyor'],
            'nama_pemilik_kbm' => $validated['nama_pemilik_kbm'],
            'nopol_kbm' => $validated['nopol_kbm'],
            'jenis_kbm' => $validated['jenis_kbm'],
            'pertanyaan_1' => $validated['pertanyaan_1'],
            'pertanyaan_2' => $validated['pertanyaan_2'],
            'pertanyaan_3' => $validated['pertanyaan_3'] ?? null,
            'foto_pemilik_kbm' => $fotoPath,
            'nama_file_pdf' => '', // diisi nanti
        ]);

        // Generate PDF dari data hasil survei
        $pdf = PDF::loadView('surveyor.pages.data-survei.input-hasil-survei.pdf', ['data' => $hasilSurvei]);
        $pdfName = $hasilSurvei->id . '.pdf'; // Nama file berdasarkan ID hasil survei
        $pdfPath = public_path("data/hasil-survei/{$pdfName}");

        // Membuat folder jika belum ada
        if (!file_exists(public_path('data/hasil-survei'))) {
            mkdir(public_path('data/hasil-survei'), 0775, true);
        }

        // Simpan PDF ke disk
        $pdf->save($pdfPath);

        // Update lokasi file PDF di tabel surveyor_hasil_survei
        $hasilSurvei->update([
            'nama_file_pdf' => $pdfName,
        ]);

        // Update kolom catatan_hasil_survei di tabel AdminJrDataLaporan dengan lokasi file PDF
        $laporan = AdminJrDataLaporan::find($validated['laporan_id']);
        $laporan->catatan_hasil_survei = "data/hasil-survei/{$pdfName}"; // Simpan lokasi file PDF
        $laporan->status_survei = "Selesai Survei"; 
        $laporan->save();

        return redirect()->route('surveyor.data-survei.index')->with('success', 'Data berhasil disimpan dan file PDF tercatat.');
    }

}
