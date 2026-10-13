<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\SavingController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\SimulationController;
use App\Http\Controllers\Auth\RegisteredUserController; // atau sesuaikan dengan controller auth yang kamu pakai

// Jika belum ada controller khusus, kita bisa pakai Auth Controller bawaan atau buat method di AuthController
Route::get('/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'store']);

// --- ROUTE GUEST (Bisa diakses tanpa login) ---
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

// --- ROUTE AUTH (Wajib Login & Masuk Dashboard/Koperasi) ---
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Halaman Utama & Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Halaman Kalkulator Angsuran / Simulasi
    Route::get('/simulation', [SimulationController::class, 'index'])->name('simulation');

    // Modul CRUD Utama (Anggota, Simpanan, Pinjaman)
    Route::resource('members', MemberController::class);
    Route::resource('savings', SavingController::class);
    Route::resource('loans', LoanController::class);

    // Route khusus update status pinjaman
    Route::patch('loans/{loan}/status', [LoanController::class, 'updateStatus'])->name('loans.updateStatus');
});
Route::middleware(['auth'])->group(function () {
    // ... route yang sudah ada ...
    
    // Route Pengajuan Pinjaman oleh User
    Route::post('/user/loans', [LoanController::class, 'storeUserLoan'])->name('user.loans.store');
});
Route::post('/user/loans', [LoanController::class, 'storeUserLoan'])->name('user.loans.store');
Route::get('/user/loans/create', [LoanController::class, 'createUserLoan'])->name('user.loans.create');
Route::post('/user/loans', [LoanController::class, 'storeUserLoan']);
Route::get('/user/savings/create', [App\Http\Controllers\SavingController::class, 'createUserSaving'])->name('user.savings.create');
Route::post('/user/savings', [App\Http\Controllers\SavingController::class, 'storeUserSaving'])->name('user.savings.store');
