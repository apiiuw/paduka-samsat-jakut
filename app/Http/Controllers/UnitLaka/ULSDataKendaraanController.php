<?php

namespace App\Http\Controllers\UnitLaka;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\UnitLakaDataKendaraan;

class ULSDataKendaraanController extends Controller
{
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
            'total_kerugian' => 'required|string',
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
