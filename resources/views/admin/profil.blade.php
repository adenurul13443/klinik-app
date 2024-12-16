@extends('admin.layouts.admin')
    <title>Profil Admin</title>
@section('content')
<div class="container mt-5 mb-5 p-3">
    <h2>Edit Profil</h2>

    <div class="profile-image mb-4">
        <img src="{{ asset('img/profile.jpg') }}" alt="profil admin">
    </div>
    <!-- Form Edit Profil tanpa alamat -->
    <form action="{{ route('admin.profil.update') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $admin->nama }}" required>
        </div>
        <div class="mb-3">
            <label for="no_hp" class="form-label">Nomor HP</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ $admin->no_hp }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>

    <!-- Form Edit Password -->
    <form action="{{ route('admin.profil.update-password') }}" method="POST" class="mt-4">
        @csrf
        <div class="mb-3">
            <label for="current_password" class="form-label">Password Lama</label>
            <div class="input-group">
                <input type="password" class="form-control" id="current_password" name="current_password" required>
                <button class="btn btn-outline-secondary toggle-password" type="button" id="toggle_current_password">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
        </div>
        <div class="mb-3">
            <label for="new_password" class="form-label">Password Baru</label>
            <div class="input-group">
                <input type="password" class="form-control" id="new_password" name="new_password" required>
                <button class="btn btn-outline-secondary toggle-password" type="button" id="toggle_new_password">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
        </div>
        <div class="mb-3">
            <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
            <div class="input-group">
                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                <button class="btn btn-outline-secondary toggle-password" type="button" id="toggle_current_password_confirmation">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Perbarui Password</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Menangani toggle untuk setiap password secara terpisah
        const togglePassword = (inputId, buttonId) => {
            const passwordInput = document.getElementById(inputId);
            const toggleButton = document.getElementById(buttonId);
            const icon = toggleButton.querySelector('i');

            toggleButton.addEventListener('click', function () {
                // Toggle tipe input antara password dan text
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text'; // Tampilkan password
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                } else {
                    passwordInput.type = 'password'; // Sembunyikan password
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                }
            });
        };

        // Inisialisasi toggle untuk setiap input password
        togglePassword('current_password', 'toggle_current_password');
        togglePassword('new_password', 'toggle_new_password');
        togglePassword('new_password_confirmation', 'toggle_new_password_confirmation');
    });
</script>

@endsection

