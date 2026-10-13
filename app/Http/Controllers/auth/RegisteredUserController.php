<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    // Tampilkan Form Register
    public function create()
    {
        return view('auth.register');
    }

    // Proses Simpan Register User Baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        // Buat user baru dengan role 'user'
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Set sebagai user biasa/anggota
        ]);

        // Otomatis daftarkan juga ke tabel members agar sinkron dengan fitur simpanan & pinjaman
        Member::create([
            'member_code' => 'MEM-' . rand(1000, 9999),
            'name' => $request->name,
            'phone' => '-',
            'address' => '-',
            'join_date' => now(),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Registrasi berhasil! Selamat datang di Koperasi.');
    }
}