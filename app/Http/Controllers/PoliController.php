<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    // Menampilkan semua data poli
    public function index()
    {
        $polis = Poli::all();
        return view('admin.poli.index', compact('polis'));
    }

    // Menampilkan form untuk menambah data poli
    public function create()
    {
        return view('admin.poli.create');
    }

    // Menyimpan data poli
    public function store(Request $request)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:500',
        ]);

        Poli::create([
            'nama_poli' => $request->nama_poli,
            'keterangan' => $request->keterangan,  // Menyimpan keterangan
        ]);

        return redirect()->route('admin.poli.index')->with('success', 'Poli berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit data poli
    public function edit(Poli $poli)
    {
        return view('admin.poli.edit', compact('poli'));
    }

    // Memperbarui data poli
    public function update(Request $request, Poli $poli)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:500',
        ]);

        $poli->update([
            'nama_poli' => $request->nama_poli,
            'keterangan' => $request->keterangan,  // Memperbarui keterangan
        ]);

        return redirect()->route('admin.poli.index')->with('success', 'Poli berhasil diperbarui');
    }

    // Menghapus data poli
    public function destroy(Poli $poli)
    {
        $poli->delete();

        return redirect()->route('admin.poli.index')->with('success', 'Poli berhasil dihapus');
    }
}