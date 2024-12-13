<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required', // Password diambil dari kolom alamat
        ]);

        $dokter = Dokter::where('username', $request->username)->first();

        if ($dokter && $request->password === $dokter->alamat) {
            if ($dokter->username === 'admin' && $dokter->alamat === 'admin') {
                // Login sebagai Admin
                session(['role' => 'admin']);
                return redirect()->route('admin.dashboard');
            } else {
                // Login sebagai Dokter
                session(['role' => 'dokter']);
                return redirect()->route('dokter.dashboard');
            }
        }

        return back()->withErrors(['error' => 'Username atau password salah']);
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }
}

