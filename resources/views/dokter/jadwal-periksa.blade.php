@extends('dokter.layouts.dashboard-dokter')
<title>Jadwal Periksa</title>
@section('content')
    <div class="container mt-3 mb-5 p-3">
        <h1>Daftar Jadwal Periksa</h1>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahJadwal">Tambah Jadwal</button>

        <table class="table">
            <thead>
                <tr>
                    <th>Dokter</th>
                    <th>Hari</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jadwals as $jadwal)
                    <tr>
                        <td>{{ $jadwal->dokter->nama ?? 'Data tidak tersedia' }}</td>
                        <td>{{ $jadwal->hari }}</td>
                        <td>{{ $jadwal->jam_mulai }}</td>
                        <td>{{ $jadwal->jam_selesai }}</td>
                        <td>{{ ucfirst($jadwal->status) }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modalEditJadwal-{{ $jadwal->id }}">Edit</button>
                            <form action="{{ route('jadwal-periksa.destroy', $jadwal->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="modalEditJadwal-{{ $jadwal->id }}" tabindex="-1" aria-labelledby="modalEditLabel-{{ $jadwal->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalEditLabel-{{ $jadwal->id }}">Edit Jadwal</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('jadwal-periksa.update', $jadwal->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group mb-3">
                                            <label for="id_dokter">Dokter</label>
                                            <input type="text" class="form-control" value="{{ $dokter->nama }}" readonly>
                                            <input type="hidden" name="id_dokter" value="{{ $dokter->id }}">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="hari">Hari</label>
                                            <input type="text" name="hari" class="form-control" value="{{ $jadwal->hari }}" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="jam_mulai">Jam Mulai</label>
                                            <input type="time" name="jam_mulai" class="form-control" value="{{ old('jam_mulai', \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i')) }}" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="jam_selesai">Jam Selesai</label>
                                            <input type="time" name="jam_selesai" class="form-control" value="{{ old('jam_selesai', \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i')) }}" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="status">Status</label>
                                            <select name="status" class="form-control" required>
                                                <option value="aktif" {{ $jadwal->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                <option value="tidak aktif" {{ $jadwal->status == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Edit -->
                @endforeach
            </tbody>
        </table>

        <!-- Modal Tambah -->
        <div class="modal fade" id="modalTambahJadwal" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahLabel">Tambah Jadwal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('jadwal-periksa.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="id_dokter">Dokter</label>
                                <input type="text" class="form-control" value="{{ $dokter->nama }}" readonly>
                                <input type="hidden" name="id_dokter" value="{{ $dokter->id }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="hari">Hari</label>
                                <input type="text" name="hari" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="jam_mulai">Jam Mulai</label>
                                <input type="time" name="jam_mulai" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="jam_selesai">Jam Selesai</label>
                                <input type="time" name="jam_selesai" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="status">Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="aktif">Aktif</option>
                                    <option value="tidak aktif">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
