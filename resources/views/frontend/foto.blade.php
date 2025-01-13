@extends('frontend.layouts.main')
@include('frontend.layouts.navbar')
@push('meta')
    <!-- SEO Meta Tags -->
    <title>Galeri - Wonderful Ternate</title>
    <meta name="description"
        content="Koleksi foto dan gambar tentang destinasi wisata, budaya, dan keindahan alam Kota Ternate. Lihat keunikan dan pesona Ternate melalui galeri foto menarik.">
    <meta name="keywords"
        content="galeri wisata ternate, foto pariwisata ternate, foto budaya ternate, dokumentasi wisata ternate, galeri wonderful ternate">
    <meta name="author" content="Wonderful Ternate">
    <meta name="robots" content="index, follow">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content=" - Wonderful Ternate">
    <meta property="og:description"
        content="Koleksi foto dan gambar tentang destinasi wisata, budaya, dan keindahan alam Kota Ternate. Lihat keunikan dan pesona Ternate melalui galeri foto menarik.">
    <meta property="og:image" content="{{ asset('assets/kora_kora.jpg') }}">
    <meta property="og:url" content="{{ route('frontFoto') }}">
    <meta property="og:site_name" content="Wonderful Ternate">
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Galeri Pariwisata - Wonderful Ternate">
    <meta name="twitter:description"
        content="Koleksi foto dan gambar tentang destinasi wisata, budaya, dan keindahan alam Kota Ternate. Lihat keunikan dan pesona Ternate melalui galeri foto menarik.">
    <meta name="twitter:image" content="{{ asset('assets/kora_kora.jpg') }}">
    <!-- Additional Meta Tags for Location -->
    <meta name="geo.region" content="ID-MU">
    <meta name="geo.placename" content="Ternate">
    <meta name="geo.position" content="0.7833;127.3667">
    <meta name="ICBM" content="0.7833, 127.3667">
@endpush
@section('body')
    <!-- Gallery -->
    <section class="py-5 mt-5" data-aos="fade-up">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-md-8">
                    <h1 class="fw-bold section-title" data-aos="fade-right">Galeri</h1>
                    <p class="text-muted" data-aos="fade-left">
                        Jelajahi keindahan Ternate melalui galeri yang menghadirkan keajaiban alam dan budaya.
                    </p>
                </div>
            </div>
            <div class="row g-4">
                @foreach ($media as $item)
                    <div class="col-md-4" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                        <a href="{{ $item->file }}" data-fancybox="gallery" data-caption="{{ $item->title }}"
                            class="gallery-item">
                            <img src="{{ $item->file }}" class="gallery-img" alt="{{ $item->title }}" />
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="row mt-4">
                <div class="col-12 d-flex justify-content-center">
                    {{ $media->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
