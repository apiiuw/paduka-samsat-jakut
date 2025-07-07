<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminJRDataLaporan extends Migration
{
    public function up()
    {
        Schema::create('admin_jr_data_kendaraan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('laporan_polisi');
            $table->date('tanggal_laporan');
            $table->date('tanggal_kejadian');
            $table->string('jenis_kendaraan');
            $table->string('nomor_polisi');
            $table->date('masa_berlaku_pkb_sw');
            $table->float('estimasi_tunggakan', 15, 2);
            $table->string('foto_barang_bukti');
            $table->text('catatan_hasil_survei')->nullable();
            $table->string('status_perkara');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('admin_jr_data_kendaraan');
    }
}
