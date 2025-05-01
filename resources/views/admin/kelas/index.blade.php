<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.head')
    <title>Daftar Kelas (Admin)</title>
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


        .btn-edit {
            background-color: #28a745;
            color: white;
        }

        .btn-hapus {
            background-color: #c9c014;
            color: white;
        }

        .btn-edit:hover, .btn-hapus:hover {
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
                <span>Daftar Kelas</span>
                <a href="{{ route('admin.kelas.create') }}" class="btn btn-primary">+ Tambah Kelas</a>
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
                                <th>Kategori</th>
                                <th>Nama Kelas</th>
                                <th>Harga Pendaftaran</th>
                                <th>Harga Kursus</th>
                                <th>Masa Belajar</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kelas as $kelasItem)
                                <tr>
                                    <td>{{ $kelasItem->kelas_id }}</td>
                                    <td>{{ $kelasItem->kategori->nama_kategori }}</td>
                                    <td>{{ $kelasItem->nama_kelas }}</td>
                                    <td>{{ $kelasItem->harga_pendaftaran }}</td>
                                    <td>{{ $kelasItem->harga_kursus }}</td>
                                    <td>{{ $kelasItem->masa_belajar }}</td>
                                    <td>{{ $kelasItem->stok }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('admin.kelas.edit', $kelasItem->kelas_id) }}" class="btn btn-sm btn-edit">
                                                <i class="bi bi-pencil-square me-1"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.kelas.destroy', $kelasItem->kelas_id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kelas ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-hapus">
                                                    <i class="bi bi-trash me-1"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>
