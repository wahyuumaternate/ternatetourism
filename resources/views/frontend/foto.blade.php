@extends('frontend.layouts.main')
@include('frontend.layouts.navbar')

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
