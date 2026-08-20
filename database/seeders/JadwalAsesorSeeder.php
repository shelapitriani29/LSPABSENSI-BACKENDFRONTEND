<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use App\Models\Skema;
use App\Models\User;
use App\Models\Penilaian;
use Illuminate\Database\Seeder;

class JadwalAsesorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil asesor
        $asesor = User::where('role', 'asesor')->first();

        if (!$asesor) {
            echo "No asesor found. Skipping seeder.\n";
            return;
        }

        // Ambil atau buat skema
        $skema = Skema::first();
        if (!$skema) {
            $skema = Skema::create([
                'nama' => 'Junior Web Developer (JWD)',
                'kode' => 'JWD',
                'status' => 'Aktif',
            ]);
        }

        // Buat jadwal untuk asesor ini
        $jadwal = Jadwal::firstOrCreate(
            [
                'kode_jadwal' => 'JWD001',
                'asesor_id' => $asesor->id,
            ],
            [
                'skema_id' => $skema->id,
                'kelas' => 'XI RPL 1',
                'tanggal' => now()->addDay()->toDateString(),
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '12:00:00',
                'lokasi' => 'Lab Komputer 1',
                'status' => 'Akan Datang',
                'passing_grade' => 75,
            ]
        );

        echo "Jadwal created/found with ID: {$jadwal->id}\n";

        echo "Jadwal created successfully without demo participant accounts.\n";
    }
}
