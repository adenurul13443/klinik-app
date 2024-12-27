<?php

namespace App\Http\Controllers;

use App\Models\JadwalPeriksa;
use App\Models\Dokter;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JadwalPeriksaController extends Controller
{
    // Menampilkan daftar jadwal periksa
    public function index()
    {
        
        $dokterId = session('id');
        if (!$dokterId) {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai dokter terlebih dahulu.');
        }

        $dokter = Dokter::find($dokterId);
        if (!$dokter) {
            return redirect()->route('login')->with('error', 'Data dokter tidak ditemukan.');
        }

        $jadwals = JadwalPeriksa::where('id_dokter', $dokterId)
            ->with('dokter:id,nama')
            ->get(['id', 'hari', 'jam_mulai', 'jam_selesai', 'status', 'id_dokter']);

        $jadwals = $jadwals->map(function ($jadwal) {
            $jadwal->jam_mulai = Carbon::parse($jadwal->jam_mulai)->format('H:i');
            $jadwal->jam_selesai = Carbon::parse($jadwal->jam_selesai)->format('H:i');
            return $jadwal;
        });       

        return view('dokter.jadwal-periksa', compact('dokter', 'jadwals'));
    }

    // Menampilkan form untuk tambah jadwal
    public function create()
    {
        $dokterId = session('id');
        if (!$dokterId) {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai dokter untuk menambah jadwal.');
        }

        $dokter = Dokter::findOrFail($dokterId);
        return view('jadwal-periksa.create', compact('dokter'));
    }

    // Menyimpan jadwal baru
    public function store(Request $request)
    {
        $dokterId = session('id');
        if (!$dokterId) {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai dokter untuk menyimpan jadwal.');
        }

        $dokter = Dokter::findOrFail($dokterId);
        $request->merge(['id_dokter' => $dokter->id]);

        $request->validate([
            'id_dokter' => 'required|exists:dokter,id',
            'hari' => 'required|string|max:50',
            'jam_mulai' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) use ($request, $dokterId) {
                    $bentrok = JadwalPeriksa::where('id_dokter', $dokterId)
                        ->where('hari', $request->hari)
                        ->where(function ($query) use ($request) {
                            $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                                  ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai]);
                        })
                        ->exists();

                    if ($bentrok) {
                        $fail('Jadwal bentrok dengan jadwal yang sudah ada.');
                    }
                },
            ],
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'status' => 'required|in:aktif,tidak aktif',
        ]);

        JadwalPeriksa::create($request->all());

        return redirect()->route('jadwal-periksa.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    // Menampilkan form untuk edit jadwal
    public function edit($id)
    {
        $dokterId = session('id');
        
        // Cek apakah dokter sudah login
        if (!$dokterId) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Temukan data dokter berdasarkan session id
        $dokter = Dokter::findOrFail($dokterId);

        // Temukan jadwal berdasarkan ID dan pastikan ada
        $jadwal = JadwalPeriksa::findOrFail($id);

        // Pastikan id_dokter pada jadwal sesuai dengan dokter yang login
        if ($jadwal->id_dokter !== $dokterId) {
            return redirect()->route('jadwal-periksa.index')->with('error', 'Anda tidak diizinkan mengubah jadwal ini.');
        }

        // Jika semuanya valid, tampilkan form edit
        return view('jadwal-periksa.edit', compact('jadwal', 'dokter'));
    }

    // Memperbarui data jadwal
    public function update(Request $request, JadwalPeriksa $jadwal, $id)
    {
        $dokterId = session('id');
        $dokter = Dokter::find($dokterId);

        $jadwal = JadwalPeriksa::findOrFail($id);
        

        // Cek apakah dokter sudah login dan apakah id_dokter pada jadwal sesuai
        if (!$dokterId || $jadwal->id_dokter !== $dokterId) {
            return redirect()->route('jadwal-periksa.index')->with('error', 'Anda tidak diizinkan memperbarui jadwal ini.');
        }

        // Validasi data input
        $request->validate([
            'hari' => 'required|string|max:50',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'status' => 'required|in:aktif,tidak aktif',
        ]);

        // Memperbarui jadwal dengan data yang diterima dari form
        $jadwal->update($request->only(['hari', 'jam_mulai', 'jam_selesai', 'status']));

        // Redirect ke halaman daftar jadwal dengan pesan sukses
        return redirect()->route('jadwal-periksa.index')->with('success', 'Jadwal berhasil diperbarui.');
    }


    // Menghapus jadwal
    public function destroy( $id)
    {
        $dokterId = session('id');
        $dokter = Dokter::find($dokterId);

        // Temukan jadwal berdasarkan ID dan pastikan ada
        $jadwal = JadwalPeriksa::findOrFail($id);

        if ($jadwal->id_dokter !== $dokter->id) {
            return redirect()->route('jadwal-periksa.index')->with('error', 'Anda tidak diizinkan menghapus jadwal ini.');
        }

        $jadwal->delete();

        return redirect()->route('jadwal-periksa.index')->with('success', 'Jadwal berhasil dihapus.');
    }

}
