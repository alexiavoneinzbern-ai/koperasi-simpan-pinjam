<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Sistem Koperasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-card { width: 100%; max-width: 420px; background: #ffffff; border-radius: 20px; padding: 40px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
        .btn-teal { background-color: #4cd137; color: white; border: none; font-weight: 600; }
        .btn-teal:hover { background-color: #44bd32; color: white; }
    </style>
</head>
<body>

<div class="login-card text-center">
    <!-- Logo Koperasi -->
    <div class="mb-4">
        <div class="bg-light rounded-circle d-inline-flex p-3 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="#4cd137" class="bi bi-bank" viewBox="0 0 16 16">
                <path d="m8 0 6.61 3 .89.5a1 1 0 0 1-.5 1.8V9H1V5.3a1 1 0 0 1-.5-1.8L8 0zM2 6v3h2V6H2zm3 0v3h2V6H5zm5 0v3h2V6h-2zm3 0v3h2V6h-2zM1 10v1h14v-1H1zm3 2v2h8v-2H4z"/>
            </svg>
        </div>
        <h4 class="fw-bold mt-3">Masuk</h4>
    </div>

    @if($errors->any())
        <div class="alert alert-danger py-2" style="font-size: 0.85rem;">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('login.process') }}" method="POST" class="text-start">
        @csrf
        <div class="mb-3">
            <label class="form-label text-muted" style="font-size: 0.85rem;">Email / Username</label>
            <input type="email" name="email" class="form-control bg-light border-0 py-2" placeholder="admin@koperasi.test" required value="{{ old('email') }}">
        </div>
        <div class="mb-4">
            <label class="form-label text-muted" style="font-size: 0.85rem;">Password</label>
            <input type="password" name="password" class="form-control bg-light border-0 py-2" placeholder="••••••••" required>
        </div>
        <button type="submit" class="btn btn-teal w-100 py-2 rounded-3 mb-3">Masuk</button>
    </form>

    <div class="text-muted" style="font-size: 0.85rem;">
        Belum punya akun? <a href="{{ route('register') }}" class="text-decoration-none text-success fw-bold">Daftar</a>
    </div>
    
    <div class="mt-4 p-2 bg-light rounded text-muted" style="font-size: 0.75rem;">
        <strong>Akun Demo Admin:</strong> admin@koperasi.test | 123456
    </div>
</div>

</body>
</html>