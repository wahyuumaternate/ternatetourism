@extends('frontend.layouts.main')
@push('meta')
    <!-- SEO Meta Tags -->
    <title>Video - Wonderful Ternate</title>
    <meta name="description"
        content="Koleksi video tentang destinasi wisata, budaya, dan keindahan alam Kota Ternate. Lihat keunikan dan pesona Ternate melalui konten video menarik.">
    <meta name="keywords"
        content="video wisata ternate, video pariwisata ternate, video budaya ternate, dokumentasi wisata ternate, video wonderful ternate">
    <meta name="author" content="Wonderful Ternate">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Video - Wonderful Ternate">
    <meta property="og:description"
        content="Koleksi video tentang destinasi wisata, budaya, dan keindahan alam Kota Ternate. Lihat keunikan dan pesona Ternate melalui konten video menarik.">
    <meta property="og:image" content="{{ asset('assets/kora_kora.jpg') }}">
    <meta property="og:url" content="{{ route('frontVideo') }}">
    <meta property="og:site_name" content="Wonderful Ternate">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Video - Wonderful Ternate">
    <meta name="twitter:description"
        content="Koleksi video tentang destinasi wisata, budaya, dan keindahan alam Kota Ternate. Lihat keunikan dan pesona Ternate melalui konten video menarik.">
    <meta name="twitter:image" content="{{ asset('assets/kora_kora.jpg') }}">

    <!-- Additional Meta Tags for Location -->
    <meta name="geo.region" content="ID-MU">
    <meta name="geo.placename" content="Ternate">
    <meta name="geo.position" content="0.7833;127.3667">
    <meta name="ICBM" content="0.7833, 127.3667">
@endpush
@include('frontend.layouts.navbar')
@section('body')
    <!-- Gallery -->
    <section class="py-5 mt-5" data-aos="fade-up">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-md-8">
                    <h1 class="fw-bold section-title" data-aos="fade-right">Video</h1>
                    <p class="text-muted" data-aos="fade-left">
                        Temukan perjalanan menarik dan visual yang memukau untuk pengalaman yang tak terlupakan.
                    </p>
                </div>
            </div>
            <div class="row g-4">
                @foreach ($video as $vid)
                    <div class="col-md-4" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="position-relative destination-card" style="height: 100%; overflow: hidden;">
                            <!-- Video Title -->
                            <div class="position-absolute top-0 start-0 p-4 text-white" style="width: 100%; z-index: 1;">
                                <h5 class="mb-3">{{ $vid->title }}</h5>
                            </div>
                            <!-- Video -->
                            <div class="ratio ratio-16x9 w-100 h-100" style="height: 100%;">
                                @php
                                    $videoUrl = $vid->file;
                                    preg_match(
                                        '/(?:youtu\.be\/|(?:www\.|m\.)?youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=))([^&\n]{11})/',
                                        $videoUrl,
                                        $matches,
                                    );
                                    $videoId = $matches[1] ?? null;
                                @endphp

                                @if ($videoId)
                                    <iframe src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0"
                                        allowfullscreen class="w-100 h-100" style="min-height: 100%; max-height: 100%;">
                                    </iframe>
                                @else
                                    <p>Video tidak dapat diputar</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="row mt-4">
                <div class="col-12 d-flex justify-content-center">
                    {{ $video->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
