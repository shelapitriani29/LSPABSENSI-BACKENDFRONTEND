<?php

namespace Database\Seeders;

use App\Models\Penilaian;
use App\Models\Jadwal;
use App\Models\User;
use Illuminate\Database\Seeder;

class PenilaianDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil user peserta dan asesor
        $peserta = User::where('role', 'peserta')->first();
        $asesor = User::where('role', 'asesor')->first();
        $jadwal = Jadwal::first();

        // Jika tidak ada, skip seeder
        if (!$peserta || !$asesor || !$jadwal) {
            echo "Skipping PenilaianDemoSeeder: Missing peserta, asesor, or jadwal data\n";
            return;
        }

        // Buat penilaian demo jika belum ada
        Penilaian::firstOrCreate(
            [
                'user_id' => $peserta->id,
                'jadwal_id' => $jadwal->id,
            ],
            [
                'asesor_id' => $asesor->id,
                'hasil' => 'Kompeten',
                'tanggal' => now()->toDateString(),
            ]
        );

        echo "Penilaian demo berhasil dibuat!\n";
    }
}
