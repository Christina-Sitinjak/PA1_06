<!DOCTYPE html>
<html>
<head>
    @include('user.head')
    <title>Pesan Kelas</title>
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
    <div class="flex-grow-1 p-4 bg-white min-vh-100 overflow-auto">
        <h1 class="mb-4">Pesan Kelas</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('user.pesan_kelas.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ Auth::user()->name }}" readonly>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" class="form-control" id="alamat" name="alamat" required>
            </div>
            <div class="form-group">
                <label for="asal_sekolah">Asal Sekolah:</label>
                <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" required>
            </div>
            <div class="form-group">
                <label for="kategori_id">Kategori:</label>
                <select class="form-control" id="kategori_id" name="kategori_id" required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($semua_kategori as $kategori)
                        <option value="{{ $kategori->kategori_id }}">{{ $kategori->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="tingkatan">Tingkatan:</label>
                <select class="form-control" id="tingkatan" name="tingkatan" required>
                    <option value="">Pilih Tingkatan</option>
                    <option value="sd">SD</option>
                    <option value="smp">SMP</option>
                    <option value="sma">SMA</option>
                </select>
            </div>
            <div class="form-group">
                <label for="kelas">Kelas:</label>
                <input type="text" class="form-control" id="kelas" name="kelas" required>
            </div>
            <div class="form-group">
                <label for="program" class="form-label">Program:</label>
                <select class="form-control" id="program" name="program" required>
                    <option value="">Pilih Program</option>
                    @foreach ($semua_kelas as $kelas)
                        <option value="{{ $kelas->kelas_id }}" {{ (old('program') == $kelas->kelas_id) ? 'selected' : '' }}>{{ $kelas->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Jadwal:</label>
                <div id="jadwal-options">
                    <!-- Opsi jadwal akan diisi oleh JavaScript -->
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Pesan</button>
            <a href="{{ route('user.pesan_kelas.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#kategori_id').change(function() {
                var kategoriId = $(this).val();
                var jadwalOptions = $('#jadwal-options');
                jadwalOptions.empty(); // Kosongkan opsi jadwal sebelumnya

                if (kategoriId === '1') { // Regular
                    jadwalOptions.append(`
                        <div>
                            <input type="radio" id="jadwal_senin_rabu" name="jadwal" value="Senin-Rabu" required>
                            <label for="jadwal_senin_rabu">Senin-Rabu</label>
                        </div>
                        <div>
                            <input type="radio" id="jadwal_selasa_kamis" name="jadwal" value="Selasa-Kamis" required>
                            <label for="jadwal_selasa_kamis">Selasa-Kamis</label>
                        </div>
                    `);
                } else if (kategoriId === '2') { // Private
                    jadwalOptions.append(`
                        <div>
                            <input type="radio" id="jadwal_jumat_sabtu" name="jadwal" value="Jumat-Sabtu" required>
                            <label for="jadwal_jumat_sabtu">Jumat-Sabtu</label>
                        </div>
                    `);
                }
            });
        });
    </script>
</body>
</html>
