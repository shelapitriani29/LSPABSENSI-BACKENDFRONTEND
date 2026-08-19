<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Jadwal;
use App\Models\Sertifikat;
use App\Models\User;

class Penilaian extends Model
{
    use HasFactory;

    protected $table = 'penilaians';

    protected $fillable = [
        'user_id',
        'jadwal_id',
        'asesor_id',
        'hasil',
        'nilai_pilihan_ganda',
        'catatan_pilihan_ganda',
        'nilai_essay',
        'catatan_essay',
        'catatan',
        'tanggal',
        'keterangan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    public function asesor()
    {
        return $this->belongsTo(User::class, 'asesor_id');
    }

    public function sertifikat()
    {
        return $this->hasOne(Sertifikat::class);
    }
}
