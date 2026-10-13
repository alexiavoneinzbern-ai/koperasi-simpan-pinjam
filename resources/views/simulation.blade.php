@extends('layouts.app')

@section('content')
<h2 class="fw-bold mb-4">Kalkulator Angsuran</h2>

<div class="row g-4">
    <!-- Form Simulasi -->
    <div class="col-md-7">
        <div class="card border-0 shadow-sm rounded-4 p-4">
            <h5 class="fw-bold mb-3">Simulasi Pinjaman</h5>
            <form action="{{ route('simulation') }}" method="GET">
                <div class="mb-3">
                    <label class="form-label text-muted">Pokok Pinjaman</label>
                    <input type="number" name="pokok" class="form-control form-control-lg bg-light border-0" value="{{ $pokok }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted">Jangka Waktu (Bulan)</label>
                    <input type="number" name="tenor" class="form-control form-control-lg bg-light border-0" value="{{ $tenor }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted">Bunga (% per bulan)</label>
                    <input type="number" step="0.1" name="bunga" class="form-control form-control-lg bg-light border-0" value="{{ $bungaPercent }}" required>
                </div>
                <button type="submit" class="btn btn-teal btn-lg w-100 rounded-3 mt-3">KALKULASI</button>
            </form>
        </div>
    </div>

    <!-- Hasil Kalkulasi -->
    <div class="col-md-5">
        <div class="card border-0 shadow-sm rounded-4 p-4">
            <h5 class="fw-bold mb-1">Pinjaman</h5>
            <p class="text-muted small mb-4">Hasil Kalkulasi</p>

            <div class="mb-2 d-flex justify-content-between">
                <span class="text-muted">Pokok Pinjaman :</span>
                <strong class="fs-5">Rp {{ number_format($pokok, 2, ',', '.') }}</strong>
            </div>
            <div class="mb-2 d-flex justify-content-between">
                <span class="text-muted">Jangka Waktu :</span>
                <strong>{{ $tenor }} Bulan</strong>
            </div>
            <div class="mb-4 d-flex justify-content-between">
                <span class="text-muted">Bunga :</span>
                <strong>{{ $bungaPercent }}%</strong>
            </div>

            <hr>

            <div class="mb-2">
                <small class="text-muted">Angsuran pokok per bulan :</small>
                <div class="fw-bold text-dark">Rp {{ number_format($angsuranPokok, 2, ',', '.') }}</div>
            </div>
            <div class="mb-3">
                <small class="text-muted">Angsuran bunga per bulan :</small>
                <div class="fw-bold text-dark">Rp {{ number_format($angsuranBunga, 2, ',', '.') }}</div>
            </div>

            <div class="p-3 bg-light rounded-3 mt-2">
                <small class="text-muted d-block">Total Angsuran per bulan :</small>
                <h4 class="fw-bold text-success mb-0">Rp {{ number_format($totalAngsuran, 2, ',', '.') }}</h4>
            </div>
        </div>
    </div>
</div>
@endsection