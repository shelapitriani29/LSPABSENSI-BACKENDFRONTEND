<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Skema;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Data Admin Utama
        User::create([
            'name'     => 'Administrator',
            'username' => 'admin',
            'email'    => 'admin@lsp.com',
            'password' => Hash::make('1'),
            'role'     => 'admin',
        ]);

        // 2. Sample Data Asesor
        User::create([
            'name'     => 'Asesor',
            'username' => 'asesor',
            'email'    => 'asesor@lsp.com',
            'password' => Hash::make('1'),
            'role'     => 'asesor',
        ]);

        // 3. Sample Data Peserta
        User::create([
            'name'     => 'Peserta',
            'username' => 'peserta',
            'email'    => 'peserta@lsp.com',
            'password' => Hash::make('1'),
            'role'     => 'peserta',
        ]);

        // 4. Sample Data Skema Sertifikasi
        Skema::create([
            'kode_skema' => 'SKM-RPL-001',
            'nama_skema' => 'Rekayasa Perangkat Lunak - Pemrograman Web',
            'status'     => 'Aktif',
        ]);

        Skema::create([
            'kode_skema' => 'SKM-TKJ-001',
            'nama_skema' => 'Teknik Komputer & Jaringan - Network Administrator',
            'status'     => 'Aktif',
        ]);
    }
}