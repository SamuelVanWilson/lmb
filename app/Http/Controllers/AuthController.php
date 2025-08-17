<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman Register
    public function halamanRegister()
    {
        return view('auth.register');
    }

    // Memproses data dari form Register
    public function register(Request $request)
    {
        // 1. Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // 2. Buat user baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Enkripsi password
            // Role dan balance akan menggunakan nilai default dari migrasi
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('home')->with('success', 'registrasi berhasil');
        }else {
            return back()->with('error', 'Email atau password yang Anda masukkan salah.');
        }

    }

    // Menampilkan halaman Login
    public function halamanLogin()
    {
        return view('auth.login');
    }

    // Memproses data dari form Login
    public function login(Request $request)
    {
        // 1. Validasi data
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Coba lakukan login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // 3. Cek peran (role) user
            $user = Auth::user();
            if ($user->role === 'admin') {
                // Jika admin, redirect ke dashboard admin
                return redirect()->intended('/admin/dashboard');
            }

            // Jika user biasa, redirect ke halaman utama (landing page)
            return redirect()->route('home')->with('success', 'Selamat datang kembali, ' . $user->name . '!');
        }else {
            return back()->with('error', 'Email atau password yang Anda masukkan salah.');
        }

        // 4. Jika login gagal

    }

    // Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah berhasil logout.'); // Redirect ke halaman utama setelah logout
    }
}
