<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Dokter</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container mt-5">
        <h2>Login Dokter</h2>
        <form method="POST" action="{{ route('dokter.login') }}">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html> -->

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pasien</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Login Pasien</h2>
        <form method="POST" action="{{ route('pasien.login') }}">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
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
</body>
</html> -->

@extends('layouts.login-layout')
    <title>Login</title>
@section('content')
            <!-- Form -->
            <div class="login-form">
                <h4 class="text-center mb-4">Login Dokter</h4>
                <form method="POST" action="{{ route('dokter.login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama Anda" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Password</label><br>
                        <div class="input-group">
                            <input type="password" class="form-control" id="alamat" name="alamat" placeholder="Masukkan password" required>
                            <button class="btn btn-outline-secondary toggle-password" type="button">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Login</button>
                    </div>
                </form>
            </div>

            <!-- Script -->
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const togglePasswordButton = document.querySelector('.toggle-password');
                    const passwordInput = document.querySelector('#alamat');

                    togglePasswordButton.addEventListener('click', function () {
                        const icon = this.querySelector('i');
                        if (passwordInput.type === 'password') {
                            passwordInput.type = 'text';
                            icon.classList.remove('bi-eye');
                            icon.classList.add('bi-eye-slash');
                        } else {
                            passwordInput.type = 'password';
                            icon.classList.remove('bi-eye-slash');
                            icon.classList.add('bi-eye');
                        }
                    });
                });
                 // SweetAlert untuk pesan error
                 @if(session('error'))
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: '{{ session('error') }}',
                        timer: 3000,
                        confirmButtonText: 'OK'
                    });
                @endif

                // SweetAlert untuk validasi error
                @if($errors->any())
                    Swal.fire({
                        icon: 'error',
                        title: 'Kesalahan!',
                        html: '{!! implode("<br>", $errors->all()) !!}',
                    });
                @endif
            </script>
@endsection