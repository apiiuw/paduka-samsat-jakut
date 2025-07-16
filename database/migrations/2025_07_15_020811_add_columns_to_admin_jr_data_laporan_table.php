<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('admin_jr_data_laporan', function (Blueprint $table) {
            // Menambahkan kolom untuk Masa Berlaku PKB/SW Tersangka dan Foto Barang Bukti Tersangka
            $table->date('masa_berlaku_pkb_sw_tersangka')->nullable();
            $table->string('foto_barang_bukti_tersangka')->nullable();
        });
    }

    public function down()
    {
        Schema::table('admin_jr_data_laporan', function (Blueprint $table) {
            $table->dropColumn('masa_berlaku_pkb_sw_tersangka');
            $table->dropColumn('foto_barang_bukti_tersangka');
        });
    }

};
