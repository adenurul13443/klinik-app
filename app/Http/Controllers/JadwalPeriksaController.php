<?php

namespace App\Http\Controllers;

use App\Models\JadwalPeriksa;
use App\Models\Dokter;
use Illuminate\Http\Request;

class JadwalPeriksaController extends Controller
{
    // Menampilkan daftar jadwal periksa
    public function index()
{
    // Pastikan session 'id' ada
    if (!session('id')) {
        return redirect()->route('login')->with('error', 'Anda harus login sebagai dokter terlebih dahulu.');
    }

    // Ambil ID dokter dari session
    $dokterId = session('id');
    $dokter = Dokter::findOrFail($dokterId);

    // Menampilkan jadwal periksa milik dokter yang sedang login
    $jadwals = JadwalPeriksa::where('id_dokter', $dokterId)->with('dokter')->get();

    return view('dokter.jadwal-periksa', compact('dokter', 'jadwals'));
}


    // Menampilkan form untuk tambah jadwal
    public function create()
    {
        $dokterId = session('id_dokter'); // Ambil ID dokter dari session
        $dokter = Dokter::findOrFail($dokterId); // Cari data dokter
        return view('jadwal-periksa.create', compact('dokter')); // Kirim data dokter
    }
    

    // Menyimpan jadwal baru
    public function store(Request $request)
    {
        // Ambil ID dokter dari session
        $dokterId = session('id');

        // Cek apakah dokter ditemukan berdasarkan ID yang ada di session
        $dokter = Dokter::find($dokterId);
        if (!$dokter) {
            return redirect()->back()->with('error', 'Dokter tidak ditemukan.');
        }

        // Tambahkan ID dokter ke request
        $request->merge(['id_dokter' => $dokter->id]);

        // Validasi input
        $request->validate([
            'id_dokter' => 'required|exists:dokter,id',
            'hari' => 'required|string',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'status' => 'required|in:aktif,tidak aktif',
        ]);

        // Simpan data jadwal periksa
        JadwalPeriksa::create($request->all());

        return redirect()->route('jadwal-periksa.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }


    // Menampilkan form untuk edit jadwal
    public function edit(JadwalPeriksa $jadwal)
    {
        $dokterId = session('id_dokter'); // Ambil ID dokter dari session
        $dokter = Dokter::findOrFail($dokterId); // Cari data dokter
    
        // Validasi: Pastikan jadwal milik dokter yang sedang login
        if ($jadwal->id_dokter !== $dokter->id) {
            return redirect()->route('jadwal-periksa.index')->with('error', 'Anda tidak diizinkan mengakses jadwal ini.');
        }
    
        return view('jadwal-periksa.edit', compact('jadwal', 'dokter')); // Kirim data ke view
    }    

    // Memperbarui data jadwal
    public function update(Request $request, JadwalPeriksa $jadwal)
    {
        // Validasi data input
        $request->validate([
            'hari' => 'required|string|max:50',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'status' => 'required|in:aktif,tidak aktif',
        ]);
    
        // Update data jadwal
        $jadwal->update([
            'hari' => $request->input('hari'),
            'jam_mulai' => $request->input('jam_mulai'),
            'jam_selesai' => $request->input('jam_selesai'),
            'status' => $request->input('status'),
        ]);
    
        // Pastikan update berhasil
        return redirect()->route('jadwal-periksa.index')->with('success', 'Jadwal berhasil diperbarui.');
    }
    


    // Menghapus jadwal
    public function destroy(JadwalPeriksa $jadwal)
    {
        // Pastikan jadwal ditemukan
        if (!$jadwal) {
            return redirect()->route('jadwal-periksa.index')->with('error', 'Jadwal tidak ditemukan');
        }
    
        // Hapus data jadwal
        $jadwal->forceDelete(); // Atau gunakan forceDelete() jika ingin hapus permanen
    
        return redirect()->route('jadwal-periksa.index')->with('success', 'Jadwal berhasil dihapus');
    }
    
}
