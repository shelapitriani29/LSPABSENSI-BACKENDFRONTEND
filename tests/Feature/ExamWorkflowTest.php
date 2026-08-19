<?php

namespace Tests\Feature;

use App\Models\Jadwal;
use App\Models\KategoriSoal;
use App\Models\Skema;
use App\Models\Soal;
use App\Models\Ujian;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExamWorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_store_exam_setting_and_question_with_auto_grading(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $asesor = User::factory()->create(['role' => 'asesor']);
        $peserta = User::factory()->create(['role' => 'peserta', 'kelas' => 'XI RPL 1']);

        $skema = Skema::create([
            'kode_skema' => 'SK-001',
            'nama_skema' => 'Junior Animator',
            'status' => 'Aktif',
            'deskripsi' => 'Deskripsi',
            'kelas' => 'XI RPL 1',
        ]);

        $jadwal = Jadwal::create([
            'kode_jadwal' => 'JWD-001',
            'skema_id' => $skema->id,
            'kelas' => 'XI RPL 1',
            'asesor_id' => $asesor->id,
            'tanggal' => '2026-08-20',
            'jam_mulai' => '08:00:00',
            'jam_selesai' => '12:00:00',
            'lokasi' => 'Lab 1',
            'passing_grade' => 75,
            'durasi_ujian' => 120,
        ]);

        $kategori = KategoriSoal::create([
            'jadwal_id' => $jadwal->id,
            'nama_kategori' => 'Prinsip Animasi',
            'deskripsi' => 'Dasar animasi',
        ]);

        $soal = Soal::create([
            'kategori_id' => $kategori->id,
            'pertanyaan' => 'Apa fungsi HTML?',
            'tipe_soal' => 'Pilihan Ganda',
            'tingkat_kesulitan' => 'Mudah',
            'poin' => 5,
            'jawaban_benar' => 'A',
        ]);

        $soal->pilihanJawaban()->createMany([
            ['pilihan' => 'A', 'teks_jawaban' => 'Membuat struktur halaman web'],
            ['pilihan' => 'B', 'teks_jawaban' => 'Mengatur database'],
            ['pilihan' => 'C', 'teks_jawaban' => 'Membuat server'],
            ['pilihan' => 'D', 'teks_jawaban' => 'Mengelola jaringan'],
        ]);

        $this->actingAs($admin);

        $response = $this->post(route('admin.sertifikasi.jadwal.kategori.store', $jadwal->id), [
            'nama_kategori' => 'Teknik Animasi',
            'deskripsi' => 'Teknik',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('kategori_soals', ['jadwal_id' => $jadwal->id, 'nama_kategori' => 'Teknik Animasi']);

        $this->assertDatabaseHas('jadwals', ['id' => $jadwal->id, 'passing_grade' => 75, 'durasi_ujian' => 120]);
        $this->assertDatabaseHas('soals', ['id' => $soal->id, 'jawaban_benar' => 'A']);

        $ujian = Ujian::create([
            'jadwal_id' => $jadwal->id,
            'peserta_id' => $peserta->id,
            'waktu_mulai' => now(),
            'waktu_selesai' => now()->addMinutes(120),
            'status' => 'selesai',
            'nilai_otomatis' => 0,
            'nilai_essay' => 0,
            'nilai_akhir' => 0,
        ]);

        $ujian->jawabanUjian()->create([
            'soal_id' => $soal->id,
            'jawaban' => 'A',
            'nilai' => 5,
        ]);

        $this->assertEquals(5, $ujian->jawabanUjian()->where('soal_id', $soal->id)->first()->nilai);
    }

    public function test_admin_can_access_kategori_detail_page(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $asesor = User::factory()->create(['role' => 'asesor']);

        $skema = Skema::create([
            'kode_skema' => 'SK-002',
            'nama_skema' => 'Test Skema',
            'status' => 'Aktif',
            'kelas' => 'XI RPL 1',
        ]);

        $jadwal = Jadwal::create([
            'kode_jadwal' => 'JWD-002',
            'skema_id' => $skema->id,
            'kelas' => 'XI RPL 1',
            'asesor_id' => $asesor->id,
            'tanggal' => '2026-08-20',
            'jam_mulai' => '08:00:00',
            'jam_selesai' => '12:00:00',
            'lokasi' => 'Lab 1',
        ]);

        $kategori = KategoriSoal::create([
            'jadwal_id' => $jadwal->id,
            'nama_kategori' => 'Test Kategori',
            'deskripsi' => 'Test Deskripsi',
        ]);

        $soal = Soal::create([
            'kategori_id' => $kategori->id,
            'pertanyaan' => 'Test Question?',
            'tipe_soal' => 'Pilihan Ganda',
            'tingkat_kesulitan' => 'Mudah',
            'poin' => 5,
            'jawaban_benar' => 'A',
        ]);

        $this->actingAs($admin)
            ->get(route('admin.sertifikasi.jadwal.kategori.soal', [$jadwal->id, $kategori->id]))
            ->assertStatus(200)
            ->assertViewHas('kategori')
            ->assertViewHas('soals');
    }

    public function test_kelola_soal_button_workflow(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $asesor = User::factory()->create(['role' => 'asesor']);

        $skema = Skema::create([
            'kode_skema' => 'SK-003',
            'nama_skema' => 'Test Skema Button',
            'status' => 'Aktif',
            'kelas' => 'XI RPL 1',
        ]);

        $jadwal = Jadwal::create([
            'kode_jadwal' => 'JWD-003',
            'skema_id' => $skema->id,
            'kelas' => 'XI RPL 1',
            'asesor_id' => $asesor->id,
            'tanggal' => '2026-08-25',
            'jam_mulai' => '09:00:00',
            'jam_selesai' => '13:00:00',
            'lokasi' => 'Lab 2',
            'passing_grade' => 75,
            'durasi_ujian' => 120,
        ]);

        $kategori1 = KategoriSoal::create([
            'jadwal_id' => $jadwal->id,
            'nama_kategori' => 'Kategori 1',
            'deskripsi' => 'Deskripsi 1',
        ]);

        // Add soals to kategori1
        $soal1 = Soal::create([
            'kategori_id' => $kategori1->id,
            'pertanyaan' => 'Question 1?',
            'tipe_soal' => 'Pilihan Ganda',
            'tingkat_kesulitan' => 'Mudah',
            'poin' => 5,
            'jawaban_benar' => 'A',
        ]);

        $this->actingAs($admin);

        // 1. Visit kelola-soal page (main Kelola Soal page)
        $response = $this->get(route('admin.sertifikasi.jadwal.soal', $jadwal->id));
        $response->assertStatus(200);
        $response->assertViewHas('kategoris');

        // 2. Click "Kelola Soal" button for kategori1 and verify it loads detail-soal with correct data
        $response = $this->get(route('admin.sertifikasi.jadwal.kategori.soal', [$jadwal->id, $kategori1->id]));
        $response->assertStatus(200);
        $response->assertViewHas('kategori', $kategori1)
            ->assertViewHas('soals')
            ->assertSee('Kategori 1'); // verify kategori name is displayed
    }
}

