@extends('frontend.layouts.main')

@push('meta')
    <!-- SEO Meta Tags -->
    <title>{{ $ekraf->name }} - Ekonomi Kreatif Wonderful Ternate</title>
    <meta name="description"
        content="{{ $ekraf->name }} - {{ $ekraf->category->name }}. {{ Str::limit(strip_tags($ekraf->description), 120) }}">
    <meta name="keywords"
        content="{{ $ekraf->name }}, {{ $ekraf->category->name }}, ekonomi kreatif ternate, produk lokal ternate, umkm ternate, {{ Str::slug($ekraf->category->name) }} ternate">
    <meta name="author" content="{{ $ekraf->name }}">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="business.business">
    <meta property="og:title" content="{{ $ekraf->name }} - Ekonomi Kreatif Wonderful Ternate">
    <meta property="og:description"
        content="{{ $ekraf->name }} - {{ $ekraf->category->name }}. {{ Str::limit(strip_tags($ekraf->description), 120) }}">
    <meta property="og:image" content="{{ $ekraf->logo }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Wonderful Ternate">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $ekraf->name }} - Ekonomi Kreatif Wonderful Ternate">
    <meta name="twitter:description"
        content="{{ $ekraf->name }} - {{ $ekraf->category->name }}. {{ Str::limit(strip_tags($ekraf->description), 120) }}">
    <meta name="twitter:image" content="{{ $ekraf->logo }}">

    <!-- Additional Meta Tags for Location -->
    <meta name="geo.region" content="ID-MU">
    <meta name="geo.placename" content="Ternate">
    <meta name="geo.position" content="0.7833;127.3667">
    <meta name="ICBM" content="0.7833, 127.3667">

    <!-- Business Specific Meta Tags -->
    <meta property="business:contact_data:street_address" content="Ternate">
    <meta property="business:contact_data:locality" content="Ternate">
    <meta property="business:contact_data:region" content="Maluku Utara">
    <meta property="business:contact_data:postal_code" content="">
    <meta property="business:contact_data:country_name" content="Indonesia">
    @if ($ekraf->phone)
        <meta property="business:contact_data:phone_number" content="{{ $ekraf->phone }}">
    @endif
    @if ($ekraf->email)
        <meta property="business:contact_data:email" content="{{ $ekraf->email }}">
    @endif
    @if ($ekraf->website)
        <meta property="business:contact_data:website" content="{{ $ekraf->website }}">
    @endif
    <meta property="business:hours:day" content="Monday through Sunday">
@endpush

@include('frontend.layouts.navbar')

