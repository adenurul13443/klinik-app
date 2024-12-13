<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Poli;
use Illuminate\Http\Request;

class DokterController extends Controller
{

    public function loginForm()
    {
        return view('dokter.auth.login'); 
    }
    // Menampilkan daftar dokter (index)
    public function index()
    {
        $dokters = Dokter::all();
        $polis = Poli::all(); // Pastikan Anda mengambil data poli untuk dropdown
        return view('admin.dokter.index', compact('dokters', 'polis'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:150',
            'alamat' => 'required|string|max:255',
        ]);

        $dokter = dokter::where('nama', $request->nama)
                        ->where('alamat', $request->alamat)
                        ->first();

        if ($dokter) {
            // Simpan informasi dokter ke dalam sesi
            session([
                'id' => $dokter->id,
                'nama' => $dokter->nama,
                'alamat' => $dokter->alamat,
                'no_hp' => $dokter->no_hp,
                'id_poli' => $dokter->id_poli,
            ]);

            // Redirect ke dashboard
            return redirect()->route('dokter.dashboard')->with('success','Login Berhasil!');
        }

        return back()->withErrors(['login' => 'Nama atau alamat salah.'])->with('danger','Silahkan Login Terlebih Dahulu!');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/')->with('success','Logout Berhasil!');
    }

    // Menyimpan dokter baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'id_poli' => 'required|exists:poli,id', // Memastikan id_poli valid
        ]);

        Dokter::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'id_poli' => $request->id_poli,  // pastikan nama kolom ini sesuai dengan di database
        ]);

        return redirect()->route('admin.dokter.index')->with('success', 'Dokter berhasil ditambahkan');
    }

    // Menampilkan form untuk edit dokter
    public function edit(Dokter $dokter)
    {
        $polis = Poli::all(); // Pastikan Anda mengambil data poli untuk dropdown
        return view('admin.dokter.edit', compact('dokter', 'polis'));
    }

    // Memperbarui data dokter
    public function update(Request $request, Dokter $dokter)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'id_poli' => 'required|exists:poli,id', 
        ]);

        $dokter->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'id_poli' => $request->id_poli,  // pastikan nama kolom ini sesuai dengan di database
        ]);

        return redirect()->route('admin.dokter.index')->with('success', 'Dokter berhasil diperbarui');
    }

    // Menghapus dokter
    public function destroy(Dokter $dokter)
    {
        $dokter->delete();
        return redirect()->route('admin.dokter.index')->with('success', 'Dokter berhasil dihapus');
    }

    public function dashboard()
    {
        if (!session('id')) {
            return redirect()->route('dokter.login.form')->withErrors(['auth' => 'Silakan login terlebih dahulu.']);
        }

        return view('dokter.dashboard');
    }
}


