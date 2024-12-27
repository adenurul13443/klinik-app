<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;

class PasienController extends Controller
{
    public function showRegisterForm()
    {
        return view('pasien.auth.register'); 
    }

    public function showLoginForm()
    {
        return view('pasien.auth.login'); 
    }

    // Fungsi untuk pendaftaran
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:150',
            'alamat' => 'required|string|max:255',
            'no_ktp' => 'required|string|max:17|unique:pasien,no_ktp',
            'no_hp' => 'required|string|max:15',
        ]);

        // Generate nomor rekam medis (no_rm) unik berdasarkan tahun-bulan dan urutan pasien
        $yearMonth = date('Ym');
        $pasienCount = Pasien::whereRaw("DATE_FORMAT(created_at, '%Y%m') = ?", [$yearMonth])->count();
        $no_rm = $yearMonth . '-' . str_pad($pasienCount + 1, STR_PAD_LEFT);

        // Simpan data pasien ke database
        $pasien = Pasien::create([
            'nama' => $validated['nama'],
            'alamat' => $validated['alamat'],
            'no_ktp' => $validated['no_ktp'],
            'no_hp' => $validated['no_hp'],
            'no_rm' => $no_rm,
        ]);

        return redirect()->route('pasien.login')->with('success','Registrasi Berhasil!');
    }

    // Fungsi untuk login
    public function login(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:150',
            'alamat' => 'required|string|max:255',
        ]);

        $pasien = Pasien::where('nama', $request->nama)
                        ->where('alamat', $request->alamat)
                        ->first();

        if ($pasien) {
            session([
                'id' => $pasien->id,
                'nama' => $pasien->nama,
                'no_rm' => $pasien->no_rm,
            ]);

            return redirect()->route('pasien.dashboard')->with('success','Login Berhasil!');
        }

        return back()->withErrors(['login' => 'Nama atau alamat salah.'])->with('danger','Login Gagal!');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/')->with('success','Logout Berhasil!');
    }

    public function dashboard()
    {
        if (!session('id')) {
            return redirect()->route('pasien.login.form')->withErrors(['auth' => 'Silakan login terlebih dahulu.'])->with('danger','Silahkan Login Terlebih Dahulu!');
        }

        return view('pasien.dashboard');
    }

    // ============================
    // CRUD Pasien
    // ============================

    // Daftar pasien (admin)
    public function index()
    {
        $pasiens = Pasien::all();
        return view('admin.pasien.index', compact('pasiens'));
    }

    // Form tambah pasien
    public function create()
    {
        $yearMonth = date('Ym');
        $pasienCount = Pasien::whereRaw("DATE_FORMAT(created_at, '%Y%m') = ?", [$yearMonth])->count();
        $no_rm = $yearMonth . '-' . str_pad($pasienCount + 1, STR_PAD_LEFT);

        return view('pasien.create', compact('no_rm')); 
    }

    // Simpan pasien baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:150',
            'alamat' => 'required|string|max:255',
            'no_ktp' => 'required|string|max:17|unique:pasien,no_ktp',
            'no_hp' => 'required|string|max:15',
        ]);

        // Generate nomor rekam medis (no_rm)
        $yearMonth = date('Ym');
        $pasienCount = Pasien::whereRaw("DATE_FORMAT(created_at, '%Y%m') = ?", [$yearMonth])->count();
        $no_rm = $yearMonth . '-' . str_pad($pasienCount + 1, STR_PAD_LEFT);

        Pasien::create([
            'nama' => $validated['nama'],
            'alamat' => $validated['alamat'],
            'no_ktp' => $validated['no_ktp'],
            'no_hp' => $validated['no_hp'],
            'no_rm' => $no_rm,
        ]);

        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil ditambahkan.');
    }

    // Tampilkan detail pasien
    public function show($id)
    {
        $pasien = Pasien::findOrFail($id);
        return view('pasien.show', compact('pasien'));
    }

    // Form edit pasien
    public function edit($id)
    {
        $pasien = Pasien::findOrFail($id);
        return view('pasien.edit', compact('pasien'));
    }

    // Update pasien
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:150',
            'alamat' => 'required|string|max:255',
            'no_ktp' => 'required|string|max:17|unique:pasien,no_ktp,' . $id,
            'no_hp' => 'required|string|max:15',
        ]);

        $pasien = Pasien::findOrFail($id);
        $pasien->update($validated);

        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil diperbarui.');
    }

    // Hapus pasien
    public function destroy($id)
    {
        $pasien = Pasien::findOrFail($id);
        $pasien->delete();

        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil dihapus.');
    }

    // PROFIL
    public function profile()
    {
        if (!session('id')) {
            return redirect()->route('pasien.login.form')
                ->withErrors(['auth' => 'Silakan login terlebih dahulu.'])
                ->with('danger', 'Silakan login terlebih dahulu!');
        }
    
        $pasien = Pasien::findOrFail(session('id'));
        return view('pasien.profil', compact('pasien'));
    }

    
    
}
