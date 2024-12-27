@extends('dokter.layouts.dashboard-dokter')
<title>Periksa Pasien</title>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@section('content')
<div class="container">
    <h3 class="mt-5">Periksa Pasien - Dokter {{ $dokter->nama }}</h3>

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
                    @if($daftarPoli->status === 'belum diperiksa')
                        <!-- Tombol Aksi Periksa -->
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalPeriksa{{ $daftarPoli->id }}">
                            Periksa
                        </button>
                    @else
                        <!-- Tombol Disabled -->
                        <button class="btn btn-secondary" disabled>Sudah Diperiksa</button>
                    @endif
            </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Form Periksa -->
@foreach($daftarPolis as $daftarPoli)
    <div class="modal fade" id="modalPeriksa{{ $daftarPoli->id }}" tabindex="-1" aria-labelledby="modalPeriksaLabel{{ $daftarPoli->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPeriksaLabel{{ $daftarPoli->id }}">Form Periksa Pasien</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('dokter.periksa.store', ['id_dokter' => $dokter->id]) }}" method="POST">
                    @csrf
                    <input type="hidden" name="dokter_id" value="{{ $dokter->id }}">
                    <input type="hidden" name="id_daftar_poli" value="{{ $daftarPoli->id }}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_pasien" class="form-label">Nama Pasien</label>
                            <input type="text" class="form-control" id="nama_pasien" value="{{ $daftarPoli->pasien->nama }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="tgl_periksa" class="form-label">Tanggal Periksa</label>
                            <input type="date" class="form-control" id="tgl_periksa" name="tgl_periksa" required>
                        </div>
                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan</label>
                            <textarea class="form-control" id="catatan" name="catatan"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="obat" class="form-label">Obat</label>
                            <select class="form-control" id="obat" name="obat[]" multiple required>
                                @foreach($obats as $obat)
                                    <option value="{{ $obat->id }}" data-harga="{{ $obat->harga }}">
                                        {{ $obat->nama_obat }} - Rp {{ number_format($obat->harga, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="biaya_periksa{{ $daftarPoli->id }}" class="form-label">Biaya Periksa</label>
                            <input type="text" class="form-control" id="biaya_periksa{{ $daftarPoli->id }}" name="biaya_periksa" value="15000" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

<!-- JavaScript untuk menghitung total biaya -->
<script>
    document.querySelectorAll('[id^="obat"]').forEach(function(selectElement) {
        selectElement.addEventListener('change', function() {
            let biayaPeriksa = 150000; // Biaya periksa tetap
            let totalBiaya = biayaPeriksa; // Inisialisasi total biaya dengan biaya periksa
            let options = selectElement.selectedOptions;
            
            // Menambahkan harga obat yang dipilih
            for (let option of options) {
                totalBiaya += parseInt(option.getAttribute('data-harga')); // Menambahkan harga obat ke total
            }
            
            // Ambil ID input biaya periksa yang sesuai
            const modalId = selectElement.id.replace('obat', 'biaya_periksa'); // Ganti 'obat' dengan 'biaya_periksa'
            
            // Update nilai input biaya periksa dengan total biaya (menambahkan Rp pada tampilan)
            document.getElementById(modalId).value = 'Rp ' + totalBiaya.toLocaleString();
        });
    });

    $(document).ready(function() {
        $('#obat').select2({
            placeholder: "Pilih Obat",
            allowClear: true
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@endsection
