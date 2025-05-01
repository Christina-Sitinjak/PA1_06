<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.header')
</head>

<body>
    <!-- Navbar start -->
    @include('layout.navbar')
    <!-- Navbar end -->

    <!-- Hero section start -->
    <section class="hero" id="home">
        <main class="content">
            <h1>UNIVERSAL <span> ENGLISH COURSE </span></h1>
            <a href="{{ route('login')}}" class="cta">Pesan Sekarang</a>
        </main>
    </section>
    <!-- Hero section end -->

    <!-- Sistem Belajar section start -->
    <section id="sistem-belajar" class="sistem-belajar">
        <div class="container">
            <h2><span>Sistem</span> Belajar</h2>
            <div class="sistem-belajar-content"> <!-- GANTI INI -->
                <div class="feature-item">
                    <strong>Pergantian program setiap 2 bulan:</strong>
                    <p>Pengajar berbahasa Inggris, siswa/i berbahasa Indonesia</p>
                    <p>Pengajar berbahasa Indonesia, siswa/i berbahasa Inggris</p>
                    <p>Pengajar dan siswa/i berbahasa Inggris</p>
                </div>
                <div class="feature-item">
                    <strong>Praktek berbicara dengan orang asing:</strong>
                    <p>Dilaksanakan setiap 2 bulan sekali.</p>
                </div>
                <div class="feature-item">
                    <strong>Ujian Akhir:</strong>
                    <p>Berpidato di depan penguji dan orang tua.</p>
                </div>
                <div class="feature-item">
                    <strong>Sertifikat:</strong>
                    <p>Diberikan bagi siswa yang berhasil tamat.</p>
                </div>
                <div class="feature-item">
                    <strong>Diskusi terpadu:</strong>
                    <p>Diadakan di luar jam belajar.</p>
                </div>
                <div class="feature-item">
                    <strong>Diklat lanjutan:</strong>
                    <p>Bagi yang tamat, berhak mengikuti pelatihan Asisten, Leader, dan Teacher.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Sistem Belajar section end -->

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
    #sistem-belajar {
        background-color: #fdf6ee; /* coklat susu lembut */
        padding: 60px 0;
    }

    #sistem-belajar .container {
        max-width: 1200px;
        margin: auto;
        padding: 0 20px;
    }

    #sistem-belajar h2 {
        text-align: center;
        color: #5c4033; /* coklat tua */
        font-size: 36px;
        margin-bottom: 40px;
    }

    #sistem-belajar h2 span {
        color: #a67b5b; /* coklat susu */
    }

    #sistem-belajar .sistem-belajar-content {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 25px;
    }


    #sistem-belajar .feature-item {
        background-color: #ffffff; /* putih bersih */
        border: 1px solid #e0c9a6; /* border soft coklat susu */
        border-radius: 12px;
        padding: 20px;
        height: 220px; /* tinggi dibatasi */
        display: flex;
        flex-direction: column;
        justify-content: center;
        box-shadow: 0 8px 16px rgba(166, 123, 91, 0.2);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    #sistem-belajar .feature-item strong {
        color: #7b5e48;
        font-size: 18px;
        margin-bottom: 8px;
    }

    #sistem-belajar .feature-item p {
        color: #5c4033;
        font-size: 15px;
        line-height: 1.5;
        margin: 0;
    }

    #sistem-belajar .feature-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(166, 123, 91, 0.3);
    }

    @media (max-width: 768px) {
        #sistem-belajar .feature-item {
            height: auto; /* di HP, biarkan tinggi dinamis */
        }
    }
</style>


</html>
