@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2>Dashboard Utama</h2>
        <p class="text-muted">Selamat datang di Sistem Informasi Koperasi Simpan Pinjam.</p>
    </div>
</div>

<div class="row g-4">
    <!-- Card Total Anggota -->
    <div class="col-md-3">
        <div class="card shadow-sm border-primary border-top border-4">
            <div class="card-body">
                <h6 class="text-muted">Total Anggota</h6>
                <h3 class="fw-bold text-primary">{{ $totalMembers }}</h3>
            </div>
        </div>
    </div>

    <!-- Card Total Simpanan -->
    <div class="col-md-3">
        <div class="card shadow-sm border-success border-top border-4">
            <div class="card-body">
                <h6 class="text-muted">Total Simpanan</h6>
                <h4 class="fw-bold text-success">Rp {{ number_format($totalSavings, 0, ',', '.') }}</h4>
            </div>
        </div>
    </div>

    <!-- Card Total Pinjaman -->
    <div class="col-md-3">
        <div class="card shadow-sm border-warning border-top border-4">
            <div class="card-body">
                <h6 class="text-muted">Total Pinjaman</h6>
                <h4 class="fw-bold text-warning">Rp {{ number_format($totalLoans, 0, ',', '.') }}</h4>
            </div>
        </div>
    </div>

    <!-- Card Pinjaman Pending -->
    <div class="col-md-3">
        <div class="card shadow-sm border-danger border-top border-4">
            <div class="card-body">
                <h6 class="text-muted">Pengajuan Pending</h6>
                <h3 class="fw-bold text-danger">{{ $pendingLoans }}</h3>
            </div>
        </div>
    </div>
</div>
@endsection