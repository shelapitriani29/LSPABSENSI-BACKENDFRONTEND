<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skema extends Model
{
    use HasFactory;

    protected $table = 'skemas';

    protected $fillable = [
        'kode_skema',
        'nama_skema',
        'status',
        'deskripsi',
        'kelas',
    ];

    public function pesertas()
    {
        return $this->hasMany(User::class, 'kelas', 'kelas');
    }
}
