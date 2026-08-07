<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Jadwal;
use App\Models\Penilaian;
use App\Models\Skema;
use App\Models\User;

class Sertifikat extends Model
{
    use HasFactory;

    protected $table = 'sertifikats';

    protected $fillable = [
        'user_id',
        'penilaian_id',
        'skema_id',
        'jadwal_id',
        'no_sertifikat',
        'tanggal_terbit',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function penilaian()
    {
        return $this->belongsTo(Penilaian::class);
    }

    public function skema()
    {
        return $this->belongsTo(Skema::class);
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }
}
