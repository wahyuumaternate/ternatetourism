@extends('frontend.layouts.main')
{{-- @include('frontend.layouts.navbar') --}}
{{-- @include('frontend.layouts.hero') --}}
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
    <div class="banner-container">
        <div class="background-image"></div>
        <div class="overlay"></div>

        <div class="content">
            <div class="left-content">
                <p id="key" style="display:none;"></p>

                <p class="subtitle" id="quote"></p>
                <p class="author" id="author"></p>
            </div>

            <script>
                // Ambil data translasi sesuai locale aktif
                const quotes = @json(__('quotes'));
                const keys = Object.keys(quotes); // ["q1", "q2", "q3", ...]
                let index = 0;

                const keyEl = document.getElementById("key");
                const quoteEl = document.getElementById("quote");
                const authorEl = document.getElementById("author");

                function showQuote() {
                    const key = keys[index];
                    const q = quotes[key];

                    keyEl.style.opacity = 0;
                    quoteEl.style.opacity = 0;
                    authorEl.style.opacity = 0;

                    setTimeout(() => {
                        keyEl.textContent = key;
                        quoteEl.textContent = `"${q.text}"`;
                        authorEl.textContent = `– ${q.author}`;

                        keyEl.style.opacity = 1;
                        quoteEl.style.opacity = 1;
                        authorEl.style.opacity = 1;

                        index = (index + 1) % keys.length;
                    }, 500);
                }

                showQuote();
                setInterval(showQuote, 8000);
            </script>

        </div>

        {{-- <div class="navigation-arrow" id="nextBtn">›</div> --}}

        <div class="side-images">
            <!-- Main destination card -->
            <div class="main-destination-card">
                <img src="{{ asset('assets/jikomalamo.webp') }}" alt="Jikomalamo" class="main-card-image" />
                <div class="main-card-content">
                    <h3 class="main-card-title">Jikomalamo</h3>
                    <p class="main-card-location">Pulau Ternate</p>
                    <p class="main-card-description">
                        Gunung berapi aktif dengan spot diving terbaik di sekitar Ternate yang memukau
                    </p>
                </div>
            </div>

            <!-- Side slider (partially visible) -->
            <div class="side-slider">
                <div class="side-card">
                    <img src="{{ asset('assets/tolire.jpg') }}" alt="Danau Tolire" class="side-card-image" />
                    <div class="side-card-overlay">
                        <h4 class="side-card-title">Danau Tolire</h4>
                        <p class="side-card-location">Ternate</p>
                    </div>
                </div>

                <div class="side-card">
                    <img src="{{ asset('assets/sulamadaha.jpg') }}" alt="Pantai Sulamadaha" class="side-card-image" />
                    <div class="side-card-overlay">
                        <h4 class="side-card-title">Pantai Sulamadaha</h4>
                        <p class="side-card-location">Ternate</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="pagination-dots">
            <div class="dot active"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
    </div>

    <!-- Video Teaser Festival Kora-Kora Section -->
    <section id="teaser-video" class="py-5 bg-white position-relative" data-aos="fade-up">
        <div class="container position-relative" style="z-index: 1;">
            <div class="row justify-content-center mb-4 text-center">
                <div class="col-lg-8">
                    <span class="badge bg-orange px-3 py-2 mb-2" data-aos="fade-down">OFFICIAL TEASER</span>
                    <h2 class="display-5 fw-bold mb-3" data-aos="fade-right">Festival <span
                            class="text-orange">Kora-Kora</span> 2026</h2>
                    <div class="d-flex justify-content-center">
                        <div class="divider-custom">
                            <div class="divider-custom-line bg-light-gray"></div>
                            <div class="divider-custom-icon">
                                <!-- Changed from Font Awesome to Bootstrap icon -->
                                <i class="bi bi-ship text-orange"></i>
                            </div>
                            <div class="divider-custom-line bg-light-gray"></div>
                        </div>
                    </div>
                    <p class="lead text-dark mb-0" data-aos="fade-left">
                        Saksikan keindahan dan kemegahan Festival Kora-Kora, warisan budaya Kota Ternate yang menakjubkan
                    </p>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <!-- Video wrapper with custom play button overlay -->
                    <div class="video-wrapper position-relative rounded-4 overflow-hidden shadow-lg" data-aos="zoom-in">
                        <!-- Play button overlay -->
                        <div class="video-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center"
                            id="video-overlay">
                            <button
                                class="btn btn-play text-white rounded-circle p-0 d-flex align-items-center justify-content-center shadow-lg position-relative"
                                style="width: 100px; height: 100px; background: linear-gradient(135deg, #ff7b00, #ff3d00); border: none;"
                                onclick="playVideo()">
                                <!-- Changed from Font Awesome to Bootstrap icon -->
                                <i class="bi bi-play-fill" style="font-size: 2.5rem; margin-left: 6px;"></i>

                                <!-- Lingkaran cahaya animasi -->
                                <span class="play-pulse"></span>
                            </button>
                        </div>

                        <!-- Video thumbnail with lazy loading -->
                        <img src="assets/images/kora-kora-thumbnail.jpg" class="img-fluid w-100 video-thumbnail"
                            alt="Festival Kora-Kora Teaser Thumbnail"
                            onerror="this.src='https://img.youtube.com/vi/9GUrxUK_GC8/maxresdefault.jpg'">

                        <!-- Actual video iframe (initially hidden) -->
                        <div class="ratio ratio-16x9 d-none" id="video-container">
                            <iframe id="teaser-video-iframe"
                                src="https://www.youtube.com/embed/9GUrxUK_GC8?autoplay=0&mute=0&rel=0&modestbranding=1"
                                title="Festival Kora-Kora Official Teaser"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen style="border: none;">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- JavaScript for video player functionality -->
    <script>
        function playVideo() {
            // Hide overlay and thumbnail
            document.getElementById('video-overlay').classList.add('d-none');
            document.querySelector('.video-thumbnail').classList.add('d-none');

            // Show and play video
            const videoContainer = document.getElementById('video-container');
            videoContainer.classList.remove('d-none');

            // Update iframe src to autoplay
            const iframe = document.getElementById('teaser-video-iframe');
            const iframeSrc = iframe.src;
            iframe.src = iframeSrc.replace('autoplay=0', 'autoplay=1');
        }
    </script>

    <!-- Custom CSS for styling -->
    <style>
        /* Custom Orange Color Variables */
        .btn-play {
            transition: all 0.3s ease-in-out;
        }

        .btn-play:hover {
            transform: scale(1.1);
            box-shadow: 0 0 25px rgba(255, 123, 0, 0.8);
        }

        /* Efek animasi cahaya berdenyut */
        .play-pulse {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 120%;
            height: 120%;
            border-radius: 50%;
            background: rgba(255, 123, 0, 0.4);
            transform: translate(-50%, -50%);
            animation: pulse 1.8s infinite ease-out;
            z-index: -1;
        }

        @keyframes pulse {
            0% {
                transform: translate(-50%, -50%) scale(0.9);
                opacity: 0.9;
            }

            70% {
                transform: translate(-50%, -50%) scale(1.3);
                opacity: 0;
            }

            100% {
                opacity: 0;
            }
        }

        :root {
            --bs-orange: #FF6600;
            --bs-orange-rgb: 255, 102, 0;
            --bs-orange-light: #FF8533;
            --bs-light-gray: #E9ECEF;
        }

        /* Background and Text Colors */
        .bg-orange {
            background-color: var(--bs-orange) !important;
        }

        .text-orange {
            color: var(--bs-orange) !important;
        }

        .bg-light-gray {
            background-color: var(--bs-light-gray) !important;
        }

        /* Button Styles */
        .btn-orange {
            background-color: var(--bs-orange);
            border-color: var(--bs-orange);
            color: #fff;
        }

        .btn-orange:hover {
            background-color: var(--bs-orange-light);
            border-color: var(--bs-orange-light);
            color: #fff;
        }

        .btn-outline-orange {
            color: var(--bs-orange);
            border-color: var(--bs-orange);
        }

        .btn-outline-orange:hover {
            background-color: var(--bs-orange);
            color: #fff;
        }

        /* Divider Custom */
        .divider-custom {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 1rem 0 1.5rem;
        }

        .divider-custom .divider-custom-line {
            width: 100%;
            max-width: 6rem;
            height: 0.25rem;
            border-radius: 1rem;
            opacity: 0.3;
        }

        .divider-custom .divider-custom-icon {
            font-size: 1.5rem;
            margin: 0 1rem;
        }

        /* Play Button */
        .btn-play {
            transition: all 0.3s ease;
        }

        .btn-play:hover {
            transform: scale(1.1);
            box-shadow: 0 0 15px rgba(255, 102, 0, 0.5) !important;
        }

        /* Video Wrapper */
        .video-wrapper {
            transition: transform 0.3s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2) !important;
        }

        /* Social Share Links */
        .social-share a {
            transition: all 0.3s ease;
        }

        .social-share a:hover {
            background-color: var(--bs-orange);
            border-color: var(--bs-orange);
            color: #fff;
        }
    </style>

    <!-- Bootstrap Icons CSS - IMPORTANT: Add this to your head section -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Popular Destinations -->
    <section class="py-5" id="destinations" data-aos="fade-up">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-md-8">
                    <h1 class="fw-bold section-title" data-aos="fade-right">{{ __('pesan.populer_destinasi') }}</h1>
                    <p class="text-muted" data-aos="fade-left">

                        {{ __('pesan.destinasi_desc') }}
                    </p>
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
                            {{-- <div class="position-absolute top-0 start-0 p-4 text-white" style="width: 100%; z-index: 1;">
                                <h5 class="mb-3">{{ $vid->title }}</h5>
                            </div> --}}
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
