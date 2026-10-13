<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    // 1. Tampilkan Daftar Pinjaman (Untuk Admin)
    public function index()
    {
        $loans = Loan::with('member')->latest()->paginate(10);
        return view('loans.index', compact('loans'));
    }

    // 2. Form Tambah Pinjaman Baru (Admin)
    public function create()
    {
        $members = Member::all();
        return view('loans.create', compact('members'));
    }

    // 3. Simpan Pinjaman Baru (Admin)
    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'amount' => 'required|numeric|min:50000',
            'duration' => 'required|integer|min:1',
        ]);

        Loan::create([
            'member_id' => $request->member_id,
            'amount' => $request->amount,
            'duration' => $request->duration,
            'interest' => $request->interest ?? 0,
            'loan_date' => now(),
            'status' => 'Pending',
        ]);

        return redirect()->route('loans.index')->with('success', 'Data pinjaman berhasil ditambahkan.');
    }

    // 4. Update Status Pinjaman (Admin: Approve / Reject / Paid)
    public function updateStatus(Request $request, Loan $loan)
    {
        $request->validate([
            'status' => 'required|in:Approved,Rejected,Pending,Paid',
        ]);

        $loan->update([
            'status' => $request->status,
        ]);

        return redirect()->route('loans.index')->with('success', 'Status pinjaman berhasil diperbarui.');
    }

    // 5. Hapus Data Pinjaman (Admin)
    public function destroy(Loan $loan)
    {
        $loan->delete();
        return redirect()->route('loans.index')->with('success', 'Data pinjaman berhasil dihapus.');
    }

    // 6. Tampilkan Form Pengajuan Pinjaman Mandiri oleh User
    public function createUserLoan()
    {
        return view('user.loans.create');
    }

    // 7. Method Khusus Simpan Pengajuan Pinjaman Mandiri oleh User
    public function storeUserLoan(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:50000',
            'duration' => 'required|integer|min:1',
        ]);

        $user = Auth::user();

        // Pastikan user benar-benar terautentikasi
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Cari data member berdasarkan nama user aktif secara aman
        $member = Member::where('name', 'LIKE', '%' . $user->name . '%')->first();

        // Pencegahan jika data anggota belum terdaftar di database
        if (!$member) {
            return back()->with('error', 'Data anggota Anda belum terdaftar di database oleh Admin.');
        }

        Loan::create([
            'member_id' => $member->id,
            'amount' => $request->amount,
            'duration' => $request->duration,
            'interest' => 0,
            'loan_date' => now(),
            'status' => 'Pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Pengajuan pinjaman berhasil dikirim. Menunggu persetujuan Admin.');
    }
}