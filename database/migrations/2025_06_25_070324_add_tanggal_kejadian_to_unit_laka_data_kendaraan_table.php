<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('unit_laka_data_kendaraan', function (Blueprint $table) {
            $table->date('tanggal_kejadian')->after('tanggal_laporan')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('unit_laka_data_kendaraan', function (Blueprint $table) {
            $table->dropColumn('tanggal_kejadian');
        });
    }
};
