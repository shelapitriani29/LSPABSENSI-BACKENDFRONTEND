<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\Penilaian;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'status',
        'no_hp',
        'instansi',
        'foto',
        // Tambahkan semua kolom detail ini agar bisa tersimpan saat di-update:
        'nip',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'no_met',
        'skema_kompetensi',
        'kelas',
        'jurusan',
        'bidang_kompetensi',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public static function normalizeRole(?string $role): string
    {
        $normalized = strtolower(trim((string) ($role ?? '')));

        return match ($normalized) {
            'administrator', 'superadministrator', 'superadmin', 'admin', '1' => 'admin',
            'examiner', 'penguji', 'asesor' => 'asesor',
            'student', 'siswa', 'peserta' => 'peserta',
            default => $normalized,
        };
    }

    public function absensis()
    {
        return $this->hasMany(Absensi::class);
    }

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class);
    }

    public function jadwal()
    {
        return $this->hasOne(Jadwal::class, 'kelas', 'kelas')->orderBy('tanggal', 'desc');
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}