<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Festival Kora-Kora 2025</title>

    <!-- Aset CSS -->
    <link rel="stylesheet" href="{{ asset('kora_kora/styles.css') }}" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2&display=swap" rel="stylesheet" />
</head>

<body>
    <div class="background">
        <!-- Logo Bar Atas -->
        <div class="top-logos">
            <img src="{{ asset('kora_kora/logo-kementrian.png') }}" alt="Kemenparekraf" width="80" height="80" />
            <img src="{{ asset('kora_kora/logo kota.png') }}" alt="Logo Kota Ternate" />
            <img src="{{ asset('kora_kora/LOGO_KEN (1).png') }}" alt="KEN 2025" />
            <img src="{{ asset('kora_kora/wi.png') }}" alt="Wonderful Indonesia" />
            <img src="{{ asset('kora_kora/kora-kora.png') }}" alt="Festival Kora-Kora" />
        </div>

        <!-- Judul Festival -->
        <div class="judul-container">
            <span class="label-festival">Festival</span>
            <h1 class="judul-kora">Kora-Kora</h1>
        </div>

        <!-- Gambar Kolase Budaya -->
        <div class="kolase">
            <img src="{{ asset('kora_kora/bg.png') }}" alt="Kolase Budaya" />
        </div>

        <!-- Informasi Tanggal dan Lokasi -->
        <div class="info-section">
            <p class="tagline">Maritime Footprints, Archipelago Heritage</p>

            <!-- Tombol Daftar Sekarang -->
            <a target="_blank" href="{{ route('kora-kora-daftar') }}" class="btn-daftar">🎟️ Daftar Sekarang</a>
        </div>

        <!-- About Section -->
        <div class="about-section">
            <h2>Tentang Festival Kora-Kora 2025</h2>
            <p>
                Festival Kora-Kora adalah perayaan budaya maritim yang menampilkan
                warisan dan tradisi kepulauan nusantara. Melalui rangkaian acara seni,
                olahraga, dan teknologi, festival ini bertujuan mempererat semangat
                kebersamaan dan melestarikan kearifan lokal.
            </p>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <a href="https://www.instagram.com/wonderfulternate/" style="color: black; text-decoration: none">
                <img src="https://img.icons8.com/ios-glyphs/30/000000/instagram-new.png" />
                @wonderfulternate
            </a>
        </footer>
    </div>
</body>

</html>
