@extends('admin.layouts.admin')
    <title>Kelola Dokter</title>
@section('content')
    <div class="container mt-5 p-3">
        <h1>Daftar Dokter</h1>
        <!-- Tombol untuk menampilkan modal -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createDokterModal">
            Tambah Dokter
        </button>

        <!-- Modal untuk tambah dokter -->
        <div class="modal fade" id="createDokterModal" tabindex="-1" aria-labelledby="createDokterModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createDokterModalLabel">Tambah Dokter</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form untuk menambah dokter -->
                        <form action="{{ route('admin.dokter.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Dokter</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label for="no_hp" class="form-label">No HP</label>
                                <input type="number" class="form-control" id="no_hp" name="no_hp" required>
                            </div>
                            <div class="mb-3">
                                <label for="id_poli" class="form-label">Poli</label>
                                <select class="form-select" id="id_poli" name="id_poli" required>
                                    <option value="">Pilih Poli</option>
                                    @foreach ($polis as $poli)
                                        <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk edit dokter -->
        @foreach ($dokters as $dokter)
        <div class="modal fade" id="editDokterModal{{ $dokter->id }}" tabindex="-1" aria-labelledby="editDokterModalLabel{{ $dokter->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editDokterModalLabel{{ $dokter->id }}">Edit Dokter</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form untuk edit dokter -->
                        <form action="{{ route('admin.dokter.update', $dokter->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Dokter</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="{{ $dokter->nama }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" required>{{ $dokter->alamat }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="no_hp" class="form-label">No HP</label>
                                <input type="number" class="form-control" id="no_hp" name="no_hp" value="{{ $dokter->no_hp }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="id_poli" class="form-label">Poli</label>
                                <select class="form-select" id="id_poli" name="id_poli" required>
                                    <option value="">Pilih Poli</option>
                                    @foreach ($polis as $poli)
                                        <option value="{{ $poli->id }}" {{ $dokter->poli_id == $poli->id ? 'selected' : '' }}>
                                            {{ $poli->nama_poli }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach



        <table class="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Alamat</th> <!-- Mengubah header dari "Spesialis" menjadi "Alamat" -->
                    <th>Poli</th>
                    <th>No HP</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dokters as $dokter)
                <tr>
                    <td>{{ $dokter->nama }}</td>
                    <td>{{ $dokter->alamat }}</td> <!-- Menampilkan alamat -->
                    <td>{{ $dokter->poli->nama_poli}}</td>
                    <td>{{ $dokter->no_hp }}</td>
                    <td>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editDokterModal{{ $dokter->id }}">
                            Edit
                        </button>
                        <form action="{{ route('admin.dokter.destroy', $dokter) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });
    </script>
    @endif
@endsection
