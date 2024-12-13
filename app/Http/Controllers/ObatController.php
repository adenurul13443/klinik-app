<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    // Menampilkan semua data obat
    public function index()
    {
        $obats = Obat::all();
        return view('admin.obat.index', compact('obats'));
    }

    // Menampilkan form untuk menambah data obat
    public function create()
    {
        return view('admin.obat.create');
    }

    // Menyimpan data obat
    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'nullable|string|max:255',
            'harga' => 'required|numeric|min:0',  // Validasi harga harus berupa angka dan lebih besar dari 0
        ]);

        Obat::create([
            'nama_obat' => $request->nama_obat,
            'kemasan' => $request->kemasan,  // Menyimpan kemasan
            'harga' => $request->harga,  // Menyimpan harga
        ]);

        return redirect()->route('admin.obat.index')->with('success', 'Obat berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit data obat
    public function edit(Obat $obat)
    {
        return view('admin.obat.edit', compact('obat'));
    }

    // Memperbarui data obat
    public function update(Request $request, Obat $obat)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'nullable|string|max:255',
            'harga' => 'required|numeric|min:0',  // Validasi harga harus berupa angka dan lebih besar dari 0
        ]);

        $obat->update([
            'nama_obat' => $request->nama_obat,
            'kemasan' => $request->kemasan,  // Memperbarui kemasan
            'harga' => $request->harga,  // Memperbarui harga
        ]);

        return redirect()->route('admin.obat.index')->with('success', 'Obat berhasil diperbarui');
    }

    // Menghapus data obat
    public function destroy(Obat $obat)
    {
        $obat->delete();

        return redirect()->route('admin.obat.index')->with('success', 'Obat berhasil dihapus');
    }
}
