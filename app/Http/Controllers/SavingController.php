<?php

namespace App\Http\Controllers;

use App\Models\Saving;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavingController extends Controller
{
    // 1. Tampilkan Daftar Simpanan (Untuk Admin)
    public function index()
    {
        $savings = Saving::with('member')->latest()->paginate(10);
        return view('savings.index', compact('savings'));
    }

    // 2. Form Tambah Simpanan (Admin)
    public function create()
    {
        $members = Member::all();
        return view('savings.create', compact('members'));
    }

    // 3. Simpan Data Simpanan (Admin)
    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'type' => 'required|string',
            'amount' => 'required|numeric|min:10000',
        ]);

        Saving::create([
            'member_id' => $request->member_id,
            'type' => $request->type,
            'amount' => $request->amount,
            'date' => now(),
        ]);

        return redirect()->route('savings.index')->with('success', 'Data simpanan berhasil ditambahkan.');
    }

    // 4. Tampilkan Form Setor Simpanan Mandiri oleh User
    public function createUserSaving()
    {
        return view('user.savings.create');
    }

    // 5. Simpan Data Simpanan Mandiri oleh User
    public function storeUserSaving(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'amount' => 'required|numeric|min:10000',
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $member = Member::where('name', 'LIKE', '%' . $user->name . '%')->first();

        if (!$member) {
            return back()->with('error', 'Data anggota Anda belum terdaftar di database.');
        }

        Saving::create([
            'member_id' => $member->id,
            'type' => $request->type,
            'amount' => $request->amount,
            'date' => now(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Simpanan berhasil ditambahkan.');
    }
}