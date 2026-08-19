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
        Schema::table('users', function (Blueprint $table) {
            // Tambah kolom yang belum ada
            if (!Schema::hasColumn('users', 'nik')) {
                $table->string('nik')->nullable()->after('username');
            }
            if (!Schema::hasColumn('users', 'nip')) {
                $table->string('nip')->nullable()->after('nik');
            }
            if (!Schema::hasColumn('users', 'nis')) {
                $table->string('nis')->nullable()->after('nip');
            }
            if (!Schema::hasColumn('users', 'tempat_lahir')) {
                $table->string('tempat_lahir')->nullable()->after('name');
            }
            if (!Schema::hasColumn('users', 'tanggal_lahir')) {
                $table->date('tanggal_lahir')->nullable()->after('tempat_lahir');
            }
            if (!Schema::hasColumn('users', 'jenis_kelamin')) {
                $table->enum('jenis_kelamin', ['L', 'P'])->nullable()->after('tanggal_lahir');
            }
            if (!Schema::hasColumn('users', 'alamat')) {
                $table->text('alamat')->nullable()->after('no_hp');
            }
            if (!Schema::hasColumn('users', 'kelas')) {
                $table->string('kelas')->nullable()->after('alamat');
            }
            if (!Schema::hasColumn('users', 'jurusan')) {
                $table->string('jurusan')->nullable()->after('kelas');
            }
            if (!Schema::hasColumn('users', 'skema_kompetensi')) {
                $table->string('skema_kompetensi')->nullable()->after('jurusan');
            }
            if (!Schema::hasColumn('users', 'foto')) {
                $table->string('foto')->nullable()->after('skema_kompetensi');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = [
                'nik', 'nip', 'nis', 'tempat_lahir', 'tanggal_lahir', 
                'jenis_kelamin', 'alamat', 'kelas', 'jurusan', 
                'skema_kompetensi', 'foto'
            ];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
