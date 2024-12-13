@extends('admin.layouts.admin')
<title>Kelola Pasien</title>
@section('content')
    <div class="container mt-5 p-3">
        <h1>Daftar Pasien</h1>

        <!-- Tombol untuk menampilkan modal tambah pasien -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createPasienModal">
            Tambah Pasien
        </button>

        <!-- Modal untuk tambah pasien -->
        <div class="modal fade" id="createPasienModal" tabindex="-1" aria-labelledby="createPasienModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createPasienModalLabel">Tambah Pasien</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form untuk menambah pasien -->
                        <form action="{{ route('admin.pasien.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Pasien</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="no_ktp" class="form-label">No. KTP</label>
                                <input type="number" class="form-control" id="no_ktp" name="no_ktp" required>
                            </div>
                            <div class="mb-3">
                                <label for="no_hp" class="form-label">No. HP</label>
                                <input type="number" class="form-control" id="no_hp" name="no_hp" required>
                            </div>
                            <div class="mb-3">
                                <label for="no_rm" class="form-label">No. Rekam Medis</label>
                                <input type="text" class="form-control" id="no_rm" name="no_rm" value="{{ $no_rm }}" readonly>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk edit pasien -->
        @foreach ($pasiens as $pasien)
        <div class="modal fade" id="editPasienModal{{ $pasien->id }}" tabindex="-1" aria-labelledby="editPasienModalLabel{{ $pasien->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPasienModalLabel{{ $pasien->id }}">Edit Pasien</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form untuk edit pasien -->
                        <form action="{{ route('admin.pasien.update', $pasien->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Pasien</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="{{ $pasien->nama }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" required>{{ $pasien->alamat }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="no_ktp" class="form-label">No. KTP</label>
                                <input type="number" class="form-control" id="no_ktp" name="no_ktp" value="{{ $pasien->no_ktp }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="no_hp" class="form-label">No. HP</label>
                                <input type="number" class="form-control" id="no_hp" name="no_hp" value="{{ $pasien->no_hp }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="no_rm" class="form-label">No. Rekam Medis</label>
                                <input type="text" class="form-control" id="no_rm" name="no_rm" value="{{ $pasien->no_rm }}" readonly>
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

        <!-- Tabel Daftar Pasien -->
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Pasien</th>
                    <th>Alamat</th>
                    <th>No. KTP</th>
                    <th>No. HP</th>
                    <th>No. RM</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pasiens as $pasien)
                <tr>
                    <td>{{ $pasien->nama }}</td>
                    <td>{{ $pasien->alamat }}</td>
                    <td>{{ $pasien->no_ktp }}</td>
                    <td>{{ $pasien->no_hp }}</td>
                    <td>{{ $pasien->no_rm }}</td>
                    <td>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editPasienModal{{ $pasien->id }}">
                            Edit
                        </button>
                        <form action="{{ route('admin.pasien.destroy', $pasien) }}" method="POST" style="display:inline;">
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

    <!-- Script Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert untuk Notifikasi -->
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
