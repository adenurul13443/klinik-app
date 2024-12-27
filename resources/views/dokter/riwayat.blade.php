@extends('dokter.layouts.dashboard-dokter')
@section('content')
<div class="container">
    <h3 class="mt-5">Riwayat Pemeriksaan Dokter {{ $dokter->nama }}</h3>

    <table class="table table-bordered mt-3 p-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pasien</th>
                <th>Poli</th>
                <th>Dokter</th>
                <th>Hari</th>
                <th>Mulai</th>
                <th>Selesai</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach($daftarPolis as $index => $daftarPoli)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $daftarPoli->pasien->nama }}</td>
                <td>{{ $daftarPoli->jadwal->dokter->poli->nama_poli }}</td>
                <td>{{ $daftarPoli->jadwal->dokter->nama }}</td>
                <td>{{ $daftarPoli->jadwal->hari }}</td>
                <td>{{ $daftarPoli->jadwal->jam_mulai }}</td>
                <td>{{ $daftarPoli->jadwal->jam_selesai }}</td>
                <td>{{ $daftarPoli->status }}</td>
                <td>
    @if($daftarPoli->periksa)
        <a href="{{ route('dokter.detail-riwayat', $daftarPoli->periksa->id) }}" class="btn btn-info">
            Lihat Detail
        </a>
    @else
        <span class="text-muted">Tidak tersedia</span>
    @endif
</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    
</div>
@endsection
