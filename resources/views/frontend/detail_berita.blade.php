@extends('frontend.layouts.main')

@push('meta')
    <!-- SEO Meta Tags -->
    <title>{{ $news->title }} - Berita Pariwisata Wonderful Ternate</title>
    <meta name="description" content="{{ Str::limit(strip_tags($news->content), 160) }}">
    <meta name="keywords"
        content="berita wisata ternate, {{ Str::slug($news->title) }}, info wisata ternate, kabar pariwisata ternate">
    <meta name="author" content="Wonderful Ternate">
    <meta name="robots" content="index, follow">

    <!-- Preload Critical Resources -->
    <link rel="preload" as="image" href="{{ $news->image }}" type="image/jpeg">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $news->title }} - Berita Pariwisata Wonderful Ternate">
    <meta property="og:description" content="{{ Str::limit(strip_tags($news->content), 160) }}">
    <meta property="og:image" content="{{ $news->image }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Wonderful Ternate">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $news->title }} - Berita Pariwisata Wonderful Ternate">
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($news->content), 160) }}">
    <meta name="twitter:image" content="{{ $news->image }}">

    <!-- Location Meta Tags -->
    <meta name="geo.region" content="ID-MU">
    <meta name="geo.placename" content="Ternate">
    <meta name="geo.position" content="0.7833;127.3667">
    <meta name="ICBM" content="0.7833, 127.3667">

    <!-- Article Meta Tags -->
    <meta property="article:published_time" content="{{ $news->created_at->toIso8601String() }}">
    <meta property="article:modified_time" content="{{ $news->updated_at->toIso8601String() }}">
    <meta property="article:section" content="Berita Pariwisata">
    <meta property="article:tag" content="Pariwisata Ternate">
@endpush
@push('css')
    <style>
        .hhh {
            margin-top: 150px !important;
            margin-bottom: 50px !important;
        }

        @media (min-width: 992px) {
            .card-img-top {
                max-height: 800px;
                /* max-width: 800px; */
                object-fit: cover;
            }
        }
    </style>
@endpush


@section('body')
    <div class="container mt-5 hhh">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <!-- Main News Image -->
                <img src="{{ $news->image }}" alt="{{ $news->title }}" class="img-fluid rounded-3 shadow mb-4 w-100"
                    style="width:600px; ">

                <!-- News Content -->
                <div class="news-content bg-white rounded-3 shadow p-4">
                    <!-- Header -->
                    <h1 class="h2 fw-bold mb-3">{{ $news->title }}</h1>

                    <!-- Meta Info -->
                    <div class="meta-info text-muted mb-4">
                        <div class="d-flex align-items-center gap-3">
                            <div>
                                <i class="bi bi-person"></i>
                                {{ $news->user->name }}
                            </div>
                            <div>
                                <i class="bi bi-calendar-event"></i>
                                {{ $news->created_at->isoFormat('D MMMM Y') }}
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="news-body">
                        {!! $news->content !!}
                    </div>

                    <!-- Share Section -->
                    <div class="share-section mt-4 pt-4 border-top">
                        <h5 class="mb-3">Bagikan:</h5>
                        <div class="d-flex gap-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" class="btn "
                                target="_blank">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $news->title }}"
                                class="btn " target="_blank">
                                <i class="bi bi-twitter"></i>
                            </a>
                            <a href="https://api.whatsapp.com/send?text={{ url()->current() }}" class="btn "
                                target="_blank">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
