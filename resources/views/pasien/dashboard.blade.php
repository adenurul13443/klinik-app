<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pasien</title>
</head>
<body>
    <h1>Selamat Datang di Dashboard Pasien</h1>
    <p>Halo, {{ session('nama') }}</p>
</body>
</html> -->

@extends('pasien.layouts.dashboard-pasien')
<title>Dashboard Pasien</title>
@section('content')
          <div class="page-inner mb-5">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3">Dashboard</h3>
              </div>
            </div>
            <div class="row">
              <div class="col-md-8">
                <div class="card card-round">
                  <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                      <div class="card-title">Riwayat Daftar Poli Terbaru</div>
                    </div>
                  </div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <!-- Projects table -->
                      <table class="table align-items-center mb-3">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">Poli</th>
                            <th scope="col" class="text-end">Dokter</th>
                            <th scope="col" class="text-end">Hari</th>
                            <th scope="col" class="text-end">Antrian</th>
                            <th scope="col" class="text-end">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">Poli Gigi</th>
                            <td class="text-end">Dokter 1</td>
                            <td class="text-end">Rabu</td>
                            <td class="text-end">40</td>
                            <td class="text-end">Belum Diperiksa</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
              <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-primary bubble-shadow-small"
                        >
                          <i class="fas fa-users"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Daftar Poli</p>
                          <h4 class="card-title">10</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner" style="border-radius: 10px; box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;">
                  <div class="carousel-item active">
                    <img src="{{ asset('img/gallery-1.jpg') }}" class="d-block w-100" alt="Image 1">
                  </div>
                  <div class="carousel-item">
                    <img src="{{ asset('img/gallery-2.jpg') }}" class="d-block w-100" alt="Image 2">
                  </div>
                  <div class="carousel-item">
                    <img src="{{ asset('img/gallery-3.jpg') }}" class="d-block w-100" alt="Image 3">
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
            </div>
          </div>
@endsection
