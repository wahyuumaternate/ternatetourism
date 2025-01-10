{{-- <section class="hero">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
        <!-- Indicators -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true"
                aria-label="Slide 1" class="carousel slide carousel-fade" data-bs-ride="carousel"
                data-bs-interval="15000"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"
                class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="15000"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"
                class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="15000"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3" aria-label="Slide 4"
                class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="15000"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="4" aria-label="Slide 5"
                class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="15000"></button>
        </div>

        <div class="carousel-inner">
            <!-- Slide 1 -->
            <div class="carousel-item active">
                <div class="slide-overlay"></div>
                <img src="{{ asset('assets/jiko.jpg') }}" class="d-block w-100" alt="Slide 1">
                <div class="carousel-content">
                    <h1>Discover Paradise<br>in Ternate</h1>
                    <p>Experience the magic of our pristine beaches and rich cultural heritage.</p>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item">
                <div class="slide-overlay"></div>
                <img src="{{ asset('assets/batu_angus.jpg') }}" class="d-block w-100" alt="Slide 2">
                <div class="carousel-content">
                    <h1>Historic Fortresses<br>& Ancient Tales</h1>
                    <p>Journey through time in our historic Portuguese and Dutch fortresses.</p>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="carousel-item">
                <div class="slide-overlay"></div>
                <img src="{{ asset('assets/DJI_20250104094318_0007_D.jpeg') }}" class="d-block w-100" alt="Slide 3">
                <div class="carousel-content">
                    <h1>Volcanic Majesty<br>Mount Gamalama</h1>
                    <p>Witness the stunning beauty of our active volcano and surrounding landscapes.</p>
                </div>
            </div>

            <!-- Slide 4 -->
            <div class="carousel-item">
                <div class="slide-overlay"></div>
                <img src="{{ asset('assets/fora.jpg') }}" class="d-block w-100" alt="Slide 4">
                <div class="carousel-content">
                    <h1>Rich Cultural<br>Heritage</h1>
                    <p>Immerse yourself in the vibrant culture of the Sultanate of Ternate.</p>
                </div>
            </div>

            <!-- Slide 5 -->
            <div class="carousel-item">
                <div class="slide-overlay"></div>
                <img src="{{ asset('assets/kora_kora.jpg') }}" class="d-block w-100" alt="Slide 5">
                <div class="carousel-content">
                    <h1>Culinary<br>Adventures</h1>
                    <p>Taste the unique flavors of traditional Ternate cuisine.</p>
                </div>
            </div>

        </div>

    </div>
</section> --}}



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
</section>
