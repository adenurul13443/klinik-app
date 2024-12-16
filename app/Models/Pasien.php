<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien'; // Tabel pasien
    protected $fillable = ['nama', 'alamat', 'no_ktp', 'no_hp', 'no_rm'];

    use SoftDeletes;

    protected $dates = ['deleted_at']; // Tambahkan kolom deleted_at
    
}


