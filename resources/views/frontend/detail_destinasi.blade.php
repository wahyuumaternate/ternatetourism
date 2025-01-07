@extends('frontend.layouts.main')

@include('frontend.layouts.navbar')
{{-- @section('meta')
    <!-- SEO Meta Tags -->
    <meta name="title" content="{{ $destination->name }}">
    <meta name="description" content="{{ Str::limit(strip_tags($destination->description), 160) }}">
    <meta name="keywords" content="{{ implode(',', ['destination', $destination->name, 'travel', 'tourism']) }}">
    <meta name="author" content="Your Website Name">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $destination->name }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($destination->description), 160) }}">
    <meta property="og:image" content="{{ $destination->image }}">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:site_name" content="Your Website Name">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $destination->name }}">
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($destination->description), 160) }}">
    <meta name="twitter:image" content="{{ $destination->image }}">
@endsection --}}


@push('css')
    <!-- SEO Meta Tags -->
    <meta name="title" content="{{ $destination->name }}">
    <meta name="description" content="{{ Str::limit(strip_tags($destination->description), 160) }}">
    <meta name="keywords" content="{{ implode(',', ['destination', $destination->name, 'travel', 'tourism']) }}">
    <meta name="author" content="Your Website Name">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $destination->name }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($destination->description), 160) }}">
    <meta property="og:image" content="{{ $destination->image }}">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:site_name" content="Your Website Name">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $destination->name }}">
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($destination->description), 160) }}">
    <meta name="twitter:image" content="{{ $destination->image }}">
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
    <div class="container my-5">
        <!-- Section Destinasi -->
        <div class="destination-section">
            <!-- Gambar -->
            <div class="col-12 col-md-6">
                <img src="{{ $destination->image }}" alt="{{ $destination->name }}" class="destination-image">
            </div>

            <!-- Konten -->
            <div class="col-12 col-md-6 destination-content">
                <h2 class="destination-title">Things to Do in {{ $destination->name }}</h2>

                <!-- Tombol Bagikan -->
                <div class="share-buttons mt-4 d-flex align-items-center gap-3">
                    <p class="mb-0 me-3">Bagikan ke:</p>

                    <!-- Facebook -->
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                        class="text-primary" target="_blank" rel="noopener" title="Bagikan ke Facebook">
                        <i class="bi bi-facebook fs-3"></i>
                    </a>

                    <!-- X (Twitter) -->
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($destination->name) }}"
                        class="text-info" target="_blank" rel="noopener" title="Bagikan ke Twitter">
                        <i class="bi bi-twitter fs-3"></i>
                    </a>

                    <!-- Instagram -->
                    <a href="https://www.instagram.com/" class="text-danger" target="_blank" rel="noopener"
                        title="Bagikan ke Instagram">
                        <i class="bi bi-instagram fs-3"></i>
                    </a>

                    <!-- WhatsApp -->
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($destination->name . ' ' . request()->url()) }}"
                        class="text-success" target="_blank" rel="noopener" title="Bagikan ke WhatsApp">
                        <i class="bi bi-whatsapp fs-3"></i>
                    </a>
                </div>

            </div>

            {{-- <!-- Konten -->
            <div class="col-12 col-md-12 destination-content">
                <p class="destination-description">
                    {!! $destination->description !!}
                </p>

            </div> --}}
        </div>

    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-md-8 destination-content">
                <div class="destination-section">
                    <!-- Konten (8 kolom) -->
                    <p class="destination-description text-center">
                        {!! $destination->description !!}
                    </p>
                </div>
            </div>

            <!-- Peta (4 kolom) -->
            <div class="col-12 col-md-4">
                <div class="destination-section">
                    <div id="map" style="height: 400px; border-radius: 15px;"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <!-- Script Peta (Leaflet) -->
    <script>
        var map = L.map('map').setView([{{ $destination->lat }}, {{ $destination->long }}], 16);

        // Layer Satelit dari Esri
        L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: '&copy; <a href="https://www.esri.com/en-us/home">Esri</a>',
        }).addTo(map);

        L.marker([{{ $destination->lat }}, {{ $destination->long }}]).addTo(map)
            .bindPopup('<b>{{ $destination->name }}</b>')
            .openPopup();
    </script>
@endpush
