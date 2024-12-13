<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
</head>
<body>
    <h1>Login Admin</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div> 
    @endif

    <form action="{{ route('admin.login.form') }}" method="POST">
        @csrf
        <label for="no_hp">Nomor HP:</label>
        <input type="text" id="no_hp" name="no_hp" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit">Login</button>
    </form>
</body>
</html> -->

@extends('layouts.login-layout')
    <title>Login</title>
@section('content')
            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div> 
            @endif
            <!-- Form -->
            <div class="login-form">
                <h4 class="text-center mb-4">Login Admin</h4>
                <form action="{{ route('admin.login.form') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">Nomor Handphone</label>
                        <input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan nomor handphone" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label><br>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
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
                    const passwordInput = document.querySelector('#password');

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

                //SweetAlert Sukses
                @if(session('success'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses!',
                        text: '{{ session('success') }}',
                        timer: 3000,
                        confirmButtonText: 'OK'
                    });
                @endif

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
