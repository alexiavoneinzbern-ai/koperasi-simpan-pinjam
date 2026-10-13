<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Simpan Pinjam - Data Simpanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data Simpanan Koperasi</h2>
        <div>
            <a href="{{ route('members.index') }}" class="btn btn-outline-secondary">Data Anggota</a>
            <a href="{{ route('savings.create') }}" class="btn btn-primary">+ Setor Simpanan</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Kode & Nama Anggota</th>
                        <th>Jenis Simpanan</th>
                        <th>Nominal Setoran</th>
                        <th>Tanggal Setor</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($savings as $index => $saving)
                        <tr>
                            <td>{{ $savings->firstItem() + $index }}</td>
                            <td>
                                <strong>{{ $saving->member->name }}</strong><br>
                                <small class="text-muted">{{ $saving->member->member_code }}</small>
                            </td>
                            <td><span class="badge bg-info text-dark">{{ $saving->type }}</span></td>
                            <td>Rp {{ number_format($saving->amount, 0, ',', '.') }}</td>
                            <td>{{ $saving->date }}</td>
                            <td>
                                <form action="{{ route('savings.destroy', $saving->id) }}" method="POST" onsubmit="return confirm('Hapus data simpanan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">Belum ada transaksi simpanan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $savings->links() }}
        </div>
    </div>
</div>

</body>
</html>