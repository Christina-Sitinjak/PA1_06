<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.head')
    <title>Daftar Pemesanan Kelas (Admin)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .main-wrapper {
            padding: 20px 30px 30px 260px; /* space for sidebar on left */
        }

        .card {
            margin-top: 1rem;
            border: none;
            border-radius: 12px;
        }
        .card-header .btn {
            margin-left: auto;
        }
        .card-header {
            background-color: #e3f2fd;
            font-weight: bold;
            font-size: 1.2rem;
            color: #333;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1.5rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .table th, .table td {
            vertical-align: middle !important;
            text-align: center;
        }


        .btn-approve {
            background-color: #28a745;
            color: white;
        }

        .btn-cancel {
            background-color: #dc3545;
            color: white;
        }

        .btn-approve:hover, .btn-cancel:hover {
            opacity: 0.9;
        }

        .table-responsive {
            overflow-x: auto;
        }
    </style>
</head>
<body>
    @include('admin.navbar')
    @include('admin.sidebar')
    <div class="main-wrapper">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Daftar Pemesanan Kelas</span>
                <!-- Tambahkan tombol jika perlu -->
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nama User</th>
                                <th>Nama Murid</th>
                                <th>Kategori</th>
                                <th>Program</th>
                                <th>Jadwal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pesanans as $pesanan)
                                <tr>
                                    <td>{{ $pesanan->pesan_kelas_id }}</td>
                                    <td>{{ $pesanan->user->name }}</td>
                                    <td>{{ $pesanan->nama }}</td>
                                    <td>{{ $pesanan->kategori->nama_kategori }}</td>
                                    <td>{{ $pesanan->kelas->nama_kelas }}</td>
                                    <td>{{ $pesanan->jadwal }}</td>
                                    <td>{{ $pesanan->status }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            @if($pesanan->status == 'pending')
                                                <form action="{{ route('admin.daftar_pemesanan.approve', $pesanan->pesan_kelas_id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-approve">
                                                        <i class="bi bi-check-circle me-1"></i> Setujui
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.daftar_pemesanan.cancel', $pesanan->pesan_kelas_id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-cancel">
                                                        <i class="bi bi-x-circle me-1"></i> Tolak
                                                    </button>
                                                </form>
                                            @else
                                                Sudah Diproses
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">Tidak ada pemesanan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
