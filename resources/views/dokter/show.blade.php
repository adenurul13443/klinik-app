@extends('dokter.layouts.dashboard-dokter')
<title>Profil Dokter</title>
@section('content')
<div class="container mt-3 mb-5 p-3">
    <h1>Edit Profil</h1>
    <form action="{{ route('dokter.profil.update') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $dokter->nama) }}" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat', $dokter->alamat) }}</textarea>
        </div>
        <div class="form-group">
            <label for="no_hp">No HP</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp', $dokter->no_hp) }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('dokter.dashboard') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection