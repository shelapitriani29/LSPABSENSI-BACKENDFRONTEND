<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('absensis')) {
            DB::statement("ALTER TABLE `absensis` MODIFY `status` ENUM('Hadir','Tidak Hadir','Terlambat','Izin','Sakit','Belum Absen','Selesai') NOT NULL DEFAULT 'Belum Absen';");
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('absensis')) {
            DB::statement("ALTER TABLE `absensis` MODIFY `status` ENUM('Hadir','Tidak Hadir','Terlambat','Izin','Sakit','Belum Absen') NOT NULL DEFAULT 'Belum Absen';");
        }
    }
};
