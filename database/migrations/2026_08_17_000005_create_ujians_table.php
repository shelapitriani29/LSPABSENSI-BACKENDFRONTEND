<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ujians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_id')->constrained('jadwals')->cascadeOnDelete();
            $table->foreignId('peserta_id')->constrained('users')->cascadeOnDelete();
            $table->dateTime('waktu_mulai')->nullable();
            $table->dateTime('waktu_selesai')->nullable();
            $table->string('status')->default('belum_dimulai');
            $table->decimal('nilai_otomatis', 8, 2)->default(0);
            $table->decimal('nilai_essay', 8, 2)->default(0);
            $table->decimal('nilai_akhir', 8, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ujians');
    }
};
