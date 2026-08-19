<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('soals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategori_soals')->cascadeOnDelete();
            $table->text('pertanyaan');
            $table->string('tipe_soal');
            $table->string('tingkat_kesulitan')->nullable();
            $table->integer('poin')->default(0);
            $table->string('jawaban_benar')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('soals');
    }
};
