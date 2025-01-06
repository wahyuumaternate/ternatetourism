@extends('frontend.layouts.main')
@include('frontend.layouts.navbar')
@include('frontend.layouts.hero')

@section('body')
    <!-- Popular Destinations -->
    <section class="py-5" id="destinations" data-aos="fade-up">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-md-8">
                    <h1 class="fw-bold section-title" data-aos="fade-right">Destinasi Populer</h1>
                    <p class="text-muted" data-aos="fade-left">
                        Kami Membawakan Rekomendasi Terbaik Untuk Pengalaman
                        Yang Tak Terlupakan.
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
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Gallery -->
    <section class="py-5 bg-light" data-aos="fade-up">
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
                @foreach ($galeri->take(6) as $item)
                    <div class="col-md-4" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                        <a href="{{ $item->file }}" data-fancybox="gallery" data-caption="{{ $item->description }}"
                            class="gallery-item">
                            <img src="{{ $item->file }}" class="gallery-img" alt="{{ $item->name }}" />
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <section class="py-5" id="blog" data-aos="fade-up">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-md-8">
                    <h1 class="fw-bold section-title" data-aos="fade-right">Berita</h1>
                    <p class="text-muted" data-aos="fade-left">
                        Dapatkan informasi terbaru seputar kegiatan, budaya, dan keindahan Ternate hanya di sini.
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
                                    {!! Str::limit($news->content, 100, '...') !!}
                                </p>
                                <a href="{{ route('berita.show', $news->slug) }}" class="btn tombol-read text-white">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Video Section -->
    <section class="py-5" id="destinations" data-aos="fade-up">
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
        </div>
    </section>

    <!-- Members Section -->
    <section class="py-5 bg-light" data-aos="fade-up">
        <div class="container">
            <div class="row mb-5 text-center">
                <div class="col-md-12" data-aos="fade-right">
                    <h1 class="fw-bold section-title">
                        In Partnership with
                    </h1>
                    <p class="text-muted">
                        Kolaborasi yang menginspirasi untuk menghadirkan pengalaman luar biasa dari Ternate.
                    </p>
                </div>
            </div>
            <div class="owl-carousel owl-theme">
                <div class="item">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTD6NiLBrpE5XvpewWqMsu-BadPFEvnO0XbdA&s"
                        class="member-logo" alt="Jetstar" />
                </div>
                <div class="item">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/7/75/Lambang_Kota_Ternate.png"
                        class="member-logo" alt="Expedia" />
                </div>
                <div class="item">
                    <img src="https://www.kemenparekraf.go.id/_next/image?url=https%3A%2F%2Fapi2.kemenparekraf.go.id%2Fstorage%2Fapp%2Fuploads%2Fpublic%2F621%2F437%2F638%2F621437638c977337188787.png&w=3840&q=75"
                        class="member-logo" alt="Qantas" />
                </div>
                <div class="item">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvgDYRC34vjMtD6mUEYMkTN1FPCUH0J_rkGw&s"
                        class="member-logo" alt="Alitalia" />
                </div>
                <div class="item">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvgDYRC34vjMtD6mUEYMkTN1FPCUH0J_rkGw&s"
                        class="member-logo" alt="Alitalia" />
                </div>
                <div class="item">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvgDYRC34vjMtD6mUEYMkTN1FPCUH0J_rkGw&s"
                        class="member-logo" alt="Alitalia" />
                </div>
                <div class="item">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTD6NiLBrpE5XvpewWqMsu-BadPFEvnO0XbdA&s"
                        class="member-logo" alt="Jetstar" />
                </div>
                <div class="item">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/7/75/Lambang_Kota_Ternate.png"
                        class="member-logo" alt="Expedia" />
                </div>
                <div class="item">
                    <img src="https://www.kemenparekraf.go.id/_next/image?url=https%3A%2F%2Fapi2.kemenparekraf.go.id%2Fstorage%2Fapp%2Fuploads%2Fpublic%2F621%2F437%2F638%2F621437638c977337188787.png&w=3840&q=75"
                        class="member-logo" alt="Qantas" />
                </div>
                <div class="item">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvgDYRC34vjMtD6mUEYMkTN1FPCUH0J_rkGw&s"
                        class="member-logo" alt="Alitalia" />
                </div>
                <div class="item">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvgDYRC34vjMtD6mUEYMkTN1FPCUH0J_rkGw&s"
                        class="member-logo" alt="Alitalia" />
                </div>
                <div class="item">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvgDYRC34vjMtD6mUEYMkTN1FPCUH0J_rkGw&s"
                        class="member-logo" alt="Alitalia" />
                </div>
            </div>
        </div>
    </section>

    <!-- Subscribe Section -->
    <section class="py-5" data-aos="fade-up">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h1 class="fw-bold section-title" data-aos="fade-right">Hubungi Kami</h1>
                    <p class="text-muted" data-aos="fade-left">
                        Ingin tahu lebih banyak tentang Ternate? Hubungi kami sekarang dan dapatkan informasi terbaik!
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
