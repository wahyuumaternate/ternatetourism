@extends('frontend.layouts.main')
@push('meta')
    <!-- SEO Meta Tags -->
    <title>{{ $facility->name }} - Fasilitas Wisata Wonderful Ternate</title>
    <meta name="description" content="{{ Str::limit(strip_tags($facility->deskripsi), 160) }}">
    <meta name="keywords"
        content="{{ $facility->name }}, {{ $facility->kategori }}, fasilitas wisata ternate, {{ strtolower($facility->kategori) }} ternate">
    <meta name="author" content="Wonderful Ternate">
    <meta name="robots" content="index, follow">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $facility->name }} - Fasilitas Wisata Wonderful Ternate">
    <meta property="og:description" content="{{ Str::limit(strip_tags($facility->deskripsi), 160) }}">
    <meta property="og:image" content="{{ Storage::url($facility->gambar) }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Wonderful Ternate">
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $facility->name }} - Fasilitas Wisata Wonderful Ternate">
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($facility->deskripsi), 160) }}">
    <meta name="twitter:image" content="{{ Storage::url($facility->gambar) }}">
    <!-- Additional Meta Tags for Location -->
    <meta name="geo.region" content="ID-MU">
    <meta name="geo.placename" content="Ternate">
    <meta name="geo.position" content="0.7833;127.3667">
    <meta name="ICBM" content="0.7833, 127.3667">
    <!-- Article Specific Meta Tags -->
    <meta property="article:published_time" content="{{ $facility->created_at->toIso8601String() }}">
    <meta property="article:modified_time" content="{{ $facility->updated_at->toIso8601String() }}">
    <meta property="article:section" content="Fasilitas Wisata">
    <meta property="article:tag" content="{{ $facility->kategori }}">
@endpush
@push('css')
    <style>
        body {
            padding-top: 100px;
            background-color: #f5f5f5;
        }

        .facility-image {
            width: 100%;
            height: 600px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .facility-content {
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .facility-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 15px;
            color: #333;
        }

        .facility-category {
            display: inline-block;
            padding: 8px 16px;
            background-color: #ff6500;
            color: white;
            border-radius: 20px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .facility-description {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #666;
            margin-bottom: 30px;
        }

        .meta-info {
            color: #888;
            font-size: 0.9rem;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }

        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ff6500;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
            margin-bottom: 30px;
        }

        .back-button:hover {
            background-color: #ff66009d;
            color: white;
        }
    </style>
@endpush

@section('body')
    <div class="container mt-5">
        {{-- <a href="{{ url()->previous() }}" class="back-button">
            <i class="bi bi-arrow-left"></i> Back
        </a> --}}

        <div class="row">
            <div class="col-lg-8 mx-auto">
                <img src="{{ $facility->gambar }}" alt="{{ $facility->name }}" class="facility-image">

                <div class="facility-content">
                    <h1 class="facility-title">{{ $facility->name }}</h1>
                    <span class="facility-category">{{ $facility->kategori }}</span>

                    <div class="meta-info facility-description">
                        {!! $facility->deskripsi !!}
                    </div>

                    {{-- <div class="meta-info">
                        <div class="row">
                            <div class="col-md-6">
                                Created: {{ $facility->created_at->format('d M Y') }}
                            </div>
                            <div class="col-md-6 text-md-end">
                                Last updated: {{ $facility->updated_at->format('d M Y') }}
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>

    </div>
@endsection
