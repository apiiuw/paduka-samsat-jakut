<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPengajuanPenghapusanKendaraan extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan oleh model
    protected $table = 'data_pengajuan_penghapusan_kendaraan';

    // Menentukan kolom mana yang dapat diisi (fillable)
    protected $fillable = [
        'nama_pemilik',
        'alamat_sesuai_identitas',
        'nik_tdp_nib_kitas_kitab',
        'no_telp',
        'email',
        'nrkb_kendaraan',
        'merek_kendaraan',
        'tipe_kendaraan',
        'jenis_kendaraan',
        'model_kendaraan',
        'tahun_pembuatan_kendaraan',
        'isi_silinder_daya_listrik_kendaraan',
        'nomor_rangka_kendaraan',
        'nomor_mesin_kendaraan',
        'warna_kendaraan',
        'bahan_bakar_sumber_energi_kendaraan',
        'warna_tnkb_kendaraan',
        'nomor_bpkb_kendaraan',
        'alasan_permohonan',
        'tanggal_form'
    ];
}
