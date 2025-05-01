<!DOCTYPE html>
<html>
<head>
    <title>Profil</title>
</head>
<body>
    <h1>Profil Pengguna</h1>

    <p><strong>Nama:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Nomor Telepon:</strong> {{ $user->phone_number }}</p>
    <!-- Tambahkan field profil lainnya sesuai kebutuhan -->

    <a href="{{ route('user.dashboard') }}">Kembali ke Dashboard</a>
</body>
</html>
