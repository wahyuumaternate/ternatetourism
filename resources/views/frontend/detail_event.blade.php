@extends('frontend.layouts.main')
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
            <div class="row align-items-center mb-5 justify-content-center">
                <div class="col-md-8">
                    <h1 class="fw-bold section-title" data-aos="fade-right">{{ $event->name }}</h1>
                    <p class="text-muted" data-aos="fade-left">
                        {{ date('d M Y', strtotime($event->date)) }}
                    </p>
                </div>
            </div>
            <div class="row g-4">
                {{-- @foreach ($events as $event) --}}
                <div class="col-md-8 d-flex justify-content-center" style="margin: 0 auto;" data-aos="zoom-in">
                    <div class="card h-100 border-0 rounded-4 overflow-hidden">
                        <!-- Event Image -->
                        <div class="image-container">
                            <img src="{{ $event->poster }}" alt="{{ $event->name }}" class="cover card-img-top"
                                style="object-fit: cover;" />
                            <div class="overlay"></div>
                        </div>
                        <!-- Event Details -->
                        <div class="card-body p-4" style="background-color: #e67e22; color: white;">
                            <h4 class="card-title text-uppercase mb-3">{{ $event->name }}</h4>

                            <!-- Location -->
                            <div class="mb-2">
                                <i class="bi bi-geo-alt me-2"></i>
                                {{ $event->location }}
                            </div>

                            <!-- Time -->
                            <div class="mb-3">
                                <i class="bi bi-clock me-2"></i>
                                {{ date('(l) H:i A', strtotime($event->time)) }}
                            </div>

                            <!-- Date Display -->
                            <div class="mb-3">
                                <span class="d-block" style="font-size: 2rem;">{{ date('d', strtotime($event->date)) }}
                                    <span>{{ date('M', strtotime($event->date)) }}</span></span>

                            </div>
                            <h4 class="card-title text-uppercase mb-3"><i class="bi bi-list me-2"></i> Detail</h4>
                            <div class="mb-3">
                                <p class="d-block" style="font-size: 2rem;">{!! $event->detail !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- @endforeach --}}
            </div>


        </div>
    </section>
@endsection
