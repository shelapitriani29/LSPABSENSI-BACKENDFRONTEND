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

        // Buat beberapa peserta untuk kelas ini
        for ($i = 1; $i <= 3; $i++) {
            $peserta = User::firstOrCreate(
                ['username' => "peserta_jwdtest_{$i}"],
                [
                    'name' => "Peserta JWD Test {$i}",
                    'email' => "peserta_jwdtest_{$i}@lsp.sch.id",
                    'password' => bcrypt('password'),
                    'role' => 'peserta',
                    'kelas' => 'XI RPL 1',
                    'status' => 'Aktif',
                ]
            );

            // Buat penilaian untuk peserta
            Penilaian::firstOrCreate(
                [
                    'user_id' => $peserta->id,
                    'jadwal_id' => $jadwal->id,
                ],
                [
                    'asesor_id' => $asesor->id,
                    'hasil' => $i === 1 ? 'Belum Kompeten' : 'Kompeten',
                    'tanggal' => now()->toDateString(),
                ]
            );
        }

        echo "Test data for jadwal created successfully!\n";
    }
}
