<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@lsp.com',
            'password' => Hash::make('1'),
            'role' => 'admin',
        ]);

        // Asesor
        User::create([
            'name' => 'Asesor',
            'username' => 'asesor',
            'email' => 'asesor@lsp.com',
            'password' => Hash::make('1'),
            'role' => 'asesor',
        ]);

        // Peserta
        User::create([
            'name' => 'Peserta',
            'username' => 'peserta',
            'email' => 'peserta@lsp.com',
            'password' => Hash::make('1'),
            'role' => 'peserta',
        ]);
    }
}