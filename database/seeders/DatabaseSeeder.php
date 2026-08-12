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
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name'     => 'Administrator',
                'email'    => 'admin@lsp.com',
                'password' => Hash::make('1'),
                'role'     => 'admin',
            ]
        );

        // 2. Sample Data Asesor
        User::updateOrCreate(
            ['username' => 'asesor'],
            [
                'name'     => 'Asesor',
                'email'    => 'asesor@lsp.com',
                'password' => Hash::make('1'),
                'role'     => 'asesor',
            ]
        );

        // 3. Sample Data Peserta
        User::updateOrCreate(
            ['username' => 'peserta'],
            [
                'name'     => 'Peserta',
                'email'    => 'peserta@lsp.com',
                'password' => Hash::make('1'),
                'role'     => 'peserta',
            ]
        );

        // 4. Sample Data Skema Sertifikasi
        Skema::updateOrCreate(
            ['kode_skema' => 'SKM-RPL-001'],
            [
                'nama_skema' => 'Rekayasa Perangkat Lunak - Pemrograman Web',
                'status'     => 'Aktif',
            ]
        );

        Skema::updateOrCreate(
            ['kode_skema' => 'SKM-TKJ-001'],
            [
                'nama_skema' => 'Teknik Komputer & Jaringan - Network Administrator',
                'status'     => 'Aktif',
            ]
        );
    }
}
