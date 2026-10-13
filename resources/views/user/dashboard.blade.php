@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <h2>Dashboard Anggota</h2>
            <p class="text-muted">Halo, <strong>{{ Auth::user()->name }}</strong>. Berikut adalah informasi saldo dan status pinjaman Anda.</p>
        </div>
    </div>

    <!-- Notifikasi Flash Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Tombol Ajukan Pinjaman -->
    <!-- Tombol Aksi -->
    <div class="mb-4 d-flex gap-2">
        <a href="{{ url('/user/loans/create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Ajukan Pinjaman
        </a>
        <a href="{{ url('/user/savings/create') }}" class="btn btn-primary">
            <i class="bi bi-wallet2"></i> Setor Simpanan
        </a>
    </div>

    <!-- Kartu Ringkasan -->
    <div class="row g-4 mb-4">
        <!-- Total Simpanan -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 p-3">
                <p class="text-muted mb-1">Total Simpanan Saya</p>
                <h3 class="fw-bold text-success">Rp {{ number_format($totalMySavings ?? 0, 0, ',', '.') }}</h3>
                <small class="text-muted">Akumulasi seluruh simpanan pokok/wajib/sukarela</small>
            </div>
        </div>

        <!-- Total Pinjaman Disetujui -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 p-3">
                <p class="text-muted mb-1">Total Pinjaman Disetujui</p>
                <h3 class="fw-bold text-primary">Rp {{ number_format($totalMyLoans ?? 0, 0, ',', '.') }}</h3>
                <small class="text-muted">Total pinjaman yang disetujui Admin</small>
            </div>
        </div>
    </div>

    <!-- Riwayat Simpanan Anda -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold">Riwayat Simpanan Anda</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis Simpanan</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mySavings as $index => $saving)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $saving->type ?? 'Simpanan' }}</td>
                                <td>Rp {{ number_format($saving->amount, 0, ',', '.') }}</td>
                                <td>{{ $saving->created_at ? $saving->created_at->format('d M Y') : '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-3">Belum ada catatan simpanan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Riwayat & Status Pengajuan Pinjaman -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold">Riwayat & Status Pengajuan Pinjaman</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jumlah Pinjaman</th>
                            <th>Durasi</th>
                            <th>Status</th>
                            <th>Tanggal Pengajuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($myLoans as $index => $loan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>Rp {{ number_format($loan->amount, 0, ',', '.') }}</td>
                                <td>{{ $loan->duration }} Bulan</td>
                                <td>
                                    @if($loan->status == 'Approved')
                                        <span class="badge bg-success">Approved</span>
                                    @elseif($loan->status == 'Pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @else
                                        <span class="badge bg-danger">{{ $loan->status }}</span>
                                    @endif
                                </td>
                                <td>{{ $loan->created_at ? $loan->created_at->format('d M Y') : '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-3">Belum ada riwayat pengajuan pinjaman.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
