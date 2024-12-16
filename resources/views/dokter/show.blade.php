@extends('dokter.layouts.dashboard-dokter')
<title>Profil Dokter</title>
@section('content')
    <div class="container">
        <h2>Profil Dokter</h2>

        <table class="table table-bordered">
            <tr>
                <th>Nama</th>
                <td>{{ $dokter->nama }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>{{ $dokter->alamat }}</td>
            </tr>
            <tr>
                <th>Nomor HP</th>
                <td>{{ $dokter->no_hp }}</td>
            </tr>
            <tr>
                <th>Poli</th>
                <td>{{ $dokter->poli->nama_poli ?? 'Poli tidak tersedia' }}</td> <!-- Menampilkan nama poli terkait -->
            </tr>
        </table>
    </div>
@endsection
