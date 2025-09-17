<div class="banner-container">
    <div class="background-image"></div>
    <div class="overlay"></div>

    <div class="content">
        <div class="left-content">
            <p id="key" style="display:none;"></p>

            <p class="subtitle" id="quote"></p>
            <p class="author" id="author"></p>
        </div>

        <script>
            // Ambil data translasi sesuai locale aktif
            const quotes = @json(__('quotes'));
            const keys = Object.keys(quotes); // ["q1", "q2", "q3", ...]
            let index = 0;

            const keyEl = document.getElementById("key");
            const quoteEl = document.getElementById("quote");
            const authorEl = document.getElementById("author");

            function showQuote() {
                const key = keys[index];
                const q = quotes[key];

                keyEl.style.opacity = 0;
                quoteEl.style.opacity = 0;
                authorEl.style.opacity = 0;

                setTimeout(() => {
                    keyEl.textContent = key;
                    quoteEl.textContent = `"${q.text}"`;
                    authorEl.textContent = `– ${q.author}`;

                    keyEl.style.opacity = 1;
                    quoteEl.style.opacity = 1;
                    authorEl.style.opacity = 1;

                    index = (index + 1) % keys.length;
                }, 500);
            }

            showQuote();
            setInterval(showQuote, 8000);
        </script>

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
