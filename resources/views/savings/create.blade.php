<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Setor Simpanan Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width: 600px;">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Transaksi Setor Simpanan</h5>
        </div>
        <div class="card-body">

            <form action="{{ route('savings.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Pilih Anggota</label>
                    <select name="member_id" class="form-select" required>
                        <option value="">-- Pilih Anggota --</option>
                        @foreach($members as $member)
                            <option value="{{ $member->id }}">{{ $member->member_code }} - {{ $member->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jenis Simpanan</label>
                    <select name="type" class="form-select" required>
                        <option value="Pokok">Simpanan Pokok</option>
                        <option value="Wajib">Simpanan Wajib</option>
                        <option value="Sukarela">Simpanan Sukarela</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nominal (Rp)</label>
                    <input type="number" name="amount" class="form-control" placeholder="Contoh: 100000" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Setor</label>
                    <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('savings.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan Setoran</button>
                </div>
            </form>

        </div>
    </div>
</div>

</body>
</html>