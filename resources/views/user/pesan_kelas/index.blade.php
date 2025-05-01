<!DOCTYPE html>
<html>
<head>
    @include('user.head')
    <title>Daftar Pemesanan Kelas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            overflow-x: hidden;
        }
    </style>
</head>
<body class="d-flex">

    <!-- Sidebar -->
    @include('user.sidebar')

    <!-- Main Content -->
    <div class="flex-grow-1 p-4 bg-light min-vh-100 overflow-auto">
        <div class="bg-white p-4 rounded shadow-sm">
            <h1 class="mb-4">Daftar Pemesanan Kelas</h1>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('user.pesan_kelas.create') }}" class="btn btn-primary mb-3">+ Pesan Kelas Baru</a>

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Kategori</th>
                            <th>Program</th>
                            <th>Jadwal</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pesanans as $pesananItem)
                        <tr>
                            <td>{{ $pesananItem->pesan_kelas_id }}</td>
                            <td>{{ $pesananItem->kategori->nama_kategori ?? 'Tidak ada Kategori' }}</td>
                            <td>
                                @if ($pesananItem->kelas instanceof \App\Models\Kelas)
                                    {{ $pesananItem->kelas->nama_kelas }}
                                @else
                                    Tidak ada Kelas
                                @endif
                            </td>

                            <td>{{ $pesananItem->jadwal }}</td>
                            <td>
                                <span class="badge badge-{{
                                    $pesananItem->status == 'diproses' ? 'warning' : (
                                    $pesananItem->status == 'diterima' ? 'success' : 'secondary'
                                    )
                                }}">
                                    {{ ucfirst($pesananItem->status ?? 'Pending') }}
                                </span>
                            </td>

                         </td>
                        <td class="text-center">
                            @if ($pesananItem->status == 'pending')
                            <a href="{{ route('user.pesan_kelas.edit', $pesananItem->pesan_kelas_id) }}" class="btn btn-sm btn-info">Edit</a>
                            <form action="{{ route('user.pesan_kelas.batalkan', $pesananItem->pesan_kelas_id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">Batalkan</button>
                            </form>
                        @endif
                        </td>

                        </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada pemesanan kelas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
