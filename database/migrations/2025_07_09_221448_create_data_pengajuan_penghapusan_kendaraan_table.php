<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPengajuanPenghapusanKendaraanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_pengajuan_penghapusan_kendaraan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemilik');
            $table->string('alamat_sesuai_identitas');
            $table->string('nik_tdp_nib_kitas_kitab');
            $table->string('no_telp');
            $table->string('email');
            $table->string('nrkb_kendaraan');
            $table->string('merek_kendaraan');
            $table->string('tipe_kendaraan');
            $table->string('jenis_kendaraan');
            $table->string('model_kendaraan');
            $table->string('tahun_pembuatan_kendaraan');
            $table->string('isi_silinder_daya_listrik_kendaraan');
            $table->string('nomor_rangka_kendaraan');
            $table->string('nomor_mesin_kendaraan');
            $table->string('warna_kendaraan');
            $table->string('bahan_bakar_sumber_energi_kendaraan');
            $table->string('warna_tnkb_kendaraan');
            $table->string('nomor_bpkb_kendaraan');
            $table->text('alasan_permohonan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_pengajuan_penghapusan_kendaraan');
    }
}
