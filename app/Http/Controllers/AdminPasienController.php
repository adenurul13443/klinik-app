<?php

namespace App\Http\Controllers;

use App\Models\Pasien; // Pastikan model Pasien sudah ada
use Illuminate\Http\Request;

class AdminPasienController extends Controller
{
    public function index()
    {
        // Ambil semua data pasien
        $pasiens = Pasien::all();

        // Kirim data ke view
        return view('admin.kelola-pasien', compact('pasien'));
    }

    public function edit($id)
    {
        $pasien = Pasien::findOrFail($id);
        return view('admin.edit-pasien', compact('pasien'));
    }

    public function update(Request $request, $id)
    {
        $pasien = Pasien::findOrFail($id);
        $pasien->update($request->all());
        return redirect()->route('admin.kelola-pasien')->with('success', 'Pasien berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pasien = Pasien::findOrFail($id);
        $pasien->delete();
        return redirect()->route('admin.kelola-pasien')->with('success', 'Pasien berhasil dihapus');
    }

}
