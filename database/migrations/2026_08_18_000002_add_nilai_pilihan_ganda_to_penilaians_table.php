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
        Schema::table('penilaians', function (Blueprint $table) {
            if (!Schema::hasColumn('penilaians', 'nilai_pilihan_ganda')) {
                $table->decimal('nilai_pilihan_ganda', 5, 2)->nullable()->after('hasil');
            }
            if (!Schema::hasColumn('penilaians', 'catatan_pilihan_ganda')) {
                $table->text('catatan_pilihan_ganda')->nullable()->after('nilai_pilihan_ganda');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penilaians', function (Blueprint $table) {
            if (Schema::hasColumn('penilaians', 'nilai_pilihan_ganda')) {
                $table->dropColumn('nilai_pilihan_ganda');
            }
            if (Schema::hasColumn('penilaians', 'catatan_pilihan_ganda')) {
                $table->dropColumn('catatan_pilihan_ganda');
            }
        });
    }
};
