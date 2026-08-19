<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use App\Models\KategoriSoal;
use App\Models\Skema;
use App\Models\Soal;
use App\Models\Ujian;
use App\Models\User;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwals';

    protected $fillable = [
        'kode_jadwal',
        'skema_id',
        'kelas',
        'asesor_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'lokasi',
        'keterangan',
        'status',
        'passing_grade',
        'durasi_ujian',
    ];

    public function skema()
    {
        return $this->belongsTo(Skema::class);
    }

    public function asesor()
    {
        return $this->belongsTo(User::class, 'asesor_id');
    }

    public function pesertas()
    {
        return $this->hasMany(User::class, 'kelas', 'kelas')->where('role', 'peserta');
    }

    public function kategoris()
    {
        return $this->hasMany(KategoriSoal::class, 'jadwal_id');
    }

    public function soals()
    {
        return $this->hasManyThrough(Soal::class, KategoriSoal::class, 'jadwal_id', 'kategori_id');
    }

    public function ujians()
    {
        return $this->hasMany(Ujian::class, 'jadwal_id');
    }

    public function getStatusAttribute($value)
    {
        if (!$this->tanggal || !$this->jam_mulai || !$this->jam_selesai) {
            return $value ?? 'Akan Mendatang';
        }

        $now = Carbon::now();
        $start = Carbon::parse("{$this->tanggal} {$this->jam_mulai}");
        $end = Carbon::parse("{$this->tanggal} {$this->jam_selesai}");

        if ($now->lt($start)) {
            return 'Akan Mendatang';
        }

        if ($now->between($start, $end)) {
            return 'Mulai';
        }

        return 'Selesai';
    }

    public function scopeWhereComputedStatus($query, $status)
    {
        $now = Carbon::now();
        $today = $now->toDateString();
        $time = $now->format('H:i:s');

        return match ($status) {
            'Akan Mendatang' => $query->where(function ($q) use ($today, $time) {
                $q->whereDate('tanggal', '>', $today)
                  ->orWhere(function ($q2) use ($today, $time) {
                      $q2->whereDate('tanggal', $today)
                         ->where('jam_mulai', '>', $time);
                  });
            }),
            'Mulai' => $query->whereDate('tanggal', $today)
                            ->where('jam_mulai', '<=', $time)
                            ->where('jam_selesai', '>=', $time),
            'Selesai' => $query->where(function ($q) use ($today, $time) {
                $q->whereDate('tanggal', '<', $today)
                  ->orWhere(function ($q2) use ($today, $time) {
                      $q2->whereDate('tanggal', $today)
                         ->where('jam_selesai', '<', $time);
                  });
            }),
            default => $query,
        };
    }
}
