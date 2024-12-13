@extends('admin.layouts.admin')
    <title>Kelola Obat</title>
@section('content')
    <div class="container mt-5 p-3">
        <h1>Daftar Obat</h1>
        <!-- Tombol untuk menampilkan modal -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createObatModal">
            Tambah Obat
        </button>

        <!-- Modal untuk tambah obat -->
        <div class="modal fade" id="createObatModal" tabindex="-1" aria-labelledby="createObatModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createObatModalLabel">Tambah Obat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form untuk menambah obat -->
                        <form action="{{ route('admin.obat.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_obat" class="form-label">Nama Obat</label>
                                <input type="text" class="form-control" id="nama_obat" name="nama_obat" required>
                            </div>
                            <div class="mb-3">
                                <label for="kemasan" class="form-label">Kemasan</label>
                                <input type="text" class="form-control" id="kemasan" name="kemasan" required>
                            </div>
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="number" class="form-control" id="harga" name="harga" required>
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

        <!-- Modal untuk edit obat-->
        @foreach ($obats as $obat)
        <div class="modal fade" id="editObatModal{{ $obat->id }}" tabindex="-1" aria-labelledby="editObatModalLabel{{ $obat->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editObatModalLabel{{ $obat->id }}">Edit Obat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form untuk edit obat -->
                        <form action="{{ route('admin.obat.update', $obat->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="nama_obat" class="form-label">Nama Obat</label>
                                <input type="text" class="form-control" id="nama_obat" name="nama_obat" value="{{ $obat->nama_obat }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="kemasan" class="form-label">Kemasan</label>
                                <input type="text" class="form-control" id="kemasan" name="kemasan" value="{{ $obat->kemasan }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="number" class="form-control" id="harga" name="harga" value="{{ $obat->harga }}" required>
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
                    <th>Nama Obat</th>
                    <th>Kemasan</th> 
                    <th>Harga</th> 
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($obats as $obat)
                <tr>
                    <td>{{ $obat->nama_obat }}</td>
                    <td>{{ $obat->kemasan }}</td> 
                    <td>{{ 'Rp ' . number_format($obat->harga, 0, ',', '.') }}</td> 
                    <td>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editObatModal{{ $obat->id }}">
                            Edit
                        </button>
                        <form action="{{ route('admin.obat.destroy', $obat) }}" method="POST" style="display:inline;">
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
