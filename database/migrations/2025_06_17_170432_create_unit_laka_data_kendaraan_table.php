<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitLakaDataKendaraanTable extends Migration
{
    public function up()
    {
        Schema::create('unit_laka_data_kendaraan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('laporan_polisi');
            $table->date('tanggal_laporan');
            $table->string('nama_korban');
            $table->string('nama_tersangka')->nullable();
            $table->string('jenis_kendaraan');
            $table->string('nomor_polisi');
            $table->date('masa_berlaku_pkb_sw');
            $table->string('total_kerugian');
            $table->string('kode_penyidik');
            $table->string('foto_barang_bukti');
            $table->text('keterangan')->nullable();
            $table->string('status_perkara');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('unit_laka_data_kendaraan');
    }
}
