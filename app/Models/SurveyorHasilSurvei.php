<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyorHasilSurvei extends Model
{
    use HasFactory;

    protected $table = 'surveyor_hasil_survei';

    protected $fillable = [
        'laporan_id',
        'nama_surveyor',
        'loket_surveyor',
        'nama_pemilik_kbm',
        'nopol_kbm',
        'jenis_kbm',
        'pertanyaan_1',
        'pertanyaan_2',
        'pertanyaan_3',
        'foto_pemilik_kbm',
        'nama_file_pdf',
    ];
}
