<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitLakaDataKendaraan extends Model
{
    public $incrementing = false; // karena id-nya UUID, bukan auto-increment

    protected $table = 'unit_laka_data_kendaraan';

    protected $fillable = [
        'id',
        'laporan_polisi',
        'tanggal_laporan',
        'tanggal_kejadian',
        'nama_tersangka',
        'jenis_kendaraan_tersangka',
        'nomor_polisi_tersangka',
        'masa_berlaku_pkb_sw_tersangka',
        'foto_barang_bukti_tersangka',
        'status_kendaraan_tersangka',
        'nama_korban',
        'jenis_kendaraan',
        'nomor_polisi',
        'masa_berlaku_pkb_sw',
        'total_kerugian',
        'kode_penyidik',
        'foto_barang_bukti',
        'keterangan',
        'status_kendaraan_korban',
        'status_perkara',
    ];
}
