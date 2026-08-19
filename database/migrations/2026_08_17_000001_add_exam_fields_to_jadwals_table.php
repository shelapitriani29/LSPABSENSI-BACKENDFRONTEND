<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jadwals', function (Blueprint $table) {
            $table->integer('passing_grade')->nullable()->after('status');
            $table->integer('durasi_ujian')->nullable()->after('passing_grade');
        });
    }

    public function down(): void
    {
        Schema::table('jadwals', function (Blueprint $table) {
            $table->dropColumn(['passing_grade', 'durasi_ujian']);
        });
    }
};
