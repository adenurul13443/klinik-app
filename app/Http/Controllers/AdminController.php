<?php
namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Dokter;
use App\Models\Poli;
use App\Models\Obat;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Menampilkan halaman login
    public function loginForm()
    {
        return view('admin.auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'no_hp' => 'required|string|max:15',
            'password' => 'required|string',
        ]);

        // Cek data admin berdasarkan nomor HP
        $admin = Admin::where('no_hp', $credentials['no_hp'])->first();

        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            // Simpan data admin ke session
            session([
                'id' => $admin->id,
                'nama' => $admin->nama,
                'no_hp' => $admin->no_hp,
                'password' => $admin->password,
            ]);

            return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');
        }

        // Jika login gagal
        return redirect()->route('admin.login.form')->withErrors('Nomor HP atau password salah.');
    }

    // Logout admin
    public function logout()
    {
        // Hapus semua data session terkait admin
        session()->forget(['id', 'nama', 'no_hp', 'password']);

        return redirect()->route('admin.login.form')->with('success', 'Logout berhasil!');
    }

    // Dashboard admin
    public function dashboard()
    {
        // Periksa apakah admin sudah login
        if (!session('id')) {
            return redirect()->route('admin.login.form')->with('danger','Harap login terlebih dahulu.');
        }

        return view('admin.dashboard');
    }

    // Menampilkan daftar dokter
    public function indexDokter()
    {
        $dokters = Dokter::with('poli')->get();
        $polis = Poli::all();  // Mengambil semua data poli
        return view('admin.dokter.index', compact('dokters', 'polis'));
    }

    // Menampilkan form tambah dokter
    public function createDokter()
    {
        $polis = Poli::all(); // Mengambil data dari tabel poli
        return view('admin.dokter.create', compact('polis'));
    }

    // Menyimpan data dokter baru
    public function storeDokter(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15|unique:dokter,no_hp',
            'id_poli' => 'required|exists:poli,id', // Sesuaikan dengan nama tabel yang benar
        ]);

        // Membuat entri dokter baru
        Dokter::create([
            'nama' => $validated['nama'],
            'alamat' => $validated['alamat'],
            'no_hp' => $validated['no_hp'],
            'id_poli' => $validated['id_poli']
        ]);

        // Redirect kembali ke halaman daftar dokter setelah simpan
        return redirect()->route('admin.dokter.index')->with('success', 'Dokter berhasil ditambahkan!');
    }

    // edit
    public function edit($id)
    {
        $dokter = Dokter::findOrFail($id);
        $polis = Poli::all();  // Pastikan Anda mengirim data poli ke view untuk select box
        return view('admin.dokter.edit', compact('dokter', 'poli'));
    }

    // Controller AdminController.php
    public function updateDokter(Request $request, $id)
    {
        $dokter = Dokter::findOrFail($id);

        // Validasi data input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15|unique:dokter,no_hp,' . $dokter->id,
            'id_poli' => 'required|exists:poli,id',
        ]);

        // Update data dokter
        $dokter->update($validated);

        return redirect()->route('admin.dokter.index')->with('success', 'Dokter berhasil diperbarui');
    }


    // Menghapus data dokter
    public function destroyDokter(Dokter $dokter)
    {
        $dokter->delete();
        return redirect()->route('admin.dokter.index')->with('success', 'Dokter berhasil dihapus.');
    }

    // Menampilkan daftar poli
    public function indexPoli()
    {
        $polis = Poli::all(); // Ambil semua data poli
        return view('admin.poli.index', compact('polis')); // Ganti dengan nama view yang sesuai
    }

    // Menampilkan form untuk tambah poli
    public function createPoli()
    {
        return view('admin.poli.create'); // Ganti dengan nama view yang sesuai
    }

    // Menyimpan poli baru
    public function storePoli(Request $request)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:255',
            'keterangan' => 'required|string',
        ]);

        Poli::create([
            'nama_poli' => $request->nama_poli,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('admin.poli.index')->with('success', 'Poli berhasil ditambahkan');
    }

    // Menampilkan form untuk edit poli
    public function editPoli(Poli $poli)
    {
        return view('admin.poli.edit', compact('poli')); // Ganti dengan nama view yang sesuai
    }

    // Memperbarui data poli
    public function updatePoli(Request $request, Poli $poli)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:255',
            'keterangan' => 'required|string',
        ]);

        $poli->update([
            'nama_poli' => $request->nama_poli,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('admin.poli.index')->with('success', 'Poli berhasil diperbarui');
    }

    // Menghapus poli
    public function destroyPoli(Poli $poli)
    {
        $poli->delete();
        return redirect()->route('admin.poli.index')->with('success', 'Poli berhasil dihapus');
    }

    // Menampilkan daftar obat
    public function indexObat()
    {
        $obats = Obat::all(); // Ambil semua data obat
        return view('admin.obat.index', compact('obats')); // Ganti dengan nama view yang sesuai
    }

    // Menampilkan form untuk tambah obat
    public function createObat()
    {
        return view('admin.obat.create'); // Ganti dengan nama view yang sesuai
    }

    // Menyimpan obat baru
    public function storeObat(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:255',
            'harga' => 'required|numeric',
        ]);

        Obat::create([
            'nama_obat' => $request->nama_obat,
            'kemasan' => $request->kemasan,
            'harga' => $request->harga,
        ]);

        return redirect()->route('admin.obat.index')->with('success', 'Obat berhasil ditambahkan');
    }

    // Menampilkan form untuk edit obat
    public function editObat(Obat $obat)
    {
        return view('admin.obat.edit', compact('obat')); // Ganti dengan nama view yang sesuai
    }

    // Memperbarui data obat
    public function updateObat(Request $request, Obat $obat)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:255',
            'harga' => 'required|numeric',
        ]);

        $obat->update([
            'nama_obat' => $request->nama_obat,
            'kemasan' => $request->kemasan,
            'harga' => $request->harga,
        ]);

        return redirect()->route('admin.obat.index')->with('success', 'Obat berhasil diperbarui');
    }

    // Menghapus obat
    public function destroyObat(Obat $obat)
    {
        $obat->delete();
        return redirect()->route('admin.obat.index')->with('success', 'Obat berhasil dihapus');
    }

    // Menampilkan daftar pasien
    public function indexPasien()
    {
        $pasiens = Pasien::all();
        $no_rm = $this->generateNoRM(); 
        return view('admin.pasien.index', compact('pasiens', 'no_rm'));
    }
    private function generateNoRM()
    {
        $yearMonth = date('Ym');
        $pasienCount = Pasien::whereRaw("DATE_FORMAT(created_at, '%Y%m') = ?", [$yearMonth])->count();
        $no_rm = $yearMonth . '-' . str_pad($pasienCount + 1, STR_PAD_LEFT);
        return $no_rm;
    }
    

    // Menampilkan form untuk tambah pasien
    public function createPasien()
    {
        return view('admin.pasien.create'); 
    }

    // Menyimpan pasien baru
    public function storePasien(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_ktp' => 'required|string|max:16',
            'no_hp' => 'required|string|max:16',
        ]);

        Pasien::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_ktp' => $request->no_ktp,
            'no_hp' => $request->no_hp,
            'no_rm' => $request->no_rm,
        ]);

        return redirect()->route('admin.pasien.index')->with('success', 'Pasien berhasil ditambahkan');
    }

    // Menampilkan form untuk edit pasien
    public function editPasien(Pasien $pasien)
    {
        return view('admin.pasien.edit', compact('pasien')); // Ganti dengan nama view yang sesuai
    }

    // Memperbarui data pasien
    public function updatePasien(Request $request, Pasien $pasien)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_ktp' => 'required|string|max:16',
            'no_hp' => 'required|string|max:16',
        ]);

        $pasien->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_ktp' => $request->no_ktp,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('admin.pasien.index')->with('success', 'Pasien berhasil diperbarui');
    }

    // Menghapus pasien
    public function destroyPasien(Pasien $pasien)
    {
        $pasien->delete();
        return redirect()->route('admin.pasien.index')->with('success', 'Pasien berhasil dihapus');
    }

}
