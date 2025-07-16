<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('unit_laka_data_kendaraan', function (Blueprint $table) {
            // Menambahkan kolom status_kendaraan_tersangka dengan default "Belum Dikembalikan"
            $table->string('status_kendaraan_tersangka')->default('Belum Dikembalikan');
        });
    }

    public function down()
    {
        Schema::table('unit_laka_data_kendaraan', function (Blueprint $table) {
            $table->dropColumn('status_kendaraan_tersangka');
        });
    }

};
