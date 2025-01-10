@extends('frontend.layouts.main')
@include('frontend.layouts.navbar')
@section('body')
    <!-- Blog Section -->
    <section class="py-5 mt-5" id="blog" data-aos="fade-up">
        <div class="container mt-5">
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
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Pagination Links -->
            <div class="d-flex justify-content-center mt-4">
                {{ $berita->links() }}
            </div>
        </div>
    </section>
@endsection
