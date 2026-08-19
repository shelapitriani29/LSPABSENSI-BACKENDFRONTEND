<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    protected $table = 'soals';

    protected $fillable = [
        'kategori_id',
        'pertanyaan',
        'tipe_soal',
        'tingkat_kesulitan',
        'poin',
        'jawaban_benar',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriSoal::class, 'kategori_id');
    }

    public function pilihanJawaban()
    {
        return $this->hasMany(PilihanJawaban::class, 'soal_id');
    }

    public function jawabanUjian()
    {
        return $this->hasMany(JawabanUjian::class, 'soal_id');
    }
}
