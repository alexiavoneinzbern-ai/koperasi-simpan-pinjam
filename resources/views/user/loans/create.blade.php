<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajukan Pinjaman Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width: 600px;">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-success text-white py-3">
            <h5 class="mb-0 fw-bold">Form Pengajuan Pinjaman Mandiri</h5>
        </div>
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('/user/loans') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nominal Pinjaman (Rp)</label>
                    <input type="number" name="amount" class="form-control" placeholder="Contoh: 1000000" required min="50000">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tenor (Bulan)</label>
                    <input type="number" name="duration" class="form-control" placeholder="Contoh: 12" required min="1">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-success">Kirim Pengajuan</button>
                </div>
            </form>

        </div>
    </div>
</div>

</body>
</html>