@section('body')
    <!-- Hero Section -->
    <div class="ekraf-hero">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="hero-content">
                        <div class="logo-container">
                            <img src="{{ $ekraf->logo }}" alt="{{ $ekraf->name }}" class="ekraf-logo">
                        </div>
                        <h1 class="hero-title">{{ $ekraf->name }}</h1>
                        <div class="category-badge">
                            <i class="fas fa-tag"></i>
                            {{ $ekraf->category->name }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="ekraf-content">
        <div class="container">
            <div class="row">
                <!-- Business Info Card -->
                <div class="col-lg-4 mb-4">
                    <div class="info-card">
                        <div class="card-header">
                            <h4><i class="fas fa-info-circle"></i> Informasi Bisnis</h4>
                        </div>
                        <div class="card-body">
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="info-content">
                                    <label>No Telepon</label>
                                    @if ($ekraf->phone)
                                        <a href="tel:{{ $ekraf->phone }}" class="info-value">{{ $ekraf->phone }}</a>
                                    @else
                                        <span class="info-value text-muted">Tidak tersedia</span>
                                    @endif
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="info-content">
                                    <label>Email</label>
                                    @if ($ekraf->email)
                                        <a href="mailto:{{ $ekraf->email }}" class="info-value">{{ $ekraf->email }}</a>
                                    @else
                                        <span class="info-value text-muted">Tidak tersedia</span>
                                    @endif
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-share-alt"></i>
                                </div>
                                <div class="info-content">
                                    <label>Sosial Media</label>
                                    @if ($ekraf->social_media)
                                        <a href="{{ $ekraf->social_media }}" target="_blank" class="info-value">Lihat
                                            Profil</a>
                                    @else
                                        <span class="info-value text-muted">Tidak tersedia</span>
                                    @endif
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-globe"></i>
                                </div>
                                <div class="info-content">
                                    <label>Website</label>
                                    @if ($ekraf->website)
                                        <a href="{{ $ekraf->website }}" target="_blank" class="info-value">Kunjungi
                                            Website</a>
                                    @else
                                        <span class="info-value text-muted">Tidak tersedia</span>
                                    @endif
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-boxes"></i>
                                </div>
                                <div class="info-content">
                                    <label>Jumlah Produk</label>
                                    <span class="info-value">{{ $ekraf->jumlah_produk ?? 0 }} Produk</span>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <!-- Description -->
                <div class="col-lg-8">
                    <div class="description-card">
                        <div class="card-header">
                            <h4><i class="fas fa-file-alt"></i> Tentang {{ $ekraf->name }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="description-content">
                                {!! $ekraf->description !!}
                            </div>
                        </div>
                    </div>

                    <!-- Products Section (if exists) -->
                    @if (isset($ekraf->products) && $ekraf->products->count() > 0)
                        <div class="products-section mt-4">
                            <div class="card-header">
                                <h4><i class="fas fa-shopping-bag"></i> Produk & Layanan</h4>
                            </div>
                            <div class="products-grid">
                                @foreach ($ekraf->products as $product)
                                    <div class="product-item">
                                        @if ($product->image)
                                            <img src="{{ $product->image }}" alt="{{ $product->name }}"
                                                class="product-image">
                                        @endif
                                        <h6>{{ $product->name }}</h6>
                                        @if ($product->price)
                                            <span class="product-price">Rp {{ number_format($product->price) }}</span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>


        </div>
    </div>
@endsection

@push('css')
    <style>
        /* Hero Section - BLACK & WHITE */
        .ekraf-hero {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            min-height: 400px;
            display: flex;
            align-items: center;
            position: relative;
            margin-top: 80px;
            overflow: hidden;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.1);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            color: white;
        }

        .logo-container {
            margin-bottom: 2rem;
        }

        .ekraf-logo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            object-fit: cover;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .category-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            font-size: 1.1rem;
            backdrop-filter: blur(10px);
        }

        /* Content Section */
        .ekraf-content {
            padding: 4rem 0;
            background: #f8f9fa;
        }

        .info-card,
        .description-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            padding: 1.5rem;
            border: none;
        }

        .card-header h4 {
            margin: 0;
            font-weight: 600;
        }

        .card-body {
            padding: 2rem;
        }

        /* Info Items */
        .info-item {
            display: flex;
            align-items: flex-start;
            padding: 1rem 0;
            border-bottom: 1px solid #eee;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-right: 1rem;
            flex-shrink: 0;
        }

        .info-content {
            flex: 1;
        }

        .info-content label {
            display: block;
            font-weight: 600;
            color: #333;
            margin-bottom: 0.25rem;
            font-size: 0.9rem;
        }

        .info-value {
            color: #2c3e50;
            text-decoration: none;
            font-weight: 500;
        }

        .info-value:hover {
            color: #34495e;
            text-decoration: underline;
        }

        /* Action Buttons */
        .action-buttons .btn {
            border-radius: 25px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(44, 62, 80, 0.4);
        }

        .btn-outline-primary {
            border: 2px solid #2c3e50;
            color: #2c3e50;
        }

        .btn-outline-primary:hover {
            background: #2c3e50;
            color: white;
        }

        /* Description */
        .description-content {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #555;
        }

        .description-content h1,
        .description-content h2,
        .description-content h3 {
            color: #333;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .description-content p {
            margin-bottom: 1.5rem;
        }

        /* Products Grid */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1.5rem;
            padding: 2rem;
        }

        .product-item {
            background: white;
            border-radius: 10px;
            padding: 1rem;
            text-align: center;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .product-item:hover {
            transform: translateY(-5px);
        }

        .product-image {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .product-price {
            color: #2c3e50;
            font-weight: 600;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }

            .ekraf-logo {
                width: 100px;
                height: 100px;
            }

            .ekraf-content {
                padding: 2rem 0;
            }

            .card-body {
                padding: 1.5rem;
            }

            .info-item {
                flex-direction: column;
                text-align: center;
            }

            .info-icon {
                margin: 0 auto 1rem auto;
            }

            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
                gap: 1rem;
                padding: 1rem;
            }
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .info-card,
        .description-card {
            animation: fadeInUp 0.6s ease;
        }
    </style>
@endpush

@push('js')
    <script>
        function shareEkraf() {
            if (navigator.share) {
                navigator.share({
                    title: '{{ $ekraf->name }} - Ekonomi Kreatif Wonderful Ternate',
                    text: '{{ $ekraf->name }} - {{ $ekraf->category->name }}. {{ Str::limit(strip_tags($ekraf->description), 100) }}',
                    url: window.location.href
                });
            } else {
                // Fallback: copy to clipboard
                navigator.clipboard.writeText(window.location.href).then(function() {
                    alert('Link berhasil disalin ke clipboard!');
                });
            }
        }

        // Smooth scroll animation
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.info-card, .description-card');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            });

            cards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'all 0.6s ease';
                observer.observe(card);
            });
        });
    </script>
@endpush
