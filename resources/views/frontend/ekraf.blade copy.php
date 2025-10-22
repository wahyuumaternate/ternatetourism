@extends('frontend.layouts.main')
@push('meta')
    <!-- SEO Meta Tags -->
    <title>Ekonomi Kreatif - Wonderful Ternate</title>
    <meta name="description"
        content="Jelajahi potensi ekonomi kreatif Kota Ternate melalui produk-produk unggulan UMKM, kerajinan tangan, kuliner khas, dan industri kreatif lainnya yang mencerminkan kearifan lokal.">
    <meta name="keywords"
        content="ekonomi kreatif ternate, umkm ternate, produk lokal ternate, kerajinan tangan ternate, kuliner khas ternate, industri kreatif ternate">
    <meta name="author" content="Wonderful Ternate">
    <meta name="robots" content="index, follow">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Ekonomi Kreatif - Wonderful Ternate">
    <meta property="og:description"
        content="Jelajahi potensi ekonomi kreatif Kota Ternate melalui produk-produk unggulan UMKM, kerajinan tangan, kuliner khas, dan industri kreatif lainnya yang mencerminkan kearifan lokal.">
    <meta property="og:image" content="{{ asset('assets/kora_kora.jpg') }}">
    <meta property="og:url" content="{{ route('ekraf.index') }}">
    <meta property="og:site_name" content="Wonderful Ternate">
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Ekonomi Kreatif - Wonderful Ternate">
    <meta name="twitter:description"
        content="Jelajahi potensi ekonomi kreatif Kota Ternate melalui produk-produk unggulan UMKM, kerajinan tangan, kuliner khas, dan industri kreatif lainnya yang mencerminkan kearifan lokal.">
    <meta name="twitter:image" content="{{ asset('assets/kora_kora.jpg') }}">
    <!-- Additional Meta Tags for Location -->
    <meta name="geo.region" content="ID-MU">
    <meta name="geo.placename" content="Ternate">
    <meta name="geo.position" content="0.7833;127.3667">
    <meta name="ICBM" content="0.7833, 127.3667">
@endpush

@section('body')
    <!-- Floating Background Elements -->
    <div class="floating-elements">
        <div class="floating-shape shape-1"></div>
        <div class="floating-shape shape-2"></div>
        <div class="floating-shape shape-3"></div>
        <div class="floating-shape shape-4"></div>
    </div>

    <div class="container-fluid ekraf-container">
        <!-- Modern Hero Section -->
        <section class="hero-modern">
            <div class="container">
                <div class="row align-items-center min-vh-75">
                    <div class="col-lg-6 order-2 order-lg-1">
                        <div class="hero-content">
                            <div class="hero-badge">
                                <span class="badge-text">Wonderful Ternate</span>
                                <div class="badge-glow"></div>
                            </div>
                            <h1 class="hero-title">
                                <span class="title-line">Ekonomi</span>
                                <span class="title-line gradient-text">Kreatif</span>
                                <span class="title-line">Ternate</span>
                            </h1>
                            <p class="hero-description">
                                Temukan keindahan produk lokal dan inovasi terdepan dari para pelaku ekonomi kreatif
                                yang membawa cita rasa autentik Ternate ke panggung global.
                            </p>
                            <div class="hero-stats-modern">
                                <div class="stat-item-modern">
                                    <div class="stat-number">{{ $totalEkraf }}</div>
                                    <div class="stat-label">Total Ekraf</div>
                                    <div class="stat-bar"></div>
                                </div>
                                <div class="stat-item-modern">
                                    <div class="stat-number">{{ $allCategories->count() }}</div>
                                    <div class="stat-label">Kategori</div>
                                    <div class="stat-bar"></div>
                                </div>
                                <div class="stat-item-modern">
                                    <div class="stat-number">100+</div>
                                    <div class="stat-label">UMKM</div>
                                    <div class="stat-bar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2">
                        <div class="hero-visual">
                            <div class="hero-card card-1">
                                <div class="card-glow"></div>
                                <i class="bi bi-palette"></i>
                            </div>
                            <div class="hero-card card-2">
                                <div class="card-glow"></div>
                                <i class="bi bi-lightbulb"></i>
                            </div>
                            <div class="hero-card card-3">
                                <div class="card-glow"></div>
                                <i class="bi bi-rocket"></i>
                            </div>
                            <div class="hero-particles"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modern Categories Section -->
        <section class="categories-modern">
            <div class="container">
                <div class="section-header">
                    <div class="section-badge">
                        <span>Jelajahi</span>
                    </div>
                    <h2 class="section-title">Kategori Unggulan</h2>
                    <p class="section-subtitle">Temukan beragam kategori ekonomi kreatif yang berkembang di Ternate</p>
                </div>

                <div class="categories-grid" id="category-container">
                    <!-- Kategori "Semua" -->
                    <a href="{{ route('ekraf.index') }}" class="category-modern">
                        <div class="category-inner">
                            <div class="category-background"></div>
                            <div class="category-icon">
                                <i class="bi bi-grid-fill"></i>
                                <div class="icon-glow"></div>
                            </div>
                            <div class="category-content">
                                <h4 class="category-title">Semua</h4>
                                <p class="category-desc">Lihat semua ekraf</p>
                                <div class="category-count">{{ $totalEkraf }}</div>
                            </div>
                            <div class="category-arrow">
                                <i class="bi bi-arrow-right"></i>
                            </div>
                        </div>
                    </a>

                    <!-- 5 kategori pertama -->
                    @foreach ($allCategories->take(5) as $category)
                        <a href="{{ route('ekraf.filterByCategory', $category->slug) }}" class="category-modern">
                            <div class="category-inner">
                                <div class="category-background"></div>
                                <div class="category-icon">
                                    <i class="bi {{ $category->icon ?? 'bi-collection' }}"></i>
                                    <div class="icon-glow"></div>
                                </div>
                                <div class="category-content">
                                    <h4 class="category-title">{{ $category->name }}</h4>
                                    <p class="category-desc">Explore category</p>
                                    <div class="category-count">{{ $category->ekraf_count }}</div>
                                </div>
                                <div class="category-arrow">
                                    <i class="bi bi-arrow-right"></i>
                                </div>
                            </div>
                        </a>
                    @endforeach

                    <!-- Kategori tersembunyi -->
                    @foreach ($allCategories->skip(5) as $category)
                        <a href="{{ route('ekraf.filterByCategory', $category->slug) }}" class="category-modern hidden">
                            <div class="category-inner">
                                <div class="category-background"></div>
                                <div class="category-icon">
                                    <i class="bi {{ $category->icon ?? 'bi-collection' }}"></i>
                                    <div class="icon-glow"></div>
                                </div>
                                <div class="category-content">
                                    <h4 class="category-title">{{ $category->name }}</h4>
                                    <p class="category-desc">Explore category</p>
                                    <div class="category-count">{{ $category->ekraf_count }}</div>
                                </div>
                                <div class="category-arrow">
                                    <i class="bi bi-arrow-right"></i>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                @if ($allCategories->count() > 5)
                    <div class="categories-actions">
                        <button id="load-more" class="btn-modern btn-primary">
                            <span class="btn-text">Lihat Semua Kategori</span>
                            <div class="btn-glow"></div>
                            <i class="bi bi-plus-circle"></i>
                        </button>
                        <button id="collapse" class="btn-modern btn-secondary" style="display:none;">
                            <span class="btn-text">Tutup</span>
                            <div class="btn-glow"></div>
                            <i class="bi bi-dash-circle"></i>
                        </button>
                    </div>
                @endif
            </div>
        </section>

        <!-- Modern Search Section -->
        <section class="search-modern">
            <div class="container">
                <div class="search-wrapper">
                    <div class="search-container">
                        <div class="search-icon">
                            <i class="bi bi-search"></i>
                        </div>
                        <input type="text" class="search-input"
                            placeholder="Cari ekraf berdasarkan nama, kategori, atau lokasi..." id="searchEkraf">
                        <div class="search-suggestions" id="searchSuggestions"></div>
                        <div class="search-loading" id="searchLoading">
                            <div class="loading-dots">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                        <button class="search-clear" id="searchClear" style="display: none;">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                    <div class="search-shortcuts">
                        <span class="shortcut-hint">Tekan <kbd>/</kbd> untuk mencari</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modern Content Section -->
        <section class="content-modern">
            <div class="container">
                <div class="content-header">
                    <div class="content-title-wrapper">
                        <h2 class="content-title">Direktori Ekraf</h2>
                        <div class="content-filter">
                            <div class="filter-dropdown">
                                <button class="filter-btn">
                                    <i class="bi bi-funnel"></i>
                                    <span>Filter</span>
                                    <i class="bi bi-chevron-down"></i>
                                </button>
                                <div class="filter-menu">
                                    <a href="#" class="filter-item active">Semua</a>
                                    <a href="#" class="filter-item">Terpopuler</a>
                                    <a href="#" class="filter-item">Terbaru</a>
                                    <a href="#" class="filter-item">A-Z</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-stats">
                        <div class="stats-chip">
                            <i class="bi bi-collection"></i>
                            <span>{{ $ekrafs->total() }} Hasil</span>
                        </div>
                    </div>
                </div>

                <div class="ekraf-grid-modern" id="ekrafList">
                    @forelse ($ekrafs as $ekraf)
                        <div class="ekraf-card-modern">
                            <a href="/ekraf/{{ $ekraf->slug }}" class="card-link">
                                <div class="card-background"></div>
                                <div class="card-image">
                                    <img src="{{ $ekraf->logo }}" alt="{{ $ekraf->name }}" loading="lazy">
                                    <div class="image-overlay">
                                        <div class="overlay-content">
                                            <i class="bi bi-arrow-up-right"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-category">
                                        <i class="bi bi-tag"></i>
                                        <span>{{ $ekraf->category->name }}</span>
                                    </div>
                                    <h3 class="card-title">{{ $ekraf->name }}</h3>
                                    <p class="card-description">Produk berkualitas dengan cita rasa autentik Ternate</p>
                                    <div class="card-meta">
                                        <div class="meta-item">
                                            <i class="bi bi-geo-alt"></i>
                                            <span>Ternate</span>
                                        </div>
                                        <div class="meta-item">
                                            <i class="bi bi-star-fill"></i>
                                            <span>4.8</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-glow"></div>
                            </a>
                        </div>
                    @empty
                        <div class="empty-state-modern">
                            <div class="empty-visual">
                                <div class="empty-icon">
                                    <i class="bi bi-search"></i>
                                </div>
                                <div class="empty-particles"></div>
                            </div>
                            <h3>Tidak ada hasil ditemukan</h3>
                            <p>Coba ubah kata kunci pencarian atau filter yang Anda gunakan</p>
                            <button class="btn-modern btn-primary" onclick="location.reload()">
                                <span class="btn-text">Reset Pencarian</span>
                                <div class="btn-glow"></div>
                                <i class="bi bi-arrow-clockwise"></i>
                            </button>
                        </div>
                    @endforelse
                </div>

                <!-- Modern Pagination -->
                <div class="pagination-modern">
                    {{ $ekrafs->links() }}
                </div>
            </div>
        </section>
    </div>
