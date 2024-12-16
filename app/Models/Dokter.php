<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'dokter'; // Tabel pasien
    protected $fillable = ['nama', 'alamat', 'no_hp', 'no_hp', 'id_poli'];

    // Dokter.php
    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id_poli');
    }
    
    public function jadwalPeriksa()
    {
        return $this->hasMany(JadwalPeriksa::class, 'id_dokter');
    }
}