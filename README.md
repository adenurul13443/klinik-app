# poliklinik-bk (U-Klinik)
Penugasan Bengkel Koding Bimbingan Karir

# Website Temu Janji Poli Udinus

Website Temu Janji Poli Udinus adalah aplikasi berbasis web yang memungkinkan pengguna untuk melakukan pendaftaran dan pengaturan jadwal kunjungan  poli di Universitas Dian Nuswantoro (Udinus). Website ini ditujukan untuk mempermudah pasien atau pengguna dalam memilih waktu kunjungan sesuai dengan kebutuhan mereka dan menghindari antrian yang panjang di rumah sakit atau klinik.

## Fitur Website 
- *Login sebagai Admin*: Admin dapat mengelola dan memantau seluruh aktivitas aplikasi.
- *Mengelola Dokter*: Admin dapat menambah, mengedit, atau menghapus data dokter yang terdaftar di sistem.
- *Mengelola Pasien*: Admin dapat mengelola data pasien yang terdaftar, termasuk melakukan pencarian dan pembaruan data pasien.
- *Mengelola Poli*: Admin dapat mengelola jadwal dan data poli yang tersedia di rumah sakit atau klinik.
- *Mengelola Obat*: Admin dapat mengelola data obat yang digunakan untuk pengobatan pasien.
- *Pendaftaran Pasien*: Pasien dapat melakukan pendaftaran secara online untuk mendapatkan layanan medis.
- *Login sebagai Pasien*: Pasien dapat masuk untuk mengakses data diri dan jadwal kunjungan mereka.
- *Mendaftar ke Poli*: Pasien dapat memilih poli yang diinginkan dan melakukan pendaftaran untuk konsultasi atau pemeriksaan.
- *Login sebagai Dokter*: Dokter dapat masuk untuk mengakses jadwal periksa dan data pasien yang akan diperiksa.
- *Memperbaharui Data Dokter*: Dokter dapat memperbarui data diri mereka, termasuk jadwal dan informasi terkait.
- *Input Jadwal Periksa*: Dokter dapat menginput jadwal pemeriksaan yang akan mereka lakukan untuk pasien.
- *Memeriksa Pasien*: Dokter dapat memeriksa pasien sesuai dengan jadwal yang telah ditentukan dan memberikan diagnosa serta perawatan yang diperlukan.
- *Menghitung Biaya Periksa*: Dokter dapat menghitung biaya periksa berdasarkan layanan yang diberikan selama pemeriksaan.
- *Memberikan Catatan Obat*: Dokter dapat memberikan resep obat kepada pasien setelah pemeriksaan.
- *Menampilkan Riwayat Pasien*: Dokter dapat melihat riwayat kesehatan dan pemeriksaan pasien sebelumnya.

## Teknologi yang Digunakan
- *Frontend*: HTML, CSS, JavaScript, Bootstrap 5
- *Backend*: PHP 
- *Database*: MySQL
- *Framework*: Laravel 11, 

## Persyaratan Sistem
- PHP >= 8.1
- Composer
- MySQL
- Node.js dan npm (untuk pengelolaan frontend)
- Laravel 11

## Instalasi dan Menjalankan Proyek
1. Clone Repository
2. Instalasi Dependensi
- Instal semua dependensi PHP menggunakan Composer:
perintah :
composer install

- Instal semua dependensi frontend menggunakan npm:
perintah
npm install

3. Pengaturan .env
Salin file .env.example menjadi file .env dan lakukan pengaturan sesuai dengan konfigurasi lingkungan yang anda gunakan
perintah : 
cp .env.example .env

Kemudian, buka file .env dan sesuaikan konfigurasi database, mail, dan lainnya sesuai kebutuhan Anda.

4. Generate Key Aplikasi
Jalankan perintah untuk menghasilkan aplikasi key Laravel:
perintah : 
php artisan key:generate

5. Migrasi dan Seeder Database
Jalankan migrasi dan seeding database untuk menyiapkan tabel dan data awal:
perintah : 
php artisan migrate --seed

6. Menjalankan Server
Setelah semuanya terinstal dan terkonfigurasi, jalankan server pengembangan Laravel menggunakan perintah berikut:
perintah : 
php artisan serve

# Informasi Login

Gunakan data berikut untuk mengakses aplikasi sesuai dengan peran:

1. Admin -> No HP: 089513613933 dan Password: admin
2. Dokter -> Nama : Dokter dan Alamat(Password): Semarang

# Berikut adalah struktur direktori utama dalam proyek ini:

├── app/               # Kode aplikasi utama
├── bootstrap/         # File konfigurasi bootstrap
├── config/            # File konfigurasi aplikasi
├── database/          # Migrasi dan seeder database
├── public/            # Berkas yang dapat diakses publik (gambar, js, css, dll.)
├── resources/         # Sumber daya tampilan (views, bahasa, dll.)
├── routes/            # Rute aplikasi
├── storage/           # File-file yang disimpan secara sementara