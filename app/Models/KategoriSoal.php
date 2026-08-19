<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriSoal extends Model
{
    use HasFactory;

    protected $table = 'kategori_soals';

    protected $fillable = [
        'jadwal_id',
        'nama_kategori',
        'deskripsi',
    ];

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id');
    }

    public function soals()
    {
        return $this->hasMany(Soal::class, 'kategori_id');
    }
}