@endsection
@push('css')
    <style>
        /* Modern Design System Variables */
        :root {
            --primary: #ff6500;
            --primary-rgb: 255, 101, 0;
            --primary-dark: #e55a00;
            --primary-light: #ff8533;
            --primary-ultra-light: #fff4e6;

            --secondary: #6c757d;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;

            --dark: #0f172a;
            --light: #f8fafc;
            --white: #ffffff;

            --glass: rgba(255, 255, 255, 0.1);
            --glass-dark: rgba(15, 23, 42, 0.1);

            --gradient-primary: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            --gradient-glass: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            --gradient-dark: linear-gradient(135deg, #ffffff 0%, #334155 100%);

            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --shadow-glow: 0 0 20px rgba(var(--primary-rgb), 0.3);

            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 24px;
            --radius-full: 9999px;

            --spacing-xs: 0.5rem;
            --spacing-sm: 1rem;
            --spacing-md: 1.5rem;
            --spacing-lg: 2rem;
            --spacing-xl: 3rem;
            --spacing-2xl: 4rem;

            --font-size-xs: 0.75rem;
            --font-size-sm: 0.875rem;
            --font-size-base: 1rem;
            --font-size-lg: 1.125rem;
            --font-size-xl: 1.25rem;
            --font-size-2xl: 1.5rem;
            --font-size-3xl: 1.875rem;
            --font-size-4xl: 2.25rem;
            --font-size-5xl: 3rem;

            --transition-fast: 150ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-normal: 300ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-slow: 500ms cubic-bezier(0.4, 0, 0.2, 1);

            --backdrop-blur: blur(20px);
            --backdrop-blur-sm: blur(10px);
        }

        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            color: var(--dark);
            line-height: 1.6;
            overflow-x: hidden;
        }

        .ekraf-container {
            padding: 0;
            margin-top: 80px;
        }

        /* Floating Background Elements */
        .floating-elements {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .floating-shape {
            position: absolute;
            background: var(--gradient-primary);
            border-radius: 50%;
            opacity: 0.03;
            animation: float 20s infinite;
        }

        .shape-1 {
            width: 200px;
            height: 200px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 150px;
            height: 150px;
            top: 60%;
            right: 15%;
            animation-delay: 5s;
        }

        .shape-3 {
            width: 100px;
            height: 100px;
            bottom: 20%;
            left: 20%;
            animation-delay: 10s;
        }

        .shape-4 {
            width: 120px;
            height: 120px;
            top: 30%;
            right: 30%;
            animation-delay: 15s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            33% {
                transform: translateY(-30px) rotate(120deg);
            }

            66% {
                transform: translateY(30px) rotate(240deg);
            }
        }

        /* Modern Hero Section */
        .hero-modern {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg,
                    rgba(248, 250, 252, 0.8) 0%,
                    rgba(241, 245, 249, 0.9) 50%,
                    rgba(255, 245, 230, 0.8) 100%);
            backdrop-filter: var(--backdrop-blur-sm);
        }

        .min-vh-75 {
            min-height: 75vh;
        }

        .hero-content {
            z-index: 2;
        }

        .hero-badge {
            display: inline-block;
            position: relative;
            padding: var(--spacing-xs) var(--spacing-md);
            background: var(--gradient-glass);
            border: 1px solid rgba(var(--primary-rgb), 0.2);
            border-radius: var(--radius-full);
            backdrop-filter: var(--backdrop-blur);
            margin-bottom: var(--spacing-lg);
            overflow: hidden;
        }

        .badge-text {
            font-size: var(--font-size-sm);
            font-weight: 600;
            color: var(--primary);
            position: relative;
            z-index: 2;
        }

        .badge-glow {
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(var(--primary-rgb), 0.4), transparent);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% {
                left: -100%;
            }

            100% {
                left: 100%;
            }
        }

        .hero-title {
            font-size: clamp(2.5rem, 8vw, 5rem);
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: var(--spacing-lg);
        }

        .title-line {
            display: block;
            position: relative;
        }

        .gradient-text {
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            position: relative;
        }

        .hero-description {
            font-size: var(--font-size-lg);
            color: var(--secondary);
            max-width: 600px;
            margin-bottom: var(--spacing-2xl);
            line-height: 1.7;
        }

        .hero-stats-modern {
            display: flex;
            gap: var(--spacing-xl);
            flex-wrap: wrap;
        }

        .stat-item-modern {
            position: relative;
        }

        .stat-number {
            font-size: var(--font-size-3xl);
            font-weight: 700;
            color: var(--dark);
            display: block;
        }

        .stat-label {
            font-size: var(--font-size-sm);
            color: var(--secondary);
            margin-top: var(--spacing-xs);
        }

        .stat-bar {
            width: 40px;
            height: 3px;
            background: var(--gradient-primary);
            border-radius: var(--radius-full);
            margin-top: var(--spacing-xs);
            position: relative;
            overflow: hidden;
        }

        .stat-bar::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.8), transparent);
            animation: progress 2s infinite;
        }

        @keyframes progress {
            0% {
                left: -100%;
            }

            100% {
                left: 100%;
            }
        }

        /* Hero Visual */
        .hero-visual {
            position: relative;
            height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-card {
            position: absolute;
            width: 120px;
            height: 120px;
            background: var(--white);
            border-radius: var(--radius-xl);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: var(--primary);
            box-shadow: var(--shadow-xl);
            border: 1px solid rgba(var(--primary-rgb), 0.1);
            overflow: hidden;
        }

        .card-1 {
            top: 20%;
            left: 20%;
            animation: cardFloat1 6s ease-in-out infinite;
        }

        .card-2 {
            top: 10%;
            right: 10%;
            animation: cardFloat2 8s ease-in-out infinite;
        }

        .card-3 {
            bottom: 20%;
            left: 40%;
            animation: cardFloat3 7s ease-in-out infinite;
        }

        @keyframes cardFloat1 {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(5deg);
            }
        }

        @keyframes cardFloat2 {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-30px) rotate(-5deg);
            }
        }

        @keyframes cardFloat3 {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-25px) rotate(3deg);
            }
        }

        .card-glow {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--gradient-primary);
            opacity: 0;
            border-radius: inherit;
            transition: var(--transition-normal);
        }

        .hero-card:hover .card-glow {
            opacity: 0.1;
        }

        /* Section Headers */
        .section-header {
            text-align: center;
            margin-bottom: var(--spacing-2xl);
        }

        .section-badge {
            display: inline-block;
            padding: var(--spacing-xs) var(--spacing-md);
            background: var(--primary-ultra-light);
            color: var(--primary);
            border-radius: var(--radius-full);
            font-size: var(--font-size-sm);
            font-weight: 600;
            margin-bottom: var(--spacing-md);
        }

        .section-title {
            font-size: var(--font-size-3xl);
            font-weight: 700;
            color: var(--dark);
            margin-bottom: var(--spacing-md);
        }

        .section-subtitle {
            font-size: var(--font-size-lg);
            color: var(--secondary);
            max-width: 600px;
            margin: 0 auto;
        }

        /* Modern Categories */
        .categories-modern {
            padding: var(--spacing-2xl) 0;
            background: var(--white);
            position: relative;
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: var(--spacing-lg);
            margin-bottom: var(--spacing-xl);
        }

        .category-modern {
            text-decoration: none;
            color: inherit;
            display: block;
            position: relative;
            height: 100%;
        }

        .category-inner {
            position: relative;
            padding: var(--spacing-xl);
            background: var(--white);
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: var(--radius-xl);
            transition: var(--transition-normal);
            overflow: hidden;
            height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .category-background {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--gradient-primary);
            opacity: 0;
            transition: var(--transition-normal);
        }

        .category-modern:hover .category-inner {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
            border-color: var(--primary);
        }

        .category-modern:hover .category-background {
            opacity: 0.03;
        }

        .category-icon {
            position: relative;
            width: 60px;
            height: 60px;
            background: var(--primary-ultra-light);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--primary);
            margin-bottom: var(--spacing-md);
            transition: var(--transition-normal);
        }

        .category-modern:hover .category-icon {
            background: var(--primary);
            color: var(--white);
            transform: scale(1.1);
        }

        .icon-glow {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--primary);
            border-radius: inherit;
            opacity: 0;
            filter: blur(20px);
            transition: var(--transition-normal);
        }

        .category-modern:hover .icon-glow {
            opacity: 0.3;
        }

        .category-content {
            flex: 1;
            position: relative;
            z-index: 2;
        }

        .category-title {
            font-size: var(--font-size-xl);
            font-weight: 600;
            color: var(--dark);
            margin-bottom: var(--spacing-xs);
            transition: var(--transition-normal);
        }

        .category-modern:hover .category-title {
            color: var(--primary);
        }

        .category-desc {
            font-size: var(--font-size-sm);
            color: var(--secondary);
            margin-bottom: var(--spacing-md);
        }

        .category-count {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background: var(--primary-ultra-light);
            color: var(--primary);
            border-radius: var(--radius-full);
            font-size: var(--font-size-sm);
            font-weight: 600;
            transition: var(--transition-normal);
        }

        .category-modern:hover .category-count {
            background: var(--primary);
            color: var(--white);
        }

        .category-arrow {
            position: absolute;
            top: var(--spacing-lg);
            right: var(--spacing-lg);
            width: 40px;
            height: 40px;
            background: rgba(0, 0, 0, 0.05);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--secondary);
            transition: var(--transition-normal);
            z-index: 2;
        }

        .category-modern:hover .category-arrow {
            background: var(--primary);
            color: var(--white);
            transform: translateX(5px);
        }

        .category-modern.hidden {
            display: none;
        }

        .categories-actions {
            text-align: center;
            margin-top: var(--spacing-xl);
        }

        /* Modern Buttons */
        .btn-modern {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: var(--spacing-xs);
            padding: var(--spacing-md) var(--spacing-xl);
            background: var(--white);
            border: 2px solid var(--primary);
            border-radius: var(--radius-full);
            font-size: var(--font-size-base);
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition-normal);
            overflow: hidden;
            cursor: pointer;
            z-index: 1;
        }

        .btn-modern.btn-primary {
            color: var(--primary);
        }

        .btn-modern.btn-secondary {
            color: var(--secondary);
            border-color: var(--secondary);
        }

        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-glow);
            color: var(--white);
        }

        .btn-modern.btn-primary:hover {
            background: var(--primary);
            border-color: var(--primary);
        }

        .btn-modern.btn-secondary:hover {
            background: var(--secondary);
            border-color: var(--secondary);
        }

        .btn-glow {
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: var(--transition-slow);
        }

        .btn-modern:hover .btn-glow {
            left: 100%;
        }

        .btn-text {
            position: relative;
            z-index: 2;
        }

        /* Modern Search */
        .search-modern {
            padding: var(--spacing-2xl) 0;
            background: linear-gradient(135deg, var(--primary-ultra-light) 0%, var(--white) 100%);
        }

        .search-wrapper {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }

        .search-container {
            position: relative;
            margin-bottom: var(--spacing-md);
        }

        .search-input {
            width: 100%;
            height: 70px;
            padding: 0 70px 0 60px;
            background: var(--white);
            border: 2px solid rgba(0, 0, 0, 0.1);
            border-radius: var(--radius-full);
            font-size: var(--font-size-lg);
            transition: var(--transition-normal);
            box-shadow: var(--shadow-lg);
            backdrop-filter: var(--backdrop-blur);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: var(--shadow-glow);
            transform: translateY(-2px);
        }

        .search-input::placeholder {
            color: var(--secondary);
        }

        .search-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--secondary);
            font-size: 1.25rem;
            z-index: 2;
            transition: var(--transition-normal);
        }

        .search-input:focus+.search-icon {
            color: var(--primary);
        }

        .search-loading {
            position: absolute;
            right: 70px;
            top: 50%;
            transform: translateY(-50%);
            display: none;
            z-index: 2;
        }

        .loading-dots {
            display: flex;
            gap: 4px;
        }

        .loading-dots span {
            width: 6px;
            height: 6px;
            background: var(--primary);
            border-radius: 50%;
            animation: loadingDots 1.4s infinite both;
        }

        .loading-dots span:nth-child(2) {
            animation-delay: 0.2s;
        }

        .loading-dots span:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes loadingDots {

            0%,
            80%,
            100% {
                transform: scale(0.8);
                opacity: 0.5;
            }

            40% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .search-clear {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            width: 30px;
            height: 30px;
            background: var(--secondary);
            border: none;
            border-radius: 50%;
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition-normal);
            z-index: 2;
        }

        .search-clear:hover {
            background: var(--danger);
            transform: translateY(-50%) scale(1.1);
        }

        .search-shortcuts {
            margin-top: var(--spacing-md);
        }

        .shortcut-hint {
            font-size: var(--font-size-sm);
            color: var(--secondary);
        }

        kbd {
            padding: 0.2rem 0.4rem;
            background: var(--dark);
            color: var(--white);
            border-radius: var(--radius-sm);
            font-size: var(--font-size-xs);
            font-family: monospace;
        }

        /* Modern Content */
        .content-modern {
            padding: var(--spacing-2xl) 0;
            background: var(--white);
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--spacing-2xl);
            flex-wrap: wrap;
            gap: var(--spacing-md);
        }

        .content-title-wrapper {
            display: flex;
            align-items: center;
            gap: var(--spacing-lg);
            flex-wrap: wrap;
        }

        .content-title {
            font-size: var(--font-size-2xl);
            font-weight: 700;
            color: var(--dark);
            margin: 0;
        }

        .content-filter {
            position: relative;
        }

        .filter-dropdown {
            position: relative;
        }

        .filter-btn {
            display: flex;
            align-items: center;
            gap: var(--spacing-xs);
            padding: var(--spacing-sm) var(--spacing-md);
            background: var(--white);
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: var(--radius-lg);
            cursor: pointer;
            transition: var(--transition-normal);
            font-size: var(--font-size-sm);
            color: var(--dark);
        }

        .filter-btn:hover {
            background: var(--primary-ultra-light);
            border-color: var(--primary);
        }

        .filter-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: var(--white);
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-xl);
            padding: var(--spacing-sm);
            min-width: 150px;
            z-index: 10;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: var(--transition-normal);
        }

        .filter-dropdown:hover .filter-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .filter-item {
            display: block;
            padding: var(--spacing-sm) var(--spacing-md);
            color: var(--dark);
            text-decoration: none;
            border-radius: var(--radius-sm);
            transition: var(--transition-fast);
            font-size: var(--font-size-sm);
        }

        .filter-item:hover,
        .filter-item.active {
            background: var(--primary);
            color: var(--white);
        }

        .content-stats {
            display: flex;
            gap: var(--spacing-md);
        }

        .stats-chip {
            display: flex;
            align-items: center;
            gap: var(--spacing-xs);
            padding: var(--spacing-sm) var(--spacing-md);
            background: var(--primary-ultra-light);
            color: var(--primary);
            border-radius: var(--radius-full);
            font-size: var(--font-size-sm);
            font-weight: 600;
        }

        /* Modern Ekraf Grid */
        .ekraf-grid-modern {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: var(--spacing-xl);
            margin-bottom: var(--spacing-2xl);
        }

        .ekraf-card-modern {
            position: relative;
            background: var(--white);
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: var(--radius-xl);
            overflow: hidden;
            transition: var(--transition-normal);
            height: 400px;
            display: flex;
            flex-direction: column;
        }

        .ekraf-card-modern:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-xl);
            border-color: var(--primary);
        }

        .card-link {
            text-decoration: none;
            color: inherit;
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .card-background {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--gradient-primary);
            opacity: 0;
            transition: var(--transition-normal);
        }

        .ekraf-card-modern:hover .card-background {
            opacity: 0.02;
        }

        .card-image {
            position: relative;
            height: 200px;
            overflow: hidden;
            border-radius: var(--radius-lg) var(--radius-lg) 0 0;
        }

        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition-slow);
        }

        .ekraf-card-modern:hover .card-image img {
            transform: scale(1.1);
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(var(--primary-rgb), 0.8), rgba(var(--primary-rgb), 0.6));
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: var(--transition-normal);
        }

        .ekraf-card-modern:hover .image-overlay {
            opacity: 1;
        }

        .overlay-content {
            width: 60px;
            height: 60px;
            background: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.5rem;
            transform: scale(0.8);
            transition: var(--transition-normal);
        }

        .ekraf-card-modern:hover .overlay-content {
            transform: scale(1);
        }

        .card-content {
            padding: var(--spacing-xl);
            flex: 1;
            display: flex;
            flex-direction: column;
            position: relative;
            z-index: 2;
        }

        .card-category {
            display: flex;
            align-items: center;
            gap: var(--spacing-xs);
            font-size: var(--font-size-xs);
            color: var(--primary);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: var(--spacing-sm);
        }

        .card-title {
            font-size: var(--font-size-xl);
            font-weight: 700;
            color: var(--dark);
            margin-bottom: var(--spacing-sm);
            line-height: 1.3;
        }

        .card-description {
            font-size: var(--font-size-sm);
            color: var(--secondary);
            line-height: 1.6;
            margin-bottom: var(--spacing-md);
            flex: 1;
        }

        .card-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            font-size: var(--font-size-xs);
            color: var(--secondary);
        }

        .meta-item:last-child {
            color: var(--warning);
            font-weight: 600;
        }

        .card-glow {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--gradient-primary);
            opacity: 0;
            border-radius: inherit;
            filter: blur(20px);
            transition: var(--transition-normal);
            z-index: -1;
        }

        .ekraf-card-modern:hover .card-glow {
            opacity: 0.1;
        }

        /* Modern Empty State */
        .empty-state-modern {
            grid-column: 1 / -1;
            text-align: center;
            padding: var(--spacing-2xl);
            background: var(--white);
            border: 2px dashed rgba(0, 0, 0, 0.1);
            border-radius: var(--radius-xl);
            position: relative;
            overflow: hidden;
        }

        .empty-visual {
            position: relative;
            margin-bottom: var(--spacing-xl);
        }

        .empty-icon {
            font-size: 4rem;
            color: var(--secondary);
            margin-bottom: var(--spacing-md);
            position: relative;
            z-index: 2;
        }

        .empty-particles {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100px;
            height: 100px;
            border: 2px solid var(--primary-ultra-light);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: translate(-50%, -50%) scale(0.8);
                opacity: 1;
            }

            100% {
                transform: translate(-50%, -50%) scale(1.2);
                opacity: 0;
            }
        }

        .empty-state-modern h3 {
            font-size: var(--font-size-xl);
            font-weight: 600;
            color: var(--dark);
            margin-bottom: var(--spacing-sm);
        }

        .empty-state-modern p {
            font-size: var(--font-size-base);
            color: var(--secondary);
            margin-bottom: var(--spacing-xl);
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Modern Pagination */
        .pagination-modern {
            display: flex;
            justify-content: center;
            margin-top: var(--spacing-2xl);
        }

        .pagination-modern .pagination {
            gap: var(--spacing-xs);
        }

        .pagination-modern .page-link {
            border: none;
            padding: var(--spacing-sm) var(--spacing-md);
            border-radius: var(--radius-lg);
            color: var(--secondary);
            background: transparent;
            transition: var(--transition-normal);
            font-weight: 500;
        }

        .pagination-modern .page-link:hover,
        .pagination-modern .page-item.active .page-link {
            background: var(--primary);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .categories-grid {
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            }

            .ekraf-grid-modern {
                grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-stats-modern {
                justify-content: center;
                gap: var(--spacing-lg);
            }

            .categories-grid {
                grid-template-columns: 1fr;
            }

            .ekraf-grid-modern {
                grid-template-columns: 1fr;
            }

            .content-header {
                flex-direction: column;
                text-align: center;
            }

            .search-input {
                height: 60px;
                font-size: var(--font-size-base);
                padding: 0 60px 0 50px;
            }

            .hero-visual {
                height: 300px;
            }

            .hero-card {
                width: 80px;
                height: 80px;
                font-size: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .ekraf-container {
                margin-top: 60px;
            }

            .hero-modern {
                min-height: 80vh;
            }

            .category-inner {
                padding: var(--spacing-lg);
                height: 160px;
            }

            .ekraf-card-modern {
                height: 350px;
            }

            .card-content {
                padding: var(--spacing-lg);
            }
        }

        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            :root {
                --dark: #0f172a;
                --light: #0f172a;
                --white: #ffffff;
                --secondary: #94a3b8;
            }

            body {
                background: linear-gradient(135deg, #0f172a 0%, #ffffff 100%);
            }

            .floating-shape {
                opacity: 0.05;
            }
        }

        /* High performance animations */
        .category-modern,
        .ekraf-card-modern,
        .btn-modern {
            will-change: transform;
            transform: translateZ(0);
            backface-visibility: hidden;
        }

        /* Accessibility improvements */
        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }

            .floating-shape {
                animation: none;
            }

            .hero-card {
                animation: none;
            }
        }

        /* Focus states for better accessibility */
        .category-modern:focus,
        .ekraf-card-modern:focus,
        .btn-modern:focus,
        .search-input:focus {
            outline: 2px solid var(--primary);
            outline-offset: 2px;
        }

        /* Print styles */
        @media print {

            .floating-elements,
            .search-modern,
            .categories-actions {
                display: none;
            }

            .hero-modern {
                background: var(--white) !important;
                color: var(--dark) !important;
            }

            .category-modern,
            .ekraf-card-modern {
                break-inside: avoid;
                box-shadow: none !important;
                border: 1px solid #ddd !important;
            }
        }
    </style>
@endpush
@push('scripts')
    <script>
        // Modern JavaScript with enhanced features
        class EkrafApp {
            constructor() {
                this.init();
            }

            init() {
                this.initializeComponents();
                this.setupEventListeners();
                this.setupIntersectionObserver();
                this.setupPerformanceOptimizations();
            }

            initializeComponents() {
                this.categoryToggle = new CategoryToggle();
                this.searchEngine = new SearchEngine();
                this.animationController = new AnimationController();
                this.keyboardHandler = new KeyboardHandler();
            }

            setupEventListeners() {
                // Enhanced category functionality
                this.categoryToggle.init();

                // Modern search with debouncing
                this.searchEngine.init();

                // Smooth animations
                this.animationController.init();

                // Keyboard shortcuts
                this.keyboardHandler.init();

                // Filter dropdown
                this.setupFilterDropdown();

                // Performance monitoring
                this.setupPerformanceMonitoring();
            }

            setupFilterDropdown() {
                const filterItems = document.querySelectorAll('.filter-item');
                filterItems.forEach(item => {
                    item.addEventListener('click', (e) => {
                        e.preventDefault();

                        // Remove active class from all items
                        filterItems.forEach(i => i.classList.remove('active'));

                        // Add active class to clicked item
                        item.classList.add('active');

                        // Here you would implement actual filtering logic
                        this.filterEkraf(item.textContent.trim());
                    });
                });
            }

            filterEkraf(filterType) {
                // Implement filtering logic based on filterType
                console.log(`Filtering by: ${filterType}`);

                // Add loading state
                const ekrafList = document.getElementById('ekrafList');
                ekrafList.style.opacity = '0.5';

                // Simulate filtering (replace with actual API call)
                setTimeout(() => {
                    ekrafList.style.opacity = '1';
                    this.animationController.animateCards();
                }, 500);
            }

            setupIntersectionObserver() {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('animate-in');
                        }
                    });
                }, {
                    threshold: 0.1,
                    rootMargin: '0px 0px -50px 0px'
                });

                // Observe all cards and sections
                document.querySelectorAll('.category-modern, .ekraf-card-modern, .section-header').forEach(el => {
                    observer.observe(el);
                });
            }

            setupPerformanceOptimizations() {
                // Lazy load images
                if ('IntersectionObserver' in window) {
                    const imageObserver = new IntersectionObserver((entries, observer) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                const img = entry.target;
                                if (img.dataset.src) {
                                    img.src = img.dataset.src;
                                    img.removeAttribute('data-src');
                                    observer.unobserve(img);
                                }
                            }
                        });
                    });

                    document.querySelectorAll('img[data-src]').forEach(img => {
                        imageObserver.observe(img);
                    });
                }

                // Preload critical resources
                this.preloadCriticalResources();
            }

            preloadCriticalResources() {
                // Preload fonts
                const fontLink = document.createElement('link');
                fontLink.rel = 'preload';
                fontLink.href = 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap';
                fontLink.as = 'style';
                document.head.appendChild(fontLink);
            }

            setupPerformanceMonitoring() {
                // Monitor performance metrics
                if ('performance' in window) {
                    window.addEventListener('load', () => {
                        const perfData = performance.getEntriesByType('navigation')[0];
                        console.log('Page Load Performance:', {
                            loadTime: perfData.loadEventEnd - perfData.loadEventStart,
                            domContentLoaded: perfData.domContentLoadedEventEnd - perfData
                                .domContentLoadedEventStart,
                            totalTime: perfData.loadEventEnd - perfData.fetchStart
                        });
                    });
                }
            }
        }

        // Category Toggle Component
        class CategoryToggle {
            constructor() {
                this.loadMoreBtn = document.getElementById('load-more');
                this.collapseBtn = document.getElementById('collapse');
                this.container = document.getElementById('category-container');
            }

            init() {
                if (this.loadMoreBtn) {
                    this.loadMoreBtn.addEventListener('click', () => this.showMore());
                }

                if (this.collapseBtn) {
                    this.collapseBtn.addEventListener('click', () => this.showLess());
                }
            }

            showMore() {
                const hiddenCategories = this.container.querySelectorAll('.category-modern.hidden');

                hiddenCategories.forEach((item, index) => {
                    setTimeout(() => {
                        item.classList.remove('hidden');
                        item.style.opacity = '0';
                        item.style.transform = 'translateY(30px) scale(0.9)';

                        requestAnimationFrame(() => {
                            item.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
                            item.style.opacity = '1';
                            item.style.transform = 'translateY(0) scale(1)';
                        });
                    }, index * 100);
                });

                this.loadMoreBtn.style.display = 'none';
                this.collapseBtn.style.display = 'inline-flex';
            }

            showLess() {
                const allCategories = this.container.querySelectorAll('.category-modern');

                allCategories.forEach((item, index) => {
                    if (index >= 6) {
                        item.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
                        item.style.opacity = '0';
                        item.style.transform = 'translateY(-20px) scale(0.9)';

                        setTimeout(() => {
                            item.classList.add('hidden');
                        }, 400);
                    }
                });

                this.collapseBtn.style.display = 'none';
                this.loadMoreBtn.style.display = 'inline-flex';

                // Smooth scroll to categories
                this.container.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }

        // Enhanced Search Engine Component
        class SearchEngine {
            constructor() {
                this.searchInput = document.getElementById('searchEkraf');
                this.searchLoading = document.getElementById('searchLoading');
                this.searchClear = document.getElementById('searchClear');
                this.ekrafList = document.getElementById('ekrafList');
                this.searchSuggestions = document.getElementById('searchSuggestions');
                this.searchTimer = null;
                this.cache = new Map();
                this.abortController = null;
            }

            init() {
                if (!this.searchInput) return;

                this.setupSearchEvents();
                this.setupSuggestions();
                this.setupClearButton();
            }

            setupSearchEvents() {
                this.searchInput.addEventListener('input', (e) => this.handleSearch(e));
                this.searchInput.addEventListener('focus', () => this.onFocus());
                this.searchInput.addEventListener('blur', () => this.onBlur());
                this.searchInput.addEventListener('keydown', (e) => this.handleKeydown(e));
            }

            setupClearButton() {
                if (this.searchClear) {
                    this.searchClear.addEventListener('click', () => this.clearSearch());
                }
            }

            setupSuggestions() {
                if (this.searchSuggestions) {
                    document.addEventListener('click', (e) => {
                        if (!e.target.closest('.search-container')) {
                            this.hideSuggestions();
                        }
                    });
                }
            }

            handleSearch(e) {
                const query = e.target.value.trim();

                // Show/hide clear button
                this.toggleClearButton(query.length > 0);

                clearTimeout(this.searchTimer);

                if (query.length === 0) {
                    this.resetResults();
                    this.hideSuggestions();
                    return;
                }

                if (query.length < 2) {
                    this.showSuggestions(['Mulai ketik untuk mencari...']);
                    return;
                }

                this.showLoading(true);

                this.searchTimer = setTimeout(() => {
                    this.performSearch(query);
                }, 300);
            }

            async performSearch(query) {
                try {
                    // Cancel previous request
                    if (this.abortController) {
                        this.abortController.abort();
                    }

                    this.abortController = new AbortController();

                    // Check cache first
                    if (this.cache.has(query)) {
                        this.renderResults(this.cache.get(query));
                        this.showLoading(false);
                        return;
                    }

                    const response = await fetch(`/ekraf/search?query=${encodeURIComponent(query)}`, {
                        signal: this.abortController.signal
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const data = await response.json();

                    // Cache results
                    this.cache.set(query, data.data);

                    this.renderResults(data.data);
                    this.showLoading(false);
                    this.hideSuggestions();

                } catch (error) {
                    if (error.name !== 'AbortError') {
                        console.error('Search error:', error);
                        this.showError(error.message);
                        this.showLoading(false);
                    }
                }
            }

            renderResults(results) {
                if (results.length === 0) {
                    this.showEmptyState();
                    return;
                }

                const html = results.map((ekraf, index) => `
                        <div class="ekraf-card-modern animate-card" style="opacity: 0; transform: translateY(30px);" data-index="${index}">
                            <a href="/ekraf/${ekraf.slug}" class="card-link">
                                <div class="card-background"></div>
                                <div class="card-image">
                                    <img src="${ekraf.logo || 'https://via.placeholder.com/350x200/ff6500/ffffff?text=EKRAF'}" 
                                         alt="${ekraf.name}" loading="lazy">
                                    <div class="image-overlay">
                                        <div class="overlay-content">
                                            <i class="bi bi-arrow-up-right"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-category">
                                        <i class="bi bi-tag"></i>
                                        <span>${ekraf.category.name}</span>
                                    </div>
                                    <h3 class="card-title">${this.highlightQuery(ekraf.name, this.searchInput.value)}</h3>
                                    <p class="card-description">Produk berkualitas dengan cita rasa autentik Ternate</p>
                                    <div class="card-meta">
                                        <div class="meta-item">
                                            <i class="bi bi-geo-alt"></i>
                                            <span>Ternate</span>
                                        </div>
                                        <div class="meta-item">
                                            <i class="bi bi-star-fill"></i>
                                            <span>4.8</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-glow"></div>
                            </a>
                        </div>
                    `).join('');

                this.ekrafList.innerHTML = html;
                this.animateCardsIn();
            }

            highlightQuery(text, query) {
                if (!query) return text;
                const regex = new RegExp(`(${query})`, 'gi');
                return text.replace(regex, '<mark class="search-highlight">$1</mark>');
            }

            animateCardsIn() {
                const cards = this.ekrafList.querySelectorAll('.animate-card');
                cards.forEach((card, index) => {
                    setTimeout(() => {
                        card.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, index * 100);
                });
            }

            showEmptyState() {
                this.ekrafList.innerHTML = `
                        <div class="empty-state-modern">
                            <div class="empty-visual">
                                <div class="empty-icon">
                                    <i class="bi bi-search"></i>
                                </div>
                                <div class="empty-particles"></div>
                            </div>
                            <h3>Tidak ada hasil ditemukan</h3>
                            <p>Coba gunakan kata kunci yang berbeda atau periksa ejaan Anda</p>
                            <div class="empty-suggestions">
                                <p class="mb-2">Saran pencarian:</p>
                                <div class="suggestion-tags">
                                    <span class="suggestion-tag" onclick="document.getElementById('searchEkraf').value='kuliner'; document.getElementById('searchEkraf').dispatchEvent(new Event('input'));">kuliner</span>
                                    <span class="suggestion-tag" onclick="document.getElementById('searchEkraf').value='kerajinan'; document.getElementById('searchEkraf').dispatchEvent(new Event('input'));">kerajinan</span>
                                    <span class="suggestion-tag" onclick="document.getElementById('searchEkraf').value='fashion'; document.getElementById('searchEkraf').dispatchEvent(new Event('input'));">fashion</span>
                                </div>
                            </div>
                            <button class="btn-modern btn-primary" onclick="this.clearSearch()">
                                <span class="btn-text">Reset Pencarian</span>
                                <div class="btn-glow"></div>
                                <i class="bi bi-arrow-clockwise"></i>
                            </button>
                        </div>
                    `;
            }

            showError(message = 'Terjadi kesalahan') {
                this.ekrafList.innerHTML = `
                        <div class="empty-state-modern">
                            <div class="empty-visual">
                                <div class="empty-icon error">
                                    <i class="bi bi-exclamation-triangle"></i>
                                </div>
                            </div>
                            <h3>${message}</h3>
                            <p>Tidak dapat memuat hasil pencarian. Silakan coba lagi.</p>
                            <button class="btn-modern btn-primary" onclick="location.reload()">
                                <span class="btn-text">Muat Ulang</span>
                                <div class="btn-glow"></div>
                                <i class="bi bi-arrow-clockwise"></i>
                            </button>
                        </div>
                    `;
            }

            showSuggestions(suggestions) {
                if (!this.searchSuggestions || !suggestions.length) return;

                const html = suggestions.map(suggestion => `
                        <div class="suggestion-item" onclick="this.selectSuggestion('${suggestion}')">
                            <i class="bi bi-search"></i>
                            <span>${suggestion}</span>
                        </div>
                    `).join('');

                this.searchSuggestions.innerHTML = html;
                this.searchSuggestions.style.display = 'block';
            }

            hideSuggestions() {
                if (this.searchSuggestions) {
                    this.searchSuggestions.style.display = 'none';
                }
            }

            selectSuggestion(suggestion) {
                this.searchInput.value = suggestion;
                this.searchInput.dispatchEvent(new Event('input'));
                this.hideSuggestions();
            }

            showLoading(show) {
                if (this.searchLoading) {
                    this.searchLoading.style.display = show ? 'block' : 'none';
                }
            }

            toggleClearButton(show) {
                if (this.searchClear) {
                    this.searchClear.style.display = show ? 'flex' : 'none';
                }
            }

            onFocus() {
                this.searchInput.closest('.search-container').classList.add('focused');

                // Show recent searches or suggestions
                if (this.searchInput.value.length === 0) {
                    const recentSearches = this.getRecentSearches();
                    if (recentSearches.length > 0) {
                        this.showSuggestions(recentSearches);
                    }
                }
            }

            onBlur() {
                setTimeout(() => {
                    this.searchInput.closest('.search-container').classList.remove('focused');
                    this.hideSuggestions();
                }, 200);
            }

            handleKeydown(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    this.saveRecentSearch(this.searchInput.value);
                    this.hideSuggestions();
                }
            }

            clearSearch() {
                this.searchInput.value = '';
                this.searchInput.dispatchEvent(new Event('input'));
                this.searchInput.focus();
                this.resetResults();
            }

            resetResults() {
                // Reload original content or redirect
                if (window.location.search) {
                    window.location.href = window.location.pathname;
                }
            }

            getRecentSearches() {
                const searches = localStorage.getItem('ekraf_recent_searches');
                return searches ? JSON.parse(searches) : [];
            }

            saveRecentSearch(query) {
                if (!query.trim()) return;

                let searches = this.getRecentSearches();
                searches = searches.filter(s => s !== query);
                searches.unshift(query);
                searches = searches.slice(0, 5); // Keep only 5 recent searches

                localStorage.setItem('ekraf_recent_searches', JSON.stringify(searches));
            }
        }

        // Animation Controller Component
        class AnimationController {
            constructor() {
                this.animatedElements = new Set();
                this.scrollTicking = false;
            }

            init() {
                this.setupScrollAnimations();
                this.setupParallaxEffect();
                this.setupMicroInteractions();
                this.setupPageTransitions();
            }

            setupScrollAnimations() {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting && !this.animatedElements.has(entry.target)) {
                            this.animateElement(entry.target);
                            this.animatedElements.add(entry.target);
                        }
                    });
                }, {
                    threshold: 0.1,
                    rootMargin: '0px 0px -50px 0px'
                });

                // Observe elements for animation
                document.querySelectorAll('.category-modern, .ekraf-card-modern, .hero-card, .section-header').forEach(
                    el => {
                        observer.observe(el);
                    });
            }

            animateElement(element) {
                const animationType = element.dataset.animation || 'fadeInUp';

                element.style.opacity = '0';
                element.style.transform = this.getInitialTransform(animationType);

                requestAnimationFrame(() => {
                    element.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0) scale(1) rotate(0deg)';
                });
            }

            getInitialTransform(type) {
                const transforms = {
                    fadeInUp: 'translateY(30px) scale(0.95)',
                    fadeInLeft: 'translateX(-30px) scale(0.95)',
                    fadeInRight: 'translateX(30px) scale(0.95)',
                    zoomIn: 'scale(0.8)',
                    rotateIn: 'rotate(-5deg) scale(0.9)'
                };
                return transforms[type] || transforms.fadeInUp;
            }

            setupParallaxEffect() {
                const updateParallax = () => {
                    if (!this.scrollTicking) {
                        requestAnimationFrame(() => {
                            const scrollY = window.pageYOffset;

                            // Hero parallax
                            this.updateHeroParallax(scrollY);

                            // Floating shapes parallax
                            this.updateFloatingShapes(scrollY);

                            // Background parallax
                            this.updateBackgroundParallax(scrollY);

                            this.scrollTicking = false;
                        });
                        this.scrollTicking = true;
                    }
                };

                window.addEventListener('scroll', updateParallax, {
                    passive: true
                });
            }

            updateHeroParallax(scrollY) {
                const heroCards = document.querySelectorAll('.hero-card');
                heroCards.forEach((card, index) => {
                    const speed = 0.3 + (index * 0.1);
                    const yPos = scrollY * speed;
                    const rotation = scrollY * 0.05;
                    card.style.transform = `translateY(${yPos}px) rotate(${rotation}deg)`;
                });
            }

            updateFloatingShapes(scrollY) {
                const shapes = document.querySelectorAll('.floating-shape');
                shapes.forEach((shape, index) => {
                    const speed = 0.1 + (index * 0.03);
                    const yPos = scrollY * speed;
                    const rotation = scrollY * 0.1;
                    shape.style.transform = `translateY(${yPos}px) rotate(${rotation}deg)`;
                });
            }

            updateBackgroundParallax(scrollY) {
                const parallaxElements = document.querySelectorAll('[data-parallax]');
                parallaxElements.forEach(element => {
                    const speed = parseFloat(element.dataset.parallax) || 0.5;
                    const yPos = scrollY * speed;
                    element.style.transform = `translateY(${yPos}px)`;
                });
            }

            setupMicroInteractions() {
                this.setupRippleEffect();
                this.setupMagneticButtons();
                this.setupHoverEffects();
                this.setupClickAnimations();
            }

            setupRippleEffect() {
                document.addEventListener('click', (e) => {
                    const target = e.target.closest('.btn-modern, .category-modern, .ekraf-card-modern');
                    if (target && !target.classList.contains('no-ripple')) {
                        this.createRipple(target, e);
                    }
                });
            }

            createRipple(element, event) {
                const ripple = document.createElement('span');
                const rect = element.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = event.clientX - rect.left - size / 2;
                const y = event.clientY - rect.top - size / 2;

                ripple.style.cssText = `
                        position: absolute;
                        width: ${size}px;
                        height: ${size}px;
                        left: ${x}px;
                        top: ${y}px;
                        background: rgba(255, 101, 0, 0.3);
                        border-radius: 50%;
                        transform: scale(0);
                        animation: rippleAnimation 0.6s linear;
                        pointer-events: none;
                        z-index: 1000;
                    `;

                // Ensure element is relatively positioned
                if (getComputedStyle(element).position === 'static') {
                    element.style.position = 'relative';
                }

                element.appendChild(ripple);

                setTimeout(() => {
                    ripple.remove();
                }, 600);
            }

            setupMagneticButtons() {
                document.querySelectorAll('.btn-modern').forEach(btn => {
                    btn.addEventListener('mousemove', (e) => {
                        if (window.innerWidth > 768) { // Only on desktop
                            const rect = btn.getBoundingClientRect();
                            const x = e.clientX - rect.left - rect.width / 2;
                            const y = e.clientY - rect.top - rect.height / 2;

                            btn.style.transform = `translate(${x * 0.1}px, ${y * 0.1}px)`;
                        }
                    });

                    btn.addEventListener('mouseleave', () => {
                        btn.style.transform = 'translate(0, 0)';
                    });
                });
            }

            setupHoverEffects() {
                // Advanced hover effects for cards
                document.querySelectorAll('.ekraf-card-modern').forEach(card => {
                    card.addEventListener('mouseenter', () => {
                        this.animateCardHover(card, true);
                    });

                    card.addEventListener('mouseleave', () => {
                        this.animateCardHover(card, false);
                    });
                });
            }

            animateCardHover(card, isEntering) {
                const image = card.querySelector('.card-image img');
                const overlay = card.querySelector('.image-overlay');
                const glow = card.querySelector('.card-glow');

                if (isEntering) {
                    if (image) image.style.transform = 'scale(1.1) rotate(2deg)';
                    if (overlay) overlay.style.opacity = '1';
                    if (glow) glow.style.opacity = '0.2';
                    card.style.transform = 'translateY(-10px) scale(1.02)';
                } else {
                    if (image) image.style.transform = 'scale(1) rotate(0deg)';
                    if (overlay) overlay.style.opacity = '0';
                    if (glow) glow.style.opacity = '0';
                    card.style.transform = 'translateY(0) scale(1)';
                }
            }

            setupClickAnimations() {
                document.querySelectorAll('a, button').forEach(element => {
                    element.addEventListener('click', (e) => {
                        // Add click animation
                        element.style.transform = 'scale(0.98)';
                        setTimeout(() => {
                            element.style.transform = '';
                        }, 150);
                    });
                });
            }

            setupPageTransitions() {
                // Smooth page transitions for SPA-like experience
                document.addEventListener('DOMContentLoaded', () => {
                    document.body.style.opacity = '0';
                    setTimeout(() => {
                        document.body.style.transition = 'opacity 0.5s ease';
                        document.body.style.opacity = '1';
                    }, 100);
                });
            }

            animateCards() {
                const cards = document.querySelectorAll('.ekraf-card-modern');
                cards.forEach((card, index) => {
                    setTimeout(() => {
                        card.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
                        card.style.transform = 'translateY(0) scale(1)';
                        card.style.opacity = '1';
                    }, index * 100);
                });
            }
        }

        // Keyboard Handler Component
        class KeyboardHandler {
            constructor() {
                this.shortcuts = new Map();
                this.setupShortcuts();
            }

            init() {
                document.addEventListener('keydown', (e) => {
                    this.handleKeydown(e);
                });

                // Show keyboard shortcuts modal
                this.setupHelpModal();
            }

            setupShortcuts() {
                this.shortcuts.set('/', () => {
                    const searchInput = document.getElementById('searchEkraf');
                    if (searchInput) {
                        searchInput.focus();
                        searchInput.select();
                    }
                });

                this.shortcuts.set('Escape', () => {
                    const searchInput = document.getElementById('searchEkraf');
                    if (searchInput && searchInput === document.activeElement) {
                        searchInput.blur();
                        if (searchInput.value) {
                            searchInput.value = '';
                            searchInput.dispatchEvent(new Event('input'));
                        }
                    }
                });

                this.shortcuts.set('?', () => {
                    this.showKeyboardShortcuts();
                });

                this.shortcuts.set('h', () => {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }

            handleKeydown(e) {
                // Don't trigger shortcuts when typing in inputs
                if (this.isInputFocused() && e.key !== 'Escape') return;

                // Handle shortcuts
                const shortcut = this.shortcuts.get(e.key);
                if (shortcut) {
                    e.preventDefault();
                    shortcut();
                    return;
                }

                // Navigation shortcuts
                this.handleNavigation(e);
            }

            handleNavigation(e) {
                switch (e.key) {
                    case 'ArrowDown':
                    case 'ArrowUp':
                        if (!this.isInputFocused()) {
                            e.preventDefault();
                            this.navigateCards(e.key === 'ArrowDown' ? 1 : -1);
                        }
                        break;
                    case 'Enter':
                        const focused = document.querySelector('.ekraf-card-modern:focus-visible');
                        if (focused) {
                            const link = focused.querySelector('.card-link');
                            if (link) link.click();
                        }
                        break;
                    case 'Tab':
                        // Enhanced tab navigation
                        this.handleTabNavigation(e);
                        break;
                }
            }

            navigateCards(direction) {
                const cards = Array.from(document.querySelectorAll('.ekraf-card-modern'));
                const currentIndex = cards.findIndex(card => card === document.activeElement);

                if (currentIndex === -1) {
                    if (cards.length > 0) {
                        cards[0].focus();
                        this.scrollToCard(cards[0]);
                    }
                    return;
                }

                const nextIndex = currentIndex + direction;
                if (nextIndex >= 0 && nextIndex < cards.length) {
                    cards[nextIndex].focus();
                    this.scrollToCard(cards[nextIndex]);
                }
            }

            scrollToCard(card) {
                card.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center',
                    inline: 'nearest'
                });
            }

            handleTabNavigation(e) {
                // Add custom tab navigation logic if needed
                const focusableElements = document.querySelectorAll(
                    'a, button, input, select, textarea, [tabindex]:not([tabindex="-1"])'
                );

                const focusableArray = Array.from(focusableElements);
                const currentIndex = focusableArray.indexOf(document.activeElement);

                // Add visual indicator for tab navigation
                document.activeElement?.classList.add('keyboard-focus');
                setTimeout(() => {
                    document.activeElement?.classList.remove('keyboard-focus');
                }, 2000);
            }

            isInputFocused() {
                const activeElement = document.activeElement;
                return activeElement && (
                    activeElement.tagName === 'INPUT' ||
                    activeElement.tagName === 'TEXTAREA' ||
                    activeElement.contentEditable === 'true'
                );
            }

            setupHelpModal() {
                // Create keyboard shortcuts help modal
                const helpModal = document.createElement('div');
                helpModal.id = 'keyboard-help-modal';
                helpModal.className = 'keyboard-help-modal';
                helpModal.innerHTML = `
                        <div class="help-modal-content">
                            <div class="help-modal-header">
                                <h3>Keyboard Shortcuts</h3>
                                <button class="help-close-btn" onclick="this.closest('.keyboard-help-modal').style.display='none'">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                            <div class="help-modal-body">
                                <div class="shortcut-group">
                                    <h4>Search</h4>
                                    <div class="shortcut-item">
                                        <kbd>/</kbd>
                                        <span>Focus search input</span>
                                    </div>
                                    <div class="shortcut-item">
                                        <kbd>Esc</kbd>
                                        <span>Clear search / Exit focus</span>
                                    </div>
                                </div>
                                <div class="shortcut-group">
                                    <h4>Navigation</h4>
                                    <div class="shortcut-item">
                                        <kbd>↑</kbd> <kbd>↓</kbd>
                                        <span>Navigate cards</span>
                                    </div>
                                    <div class="shortcut-item">
                                        <kbd>Enter</kbd>
                                        <span>Open selected card</span>
                                    </div>
                                    <div class="shortcut-item">
                                        <kbd>h</kbd>
                                        <span>Go to top</span>
                                    </div>
                                </div>
                                <div class="shortcut-group">
                                    <h4>Help</h4>
                                    <div class="shortcut-item">
                                        <kbd>?</kbd>
                                        <span>Show this help</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                document.body.appendChild(helpModal);
            }

            showKeyboardShortcuts() {
                const modal = document.getElementById('keyboard-help-modal');
                if (modal) {
                    modal.style.display = 'flex';
                }
            }
        }

        // Theme Manager Component
        class ThemeManager {
            constructor() {
                this.theme = this.getPreferredTheme();
                this.init();
            }

            init() {
                this.applyTheme();
                this.setupThemeToggle();
                this.watchSystemTheme();
                this.setupThemeTransitions();
            }

            getPreferredTheme() {
                const stored = localStorage.getItem('ekraf-theme');
                if (stored) return stored;

                return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            }

            applyTheme() {
                document.documentElement.setAttribute('data-theme', this.theme);
                this.updateThemeIcon();
            }

            toggleTheme() {
                this.theme = this.theme === 'light' ? 'dark' : 'light';
                localStorage.setItem('ekraf-theme', this.theme);
                this.applyTheme();
                this.animateThemeTransition();
            }

            setupThemeToggle() {
                // Create theme toggle button if it doesn't exist
                if (!document.getElementById('theme-toggle')) {
                    this.createThemeToggle();
                }

                const themeToggle = document.getElementById('theme-toggle');
                if (themeToggle) {
                    themeToggle.addEventListener('click', () => this.toggleTheme());
                }
            }

            createThemeToggle() {
                const toggleBtn = document.createElement('button');
                toggleBtn.id = 'theme-toggle';
                toggleBtn.className = 'theme-toggle-btn';
                toggleBtn.innerHTML = '<i class="bi bi-moon"></i>';
                toggleBtn.setAttribute('aria-label', 'Toggle theme');

                // Position in top right corner
                toggleBtn.style.cssText = `
                        position: fixed;
                        top: 20px;
                        right: 20px;
                        z-index: 1000;
                        width: 50px;
                        height: 50px;
                        border-radius: 50%;
                        border: none;
                        background: var(--white);
                        box-shadow: var(--shadow-lg);
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        cursor: pointer;
                        transition: all 0.3s ease;
                        font-size: 1.2rem;
                        color: var(--primary);
                    `;

                document.body.appendChild(toggleBtn);
            }

            updateThemeIcon() {
                const themeToggle = document.getElementById('theme-toggle');
                if (themeToggle) {
                    const icon = themeToggle.querySelector('i');
                    if (icon) {
                        icon.className = this.theme === 'light' ? 'bi bi-moon' : 'bi bi-sun';
                    }
                }
            }

            animateThemeTransition() {
                document.body.style.transition = 'background-color 0.3s ease, color 0.3s ease';
                setTimeout(() => {
                    document.body.style.transition = '';
                }, 300);
            }

            watchSystemTheme() {
                const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
                mediaQuery.addEventListener('change', (e) => {
                    if (!localStorage.getItem('ekraf-theme')) {
                        this.theme = e.matches ? 'dark' : 'light';
                        this.applyTheme();
                    }
                });
            }

            setupThemeTransitions() {
                // Add smooth transitions for theme changes
                const style = document.createElement('style');
                style.textContent = `
                        * {
                            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
                        }
                        
                        .theme-transition-disable * {
                            transition: none !important;
                        }
                    `;
                document.head.appendChild(style);
            }
        }

        // Notification System
        class NotificationSystem {
            constructor() {
                this.container = this.createContainer();
                this.notifications = [];
            }

            createContainer() {
                const container = document.createElement('div');
                container.id = 'notification-container';
                container.style.cssText = `
                        position: fixed;
                        top: 20px;
                        right: 20px;
                        z-index: 10000;
                        display: flex;
                        flex-direction: column;
                        gap: 10px;
                        pointer-events: none;
                    `;
                document.body.appendChild(container);
                return container;
            }

            show(message, type = 'info', duration = 5000) {
                const notification = this.createNotification(message, type, duration);
                this.container.appendChild(notification);
                this.notifications.push(notification);

                // Animate in
                requestAnimationFrame(() => {
                    notification.style.transform = 'translateX(0)';
                    notification.style.opacity = '1';
                });

                // Auto remove
                if (duration > 0) {
                    setTimeout(() => {
                        this.remove(notification);
                    }, duration);
                }

                return notification;
            }

            createNotification(message, type, duration) {
                const notification = document.createElement('div');
                notification.className = `notification notification-${type}`;
                notification.style.cssText = `
                        background: var(--white);
                        border: 1px solid var(--border-light);
                        border-left: 4px solid var(--${type === 'error' ? 'danger' : type === 'success' ? 'success' : 'primary'});
                        border-radius: var(--radius-lg);
                        padding: 1rem 1.5rem;
                        box-shadow: var(--shadow-xl);
                        max-width: 400px;
                        transform: translateX(100%);
                        opacity: 0;
                        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                        pointer-events: auto;
                        display: flex;
                        align-items: center;
                        gap: 0.75rem;
                        font-size: 0.9rem;
                        line-height: 1.4;
                    `;

                const icon = this.getIcon(type);
                const closeBtn = `
                        <button onclick="this.closest('.notification').remove()" 
                                style="background: none; border: none; color: var(--secondary); cursor: pointer; padding: 0; margin-left: auto;">
                            <i class="bi bi-x"></i>
                        </button>
                    `;

                notification.innerHTML = `
                        <i class="bi ${icon}" style="color: var(--${type === 'error' ? 'danger' : type === 'success' ? 'success' : 'primary'}); font-size: 1.1rem;"></i>
                        <span style="flex: 1;">${message}</span>
                        ${closeBtn}
                    `;

                return notification;
            }

            getIcon(type) {
                const icons = {
                    success: 'bi-check-circle',
                    error: 'bi-exclamation-circle',
                    warning: 'bi-exclamation-triangle',
                    info: 'bi-info-circle'
                };
                return icons[type] || icons.info;
            }

            remove(notification) {
                notification.style.transform = 'translateX(100%)';
                notification.style.opacity = '0';

                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.parentNode.removeChild(notification);
                    }
                    this.notifications = this.notifications.filter(n => n !== notification);
                }, 300);
            }

            clear() {
                this.notifications.forEach(notification => {
                    this.remove(notification);
                });
            }
        }

        // Performance Monitor
        class PerformanceMonitor {
            constructor() {
                this.metrics = {};
                this.observers = [];
            }

            init() {
                this.setupPerformanceObservers();
                this.monitorPageLoad();
                this.monitorUserInteractions();
                this.setupMemoryMonitoring();
            }

            setupPerformanceObservers() {
                // Monitor Largest Contentful Paint
                if ('PerformanceObserver' in window) {
                    try {
                        const lcpObserver = new PerformanceObserver((list) => {
                            const entries = list.getEntries();
                            const lastEntry = entries[entries.length - 1];
                            this.metrics.lcp = lastEntry.startTime;
                        });
                        lcpObserver.observe({
                            entryTypes: ['largest-contentful-paint']
                        });
                        this.observers.push(lcpObserver);
                    } catch (e) {
                        console.warn('LCP observer not supported');
                    }

                    // Monitor First Input Delay
                    try {
                        const fidObserver = new PerformanceObserver((list) => {
                            const entries = list.getEntries();
                            entries.forEach(entry => {
                                this.metrics.fid = entry.processingStart - entry.startTime;
                            });
                        });
                        fidObserver.observe({
                            entryTypes: ['first-input']
                        });
                        this.observers.push(fidObserver);
                    } catch (e) {
                        console.warn('FID observer not supported');
                    }
                }
            }

            monitorPageLoad() {
                window.addEventListener('load', () => {
                    if ('performance' in window) {
                        const perfData = performance.getEntriesByType('navigation')[0];
                        this.metrics.pageLoad = {
                            loadTime: perfData.loadEventEnd - perfData.loadEventStart,
                            domContentLoaded: perfData.domContentLoadedEventEnd - perfData
                                .domContentLoadedEventStart,
                            totalTime: perfData.loadEventEnd - perfData.fetchStart,
                            ttfb: perfData.responseStart - perfData.fetchStart
                        };

                        this.reportMetrics();
                    }
                });
            }

            monitorUserInteractions() {
                let interactionCount = 0;
                let totalDelay = 0;

                ['click', 'keydown', 'touchstart'].forEach(eventType => {
                    document.addEventListener(eventType, (e) => {
                        const startTime = performance.now();

                        requestAnimationFrame(() => {
                            const endTime = performance.now();
                            const delay = endTime - startTime;

                            interactionCount++;
                            totalDelay += delay;

                            this.metrics.averageInteractionDelay = totalDelay /
                                interactionCount;
                        });
                    }, {
                        passive: true
                    });
                });
            }

            setupMemoryMonitoring() {
                if ('memory' in performance) {
                    setInterval(() => {
                        this.metrics.memory = {
                            used: performance.memory.usedJSHeapSize,
                            total: performance.memory.totalJSHeapSize,
                            limit: performance.memory.jsHeapSizeLimit
                        };
                    }, 30000); // Check every 30 seconds
                }
            }

            reportMetrics() {
                // Log performance metrics
                console.group('Performance Metrics');
                console.log('Page Load Time:', this.metrics.pageLoad?.totalTime, 'ms');
                console.log('LCP:', this.metrics.lcp, 'ms');
                console.log('FID:', this.metrics.fid, 'ms');
                console.log('Average Interaction Delay:', this.metrics.averageInteractionDelay, 'ms');
                console.groupEnd();

                // Send to analytics if needed
                this.sendToAnalytics();
            }

            sendToAnalytics() {
                // Send metrics to your analytics service
                if (window.gtag) {
                    window.gtag('event', 'page_performance', {
                        load_time: this.metrics.pageLoad?.totalTime,
                        lcp: this.metrics.lcp,
                        fid: this.metrics.fid
                    });
                }
            }

            getMetrics() {
                return this.metrics;
            }

            destroy() {
                this.observers.forEach(observer => observer.disconnect());
                this.observers = [];
            }
        }

        // Error Handler
        class ErrorHandler {
            static init() {
                window.addEventListener('error', (e) => {
                    console.error('JavaScript Error:', e.error);
                    ErrorHandler.handleError(e.error, 'JavaScript Error');
                });

                window.addEventListener('unhandledrejection', (e) => {
                    console.error('Unhandled Promise Rejection:', e.reason);
                    ErrorHandler.handleError(e.reason, 'Promise Rejection');
                });
            }

            static handleError(error, type) {
                // Log error details
                const errorInfo = {
                    type,
                    message: error.message || error,
                    stack: error.stack,
                    url: window.location.href,
                    userAgent: navigator.userAgent,
                    timestamp: new Date().toISOString()
                };

                // Send to error tracking service
                ErrorHandler.reportError(errorInfo);

                // Show user-friendly notification
                if (window.notificationSystem) {
                    window.notificationSystem.show(
                        'Terjadi kesalahan pada aplikasi. Tim kami telah diberitahu.',
                        'error',
                        5000
                    );
                }
            }

            static reportError(errorInfo) {
                // Send to your error tracking service (e.g., Sentry, LogRocket)
                if (console.error) {
                    console.error('Error Report:', errorInfo);
                }

                // Could also send to your backend
                /*
                fetch('/api/errors', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(errorInfo)
                }).catch(() => {
                    // Silently fail if error reporting fails
                });
                */
            }
        }

        // Initialize the application
        document.addEventListener('DOMContentLoaded', () => {
            // Initialize error handling first
            ErrorHandler.init();

            // Initialize notification system
            window.notificationSystem = new NotificationSystem();

            // Initialize main application
            const app = new EkrafApp();

            // Initialize theme manager
            const themeManager = new ThemeManager();

            // Initialize performance monitoring
            const performanceMonitor = new PerformanceMonitor();
            performanceMonitor.init();

            // Service Worker registration for PWA capabilities
            if ('serviceWorker' in navigator) {
                navigator.serviceWorker.register('/sw.js')
                    .then(registration => {
                        console.log('SW registered:', registration);
                    })
                    .catch(error => {
                        console.log('SW registration failed:', error);
                    });
            }

            // Add CSS for additional features
            const additionalStyles = document.createElement('style');
            additionalStyles.textContent = `
                    /* Keyboard focus indicator */
                    .keyboard-focus {
                        outline: 2px solid var(--primary) !important;
                        outline-offset: 2px !important;
                    }

                    /* Search highlight */
                    .search-highlight {
                        background: rgba(255, 101, 0, 0.2);
                        border-radius: 2px;
                        padding: 0 2px;
                    }

                    /* Suggestion tags */
                    .suggestion-tags {
                        display: flex;
                        gap: 0.5rem;
                        flex-wrap: wrap;
                        justify-content: center;
                    }

                    .suggestion-tag {
                        padding: 0.25rem 0.75rem;
                        background: var(--primary-ultra-light);
                        color: var(--primary);
                        border-radius: var(--radius-full);
                        font-size: 0.8rem;
                        cursor: pointer;
                        transition: all 0.2s ease;
                    }

                    .suggestion-tag:hover {
                        background: var(--primary);
                        color: white;
                    }

                    /* Search suggestions */
                    .search-suggestions {
                        position: absolute;
                        top: 100%;
                        left: 0;
                        right: 0;
                        background: var(--white);
                        border: 1px solid var(--border-light);
                        border-radius: var(--radius-lg);
                        box-shadow: var(--shadow-xl);
                        z-index: 1000;
                        display: none;
                        max-height: 300px;
                        overflow-y: auto;
                    }

                    .suggestion-item {
                        padding: 0.75rem 1rem;
                        display: flex;
                        align-items: center;
                        gap: 0.75rem;
                        cursor: pointer;
                        transition: background-color 0.2s ease;
                        border-bottom: 1px solid var(--border-light);
                    }

                    .suggestion-item:last-child {
                        border-bottom: none;
                    }

                    .suggestion-item:hover {
                        background: var(--primary-ultra-light);
                    }

                    .suggestion-item i {
                        color: var(--secondary);
                        font-size: 0.9rem;
                    }

                    /* Keyboard help modal */
                    .keyboard-help-modal {
                        position: fixed;
                        top: 0;
                        left: 0;
                        right: 0;
                        bottom: 0;
                        background: rgba(0, 0, 0, 0.5);
                        z-index: 10000;
                        display: none;
                        align-items: center;
                        justify-content: center;
                        backdrop-filter: blur(5px);
                    }

                    .help-modal-content {
                        background: var(--white);
                        border-radius: var(--radius-xl);
                        padding: 2rem;
                        max-width: 500px;
                        width: 90%;
                        max-height: 80vh;
                        overflow-y: auto;
                        box-shadow: var(--shadow-xl);
                    }

                    .help-modal-header {
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        margin-bottom: 1.5rem;
                        padding-bottom: 1rem;
                        border-bottom: 1px solid var(--border-light);
                    }

                    .help-close-btn {
                        background: none;
                        border: none;
                        font-size: 1.5rem;
                        cursor: pointer;
                        color: var(--secondary);
                        padding: 0;
                        width: 30px;
                        height: 30px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        border-radius: 50%;
                        transition: all 0.2s ease;
                    }

                    .help-close-btn:hover {
                        background: var(--primary-ultra-light);
                        color: var(--primary);
                    }

                    .shortcut-group {
                        margin-bottom: 1.5rem;
                    }

                    .shortcut-group h4 {
                        margin-bottom: 0.75rem;
                        color: var(--dark);
                        font-size: 1rem;
                    }

                    .shortcut-item {
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        padding: 0.5rem 0;
                        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
                    }

                    .shortcut-item:last-child {
                        border-bottom: none;
                    }

                    .shortcut-item kbd {
                        background: var(--primary-ultra-light);
                        color: var(--primary);
                        padding: 0.25rem 0.5rem;
                        border-radius: 4px;
                        font-size: 0.8rem;
                        border: 1px solid rgba(255, 101, 0, 0.2);
                        margin-right: 0.25rem;
                    }

                    /* Ripple animation */
                    @keyframes rippleAnimation {
                        to {
                            transform: scale(4);
                            opacity: 0;
                        }
                    }

                    /* Theme toggle button hover */
                    .theme-toggle-btn:hover {
                        transform: scale(1.1);
                        box-shadow: var(--shadow-glow);
                    }

                    /* Error state styling */
                    .empty-icon.error {
                        color: var(--danger);
                    }

                    /* Loading state for cards */
                    .ekraf-card-modern.loading {
                        opacity: 0.6;
                        pointer-events: none;
                    }

                    .ekraf-card-modern.loading::after {
                        content: '';
                        position: absolute;
                        top: 0;
                        left: 0;
                        right: 0;
                        bottom: 0;
                        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.8), transparent);
                        animation: shimmer 1.5s infinite;
                    }

                    @keyframes shimmer {
                        0% { transform: translateX(-100%); }
                        100% { transform: translateX(100%); }
                    }

                    /* Responsive adjustments */
                    @media (max-width: 768px) {
                        .theme-toggle-btn {
                            width: 40px !important;
                            height: 40px !important;
                            font-size: 1rem !important;
                        }

                        .help-modal-content {
                            padding: 1.5rem;
                        }

                        .notification {
                            max-width: calc(100vw - 40px) !important;
                        }
                    }
                `;
            document.head.appendChild(additionalStyles);

            // Performance timing log
            if ('performance' in window) {
                window.addEventListener('load', () => {
                    const perfData = performance.getEntriesByType('navigation')[0];
                    const loadTime = perfData.loadEventEnd - perfData.loadEventStart;

                    if (loadTime > 3000) {
                        console.warn(`Page load time is high: ${loadTime}ms`);
                        if (window.notificationSystem) {
                            window.notificationSystem.show(
                                'Halaman dimuat lebih lambat dari biasanya',
                                'warning',
                                3000
                            );
                        }
                    }
                });
            }

            // Expose API for debugging
            window.EkrafApp = {
                app,
                themeManager,
                performanceMonitor,
                notificationSystem: window.notificationSystem
            };

            // Show welcome notification
            setTimeout(() => {
                if (window.notificationSystem) {
                    window.notificationSystem.show(
                        'Selamat datang di Ekonomi Kreatif Ternate! Tekan ? untuk melihat shortcut keyboard.',
                        'info',
                        7000
                    );
                }
            }, 2000);
        });
    </script>
@endpush
