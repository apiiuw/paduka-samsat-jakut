<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::table('admin_jr_data_laporan', function (Blueprint $table) {
        $table->string('jenis_kendaraan_tersangka')->nullable();
        $table->date('masa_berlaku_pkb_sw_tersangka')->nullable();
        $table->string('nomor_polisi_tersangka')->nullable();
        $table->string('foto_barang_bukti_tersangka')->nullable();
    });
}

public function down()
{
    Schema::table('admin_jr_data_laporan', function (Blueprint $table) {
        $table->dropColumn(['jenis_kendaraan_tersangka', 'masa_berlaku_pkb_sw_tersangka', 'nomor_polisi_tersangka', 'foto_barang_bukti_tersangka']);
    });
}

};
