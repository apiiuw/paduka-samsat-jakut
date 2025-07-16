<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('unit_laka_data_kendaraan', function (Blueprint $table) {
            $table->string('nomor_polisi_tersangka')->nullable();
            $table->string('jenis_kendaraan_tersangka')->nullable();
        });
    }

    public function down()
    {
        Schema::table('unit_laka_data_kendaraan', function (Blueprint $table) {
            $table->dropColumn(['nomor_polisi_tersangka', 'jenis_kendaraan_tersangka']);
        });
    }
};
