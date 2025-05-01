<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.header')
    <title>Daftar Pengajar</title>
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

    <section id="pengajar" class="py-5 px-4">
        <h2 class="text-center text-white mb-4">
            <span class="highlight-coklat">Daftar</span> Pengajar
        </h2>

        <div class="pengajar-grid">
            @if(isset($pengajars) && count($pengajars) > 0)
                @foreach ($pengajars as $pengajar)
                    <div class="pengajar-card">
                        <div class="pengajar-img-wrap">
                            @if($pengajar->gambar)
                                <img src="{{ asset('storage/pengajars/' . $pengajar->gambar) }}" alt="{{ $pengajar->nama_pengajar }}">
                            @else
                                <div class="no-image">No Image</div>
                            @endif
                        </div>
                        <div class="pengajar-content">
                            <h3>{{ $pengajar->nama_pengajar }}</h3>
                            <p class="phone">{{ $pengajar->phone_number }}</p>
                            <p class="desc">{{ $pengajar->deskripsi }}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-white text-center w-100">Tidak ada pengajar yang tersedia saat ini.</div>
            @endif
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
    .pengajar-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
    justify-items: center;
}

.pengajar-card {
    background-color: #fff5e1;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    width: 100%;
    max-width: 240px;
    transition: transform 0.3s;
    text-align: center;
}

.pengajar-card:hover {
    transform: translateY(-5px);
}

.pengajar-img-wrap {
    height: 180px;
    overflow: hidden;
    background-color: #ddd;
}

.pengajar-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.pengajar-content {
    padding: 15px;
}

.pengajar-content h3 {
    font-size: 1.1rem;
    margin-bottom: 8px;
    color: #5c3c1e;
}

.pengajar-content .phone {
    font-size: 0.9rem;
    color: #7a5c3b;
    margin-bottom: 6px;
}

.pengajar-content .desc {
    font-size: 0.85rem;
    font-style: italic;
    color: #9c7151;
}

.highlight-coklat {
    color: #d2a679;
    font-weight: bold;
}

</style>

</html>
