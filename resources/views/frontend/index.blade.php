@extends('frontend.layouts.main')
@include('frontend.layouts.navbar')
@include('frontend.layouts.hero')
@push('meta')
    <!-- SEO Meta Tags -->
    <title>Wonderful Ternate</title>
    <meta name="description"
        content="Jelajahi berbagai destinasi wisata menarik di Kota Ternate. Temukan keindahan alam, sejarah, dan budaya yang menakjubkan di setiap sudut kota.">
    <meta name="keywords"
        content="destinasi wisata ternate, objek wisata ternate, tempat wisata ternate, wisata sejarah ternate, wisata alam ternate, wonderful ternate">
    <meta name="author" content="Wonderful Ternate">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Wonderful Ternate">
    <meta property="og:description"
        content="Jelajahi berbagai destinasi wisata menarik di Kota Ternate. Temukan keindahan alam, sejarah, dan budaya yang menakjubkan di setiap sudut kota.">
    <meta property="og:image" content="{{ asset('assets/kora_kora.jpg') }}">
    <meta property="og:url" content="{{ url('') }}">
    <meta property="og:site_name" content="Wonderful Ternate">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Wonderful Ternate">
    <meta name="twitter:description"
        content="Jelajahi berbagai destinasi wisata menarik di Kota Ternate. Temukan keindahan alam, sejarah, dan budaya yang menakjubkan di setiap sudut kota.">
    <meta name="twitter:image" content="{{ asset('assets/kora_kora.jpg') }}">

    <!-- Additional Meta Tags for Location -->
    <meta name="geo.region" content="ID-MU">
    <meta name="geo.placename" content="Ternate">
    <meta name="geo.position" content="0.7833;127.3667">
    <meta name="ICBM" content="0.7833, 127.3667">
