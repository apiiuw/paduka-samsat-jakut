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
        Schema::create('surveyor_hasil_survei', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('laporan_id'); // foreign key dari AdminJrDataLaporan
            $table->string('nama_surveyor');
            $table->string('loket_surveyor');
            $table->string('nama_pemilik_kbm');
            $table->string('nopol_kbm');
            $table->string('jenis_kbm');
            $table->string('pertanyaan_1');
            $table->string('pertanyaan_2');
            $table->string('pertanyaan_3')->nullable();
            $table->string('foto_pemilik_kbm')->nullable();
            $table->string('nama_file_pdf'); // untuk menyimpan nama file hasil PDF
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveyor_hasil_survei');
    }
};
