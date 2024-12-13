@extends('admin.layouts.admin')
    <title>Kelola Poli</title>
@section('content')
    <div class="container mt-5 p-3">
        <h1>Daftar Poli</h1>
        <!-- Tombol untuk menampilkan modal -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createPoliModal">
            Tambah Poli
        </button>

        <!-- Modal untuk tambah poli -->
        <div class="modal fade" id="createPoliModal" tabindex="-1" aria-labelledby="createPoliModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createPoliModalLabel">Tambah Poli</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form untuk menambah poli -->
                        <form action="{{ route('admin.poli.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_poli" class="form-label">Nama Poli</label>
                                <input type="text" class="form-control" id="nama_poli" name="nama_poli" required>
                            </div>
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" required></textarea>
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

        <!-- Modal untuk edit poli-->
        @foreach ($polis as $poli)
        <div class="modal fade" id="editPoliModal{{ $poli->id }}" tabindex="-1" aria-labelledby="editPoliModalLabel{{ $poli->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPoliModalLabel{{ $poli->id }}">Edit Poli</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form untuk edit poli -->
                        <form action="{{ route('admin.poli.update', $poli->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="nama_poli" class="form-label">Nama Poli</label>
                                <input type="text" class="form-control" id="nama_poli" name="nama_poli" value="{{ $poli->nama_poli }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" required>{{ $poli->keterangan }}</textarea>
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
                    <th>Nama Poli</th>
                    <th>Keterangan</th> 
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($polis as $poli)
                <tr>
                    <td>{{ $poli->nama_poli }}</td>
                    <td>{{ $poli->keterangan }}</td> 
                    <td>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editPoliModal{{ $poli->id }}">
                            Edit
                        </button>
                        <form action="{{ route('admin.poli.destroy', $poli) }}" method="POST" style="display:inline;">
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

    <!-- Tambahkan link JS Bootstrap atau JS lainnya di sini -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

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
