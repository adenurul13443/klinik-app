<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    use HasFactory;

    protected $table = 'poli';

    protected $fillable = [
        'nama_poli',
        'keterangan',
    ];

  
     // Relasi dengan DaftarPoli
     public function daftarPolis()
     {
         return $this->hasMany(DaftarPoli::class);
     }
     public function dokter()
     {
         return $this->hasMany(Dokter::class, 'id_poli');
     }

    // Relasi dengan JadwalPeriksa (Jika ada)
    public function jadwalPeriksas()
    {
        return $this->hasMany(JadwalPeriksa::class, 'id_poli');
    }
}
