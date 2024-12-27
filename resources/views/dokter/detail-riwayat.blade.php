@extends('dokter.layouts.dashboard-dokter')
<title>Detail Riwayat Periksa</title>
@section('content')
<div class="container mt-4 mb-5">
    <h2>Detail Pemeriksaan</h2>

    <div class="card mb-4">
        <div class="card-header">Informasi Pemeriksaan</div>
        <div class="card-body">
            <p><strong>Nama Pasien:</strong> {{ $periksa->daftarPoli->pasien->nama }}</p>
            <p><strong>Poli:</strong> {{ $periksa->daftarPoli->jadwal->dokter->poli->nama_poli }}</p>
            <p><strong>Dokter:</strong> {{ $periksa->daftarPoli->jadwal->dokter->nama }}</p>
            <p><strong>Hari:</strong> {{ $periksa->daftarPoli->jadwal->hari }}</p>
            <p><strong>Jam Mulai:</strong> {{ $periksa->daftarPoli->jadwal->jam_mulai }}</p>
            <p><strong>Jam Selesai:</strong> {{ $periksa->daftarPoli->jadwal->jam_selesai }}</p>
            <p><strong>Status:</strong> {{ $periksa->daftarPoli->status }}</p>
            <p><strong>Catatan Pemeriksaan:</strong> {{ $periksa->catatan ?? 'Tidak ada catatan.' }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Detail Obat yang Diberikan</div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Obat</th>
                        <th>Harga</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detailPeriksa as $index => $detail)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $detail->obat->nama_obat }}</td>
                        <td>{{ number_format($detail->obat->harga, 0, ',', '.') }}</td>
                        <td>{{ $detail->keterangan ?? 'Tidak ada keterangan' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <h5><strong>Total Biaya Pemeriksaan: </strong>Rp {{ number_format($biayaPeriksa, 0, ',', '.') }}</h5>
        </div>
    </div>

    <a href="{{ route('dokter.riwayat', ['id_dokter' => $dokter->id]) }}" class="btn btn-primary">Kembali ke Riwayat</a>

</div>
@endsection
