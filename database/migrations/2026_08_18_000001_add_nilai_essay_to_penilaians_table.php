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
            if (!Schema::hasColumn('penilaians', 'nilai_essay')) {
                $table->decimal('nilai_essay', 5, 2)->nullable()->after('hasil');
            }
            if (!Schema::hasColumn('penilaians', 'catatan_essay')) {
                $table->text('catatan_essay')->nullable()->after('nilai_essay');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penilaians', function (Blueprint $table) {
            if (Schema::hasColumn('penilaians', 'nilai_essay')) {
                $table->dropColumn('nilai_essay');
            }
            if (Schema::hasColumn('penilaians', 'catatan_essay')) {
                $table->dropColumn('catatan_essay');
            }
        });
    }
};
