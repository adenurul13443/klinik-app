<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Poli;
use App\Models\JadwalPeriksa;
use App\Models\DaftarPoli;
use App\Models\DetailPeriksa;
use App\Models\Periksa;
use App\Models\Dokter;
use App\Models\Obat;
use Illuminate\Http\Request;

class DaftarPoliController extends Controller
{
    // Menampilkan form daftar poli
    public function showForm(Request $request)
    {
     
        if (!session('id')) {
            return redirect()->route('login')->with('danger', 'Silakan login terlebih dahulu.');
        }

        $pasien = Pasien::find(session('id'));

        if (!$pasien) {
            return redirect()->route('login')->with('danger', 'Pasien tidak ditemukan.');
        }

        $polis = Poli::all();
           // Ambil riwayat daftar poli untuk pasien yang sedang login
        $riwayats = DaftarPoli::where('id_pasien', $pasien->id)
        ->with(['jadwal.dokter', 'jadwal.poli'])
        ->get();
        
    // Ambil jadwal berdasarkan poli yang dipilih jika ada
    $jadwals = collect(); // Default kosong
    
    if ($request->has('id_poli') && $request->id_poli) {
        $poliId = $request->id_poli;
    
        // Ambil semua dokter berdasarkan poli
        $dokters = Dokter::where('id_poli', $poliId)->get();
    
        // Ambil jadwal berdasarkan dokter yang ditemukan
        $jadwals = JadwalPeriksa::with('dokter.poli') // Pastikan eager loading relasi
            ->whereIn('id_dokter', $dokters->pluck('id'))
            ->where('status', 'aktif')
            ->get();
    }
        return view('pasien.daftar_poli', compact('pasien', 'polis', 'riwayats', 'jadwals'));
    }

    // Menyimpan data daftar poli
    public function store(Request $request)
    {
        $request->validate([
            'keluhan' => 'required|string',
            'id_poli' => 'required|exists:poli,id',
            'id_jadwal' => 'required|exists:jadwal_periksa,id',
        ]);
    
        // Ambil nomor antrian terakhir untuk jadwal dan tanggal hari ini
        $lastAntrian = DaftarPoli::where('id_jadwal', $request->id_jadwal)
        ->whereDate('created_at', now()->toDateString()) // Filter berdasarkan tanggal hari ini
        ->max('no_antrian'); // Ambil nomor antrian tertinggi pada hari ini

        $nextAntrian = $lastAntrian ? $lastAntrian + 1 : 1; // Jika ada, tambahkan 1. Jika tidak, mulai dari 1.

    
        $nextAntrian = $lastAntrian ? $lastAntrian + 1 : 1; // Jika ada, tambahkan 1. Jika tidak, mulai dari 1.
    
        // Simpan data ke database
        DaftarPoli::create([
            'id_pasien' => session('id'),
            'id_jadwal' => $request->id_jadwal,
            'keluhan' => $request->keluhan,
            'no_antrian' => $nextAntrian,
        ]);
    
        return redirect()->route('pasien.daftar_poli')->with('success', 'Berhasil mendaftar ke Poli!');
    }
    

public function getJadwal(Request $request)
{
    if ($request->has('id_poli') && $request->id_poli) {
        $poliId = $request->id_poli;

        // Ambil semua dokter berdasarkan poli
        $dokters = Dokter::where('id_poli', $poliId)->get();

        // Ambil jadwal berdasarkan dokter yang ditemukan
        $jadwals = JadwalPeriksa::with('dokter.poli') // Eager loading relasi
            ->whereIn('id_dokter', $dokters->pluck('id'))
            ->where('status', 'aktif')
            ->get();

        return response()->json($jadwals);
    }

    return response()->json([]);
}

public function riwayatPendaftaran()
{
    $riwayats = DaftarPoli::with(['jadwal.dokter.poli', 'jadwal.dokter', 'jadwal', 'detailPeriksa.obat'])->get();

    foreach ($riwayats as $riwayat) {
        // Menambahkan data pemeriksaan ke masing-masing riwayat
        if ($riwayat->status == 'sudah diperiksa') {
            $riwayat->periksa = Periksa::where('id_daftar_poli', $riwayat->id)->first();
            $riwayat->detailPeriksa = DetailPeriksa::where('id_periksa', $riwayat->periksa->id)->get();
            $riwayat->biayaPeriksa = $riwayat->periksa->biaya_periksa;
        }
    }

    return view('pasien.riwayat', compact('riwayats'));
}


    
}
