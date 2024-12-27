@extends('pasien.layouts.dashboard-pasien')
<title>Daftar Poli</title>
@section('content')

<div class="container mt-3 mb-5 p-3">
    <h2>Daftar Poli</h2>

    <form action="{{ route('daftar_poli.store') }}" method="POST">
    @if(isset($pasien))
        @csrf
    
        <div class="form-group">
            <label for="no_rm">Nomor Rekam Medis</label>
            <input type="text" name="no_rm" value="{{ $pasien->no_rm }}" class="form-control" readonly>
        </div>
     @else
    <p>Data pasien tidak ditemukan. Pastikan Anda sudah login.</p>
    @endif


    <div class="form-group">
        <label for="poli">Pilih Poli</label>
        <select id="poli" name="id_poli" class="form-select">
            <option value="">-- Pilih Poli --</option>
            @foreach ($polis as $poli)
                <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
            @endforeach
        </select>
    </div>

<div class="form-group">
    <label for="jadwal">Pilih Jadwal</label>
    <select id="jadwal" name="id_jadwal" class="form-select">
        <option value="">-- Pilih Jadwal --</option>
        <!-- Data jadwal akan diisi melalui AJAX -->
    </select>
</div>


    <div class="form-group">
        <label for="keluhan">Keluhan</label>
        <textarea name="keluhan" id="keluhan" class="form-control" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Daftar</button>
    </form>


        <!-- Tabel Riwayat -->
        <h3 class="mt-5">Riwayat Pendaftaran</h3>
<table class="table table-bordered mt-3 p-3">
    <thead>
        <tr>
            <th>No</th>
            <th>Poli</th>
            <th>Dokter</th>
            <th>Hari</th>
            <th>Mulai</th>
            <th>Selesai</th>
            <th>Antrian</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    @foreach($riwayats as $index => $riwayat)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $riwayat->jadwal && $riwayat->jadwal->dokter && $riwayat->jadwal->dokter->poli ? $riwayat->jadwal->dokter->poli->nama_poli : 'Tidak ada poli' }}</td>
            <td>{{ $riwayat->jadwal->dokter ? $riwayat->jadwal->dokter->nama : 'Tidak ada dokter' }}</td>
            <td>{{ $riwayat->jadwal ? $riwayat->jadwal->hari : 'Tidak ada hari' }}</td>
            <td>{{ $riwayat->jadwal ? $riwayat->jadwal->jam_mulai : 'Tidak ada jam mulai' }}</td>
            <td>{{ $riwayat->jadwal ? $riwayat->jadwal->jam_selesai : 'Tidak ada jam selesai' }}</td>
            <td>{{ $riwayat->no_antrian }}</td> <!-- Menampilkan nomor antrian -->
            <td>{{ $riwayat->status ?? 'Tidak ada status' }}</td> <!-- Misalnya, jika ada status -->
            <td>
                <!-- Tombol Detail -->
                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $riwayat->id }}">
                    Detail
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<!-- Modal Detail -->
<!-- Modal Detail -->
@foreach($riwayats as $riwayat)
<div class="modal fade" id="modalDetail{{ $riwayat->id }}" tabindex="-1" aria-labelledby="modalDetailLabel{{ $riwayat->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailLabel{{ $riwayat->id }}">Detail Pendaftaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Informasi Poli</h5>
                <p><strong>Poli:</strong> {{ $riwayat->jadwal->dokter->poli->nama_poli ?? 'Tidak ada poli' }}</p>
                <p><strong>Dokter:</strong> {{ $riwayat->jadwal->dokter->nama ?? 'Tidak ada dokter' }}</p>
                <p><strong>Hari:</strong> {{ $riwayat->jadwal->hari ?? 'Tidak ada hari' }}</p>
                <p><strong>Jam Mulai:</strong> {{ $riwayat->jadwal->jam_mulai ?? 'Tidak ada jam mulai' }}</p>
                <p><strong>Jam Selesai:</strong> {{ $riwayat->jadwal->jam_selesai ?? 'Tidak ada jam selesai' }}</p>
                <p><strong>Antrian:</strong> {{ $riwayat->no_antrian }}</p>
                <p><strong>Status:</strong> {{ $riwayat->status ?? 'Tidak ada status' }}</p>

                @if($riwayat->status == 'sudah diperiksa')
                    <p><strong>Tanggal Periksa:</strong> {{ $riwayat->periksa->tgl_periksa }}</p>
                    <p><strong>Biaya Pemeriksaan:</strong> Rp {{ number_format($riwayat->biayaPeriksa, 0, ',', '.') }}</p>
                    <p><strong>Catatan Pemeriksaan:</strong> {{ $riwayat->periksa->catatan ?? 'Tidak ada catatan.' }}</p>
                @else
                    <p>Pasien belum diperiksa.</p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach



</div>

<script>
    document.getElementById('poli').addEventListener('change', function () {
        const poliId = this.value;
        const jadwalSelect = document.getElementById('jadwal');

        // Kosongkan dropdown jadwal
        jadwalSelect.innerHTML = '<option value="">-- Pilih Jadwal --</option>';

        if (poliId) {
            // Lakukan AJAX ke server
            fetch(`/get-jadwal?id_poli=${poliId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        data.forEach(jadwal => {
                            const option = document.createElement('option');
                            option.value = jadwal.id;
                            option.textContent = `${jadwal.dokter.nama} | ${jadwal.hari}, ${jadwal.jam_mulai} - ${jadwal.jam_selesai}`;
                            jadwalSelect.appendChild(option);
                        });
                    } else {
                        alert('Tidak ada jadwal untuk poli yang dipilih.');
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    });

    document.querySelectorAll('.btn-info').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            fetch(`/daftar-poli/${id}/detail`)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    // Update modal dengan data detail
                })
                .catch(error => console.error('Error:', error));
        });
    });

</script>

@endsection
