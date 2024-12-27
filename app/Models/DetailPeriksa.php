<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPeriksa extends Model
{
    protected $table = 'detail_periksa';
    protected $fillable = [
        'id_periksa',   // Tambahkan kolom id_daftar_poli di sini
        'id_obat',
    ];
    public function periksa()
    {
        return $this->belongsTo(Periksa::class, 'id_periksa');
    }
    
    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat');
    }
}
