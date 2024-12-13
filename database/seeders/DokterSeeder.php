<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Dokter;
use Illuminate\Database\Seeder;

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dokter::create([
            'nama' => 'Dokter',
            'alamat' => 'Semarang',
            'no_hp' => '089123123123',
            'id_poli' => '1',
        ]);
    }
}
