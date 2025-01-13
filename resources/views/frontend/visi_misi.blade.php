@extends('frontend.layouts.main')

@if ($visi_misi->slug == 'visi-misi')
    @push('meta')
        <!-- SEO Meta Tags -->
        <title>Visi & Misi - Wonderful Ternate</title>
        <meta name="description"
            content="Visi dan misi pariwisata Kota Ternate dalam membangun dan mengembangkan sektor pariwisata yang berkelanjutan dan bermanfaat bagi masyarakat.">
        <meta name="keywords"
            content="visi misi wonderful ternate, visi misi pariwisata ternate, tujuan pariwisata ternate, pengembangan wisata ternate">
        <meta name="author" content="Wonderful Ternate">
        <meta name="robots" content="index, follow">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:title" content="Visi & Misi - Wonderful Ternate">
        <meta property="og:description"
            content="Visi dan misi pariwisata Kota Ternate dalam membangun dan mengembangkan sektor pariwisata yang berkelanjutan dan bermanfaat bagi masyarakat.">
        <meta property="og:image" content="{{ asset('assets/kora_kora.jpg') }}">
        <meta property="og:url" content="{{ route('profil', 'visi-misi') }}">
        <meta property="og:site_name" content="Wonderful Ternate">

        <!-- Twitter -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Visi & Misi - Wonderful Ternate">
        <meta name="twitter:description"
            content="Visi dan misi pariwisata Kota Ternate dalam membangun dan mengembangkan sektor pariwisata yang berkelanjutan dan bermanfaat bagi masyarakat.">
        <meta name="twitter:image" content="{{ asset('assets/kora_kora.jpg') }}">

        <!-- Additional Meta Tags for Location -->
        <meta name="geo.region" content="ID-MU">
        <meta name="geo.placename" content="Ternate">
        <meta name="geo.position" content="0.7833;127.3667">
        <meta name="ICBM" content="0.7833, 127.3667">
    @endpush
@else
    @push('meta')
        <!-- SEO Meta Tags -->
        <title>Struktur Organisasi - Wonderful Ternate</title>
        <meta name="description"
            content="Struktur organisasi dan susunan kepengurusan Dinas Pariwisata Kota Ternate dalam mengelola dan mengembangkan sektor pariwisata daerah.">
        <meta name="keywords"
            content="struktur organisasi pariwisata ternate, kepengurusan dinas pariwisata ternate, manajemen pariwisata ternate, pejabat dinas pariwisata ternate">
        <meta name="author" content="Wonderful Ternate">
        <meta name="robots" content="index, follow">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:title" content="Struktur Organisasi - Wonderful Ternate">
        <meta property="og:description"
            content="Struktur organisasi dan susunan kepengurusan Dinas Pariwisata Kota Ternate dalam mengelola dan mengembangkan sektor pariwisata daerah.">
        <meta property="og:image" content="{{ asset('assets/kora_kora.jpg') }}">
        <meta property="og:url" content="{{ route('profil', 'struktur') }}">
        <meta property="og:site_name" content="Wonderful Ternate">

        <!-- Twitter -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Struktur Organisasi - Wonderful Ternate">
        <meta name="twitter:description"
            content="Struktur organisasi dan susunan kepengurusan Dinas Pariwisata Kota Ternate dalam mengelola dan mengembangkan sektor pariwisata daerah.">
        <meta name="twitter:image" content="{{ asset('assets/kora_kora.jpg') }}">

        <!-- Additional Meta Tags for Location -->
        <meta name="geo.region" content="ID-MU">
        <meta name="geo.placename" content="Ternate">
        <meta name="geo.position" content="0.7833;127.3667">
        <meta name="ICBM" content="0.7833, 127.3667">
    @endpush
@endif


@push('css')
    <style>
        /* Memberikan padding atas agar tidak mentok navbar */
        body {
            padding-top: 100px;
            /* Sesuaikan dengan tinggi navbar */
        }

        /* Section untuk card utama */
        .destination-section {
            display: flex;
            flex-wrap: wrap;
            background-color: #ffffff;
            /* Latar belakang ungu pucat */
            border-radius: 15px;
            padding: 30px;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Gaya untuk gambar */
        .destination-image {
            width: 100%;
            height: auto;
            max-height: 400px;
            /* Batasi tinggi gambar */
            object-fit: cover;
            /* Menjaga rasio gambar */
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Konten teks di sebelah kanan gambar */
        .destination-content {
            padding: 20px;
        }

        .destination-title {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .destination-description {
            font-size: 1rem;
            color: #555;
            margin-bottom: 20px;
        }

        .destination-description a {
            color: #007bff;
            text-decoration: none;
        }

        .destination-description a:hover {
            text-decoration: underline;
        }

        /* Tombol modern */
        .btn-destination {
            background-color: #ffffff;
            color: white;
            padding: 10px 20px;
            border-radius: 30px;
            font-size: 1rem;
            font-weight: bold;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-destination:hover {
            background-color: #7d3c98;
            transform: translateY(-2px);
        }

        /* Teks kecil untuk footer */
        .powered-by {
            font-size: 0.8rem;
            color: #888;
            margin-top: 10px;
        }

        .badge-beta {
            background-color: #e6e6fa;
            color: #333;
            font-weight: bold;
            font-size: 0.7rem;
            border-radius: 5px;
            padding: 3px 6px;
        }

        #map {
            width: 100%;
            height: 400px;
            border-radius: 15px;
            margin-top: 20px;
        }

        .share-buttons a i {
            font-size: 1.5rem;
            /* Ukuran ikon */
            transition: transform 0.2s ease;
        }

        .share-buttons a i:hover {
            transform: scale(1.2);
            /* Membesarkan ikon saat hover */
        }
    </style>
@endpush

@section('body')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12  destination-content">
                <div class="destination-section">
                    <!-- Konten (8 kolom) -->
                    <p class="destination-description text-center">
                        {!! $visi_misi->content !!}
                    </p>
                </div>
            </div>


        </div>
    </div>
@endsection
