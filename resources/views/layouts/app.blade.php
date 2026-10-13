<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Koperasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f7f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .sidebar { width: 260px; min-height: 100vh; background: #ffffff; border-radius: 0 20px 20px 0; box-shadow: 2px 0 10px rgba(0,0,0,0.03); }
        .sidebar .brand { font-size: 1.3rem; font-weight: 800; color: #111; padding: 25px 20px; }
        .user-card { background: #f8fafc; border-radius: 12px; padding: 12px; margin: 0 15px 20px 15px; border: 1px solid #e2e8f0; }
        .nav-link-custom { color: #64748b; font-weight: 500; border-radius: 10px; margin: 4px 15px; padding: 10px 15px; display: flex; align-items: center; text-decoration: none; }
        .nav-link-custom:hover, .nav-link-custom.active { background-color: #e6f7f5; color: #20c997; font-weight: 600; }
        .nav-link-custom i { font-size: 1.1rem; margin-right: 12px; }
        .main-content { flex: 1; padding: 30px; }
        .card-stat { border: none; border-radius: 16px; color: #fff; padding: 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .btn-teal { background-color: #4cd137; color: white; border: none; font-weight: 600; }
        .btn-teal:hover { background-color: #44bd32; color: white; }
    </style>
</head>
<body>

<div class="d-flex">
    <!-- Sidebar Kiri -->
    <div class="sidebar d-flex flex-column justify-content-between">
        <div>
            <div class="brand d-flex justify-content-between align-items-center">
                <span>KOPERASI</span>
                <i class="bi bi-list fs-4"></i>
            </div>

            <!-- Profile Ringkas Dinamis -->
            <div class="user-card d-flex align-items-center">
                <div class="bg-secondary bg-opacity-20 rounded-circle p-2 me-2">
                    <i class="bi bi-person-fill fs-4 text-secondary"></i>
                </div>
                <div style="overflow: hidden;">
                    <h6 class="mb-0 fw-bold text-truncate" style="font-size: 0.9rem;">Hi, {{ Auth::user()->name ?? 'User' }}</h6>
                    <small class="text-muted text-capitalize" style="font-size: 0.75rem;">{{ Auth::user()->role ?? 'Anggota' }}</small>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="nav flex-column">
                <a class="nav-link-custom {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="bi bi-grid-fill"></i> Dashboard
                </a>

                @if(Auth::check() && Auth::user()->role === 'admin')
                    <!-- Menu Khusus Admin -->
                    <a class="nav-link-custom {{ request()->routeIs('members.*') ? 'active' : '' }}" href="{{ route('members.index') }}">
                        <i class="bi bi-people-fill"></i> Data Anggota
                    </a>
                    <a class="nav-link-custom {{ request()->routeIs('loans.*') ? 'active' : '' }}" href="{{ route('loans.index') }}">
                        <i class="bi bi-arrow-up-circle-fill"></i> Kelola Pinjaman
                    </a>
                    <a class="nav-link-custom {{ request()->routeIs('savings.*') ? 'active' : '' }}" href="{{ route('savings.index') }}">
                        <i class="bi bi-arrow-down-circle-fill"></i> Kelola Simpanan
                    </a>
                @endif

                <!-- Menu Bisa Diakses Kedua Aktor -->
                <a class="nav-link-custom {{ request()->routeIs('simulation') ? 'active' : '' }}" href="{{ route('simulation') }}">
                    <i class="bi bi-calculator-fill"></i> Kalkulator Angsuran
                </a>
            </nav>
        </div>

        <!-- Bagian Bawah Sidebar (Tombol Logout & Copyright) -->
        <div>
            <div class="px-3 pb-2">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm w-100 rounded-3">
                        <i class="bi bi-box-arrow-right me-1"></i> Keluar (Logout)
                    </button>
                </form>
            </div>
            <div class="p-3 text-center text-muted border-top" style="font-size: 0.75rem;">
                Koperasi Dashboard<br>© 2026 All Rights Reserved
            </div>
        </div>
    </div>

    <!-- Area Konten Utama -->
    <div class="main-content">
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>