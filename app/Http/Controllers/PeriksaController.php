<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\Periksa;
use App\Models\DetailPeriksa;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Dokter;
use Illuminate\Http\Request;

class PeriksaController extends Controller
{
    public function index($id_dokter)
    {
        // Ambil data riwayat pendaftaran berdasarkan dokter yang sedang login
        $daftarPolis = DaftarPoli::whereHas('jadwal', function ($query) use ($id_dokter) {
            $query->where('id_dokter', $id_dokter);
        })->get();

        // Ambil data obat yang tersedia
        $obats = Obat::all();

          // Ambil data dokter berdasarkan ID
        $dokter = Dokter::findOrFail($id_dokter);

        return view('dokter.periksa', compact('daftarPolis', 'obats', 'dokter'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'id_daftar_poli' => 'required',
            'tgl_periksa' => 'required|date',
            'catatan' => 'nullable|string',
            'obat' => 'required|array', // Multiple obat
            'obat.*' => 'exists:obat,id', // Validasi bahwa obat yang dipilih ada dalam database
        ]);
    
        // Hitung biaya periksa
        $biaya_periksa = 150000; // Biaya operasi tetap 150 ribu
        $biaya_obat = Obat::whereIn('id', $request->obat)->sum('harga');
        $biaya_periksa += $biaya_obat;
    
        // Simpan data periksa
        $periksa = Periksa::create([
            'id_daftar_poli' => $validated['id_daftar_poli'],
            'tgl_periksa' => $validated['tgl_periksa'],
            'catatan' => $validated['catatan'],
            'biaya_periksa' => $biaya_periksa,
        ]);
        
        // Simpan detail periksa (relasi obat)
        foreach ($validated['obat'] as $obat_id) {
            DetailPeriksa::create([
                'id_periksa' => $periksa->id,
                'id_obat' => $obat_id,
            ]);
        }
    
        // Update status pada DaftarPoli menjadi 'sudah diperiksa'
        $daftarPoli = DaftarPoli::findOrFail($validated['id_daftar_poli']);
        $daftarPoli->status = 'sudah diperiksa';
        $daftarPoli->save();
    
        // Arahkan ke halaman riwayat untuk menampilkan detail periksa
    return redirect()->route('dokter.riwayat', ['id_dokter' => $request->id_dokter])->with('success', 'Periksa berhasil dilakukan!');

    }

    public function riwayat($id_dokter)
{
    // Ambil data riwayat periksa untuk dokter tertentu
    $dokter = Dokter::findOrFail($id_dokter);
    $daftarPolis = DaftarPoli::whereHas('jadwal.dokter', function ($query) use ($dokter) {
        $query->where('id', $dokter->id);
    })->where('status', 'sudah diperiksa')->get();

    return view('dokter.riwayat', compact('dokter', 'daftarPolis'));
}

public function detailRiwayat($id_periksa)
{
    // Ambil data periksa dan detail periksa
    $periksa = Periksa::findOrFail($id_periksa);
    $detailPeriksa = DetailPeriksa::where('id_periksa', $id_periksa)->get();

    // Ambil data dokter terkait periksa
    $dokter = $periksa->daftarPoli->jadwal->dokter;

    $biayaPeriksa = $periksa->biaya_periksa;

    // Kirim data ke view
    return view('dokter.detail-riwayat', compact('periksa', 'detailPeriksa', 'dokter', 'biayaPeriksa'));
}

    
}