@endpush
@section('body')
    <!-- Popular Destinations -->
    <section class="py-5" id="destinations" data-aos="fade-up">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-md-8">
                    <div class="col-md-8 d-flex align-items-center">
                        <div>
                            <div class="d-flex align-items-center">
                                <h1 class="fw-bold section-title me-2" data-aos="fade-right">
                                    {{ __('pesan.populer_destinasi') }}</h1>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" class="align-middle"
                                    style="fill: orange; height: 2em; width: 2em;">
                                    <path
                                        d="m19.6 66.5 19.7-11 .3-1-.3-.5h-1l-3.3-.2-11.2-.3L14 53l-9.5-.5-2.4-.5L0 49l.2-1.5 2-1.3 2.9.2 6.3.5 9.5.6 6.9.4L38 49.1h1.6l.2-.7-.5-.4-.4-.4L29 41l-10.6-7-5.6-4.1-3-2-1.5-2-.6-4.2 2.7-3 3.7.3.9.2 3.7 2.9 8 6.1L37 36l1.5 1.2.6-.4.1-.3-.7-1.1L33 25l-6-10.4-2.7-4.3-.7-2.6c-.3-1-.4-2-.4-3l3-4.2L28 0l4.2.6L33.8 2l2.6 6 4.1 9.3L47 29.9l2 3.8 1 3.4.3 1h.7v-.5l.5-7.2 1-8.7 1-11.2.3-3.2 1.6-3.8 3-2L61 2.6l2 2.9-.3 1.8-1.1 7.7L59 27.1l-1.5 8.2h.9l1-1.1 4.1-5.4 6.9-8.6 3-3.5L77 13l2.3-1.8h4.3l3.1 4.7-1.4 4.9-4.4 5.6-3.7 4.7-5.3 7.1-3.2 5.7.3.4h.7l12-2.6 6.4-1.1 7.6-1.3 3.5 1.6.4 1.6-1.4 3.4-8.2 2-9.6 2-14.3 3.3-.2.1.2.3 6.4.6 2.8.2h6.8l12.6 1 3.3 2 1.9 2.7-.3 2-5.1 2.6-6.8-1.6-16-3.8-5.4-1.3h-.8v.4l4.6 4.5 8.3 7.5L89 80.1l.5 2.4-1.3 2-1.4-.2-9.2-7-3.6-3-8-6.8h-.5v.7l1.8 2.7 9.8 14.7.5 4.5-.7 1.4-2.6 1-2.7-.6-5.8-8-6-9-4.7-8.2-.5.4-2.9 30.2-1.3 1.5-3 1.2-2.5-2-1.4-3 1.4-6.2 1.6-8 1.3-6.4 1.2-7.9.7-2.6v-.2H49L43 72l-9 12.3-7.2 7.6-1.7.7-3-1.5.3-2.8L24 86l10-12.8 6-7.9 4-4.6-.1-.5h-.3L17.2 77.4l-4.7.6-2-2 .2-3 1-1 8-5.5Z">
                                    </path>
                                </svg>
                            </div>
                            <p class="text-muted" data-aos="fade-left">
                                {{ __('pesan.destinasi_desc') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                @foreach ($destinasi->take(3) as $item)
                    <div class="col-md-4" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="position-relative destination-card">
                            <!-- Gambar Destinasi -->
                            <img src="{{ $item->image ? asset($item->image) : 'https://via.placeholder.com/300' }}"
                                alt="{{ $item->name }}" class="w-100 h-100 object-fit-cover" />

                            <!-- Detail Destinasi -->
                            <div class="position-absolute bottom-0 start-0 p-4 text-white"
                                style="
                                    background: linear-gradient(
                                        transparent,
                                        rgba(0, 0, 0, 0.8)
                                    );
                                    width: 100%;
                                ">
                                <h5 class="mb-3">{{ $item->name }}</h5>
                                <a href="{{ route('destinasi.show', $item->slug) }}" class="btn text-white btn-sm">

                                    {{-- {{ __('pesan.') }} --}}
                                    {{ __('pesan.read_more') }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if ($destinasi->count() > 0)
                <div class="row mt-4">
                    <div class="col-12 text-end">
                        <a href="{{ route('destinasi.all') }}" class="btn text-white btn-sm">
                            {{ __('pesan.read_more') }}
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Gallery -->
    <section class="py-5 bg-light" data-aos="fade-up">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-md-8">
                    <h1 class="fw-bold section-title" data-aos="fade-right">{{ __('pesan.galeri') }}</h1>
                    <p class="text-muted" data-aos="fade-left">
                        {{ __('pesan.galeri_desc') }}
                    </p>
                </div>
            </div>
            <div class="row g-4">
                @foreach ($galeri->take(6) as $item)
                    <div class="col-md-4" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                        <a href="{{ $item->file }}" data-fancybox="gallery" data-caption="{{ $item->title }}"
                            class="gallery-item">
                            <img src="{{ $item->file }}" class="gallery-img" alt="{{ $item->title }}" />
                        </a>
                    </div>
                @endforeach
            </div>
            @if ($galeri->count() > 0)
                <div class="row mt-4">
                    <div class="col-12 text-end">
                        <a href="{{ route('frontFoto') }}" class="btn text-white btn-sm">
                            {{ __('pesan.read_more') }}
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Blog Section -->
    <section class="py-5" id="blog" data-aos="fade-up">
        <div class="container">
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
                                    {{ __('pesan.read_more') }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if ($berita->count() > 0)
                <div class="row mt-4">
                    <div class="col-12 text-end">
                        <a href="{{ route('berita.all') }}" class="btn text-white btn-sm">
                            {{ __('pesan.read_more') }}
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Video Section -->
    <section class="py-5" id="destinations" data-aos="fade-up">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-md-8">
                    <h1 class="fw-bold section-title" data-aos="fade-right">{{ __('pesan.video') }}</h1>
                    <p class="text-muted" data-aos="fade-left">

                        {{ __('pesan.video_desc') }}
                    </p>
                </div>
            </div>
            <div class="row g-4">
                @foreach ($video->take(6) as $vid)
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
            @if ($video->count() > 0)
                <div class="row mt-4">
                    <div class="col-12 text-end">
                        <a href="{{ route('frontVideo') }}" class="btn text-white btn-sm">
                            {{ __('pesan.read_more') }}
                        </a>
                    </div>
            @endif
        </div>
        </div>
    </section>

    <!-- Members Section -->
    <section class="py-5 bg-light" data-aos="fade-up">
        <div class="container">
            <div class="row mb-5 text-center">
                <div class="col-md-12" data-aos="fade-right">
                    <h1 class="fw-bold section-title">
                        {{ __('pesan.partner') }}
                    </h1>
                    <p class="text-muted">
                        {{ __('pesan.partner_desc') }}
                    </p>
                </div>
            </div>
            <div class="owl-carousel owl-theme">
                @foreach ($partners as $partner)
                    @if ($partner->logo)
                        <div class="item">
                            <img src="{{ $partner->logo }}" class="member-logo mb-3" alt="{{ $partner->name }}"
                                onerror="this.style.display='none'" /> <!-- Sembunyikan gambar jika gagal load -->
                            <small class="mt-2">{{ $partner->name }}</small>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
@endsection
