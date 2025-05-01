<!DOCTYPE html>
<html lang="en">

<head>
    {{-- Menggunakan include untuk header standar --}}
    @include('layout.header')
    <title>Daftar Pengumuman - Universal English Course</title> {{-- Judul Halaman Disesuaikan --}}
</head>

<body>
    <!-- Navbar start -->
    @include('layout.navbar')
    <!-- Navbar end -->

    <!-- Hero section start -->
    {{-- Anda bisa menyesuaikan atau menghapus hero section ini jika tidak relevan untuk halaman pengumuman --}}
    <section class="hero" id="home">
        <main class="content">
            <h1>UNIVERSAL <span> ENGLISH COURSE </span></h1>
            {{-- CTA bisa diarahkan ke halaman lain jika perlu, atau dihapus --}}
            <a href="{{ route('login') }}" class="cta">Pesan Sekarang</a>
        </main>
    </section>
    <!-- Hero section end -->

    {{-- Section khusus untuk menampilkan pengumuman --}}
    <section id="pengumuman-terbaru" class="pengumuman-terbaru kelas-belajar"> {{-- ID & Class disesuaikan, bisa pakai class 'kelas-belajar' jika styling sama --}}
        <h2><span>Pengumuman</span> Terbaru</h2>
        <div class="content">
            <table>
                <thead> {{-- Tambahkan thead untuk struktur tabel yang lebih baik --}}
                    <tr>
                        <th>Judul Pengumuman</th>
                        <th>Tanggal</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Pastikan variabel $semua_pengumuman dikirim dari controller showPublic --}}
                    @if(isset($semua_pengumuman) && count($semua_pengumuman) > 0)
                        @foreach ($semua_pengumuman as $item)
                            <tr>
                                <td>{{ $item->judul_pengumuman }}</td>
                                {{-- Format tanggal, pastikan $item->tanggal adalah objek Carbon --}}
                                <td>{{ $item->tanggal instanceof \Carbon\Carbon ? $item->tanggal->format('d M Y') : $item->tanggal }}</td>
                                {{-- Tampilkan deskripsi, mungkin perlu penyesuaian jika terlalu panjang untuk tabel --}}
                                <td>{!! nl2br(e($item->deskripsi)) !!}</td> {{-- nl2br untuk ganti baris, e() untuk escape HTML --}}
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3" style="text-align: center;">Tidak ada pengumuman terbaru saat ini.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </section>

    <!-- Footer start -->
    @include('layout.footer')
    <!-- Footer end -->

    <!-- Feather Icons -->
    <script>
        // Pastikan library Feather Icons sudah dimuat di layout.header atau di sini
        if (typeof feather !== 'undefined') {
             feather.replace()
        }
    </script>

    <!-- My Javascript -->
    {{-- Pastikan path ke script.js benar --}}
    <script src="{{URL::asset('js/script.js')}}"></script>
</body>

<style>
    /* Pengaturan untuk section pengumuman */
#pengumuman-terbaru {
    background-color: #000; /* Latar belakang hitam */
    padding: 60px 20px;
}

#pengumuman-terbaru h2 {
    text-align: center;
    color: #f5f5dc; /* Teks coklat susu terang */
    font-size: 36px;
    margin-bottom: 40px;
}

#pengumuman-terbaru h2 span {
    color: #a67b5b; /* Coklat susu soft untuk span */
}

/* Kontainer untuk tabel */
#pengumuman-terbaru .content {
    max-width: 1200px;
    margin: auto;
    overflow-x: auto;
    background: #fdf6ee; /* Coklat susu sangat lembut */
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(166, 123, 91, 0.2);
    padding: 20px;
}

/* Styling untuk tabel */
#pengumuman-terbaru table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
}

#pengumuman-terbaru th, #pengumuman-terbaru td {
    padding: 16px 20px;
    text-align: center; /* Menempatkan semua teks di tengah */
    color: #5c4033; /* Teks coklat */
    font-size: 15px;
    border-bottom: 1px solid #e0c9a6;
}

#pengumuman-terbaru th {
    background-color: #e6d3bc; /* Header tabel coklat susu sedikit lebih tua */
    font-size: 16px;
    font-weight: bold;
    color: #4b3621;
}

#pengumuman-terbaru tr:last-child td {
    border-bottom: none;
}

/* Efek hover pada baris tabel */
#pengumuman-terbaru tr:hover {
    background-color: #f8efe4; /* Efek hover soft */
    transition: background-color 0.3s ease;
}

#pengumuman-terbaru td[colspan="3"] {
    text-align: center;
    font-style: italic;
    color: #7b5e48;
}

/* Responsif pada layar kecil */
@media (max-width: 768px) {
    #pengumuman-terbaru th, #pengumuman-terbaru td {
        padding: 12px 10px;
        font-size: 14px;
    }
}

</style>

</html>
