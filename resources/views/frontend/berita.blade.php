@extends('frontend.layouts.main')
@push('meta')
    <!-- SEO Meta Tags -->
    <title>Berita - Wonderful Ternate</title>
    <meta name="description"
        content="Berita terkini seputar pariwisata Kota Ternate, update informasi wisata, pengembangan destinasi, dan berbagai kegiatan pariwisata yang ada di Kota Ternate.">
    <meta name="keywords"
        content="berita wisata ternate, info wisata ternate, kabar pariwisata ternate, berita terkini ternate, update wisata ternate">
    <meta name="author" content="Wonderful Ternate">
    <meta name="robots" content="index, follow">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Berita - Wonderful Ternate">
    <meta property="og:description"
        content="Berita terkini seputar pariwisata Kota Ternate, update informasi wisata, pengembangan destinasi, dan berbagai kegiatan pariwisata yang ada di Kota Ternate.">
    <meta property="og:image" content="{{ asset('assets/kora_kora.jpg') }}">
    <meta property="og:url" content="{{ route('berita.all') }}">
    <meta property="og:site_name" content="Wonderful Ternate">
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Berita - Wonderful Ternate">
    <meta name="twitter:description"
        content="Berita terkini seputar pariwisata Kota Ternate, update informasi wisata, pengembangan destinasi, dan berbagai kegiatan pariwisata yang ada di Kota Ternate.">
    <meta name="twitter:image" content="{{ asset('assets/kora_kora.jpg') }}">
    <!-- Additional Meta Tags for Location -->
    <meta name="geo.region" content="ID-MU">
    <meta name="geo.placename" content="Ternate">
    <meta name="geo.position" content="0.7833;127.3667">
    <meta name="ICBM" content="0.7833, 127.3667">
@endpush
@include('frontend.layouts.navbar')
@section('body')
    <!-- Blog Section -->
    <section class="py-5 mt-5" id="blog" data-aos="fade-up">
        <div class="container mt-5">
            <div class="row align-items-center mb-5">
                <div class="col-md-8">
                    <h1 class="fw-bold section-title" data-aos="fade-right"> {{ __('pesan.berita') }}</h1>
                    <p class="text-muted" data-aos="fade-left">
                        {{ __('pesan.berita_desc') }}
                    </p>
                </div>
            </div>
            <div class="row g-4">
                @foreach ($berita as $news)
                    <div class="col-md-4" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="card blog-card">
                            <img src="{{ $news->image }}" class="card-img-top" alt="{{ $news->title }}" />
                            <div class="card-body">
                                <h5 class="card-title">{{ $news->title }}</h5>
                                <p class="card-text">
                                    {!! Str::limit($news->excerpt, 120, '...') !!}
                                </p>
                                <a href="{{ route('berita.detail', $news->slug) }}" class="btn tombol-read text-white">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Pagination Links -->
            <div class="d-flex justify-content-center mt-4">
                {{ $berita->links() }}
            </div>
        </div>
    </section>
@endsection
