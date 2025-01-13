@extends('frontend.layouts.main')
@push('meta')
    <!-- SEO Meta Tags -->
    <title>Event & Festival - Wonderful Ternate</title>
    <meta name="description"
        content="Jadwal lengkap event, festival budaya, dan acara menarik di Kota Ternate. Temukan berbagai perayaan tradisional, festival seni, dan acara wisata yang dapat Anda nikmati.">
    <meta name="keywords"
        content="event ternate, festival ternate, acara budaya ternate, festival budaya ternate, agenda wisata ternate, kalender event ternate">
    <meta name="author" content="Wonderful Ternate">
    <meta name="robots" content="index, follow">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Event & Festival - Wonderful Ternate">
    <meta property="og:description"
        content="Jadwal lengkap event, festival budaya, dan acara menarik di Kota Ternate. Temukan berbagai perayaan tradisional, festival seni, dan acara wisata yang dapat Anda nikmati.">
    <meta property="og:image" content="{{ asset('assets/kora_kora.jpg') }}">
    <meta property="og:url" content="{{ route('events.all') }}">
    <meta property="og:site_name" content="Wonderful Ternate">
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Event & Festival - Wonderful Ternate">
    <meta name="twitter:description"
        content="Jadwal lengkap event, festival budaya, dan acara menarik di Kota Ternate. Temukan berbagai perayaan tradisional, festival seni, dan acara wisata yang dapat Anda nikmati.">
    <meta name="twitter:image" content="{{ asset('assets/kora_kora.jpg') }}">
    <!-- Additional Meta Tags for Location -->
    <meta name="geo.region" content="ID-MU">
    <meta name="geo.placename" content="Ternate">
    <meta name="geo.position" content="0.7833;127.3667">
    <meta name="ICBM" content="0.7833, 127.3667">
@endpush
@include('frontend.layouts.navbar')
@push('css')
    <style>
        .card {
            transition: transform 0.3s ease;
            text-decoration: none;
            /* Menghilangkan garis bawah di link */
            color: inherit;
            /* Mengambil warna teks dari parent */
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .fas,
        .far {
            width: 20px;
        }

        .cover {
            max-height: 2250px;
            max-width: 1410px;

            display: block;
            /* Menghilangkan spasi di bawah gambar */
            transition: transform 0.3s ease;
            /* Efek transisi zoom */
        }



        .cover:hover {
            transform: scale(1.05);
            /* Zoom in */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            /* Shadow effect */
        }

        .image-container {
            position: relative;
            /* Posisi relatif untuk overlay */
            display: inline-block;
            /* Mengatur ukuran sesuai gambar */
        }

        .image-container:hover .event-image {
            transform: scale(1.05);
            /* Zoom in saat hover */
        }

        .overlay {
            position: absolute;
            /* Overlay di posisi absolut */
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ff660080;
            /* Warna oranye */
            opacity: 0;
            /* Mulai dengan transparan */
            transition: opacity 0.3s ease;
            /* Transisi opacity */
        }

        .image-container:hover .overlay {
            opacity: 1;
            /* Menampilkan overlay saat hover */
        }
    </style>
@endpush
@section('body')
    <!-- Events Section -->
    <section class="py-5 mt-5" id="events" data-aos="fade-up">
        <div class="container mt-5">
            <div class="row align-items-center mb-5">
                <div class="col-md-8">
                    <h1 class="fw-bold section-title" data-aos="fade-right">{{ __('pesan.events_title') }}</h1>
                    <p class="text-muted" data-aos="fade-left">
                        {{ __('pesan.events_subtitle') }}
                    </p>
                </div>
            </div>
            <div class="row g-4">
                @foreach ($events as $item)
                    <div class="col-md-4" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                        <a href="{{ route('event.detail', $item->slug) }}"
                            class="card h-100 border-0 rounded-4 overflow-hidden">
                            <!-- Event Image -->
                            <div class="image-container">
                                <img src="{{ $item->poster }}" alt="{{ $item->name }}" class="cover card-img-top"
                                    style="object-fit: cover;" />
                                <div class="overlay"></div>
                            </div>
                            <!-- Event Details -->
                            <div class="card-body p-4"
                                style="background-color: {{ $loop->iteration % 2 == 1 ? '#e67e22' : '#4a69bd' }}; color: white;">
                                <h4 class="card-title text-uppercase mb-3">{{ $item->name }}</h4>

                                <!-- Location -->
                                <div class="mb-2">
                                    <i class="bi bi-geo-alt me-2"></i>
                                    {{ $item->location }}
                                </div>

                                <!-- Time -->
                                <div class="mb-3">
                                    <i class="bi bi-clock me-2"></i>
                                    {{ date('H:i A', strtotime($item->time)) }}
                                </div>

                                <!-- Date Display -->
                                <div class="mb-3">
                                    <span class="d-block"
                                        style="font-size: 2rem;">{{ date('d', strtotime($item->date)) }}</span>
                                    <span class="ms-2">{{ date('M', strtotime($item->date)) }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Pagination Links -->
            <div class="d-flex justify-content-center mt-4">
                {{ $events->links() }}
            </div>
        </div>
    </section>
@endsection
