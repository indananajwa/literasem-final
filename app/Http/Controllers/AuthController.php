<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function authenticate(Request $request)
    {
        // Validasi input: bisa login dengan NIP atau Email
        $credentials = $request->validate([
            'email' => ['required'],  // Bisa email atau NIP
            'password' => ['required'],
        ]);

        // Cek apakah input adalah NIP (18 karakter) atau Email
        $fieldToCheck = strlen($credentials['email']) == 18 ? 'nip' : 'email';

        // Attempt login dengan field yang sesuai
        if (Auth::attempt([$fieldToCheck => $credentials['email'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'NIP/Email atau password salah.',
        ])->withInput();
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'nip' => 'required|string|size:18|unique:admin,nip',
            'name' => 'required|string|max:32',
            'email' => 'required|email|max:32|unique:admin,email',
            'password' => 'required',
            'confirm-password' => 'required|same:password'
        ], [
            'nip.required' => 'NIP wajib diisi',
            'nip.size' => 'NIP harus 18 karakter',
            'nip.unique' => 'NIP sudah terdaftar',
            'name.required' => 'Nama wajib diisi',
            'name.max' => 'Nama maksimal 32 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'confirm-password.same' => 'Password tidak sama',
        ]);

        try {
            Admin::create([
                'nip' => $validate['nip'],
                'name' => $validate['name'],
                'email' => $validate['email'],
                'password' => Hash::make($validate['password']),
            ]);

            return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat registrasi.')
                ->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}