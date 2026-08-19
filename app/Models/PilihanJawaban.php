<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PilihanJawaban extends Model
{
    use HasFactory;

    protected $table = 'pilihan_jawabans';

    protected $fillable = [
        'soal_id',
        'pilihan',
        'teks_jawaban',
    ];

    public function soal()
    {
        return $this->belongsTo(Soal::class, 'soal_id');
    }
}
