<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class authController extends Controller
{
    public function index()
    {
        return view('module.auth.login');
    }

    public function register()
    {
        return view('module.auth.register');
    }

    public function registerProses(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            // 'password' => 'required|string|min:6|confirmed', // 'confirmed' secara otomatis mengecek dengan 'confirm_password'
        ]);

        // Membuat pengguna baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Hash password
        ]);

        // Redirect ke halaman lain setelah berhasil registrasi
        return redirect()->route('login')->with('success', 'Registration successful! Please login.');
    }


    public function authProcess(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'Login berhasil');
        }
        return back()->with('error', 'Email atau Password tidak sesuai!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login')->with('success', 'kata-kata');
    }

}
