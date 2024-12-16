@extends('pasien.layouts.dashboard-pasien')
<title>Dashboard Pasien</title>

<!-- STYLE -->
 <style>
    .header{
        background-color:blue;
        color:white;
        border-radius: 10px 10px 0px 0px;
        padding: 5px 10px;
    }
 </style>
@section('content')
<div class="container mt-5 mb-5">
    <h1>Daftar Poli</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="poli-form card card-rounded">
                <div class="header mb-3">
                    <h3>Daftar Poli</h3>
                </div>
                <form class="p-3">
                    <div class="mb-3">
                        <label for="no_rm" class="form-label">Nomor Rekam Medis</label>
                        <input type="text" class="form-control" id="no_rm" name="no_rm" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="id_poli" class="form-label">Pilih Poli</label>
                        <select class="form-select" id="id_poli" name="id_poli" required>
                            <option value="">Pilih Poli</option>
                            <option value="">Poli 1</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="id_jadwal" class="form-label">Pilih Jadwal</label>
                        <select class="form-select" id="id_jadwal" name="id_jadwal" required>
                            <option value="">Pilih Jadwal</option>
                            <option value="">Poli 1</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="keluhan" class="form-label">Keluhan</label>
                        <textarea class="form-control" id="keluhan" name="keluhan" required></textarea>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-12">
            <div class="riwayat card card-rounded">
                <div class="header mb-3">
                    <h3>Riwayat Daftar Poli</h3>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Poli</th>
                            <th>Dokter</th>
                            <th>Hari</th>
                            <th>Mulai</th>
                            <th>Selesai</th>
                            <th>Antrian</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Poli Gigi</td>
                            <td>Dokter 1</td>
                            <td>Senin</td>
                            <td>08.00 wib</td>
                            <td>09.00 wib</td>
                            <td>40</td>
                            <td>Belum Diperiksa</td>
                            <td>Edit|Hapus</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection