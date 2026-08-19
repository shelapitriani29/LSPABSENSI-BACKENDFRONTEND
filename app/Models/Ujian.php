<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    use HasFactory;

    protected $table = 'ujians';

    protected $fillable = [
        'jadwal_id',
        'peserta_id',
        'waktu_mulai',
        'waktu_selesai',
        'status',
        'nilai_otomatis',
        'nilai_essay',
        'nilai_akhir',
    ];

    protected $casts = [
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
    ];

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id');
    }

    public function peserta()
    {
        return $this->belongsTo(User::class, 'peserta_id');
    }

    public function jawabanUjian()
    {
        return $this->hasMany(JawabanUjian::class, 'ujian_id');
    }
}
