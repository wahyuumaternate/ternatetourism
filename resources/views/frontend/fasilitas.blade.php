@extends('frontend.layouts.main')

@push('css')
    <style>
        body {
            padding-top: 100px;
            background-color: #f5f5f5;
        }

        .facility-card {
            position: relative;
            height: 400px;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 30px;
            transition: transform 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .facility-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .facility-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .facility-card:hover .facility-image {
            transform: scale(1.05);
        }

        .facility-info {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 30px 20px;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.9));
            color: white;
        }

        .facility-name {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 10px;
            color: white;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .facility-category {
            color: #e0e0e0;
            font-size: 1.1rem;
            margin-bottom: 10px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .facility-description {
            color: #f0f0f0;
            font-size: 0.9rem;
            margin-bottom: 15px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .detail-button {
            display: inline-block;
            padding: 8px 20px;
            background-color: #ff6500;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .detail-button:hover {
            background-color: #ff66009d;
            color: white;
        }

        .container {
            max-width: 1400px;
        }
    </style>
@endpush

@section('body')
    <div class="container mt-5">
        <div class="row align-items-center mb-5">
            <div class="col-md-8">
                <h1 class="fw-bold section-title" data-aos="fade-right">{{ __('pesan.facilities_title') }}</h1>
                <p class="text-muted" data-aos="fade-left">
                    {{ __('pesan.facilities_subtitle') }}
                </p>
            </div>
        </div>

        <div class="row">
            @foreach ($facilities as $facility)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="facility-card">
                        <img src="{{ $facility->gambar }}" alt="{{ $facility->name }}" class="facility-image">
                        <div class="facility-info">
                            <h3 class="facility-name">{{ $facility->name }}</h3>
                            <p class="facility-category">{{ $facility->kategori }}</p>
                            {{-- <p class="facility-description">{{ $facility->deskripsi }}</p> --}}
                            <a href="{{ route('fasilitas.detail', $facility->slug) }}" class="detail-button">
                                {{ __('pesan.read_more') }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
