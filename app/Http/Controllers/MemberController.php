<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    // Tampilkan daftar anggota
    public function index()
    {
        $members = Member::latest()->paginate(10);
        return view('members.index', compact('members'));
    }

    // Form tambah anggota
    public function create()
    {
        return view('members.create');
    }

    // Simpan data anggota baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'member_code' => 'required|unique:members,member_code',
            'name' => 'required|string|max:255',
            'address' => 'required',
            'phone' => 'required|string|max:15',
            'join_date' => 'required|date',
        ]);

        Member::create($request->all());

        return redirect()->route('members.index')->with('success', 'Data anggota berhasil ditambahkan!');
    }

    // Form edit anggota
    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    // Update data anggota
    public function update(Request $request, Member $member)
    {
        $request->validate([
            'member_code' => 'required|unique:members,member_code,' . $member->id,
            'name' => 'required|string|max:255',
            'address' => 'required',
            'phone' => 'required|string|max:15',
            'join_date' => 'required|date',
        ]);

        $member->update($request->all());

        return redirect()->route('members.index')->with('success', 'Data anggota berhasil diperbarui!');
    }

    // Hapus data anggota
    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('members.index')->with('success', 'Data anggota berhasil dihapus!');
    }
}