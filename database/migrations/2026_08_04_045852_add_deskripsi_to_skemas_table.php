<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
        public function up(): void
    {
        Schema::table('skemas', function (Blueprint $table) {
            $table->text('deskripsi')->nullable(); // Sesuaikan tipe data jika perlu
        });
    }

    public function down(): void
    {
        Schema::table('skemas', function (Blueprint $table) {
            $table->dropColumn('deskripsi');
        });
    }
};
