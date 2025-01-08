@extends('frontend.layouts.main')

{{-- @push('meta')
    <!-- SEO Meta Tags -->
    <title>{{ $destination->name }} - Wonderful Ternate</title>
    <meta name="description" content="{{ Str::limit(strip_tags($destination->description), 160) }}">
    <meta name="keywords" content="{{ implode(',', ['destination', $destination->name, 'travel', 'tourism']) }}">
    <meta name="author" content="Your Website Name">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $destination->name }} - Your Website Name">
    <meta property="og:description" content="{{ Str::limit(strip_tags($destination->description), 160) }}">
    <meta property="og:image" content="{{ $destination->image }}">
    <meta property="og:url" content="{{ route('destinasi.show', $destination->slug) }}">
    <meta property="og:site_name" content="Your Website Name">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $destination->name }} - Your Website Name">
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($destination->description), 160) }}">
    <meta name="twitter:image" content="{{ $destination->image }}">
@endpush --}}


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
