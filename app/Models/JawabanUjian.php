<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanUjian extends Model
{
    use HasFactory;

    protected $table = 'jawaban_ujians';

    protected $fillable = [
        'ujian_id',
        'soal_id',
        'jawaban',
        'nilai',
        'dinilai_oleh',
        'waktu_dinilai',
    ];

    protected $casts = [
        'waktu_dinilai' => 'datetime',
    ];

    public function ujian()
    {
        return $this->belongsTo(Ujian::class, 'ujian_id');
    }

    public function soal()
    {
        return $this->belongsTo(Soal::class, 'soal_id');
    }
}
