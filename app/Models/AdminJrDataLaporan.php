<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AdminJrDataLaporan extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $table = 'admin_jr_data_laporan';

    protected $fillable = [
        'id',
        'laporan_polisi',
        'tanggal_laporan',
        'tanggal_kejadian',
        'jenis_kendaraan_tersangka',
        'masa_berlaku_pkb_sw_tersangka',
        'nomor_polisi_tersangka',
        'estimasi_tunggakan_tersangka',
        'foto_barang_bukti_tersangka',
        'status_validasi_tersangka',
        'status_survei_tersangka',
        'catatan_hasil_survei_tersangka',
        'jenis_kendaraan',
        'masa_berlaku_pkb_sw',
        'estimasi_tunggakan',
        'nomor_polisi',
        'foto_barang_bukti',
        'status_perkara',
        'status_validasi',
        'status_survei',
        'catatan_hasil_survei',
    ];
}
