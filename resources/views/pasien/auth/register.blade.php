<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Pasien</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> 
</head>
<body>
    <div class="container mt-5">
        <h2>Pendaftaran Pasien</h2>
        <form method="POST" action="{{ route('pasien.register') }}">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="no_ktp" class="form-label">No. KTP</label>
                <input type="text" class="form-control" id="no_ktp" name="no_ktp" required>
            </div>
            <div class="mb-3">
                <label for="no_hp" class="form-label">No. HP</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp" required>
            </div>
            <button type="submit" class="btn btn-primary">Daftar</button>
        </form>
    </div>
</body>
</html> -->


@extends('layouts.login-layout')
    <title>Registrasi</title>
@section('content')
            <!-- Form -->
            <div class="login-form">
                <h4 class="text-center mb-4">Registrasi</h4>
                <form method="POST" action="{{ route('pasien.register') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="no_ktp" class="form-label">Nomor KTP</label>
                        <input type="number" class="form-control" id="no_ktp" name="no_ktp" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">Nomor Handphone</label>
                        <input type="number" class="form-control" id="no_hp" name="no_hp" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Registrasi</button>
                    </div>
                </form>
                <!-- Footer -->
                <div class="login-footer mt-3">
                    Sudah punya akun? <a href="{{ route('pasien.login') }}"><b>Login Di sini.</b></a>
                </div>
            </div>
@endsection
