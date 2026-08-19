<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Skema;
use App\Models\Jadwal;
use App\Models\KategoriSoal;
use App\Models\Soal;
use App\Models\PilihanJawaban;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Data Admin Utama
        $admin = User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name'     => 'Administrator',
                'email'    => 'admin@lsp.com',
                'password' => Hash::make('1'),
                'role'     => 'admin',
                'instansi' => 'SMK NEGERI 1 GARUT',
            ]
        );

        // 2. Sample Data Asesor
        $asesor = User::updateOrCreate(
            ['username' => 'asesor'],
            [
                'name'     => 'Asesor',
                'email'    => 'asesor@lsp.com',
                'password' => Hash::make('1'),
                'role'     => 'asesor',
                'instansi' => 'SMK NEGERI 1 GARUT',
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
                'kelas'    => 'XI RPL 1',
                'instansi' => 'SMK NEGERI 1 GARUT',
            ]
        );

        // 4. Sample Data Skema Sertifikasi
        $skema = Skema::updateOrCreate(
            ['kode_skema' => 'SKM-JAN-001'],
            [
                'nama_skema' => 'Junior Animator',
                'status'     => 'Aktif',
                'kelas'      => 'XI RPL 1',
            ]
        );

        Skema::updateOrCreate(
            ['kode_skema' => 'SKM-TKJ-001'],
            [
                'nama_skema' => 'Teknik Komputer & Jaringan - Network Administrator',
                'status'     => 'Aktif',
            ]
        );

        // 5. Create Test Jadwal (Exam Schedule)
        $jadwal = Jadwal::updateOrCreate(
            ['kode_jadwal' => 'JWD-2026-001'],
            [
                'skema_id'     => $skema->id,
                'kelas'        => 'XI RPL 1',
                'asesor_id'    => $asesor->id,
                'tanggal'      => now()->addDays(7)->toDateString(),
                'jam_mulai'    => '08:00',
                'jam_selesai'  => '12:00',
                'lokasi'       => 'Lab Komputer 1',
                'passing_grade' => 75,
                'durasi_ujian' => 120,
            ]
        );

        // 6. Create Test Kategori Soal (Categories)
        $kategori1 = KategoriSoal::updateOrCreate(
            ['jadwal_id' => $jadwal->id, 'nama_kategori' => 'Prinsip Animasi'],
            [
                'deskripsi' => 'Konsep dasar animasi seperti squash & stretch, anticipation, staging, dll.',
            ]
        );

        // 7. Create Test Soal (Questions) with multiple choice answers
        $soal1 = Soal::updateOrCreate(
            ['kategori_id' => $kategori1->id, 'pertanyaan' => 'Apa tujuan utama prinsip "Squash and Stretch" dalam animasi?'],
            [
                'tipe_soal'         => 'Pilihan Ganda',
                'tingkat_kesulitan' => 'Mudah',
                'poin'              => 5,
                'jawaban_benar'     => 'A',
            ]
        );

        PilihanJawaban::updateOrCreate(
            ['soal_id' => $soal1->id, 'pilihan' => 'A'],
            ['teks_jawaban' => 'Memberikan kehidupan dan fleksibilitas pada karakter']
        );
        PilihanJawaban::updateOrCreate(
            ['soal_id' => $soal1->id, 'pilihan' => 'B'],
            ['teks_jawaban' => 'Membuat karakter bergerak lebih cepat']
        );
        PilihanJawaban::updateOrCreate(
            ['soal_id' => $soal1->id, 'pilihan' => 'C'],
            ['teks_jawaban' => 'Mengurangi jumlah frame animasi']
        );
        PilihanJawaban::updateOrCreate(
            ['soal_id' => $soal1->id, 'pilihan' => 'D'],
            ['teks_jawaban' => 'Mengubah warna karakter']
        );
    }
}
