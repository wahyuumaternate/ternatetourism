@extends('frontend.layouts.main')

@include('frontend.layouts.navbar')
@section('meta')
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
    <meta property="og:image" content="{{ asset($destination->image) }}">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:site_name" content="Your Website Name">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $destination->name }}">
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($destination->description), 160) }}">
    <meta name="twitter:image" content="{{ asset($destination->image) }}">
@endsection

@push('css')
    <style>
        /* Add your CSS styles here */
    </style>
@endpush

@section('body')
    <div class="container my-5">
        <div class="destination-section">
            {{-- Image Section --}}
            <div class="col-12 col-md-6">
                <img src="{{ asset($destination->image) }}" alt="{{ $destination->name }}" class="destination-image">
            </div>

            {{-- Content Section --}}
            <div class="col-12 col-md-6 destination-content">
                <h2 class="destination-title">Things to Do in {{ $destination->name }}</h2>

                <div class="share-buttons mt-4 d-flex align-items-center gap-3">
                    <p class="mb-0 me-3">Bagikan ke:</p>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                        class="text-primary" target="_blank" title="Bagikan ke Facebook">
                        <i class="bi bi-facebook fs-3"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}" class="text-info"
                        target="_blank" title="Bagikan ke Twitter">
                        <i class="bi bi-twitter fs-3"></i>
                    </a>
                    <a href="https://www.instagram.com/" class="text-danger" target="_blank" title="Bagikan ke Instagram">
                        <i class="bi bi-instagram fs-3"></i>
                    </a>
                    <a href="https://api.whatsapp.com/send?text={{ request()->url() }}" class="text-success"
                        target="_blank" title="Bagikan ke WhatsApp">
                        <i class="bi bi-whatsapp fs-3"></i>
                    </a>
                </div>

                <p class="destination-description">{!! $destination->description !!}</p>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-md-8 destination-content">
                <div class="destination-section">
                    <p class="destination-description text-center">{!! $destination->description !!}</p>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="destination-section">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var map = L.map('map').setView([{{ $destination->lat }}, {{ $destination->long }}], 16);
        L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: '&copy; <a href="https://www.esri.com/en-us/home">Esri</a>',
        }).addTo(map);

        L.marker([{{ $destination->lat }}, {{ $destination->long }}]).addTo(map)
            .bindPopup('<b>{{ $destination->name }}</b>')
            .openPopup();
    </script>
@endpush
