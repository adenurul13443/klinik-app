@extends('pasien.layouts.dashboard-pasien')
<title>Profil Pasien</title>
@section('content')
<div class="container mt-5">
    <h1>Profil Pasien</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>Nomor Rekam Medis:</strong> {{ $pasien->no_rm }}</p>
            <p><strong>Nama:</strong> {{ $pasien->nama }}</p>
            <p><strong>Alamat:</strong> {{ $pasien->alamat }}</p>
            <p><strong>No. KTP:</strong> {{ $pasien->no_ktp }}</p>
            <p><strong>No. HP:</strong> {{ $pasien->no_hp }}</p>
        </div>
    </div>
</div>
@endsection
