@extends('frontend.layouts.main')
@include('frontend.layouts.navbar')

@section('body')
    <!-- Popular Destinations -->
    <section class="py-5 mt-5" id="destinations" data-aos="fade-up">
        <div class="container mt-5">
            <div class="row align-items-center mb-5">
                <div class="col-md-8">
                    <h1 class="fw-bold section-title" data-aos="fade-right">{{ __('pesan.populer_destinasi') }}</h1>
                    <p class="text-muted" data-aos="fade-left">
                        {{ __('pesan.destinasi_desc') }}
                    </p>
                </div>
            </div>
            <div class="row g-4">
                @foreach ($destination as $item)
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

            <!-- Pagination Links -->
            <div class="d-flex justify-content-center mt-4">
                {{ $destination->links() }}
            </div>
        </div>
    </section>
@endsection
