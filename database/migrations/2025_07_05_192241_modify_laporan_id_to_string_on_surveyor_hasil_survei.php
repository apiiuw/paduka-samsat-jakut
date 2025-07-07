<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('surveyor_hasil_survei', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->string('laporan_id')->change(); // ubah kolom menjadi string
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('surveyor_hasil_survei', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->unsignedBigInteger('laporan_id')->change(); // rollback ke integer kalau perlu
        });
    }
};
