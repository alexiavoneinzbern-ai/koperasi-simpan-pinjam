<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Simpan Pinjam - Data Pinjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data Pinjaman Koperasi</h2>
        <div>
            <a href="{{ route('members.index') }}" class="btn btn-outline-secondary">Anggota</a>
            <a href="{{ route('savings.index') }}" class="btn btn-outline-secondary">Simpanan</a>
            <a href="{{ route('loans.create') }}" class="btn btn-primary">+ Ajukan Pinjaman</a>
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
                        <th>Nama Anggota</th>
                        <th>Jumlah Pinjaman</th>
                        <th>Bunga</th>
                        <th>Tenor</th>
                        <th>Status</th>
                        <th>Aksi / Ubah Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($loans as $index => $loan)
                        <tr>
                            <td>{{ (method_exists($loans, 'firstItem') && $loans->firstItem()) ? $loans->firstItem() + $index : $index + 1 }}</td>
                            <td>
                                <strong>{{ $loan->member->name ?? 'Anggota Tidak Ditemukan' }}</strong><br>
                                <small class="text-muted">{{ $loan->member->phone ?? '-' }}</small>
                            </td>
                            <td>Rp {{ number_format($loan->amount, 0, ',', '.') }}</td>
                            <td>{{ $loan->interest ?? '-' }}%</td>
                            <td>{{ $loan->duration }} Bulan</td>
                            <td>
                                @if($loan->status == 'Pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($loan->status == 'Approved')
                                    <span class="badge bg-success">Disetujui</span>
                                @elseif($loan->status == 'Rejected')
                                    <span class="badge bg-danger">Ditolak</span>
                                @else
                                    <span class="badge bg-info">Lunas</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('loans.updateStatus', $loan->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="form-select form-select-sm d-inline w-auto">
                                        <option value="Pending" {{ $loan->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Approved" {{ $loan->status == 'Approved' ? 'selected' : '' }}>Setujui</option>
                                        <option value="Rejected" {{ $loan->status == 'Rejected' ? 'selected' : '' }}>Tolak</option>
                                        <option value="Paid" {{ $loan->status == 'Paid' ? 'selected' : '' }}>Lunas</option>
                                    </select>
                                </form>
                                <form action="{{ route('loans.destroy', $loan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data pinjaman ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm ms-1">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">Belum ada data pengajuan pinjaman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @if(method_exists($loans, 'links') && $loans->hasPages())
                <div class="mt-3">
                    {{ $loans->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

</body>
</html>