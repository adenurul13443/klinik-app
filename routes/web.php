<?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\AuthController;
    use App\Http\Middleware\RoleMiddleware;
    use App\Http\Controllers\PasienController;
    use App\Http\Controllers\DokterController;
    use App\Http\Controllers\AdminController;
    use App\Http\Controllers\AdminPasienController;
    use App\Http\Controllers\PoliController;
    use App\Http\Controllers\ObatController;
    use App\Http\Controllers\JadwalPeriksaController;
    
 
    Route::get('/register', [PasienController::class, 'showRegisterForm'])->name('pasien.register.form');
    Route::post('/register', [PasienController::class, 'register'])->name('pasien.register');

    Route::get('/login', [PasienController::class, 'showLoginForm'])->name('pasien.login.form');
    Route::post('/login', [PasienController::class, 'login'])->name('pasien.login');
    Route::post('/logout', [PasienController::class, 'logout'])->name('pasien.logout');

    Route::get('/dokter/login', [DokterController::class, 'loginForm'])->name('dokter.login.form');
    Route::post('/dokter/login', [DokterController::class, 'login'])->name('dokter.login');
    Route::post('/dokter/logout', [DokterController::class, 'logout'])->name('dokter.logout');

    Route::prefix('admin')->group(function () {
        Route::get('login', [AdminController::class, 'loginForm'])->name('admin.login.form');
        Route::post('login', [AdminController::class, 'login'])->name('admin.login');
        Route::post('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

        // KELOLA DOKTER
        Route::get('/dokter', [AdminController::class, 'indexDokter'])->name('admin.dokter.index');
        Route::get('/dokter/create', [AdminController::class, 'createDokter'])->name('admin.dokter.create');
        Route::post('/dokter', [AdminController::class, 'storeDokter'])->name('admin.dokter.store');
        Route::get('dokter/{dokter}/edit', [AdminController::class, 'editDokter'])->name('admin.dokter.edit');
        Route::put('dokter/{dokter}', [AdminController::class, 'updateDokter'])->name('admin.dokter.update');
        Route::delete('dokter/{dokter}', [AdminController::class, 'destroyDokter'])->name('admin.dokter.destroy');

         // KELOLA POLI
        Route::get('/poli', [AdminController::class, 'indexPoli'])->name('admin.poli.index');
        Route::get('/poli/create', [AdminController::class, 'createPoli'])->name('admin.poli.create');
        Route::post('/poli', [AdminController::class, 'storePoli'])->name('admin.poli.store');
        Route::get('/poli/{poli}/edit', [AdminController::class, 'editPoli'])->name('admin.poli.edit');
        Route::put('/poli/{poli}', [AdminController::class, 'updatePoli'])->name('admin.poli.update');
        Route::delete('/poli/{poli}', [AdminController::class, 'destroyPoli'])->name('admin.poli.destroy');

        // KELOLA OBAT
        Route::get('/obat', [AdminController::class, 'indexObat'])->name('admin.obat.index');
        Route::get('/obat/create', [AdminController::class, 'createObat'])->name('admin.obat.create');
        Route::post('/obat', [AdminController::class, 'storeObat'])->name('admin.obat.store');
        Route::get('/obat/{obat}/edit', [AdminController::class, 'editObat'])->name('admin.obat.edit');
        Route::put('/obat/{obat}', [AdminController::class, 'updateObat'])->name('admin.obat.update');
        Route::delete('/obat/{obat}', [AdminController::class, 'destroyObat'])->name('admin.obat.destroy');

        // KELOLA PASIEN
        Route::get('/pasien', [AdminController::class, 'indexPasien'])->name('admin.pasien.index');
        Route::get('/pasien/create', [AdminController::class, 'createPasien'])->name('admin.pasien.create');
        Route::post('/pasien', [AdminController::class, 'storePasien'])->name('admin.pasien.store');
        Route::get('/pasien/{pasien}/edit', [AdminController::class, 'editPasien'])->name('admin.pasien.edit');
        Route::put('/pasien/{pasien}', [AdminController::class, 'updatePasien'])->name('admin.pasien.update');
        Route::delete('/pasien/{pasien}', [AdminController::class, 'destroyPasien'])->name('admin.pasien.destroy');

        Route::middleware('auth:admin')->group(function () {
            Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        });   
    });

    Route::resource('dokter', DokterController::class)->except(['show']);
    Route::resource('poli', PoliController::class);
    Route::resource('obat', ObatController::class);
    Route::resource('pasien', PasienController::class);

    // Route untuk halaman dashboard setelah login
    Route::get('/dashboard', [PasienController::class, 'dashboard'])->name('pasien.dashboard');
    Route::get('/dokter/dashboard', [DokterController::class, 'dashboard'])->name('dokter.dashboard');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');


    // Profil Admin
    Route::get('admin/profil/edit', [AdminController::class, 'editProfil'])->name('admin.profil.edit');
    Route::post('admin/profil/update', [AdminController::class, 'updateProfil'])->name('admin.profil.update');
    Route::post('admin/profil/update-password', [AdminController::class, 'updatePassword'])->name('admin.profil.update-password');
    
    // Profil Pasien
    Route::get('pasien/profil', [PasienController::class, 'profile'])->name('pasien.profile');
    
    //profil Dokter
    Route::get('dokter/profil', [DokterController::class, 'showProfil'])->name('dokter.profil.show');

    // Jadwal Periksa
    use App\Http\Controllers\Admin\JadwalController;

    // Route untuk Jadwal Periksa
    Route::prefix('dokter')->group(function() {
        Route::get('jadwal-periksa', [JadwalPeriksaController::class, 'index'])->name('jadwal-periksa');
        Route::get('jadwal-periksa/create', [JadwalPeriksaController::class, 'create'])->name('jadwal-periksa.create');
        Route::post('jadwal-periksa', [JadwalPeriksaController::class, 'store'])->name('jadwal-periksa.store');
        Route::get('jadwal-periksa/{jadwal}/edit', [JadwalPeriksaController::class, 'edit'])->name('jadwal-periksa.edit');
        Route::put('jadwal-periksa/{jadwal}', [JadwalPeriksaController::class, 'update'])->name('jadwal-periksa.update');
        Route::delete('jadwal-periksa/{jadwal}', [JadwalPeriksaController::class, 'destroy'])->name('jadwal-periksa.destroy');
    });

    Route::resource('jadwal-periksa', JadwalPeriksaController::class);

    Route::get('/poli', function () {
        return view('pasien.poli');
    })->name('poli');

    Route::get('/', function () {
        return view('homepage');
    });

?>

