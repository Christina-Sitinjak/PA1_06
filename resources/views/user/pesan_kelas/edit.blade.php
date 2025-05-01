<!DOCTYPE html>
<html>
<head>
    @include('user.head')
    <title>Edit Pesan Kelas</title>
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
        <h1 class="mb-4">Edit Pesan Kelas</h1>  <!-- Judul Diubah -->

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('user.pesan_kelas.update', $pesanKelas->pesan_kelas_id) }}" method="POST">  <!-- Action Diubah -->
            @csrf
            @method('PUT')  <!-- Method PUT Ditambahkan -->

            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $pesanKelas->nama) }}" readonly>  <!-- Value Diisi -->
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat', $pesanKelas->alamat) }}" required>  <!-- Value Diisi -->
            </div>
            <div class="form-group">
                <label for="asal_sekolah">Asal Sekolah:</label>
                <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" value="{{ old('asal_sekolah', $pesanKelas->asal_sekolah) }}" required>  <!-- Value Diisi -->
            </div>
            <div class="form-group">
                <label for="kategori_id">Kategori:</label>
                <select class="form-control" id="kategori_id" name="kategori_id" required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($semua_kategori as $kategori)
                        <option value="{{ $kategori->kategori_id }}" {{ (old('kategori_id', $pesanKelas->kategori_id) == $kategori->kategori_id) ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>  <!-- Selected Diisi -->
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="tingkatan">Tingkatan:</label>
                <select class="form-control" id="tingkatan" name="tingkatan" required>
                    <option value="">Pilih Tingkatan</option>
                    <option value="sd" {{ (old('tingkatan', $pesanKelas->tingkatan) == 'sd') ? 'selected' : '' }}>SD</option>  <!-- Selected Diisi -->
                    <option value="smp" {{ (old('tingkatan', $pesanKelas->tingkatan) == 'smp') ? 'selected' : '' }}>SMP</option>  <!-- Selected Diisi -->
                    <option value="sma" {{ (old('tingkatan', $pesanKelas->tingkatan) == 'sma') ? 'selected' : '' }}>SMA</option>  <!-- Selected Diisi -->
                </select>
            </div>
            <div class="form-group">
                <label for="kelas">Kelas:</label>
                <input type="text" class="form-control" id="kelas" name="kelas" value="{{ old('kelas', $pesanKelas->kelas) }}" required>  <!-- Value Diisi -->
            </div>
           <div class="form-group">
                <label for="program" class="form-label">Program:</label>
                <select class="form-control" id="program" name="program" required>
                    <option value="">Pilih Program</option>
                    @foreach ($semua_kelas as $kelas)
                        <option value="{{ $kelas->kelas_id }}" {{ (old('program', $pesanKelas->program) == $kelas->kelas_id) ? 'selected' : '' }}>{{ $kelas->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Jadwal:</label>
                <div>
                    <input type="radio" id="jadwal_senin_rabu" name="jadwal" value="Senin-Rabu" {{ (old('jadwal', $pesanKelas->jadwal) == 'Senin-Rabu') ? 'checked' : '' }} required>  <!-- Checked Diisi -->
                    <label for="jadwal_senin_rabu">Senin-Rabu</label>
                </div>
                <div>
                    <input type="radio" id="jadwal_selasa_kamis" name="jadwal" value="Selasa-Kamis" {{ (old('jadwal', $pesanKelas->jadwal) == 'Selasa-Kamis') ? 'checked' : '' }} required>  <!-- Checked Diisi -->
                    <label for="jadwal_selasa_kamis">Selasa-Kamis</label>
                </div>
                <div>
                    <input type="radio" id="jadwal_jumat_sabtu" name="jadwal" value="Jumat-Sabtu" {{ (old('jadwal', $pesanKelas->jadwal) == 'Jumat-Sabtu') ? 'checked' : '' }} required>  <!-- Checked Diisi -->
                    <label for="jadwal_jumat_sabtu">Jumat-Sabtu</label>
                </div>
            </div>
<button type="submit" class="btn btn-primary">Update</button>
<a href="{{ route('user.pesan_kelas.index') }}" class="btn btn-secondary">Batal</a>
</form>
</div>

</body>
</html>
