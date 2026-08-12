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
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrator',
                'email' => 'admin@lsp.com',
                'password' => Hash::make('1'),
                'role' => 'admin',
            ]
        );

        // Asesor
        User::updateOrCreate(
            ['username' => 'asesor'],
            [
                'name' => 'Asesor',
                'email' => 'asesor@lsp.com',
                'password' => Hash::make('1'),
                'role' => 'asesor',
            ]
        );

        // Peserta
        User::updateOrCreate(
            ['username' => 'peserta'],
            [
                'name' => 'Peserta',
                'email' => 'peserta@lsp.com',
                'password' => Hash::make('1'),
                'role' => 'peserta',
            ]
        );
    }
}
