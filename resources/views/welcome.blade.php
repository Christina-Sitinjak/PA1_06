<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.header')
    <style>
        /* Umum */
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .green-text {
            color: #3bb143;
        }

        /* Menu Grid */
        #menu-grid {
            padding: 50px 20px;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .menu-item {
            position: relative;
            overflow: hidden;
        }

        .menu-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .menu-item .overlay {
            position: absolute;
            bottom: 0;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            text-align: center;
            padding: 10px;
        }

        /* About Section */
        #about {
            padding: 4rem 2rem;
            color: #ffffff;
        }

        #about h2 {
            text-align: center;
            margin-bottom: 2rem;
        }

        .about-row {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            align-items: center; /* Pusatkan item secara vertikal */
        }

        .about-column {
            flex: 1 1 50%;
            min-width: 300px;
            text-align: center; /* Pusatkan konten di setiap kolom */
        }

        .about-column img {
            max-width: 100%;
            height: auto;
            margin-bottom: 1rem;
            display: block; /* Hilangkan ruang ekstra di bawah gambar */
            margin-left: auto;
            margin-right: auto;
        }

        .about-column:first-child img {
          max-width: 200px; /* Ukuran logo */
          height: auto;
        }

        .about-title {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 1rem;
            text-align: center;
        }

        .about-column p {
            margin-bottom: 1rem;
            line-height: 1.6;
            text-align: justify;
        }

        /* Fitur-Fitur */
        .features {
            margin-top: 3rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .features div {
            text-align: left;
        }

        .features h4 {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .features p {
            margin-top: 0.5rem;
            line-height: 1.6;
        }
    </style>
</head>

<body>
    <!-- Navbar start -->
    @include('layout.navbar')
    <!-- Navbar end -->

    <!-- Hero section start -->
    <section class="hero" id="home">
        <main class="content">
            <h1>UNIVERSAL <span> ENGLISH COURSE </span></h1>
            <a href="{{ route('login') }}" class="cta">Pesan Sekarang</a>
        </main>
    </section>
    <!-- Hero section end -->

    <!-- About section start -->
    <section id="about">
        <div class="container">
            <h2><span>Tentang</span> Kami</h2>
            <div class="about-row">
                <div class="about-column">
                    <img src="img/ueclogo.png" alt="UEC Logo">
                    <h3 class="about-title">
                        Learning <span class="green-text">Today</span> For A Better <span
                            class="green-text">Tomorrow</span>
                    </h3>
                </div>
                <div class="about-column">
                    <p>
                        Universal English Course (UEC) yang berada di Laguboti merupakan lembaga pendidikan luar
                        sekolah yakni kursus bahasa Inggris yang berkomitmen dalam memberikan pendidikan dan
                        pengajaran yang berkualitas bagi masyarakat khususnya siswa/siswi yang masih bersekolah di
                        tingkat TK, SD, SMP, dan SMA dari berbagai kalangan atau lokasi yang berbeda.
                    </p>
                    <p>
                        UEC senantiasa berusaha dengan sepenuh hati untuk mengantarkan siswa-siswi didik meraih
                        kesuksesan secara holistik, yakni kesuksesan yang tidak hanya dari sisi akademik dan prestasi
                        belajar (IQ) saja, namun juga sisi sosial dan spiritualnya (EQ dan SQ).
                    </p>
                    <p>
                        Berikut ini adalah beberapa metode dan teknologi yang UEC kembangkan untuk mencapai
                        kesuksesan holistik tersebut.
                    </p>
                    <img src="img/de.jpg" alt="Tentang Kami">
                </div>
            </div>
        </div>
    </section>
    <!-- About section end -->

    <!-- Fitur-Fitur -->
    <section class="features">
        <div class="container">
            <div>
                <h4>🕒 Kepercayaan Diri</h4>
                <p>
                    UEC menanamkan pentingnya kepercayaan diri sebagai fondasi dalam proses belajar.
                    Ketika siswa yakin terhadap kemampuan mereka sendiri, potensi maksimal akan lebih mudah dicapai.
                    Oleh karena itu, pendekatan kami turut mengembangkan sikap positif dan rasa percaya diri.
                </p>
            </div>
            <div>
                <h4>🕒 Strategi Belajar</h4>
                <p>
                    UEC merancang strategi belajar yang adaptif, menggabungkan berbagai pendekatan seperti pembelajaran berbasis proyek,
                    teknik mengingat jangka panjang, serta integrasi teknologi untuk meningkatkan pemahaman dan retensi materi.
                </p>
            </div>
            <div>
                <h4>🕒 Program Pengembangan</h4>
                <p>
                    Melalui aktivitas reflektif, pelatihan kepemimpinan, dan penguatan karakter (melalui kegiatan seperti mentoring,
                    forum diskusi, dan ekspedisi sosial),
                    UEC membantu siswa membangun kecerdasan intelektual, emosional, dan spiritual secara harmonis.
            </div>
            <div>
                <h4>🕒 Program Penguatan</h4>
                <p>
                    Melalui kegiatan pengembangan spiritual, motivasi, dan karakter (seperti Camp, Seminar, dan
                    Duta Bahasa), UEC memperkuat IQ, EQ, dan SQ siswa secara seimbang.
                </p>
            </div>
        </div>
    </section>

    <!-- Footer start -->
    <!-- Footer end -->

    <!-- Feather Icons -->
    <script>
        feather.replace()
    </script>

    <!-- My Javascript -->
    <script src="{{URL::asset('js/script.js')}}"></script>
</body>
@include('layout.footer')

</html>
