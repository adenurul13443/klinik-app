@extends('pasien.layouts.dashboard-pasien')
<title>Profil Pasien</title>
@section('content')
    <div class="container">
        <h2>Profil Pasien</h2>

        <table class="table table-bordered">
            <tr>
                <th>Nama</th>
                <td>{{ $pasien->nama }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>{{ $pasien->alamat }}</td>
            </tr>
            <tr>
                <th>Nomor HP</th>
                <td>{{ $pasien->no_hp }}</td>
            </tr>
            <tr>
                <th>Nomor KTP</th>
                <td>{{ $pasien->no_ktp }}</td>
            </tr>
            <tr>
                <th>Nomor Rekam Medis</th>
                <td>{{ $pasien->no_rm }}</td>
            </tr>
        </table>
    </div>
@endsection
