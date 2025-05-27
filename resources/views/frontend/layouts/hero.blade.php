<section class="hero">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
        <!-- Indicators -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true"
                aria-label="Slide 1" class="carousel slide carousel-fade" data-bs-ride="carousel"
                data-bs-interval="15000"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"
                class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="15000"></button>

        </div>

        <div class="carousel-inner">
            <!-- Slide 1 -->
            <div class="carousel-item active">
                <div class="slide-overlay"></div>
                <img src="{{ asset('assets/banner_kora.jpg') }}" class="d-block w-100" alt="Slide 1">

            </div>
            <!-- Slide 3 -->
            <div class="carousel-item">
                <div class="slide-overlay"></div>
                <video class="d-block w-100" autoplay muted loop playsinline>
                    <source src="{{ asset('assets/opening.mp4') }}" type="video/mp4">
                    Browser Anda tidak mendukung video.
                </video>

            </div>

        </div>

    </div>
</section>


{{-- 
<section class="hero">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
        <!-- Indicators -->
        <div class="carousel-indicators">
            @foreach ($heroes as $key => $hero)
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $key }}"
                    class="{{ $key == 0 ? 'active' : '' }}" aria-current="{{ $key == 0 ? 'true' : 'false' }}"
                    aria-label="Slide {{ $key + 1 }}" class="carousel slide carousel-fade" data-bs-ride="carousel"
                    data-bs-interval="15000">
                </button>
            @endforeach
        </div>

        <div class="carousel-inner">
            @foreach ($heroes as $key => $hero)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <div class="slide-overlay"></div>
                    <img src="{{ $hero->image }}" class="d-block w-100" alt="Slide {{ $key + 1 }}">
                    <div class="carousel-content">
                        <h1>{!! nl2br(e($hero->title)) !!}</h1>
                        <p>{{ $hero->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section> --}}
