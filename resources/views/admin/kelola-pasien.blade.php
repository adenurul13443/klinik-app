@extends('admin.dashboard') <!-- Sesuaikan layout admin Anda -->

@section('content')
<div class="container">
    <h1>Kelola Pasien</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pasiens as $index => $pasien)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $pasien->nama }}</td>
                <td>{{ $pasien->email }}</td>
                <td>{{ $pasien->telepon }}</td>
                <td>{{ $pasien->alamat }}</td>
                <td>
                    <!-- Tombol Edit -->
                    <a href="{{ route('admin.edit-pasien', $pasien->id) }}" class="btn btn-primary">Edit</a>
                    <!-- Tombol Hapus -->
                    <form action="{{ route('admin.delete-pasien', $pasien->id) }}" method="POST" style="display:inline;">
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
@endsection
