<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->string('kode_jadwal')->unique();
            $table->foreignId('skema_id')->nullable()->constrained('skemas')->cascadeOnDelete();
            $table->string('kelas')->nullable();
            $table->foreignId('asesor_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->date('tanggal')->nullable();
            $table->time('jam_mulai')->nullable();
            $table->time('jam_selesai')->nullable();
            $table->string('lokasi')->nullable();
            $table->text('keterangan')->nullable();
            $table->enum('status', ['Akan Datang', 'Aktif', 'Selesai'])->default('Akan Datang');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
