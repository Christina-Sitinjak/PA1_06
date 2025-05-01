<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.header')
    <title>Daftar Kelas</title>
</head>

<body>
    <!-- Navbar start -->
    @include('layout.navbar')
    <!-- Navbar end -->

    <!-- Hero section start (Anda mungkin ingin menyesuaikan ini atau menghapusnya) -->
    <section class="hero" id="home">
        <main class="content">
            <h1>UNIVERSAL <span> ENGLISH COURSE </span></h1>
            <a href="{{ route('login') }}" class="cta">Pesan Sekarang</a> <!-- Sesuaikan link ini -->
        </main>
    </section>
    <!-- Hero section end -->

    <section id="kelas" class="kelas">
        <h2><span>Daftar</span> Kelas</h2>
        <div class="content">
            <table>
                <tr>
                    <th>NAMA KELAS</th>
                    <th>KATEGORI</th>
                    <th>HARGA PENDAFTARAN (HANYA SEKALI)</th>
                    <th>HARGA KURSUS PER BULAN</th>
                    <th>MASA BELAJAR (DALAM BULAN)</th>
                </tr>
                @if(isset($semua_kelas) && count($semua_kelas) > 0)
                @foreach ($semua_kelas as $kelasItem)
                        <tr>
                            <td>{{ $kelasItem->nama_kelas }}</td>
                            <td>{{ $kelasItem->kategori->nama_kategori }}</td>
                            <td>{{ $kelasItem->harga_pendaftaran }}</td>
                            <td>{{ $kelasItem->harga_kursus }}</td>
                            <td>{{ $kelasItem->masa_belajar }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6">Tidak ada kelas yang tersedia saat ini.</td>
                    </tr>
                @endif
            </table>
        </div>
    </section>

    <!-- Footer start -->
    @include('layout.footer')
    <!-- Footer end -->

    <!-- Feather Icons -->
    <script>
        feather.replace()
    </script>

    <!-- My Javascript -->
    <script src="{{URL::asset('js/script.js')}}"></script>
</body>

<style>
    /* Tetap hitam untuk latar belakang seluruh section */
    #kelas {
        background-color: #000; /* warna hitam */
        padding: 60px 20px;
    }

    #kelas h2 {
        text-align: center;
        color: #f5f5dc; /* warna coklat susu terang */
        font-size: 36px;
        margin-bottom: 40px;
    }

    #kelas h2 span {
        color: #a67b5b; /* coklat susu soft */
    }

    /* Ini kontainer tabelnya */
    #kelas .content {
        max-width: 1200px;
        margin: auto;
        overflow-x: auto;
        background: #fdf6ee; /* coklat susu sangat lembut */
        border-radius: 12px;
        box-shadow: 0 8px 16px rgba(166, 123, 91, 0.2);
        padding: 20px;
    }

    #kelas table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    #kelas th, #kelas td {
        padding: 16px 20px;
        text-align: left;
        color: #5c4033; /* warna teks coklat */
        font-size: 15px;
        border-bottom: 1px solid #e0c9a6;
    }

    #kelas th {
        background-color: #e6d3bc; /* header tabel sedikit lebih tua coklat susunya */
        font-size: 16px;
        font-weight: bold;
        color: #4b3621;
        text-align: center;
    }

    #kelas tr:last-child td {
        border-bottom: none;
    }

    #kelas tr:hover {
        background-color: #f8efe4; /* efek hover soft */
        transition: background-color 0.3s ease;
    }

    #kelas td[colspan="6"] {
        text-align: center;
        font-style: italic;
        color: #7b5e48;
    }

    @media (max-width: 768px) {
        #kelas th, #kelas td {
            padding: 12px 10px;
            font-size: 14px;
        }
    }
</style>


</html>
