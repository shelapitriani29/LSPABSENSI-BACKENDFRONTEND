<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Memproses permintaan login menggunakan Username.
     */
    public function login(Request $request)
    {
        // Validasi input username
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        // Temukan user berdasarkan username case-insensitive atau email
        $usernameInput = $request->input('username');
        $user = User::where('username', $usernameInput)
            ->orWhereRaw('LOWER(username) = ?', [Str::lower($usernameInput)])
            ->orWhere('email', $usernameInput)
            ->first();

        if ($user && Hash::check($request->input('password'), $user->password)) {
            Auth::login($user, $request->has('remember'));
            $request->session()->regenerate();

            $user = Auth::user();

            $normalizedRole = User::normalizeRole($user->role);

            // Direct Redirect berdasarkan Role
            if ($normalizedRole === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            if ($normalizedRole === 'asesor') {
                return redirect()->route('asesor.dashboard');
            }

            if ($normalizedRole === 'peserta') {
                return redirect()->route('peserta.dashboard');
            }

            return redirect()->route('login');
        }

        // Jika kredensial tidak cocok
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    /**
     * Memproses logout sesi.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
