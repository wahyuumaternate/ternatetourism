<div class="banner-container">
    <div class="background-image"></div>
    <div class="overlay"></div>

    <div class="content">
        <div class="left-content">
            <h1 class="main-title">
                Wonderful<br />
                Ternate
            </h1>
            <p class="subtitle">Jelajahi Keajaiban Alam Ternate!</p>
            {{-- <a href="#" class="cta-button">E X P L O R E</a> --}}
        </div>
    </div>

    {{-- <div class="navigation-arrow" id="nextBtn">›</div> --}}

    <div class="side-images">
        <!-- Main destination card -->
        <div class="main-destination-card">
            <img src="{{ asset('assets/jikomalamo.webp') }}" alt="Jikomalamo" class="main-card-image" />
            <div class="main-card-content">
                <h3 class="main-card-title">Jikomalamo</h3>
                <p class="main-card-location">Pulau Ternate</p>
                <p class="main-card-description">
                    Gunung berapi aktif dengan spot diving terbaik di sekitar Ternate yang memukau
                </p>
            </div>
        </div>

        <!-- Side slider (partially visible) -->
        <div class="side-slider">
            <div class="side-card">
                <img src="{{ asset('assets/tolire.jpg') }}" alt="Danau Tolire" class="side-card-image" />
                <div class="side-card-overlay">
                    <h4 class="side-card-title">Danau Tolire</h4>
                    <p class="side-card-location">Ternate</p>
                </div>
            </div>

            <div class="side-card">
                <img src="{{ asset('assets/sulamadaha.jpg') }}" alt="Pantai Sulamadaha" class="side-card-image" />
                <div class="side-card-overlay">
                    <h4 class="side-card-title">Pantai Sulamadaha</h4>
                    <p class="side-card-location">Ternate</p>
                </div>
            </div>
        </div>
    </div>

    <div class="pagination-dots">
        <div class="dot active"></div>
        <div class="dot"></div>
        <div class="dot"></div>
    </div>
</div>
