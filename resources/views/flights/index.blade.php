@extends('frontend.layouts.main')

@section('body')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #003b95;
            --secondary-color: #0066cc;
            --accent-color: #ff6b35;
            --success-color: #28a745;
            --light-blue: #f8fafc;
            --border-color: #e2e8f0;
            --text-gray: #64748b;
        }

        body {
            background-color: #f5f7fa;
            padding-top: 100px;
            min-height: 100vh;
        }

        .flight-hero {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.3)),
                url('{{ asset('assets/kora_kora.jpg') }}') center/cover;
            height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            position: relative;
            margin-bottom: -120px;
            overflow: hidden;
        }

        .floating-elements {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .floating-circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 6s ease-in-out infinite;
        }

        .floating-circle:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-circle:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 60%;
            right: 15%;
            animation-delay: 2s;
        }

        .floating-circle:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        .floating-plane {
            position: absolute;
            color: rgba(255, 255, 255, 0.2);
            font-size: 40px;
            animation: flyAcross 15s linear infinite;
        }

        .floating-plane:nth-child(4) {
            top: 30%;
            animation-delay: 0s;
        }

        .floating-plane:nth-child(5) {
            top: 70%;
            animation-delay: 7s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes flyAcross {
            0% {
                left: -100px;
                transform: translateY(0px);
            }

            25% {
                transform: translateY(-10px);
            }

            75% {
                transform: translateY(10px);
            }

            100% {
                left: calc(100% + 100px);
                transform: translateY(0px);
            }
        }

        .hero-content h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .hero-content p {
            font-size: 1.3rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .search-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 2rem;
            margin: 0 0 2rem 0;
            position: relative;
            z-index: 10;
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 3rem 0;
            position: relative;
            overflow: hidden;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 60px;
            background: linear-gradient(180deg, transparent 0%, #f5f7fa 100%);
        }

        .search-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            padding: 2rem;
            margin: -3rem 0 2rem 0;
            position: relative;
            z-index: 10;
        }

        .form-floating {
            position: relative;
            margin-bottom: 1rem;
        }

        .form-floating .form-select,
        .form-floating .form-control {
            height: 58px;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s ease;
            background-color: #fff;
        }

        .form-floating .form-select:focus,
        .form-floating .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(0, 102, 204, 0.15);
            outline: none;
        }

        .form-floating label {
            color: var(--text-gray);
            font-weight: 500;
            padding-left: 0.75rem;
        }

        .swap-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 58px;
            margin-bottom: 1rem;
        }

        .swap-button {
            background: var(--accent-color);
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            color: white;
            font-size: 16px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .swap-button:hover {
            background: #e55a2b;
            transform: rotate(180deg);
        }

        .search-btn {
            background: linear-gradient(135deg, var(--accent-color), #ff8c42);
            border: none;
            padding: 15px 40px;
            border-radius: 30px;
            color: white;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 1rem;
        }

        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 53, 0.3);
        }

        .flight-card {
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .flight-card:hover {
            border-color: var(--secondary-color);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transform: translateY(-1px);
        }

        .airline-info {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 1rem;
        }

        .airline-logo {
            width: 45px;
            height: 45px;
            object-fit: contain;
            border-radius: 6px;
            background: #f8f9fa;
            padding: 4px;
            border: 1px solid #eee;
        }

        .airline-details h6 {
            margin: 0;
            color: var(--primary-color);
            font-weight: 600;
            font-size: 16px;
        }

        .flight-number {
            color: var(--text-gray);
            font-size: 13px;
            margin: 2px 0 0 0;
        }

        .baggage-info {
            display: flex;
            gap: 15px;
            margin-top: 8px;
        }

        .baggage-item {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            color: var(--text-gray);
        }

        .baggage-item.included {
            color: var(--success-color);
        }

        .flight-route {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 1rem 0;
            position: relative;
        }

        .time-info {
            text-align: center;
            flex: 1;
        }

        .time {
            font-size: 22px;
            font-weight: 700;
            color: var(--primary-color);
            margin: 0;
        }

        .date {
            font-size: 13px;
            color: var(--text-gray);
            margin: 2px 0 0 0;
        }

        .route-line {
            flex: 2;
            margin: 0 1rem;
            position: relative;
            height: 2px;
            background: linear-gradient(to right, var(--border-color) 0%, var(--secondary-color) 50%, var(--border-color) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .route-line::before {
            content: '';
            position: absolute;
            background: white;
            padding: 0 8px;
            color: var(--secondary-color);
            font-size: 16px;
            top: -8px;
            font-family: 'bootstrap-icons';
            font-content: '\F4E3';
        }

        .route-line .airplane-icon {
            position: absolute;
            background: white;
            padding: 0 8px;
            color: var(--secondary-color);
            font-size: 16px;
            top: -8px;
        }

        .duration {
            position: absolute;
            top: -28px;
            background: var(--light-blue);
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 11px;
            color: var(--text-gray);
            white-space: nowrap;
            border: 1px solid var(--border-color);
        }

        .price-section {
            text-align: right;
            border-left: 1px solid var(--border-color);
            padding-left: 1.5rem;
        }

        .price {
            font-size: 24px;
            font-weight: 700;
            color: var(--accent-color);
            margin: 0;
        }

        .price-label {
            font-size: 12px;
            color: var(--text-gray);
            margin: 2px 0 0 0;
        }

        .select-btn {
            background: var(--success-color);
            border: none;
            color: white;
            padding: 8px 16px;
            border-radius: 18px;
            font-weight: 600;
            font-size: 13px;
            margin-top: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .select-btn:hover {
            background: #218838;
            transform: translateY(-1px);
        }

        .no-results {
            text-align: center;
            padding: 3rem;
            color: var(--text-gray);
        }

        .no-results i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: var(--border-color);
        }

        .badge-direct {
            background: var(--success-color);
            color: white;
            padding: 4px 10px;
            border-radius: 10px;
            font-size: 11px;
            position: absolute;
            top: 12px;
            right: 12px;
            font-weight: 600;
        }

        .section-header {
            background: white;
            padding: 1.5rem 0;
            border-radius: 10px;
            margin-bottom: 1rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .flight-details-toggle {
            color: var(--secondary-color) !important;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .flight-details-toggle:hover {
            color: var(--primary-color) !important;
        }

        .flight-details-toggle .toggle-icon {
            transition: transform 0.3s ease;
        }

        .flight-details-toggle[aria-expanded="true"] .toggle-icon {
            transform: rotate(180deg);
        }

        .flight-details-toggle[aria-expanded="true"] .toggle-text::before {
            content: "Sembunyikan ";
        }

        .flight-details-content {
            background: #fafbfc;
            border-radius: 8px;
            padding: 1.5rem;
            margin-top: 1rem;
        }

        .flight-timeline {
            position: relative;
        }

        .timeline-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1.5rem;
            position: relative;
        }

        .timeline-item:last-child {
            margin-bottom: 0;
        }

        .timeline-time {
            width: 80px;
            flex-shrink: 0;
            text-align: right;
            margin-right: 1rem;
        }

        .timeline-dot {
            width: 12px;
            height: 12px;
            background: var(--secondary-color);
            border-radius: 50%;
            margin-right: 1rem;
            margin-top: 4px;
            flex-shrink: 0;
            position: relative;
        }

        .timeline-dot.transit {
            background: var(--text-gray);
            width: 8px;
            height: 8px;
        }

        .timeline-item:not(:last-child) .timeline-dot::after {
            content: '';
            position: absolute;
            left: 50%;
            top: 12px;
            transform: translateX(-50%);
            width: 2px;
            height: 40px;
            background: var(--border-color);
        }

        .timeline-content {
            flex: 1;
            padding-top: 1px;
        }

        .flight-info-sidebar {
            background: white;
            border-radius: 8px;
            padding: 1rem;
            border: 1px solid var(--border-color);
            height: fit-content;
        }

        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.8rem;
            font-size: 14px;
        }

        .info-item:last-child {
            margin-bottom: 0;
        }

        .info-item i {
            width: 20px;
            margin-right: 8px;
            color: var(--success-color);
        }

        .baggage-details {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 1rem;
            margin-top: 1rem;
        }

        .baggage-section {
            margin-bottom: 1rem;
        }

        .baggage-section:last-child {
            margin-bottom: 0;
        }

        .baggage-title {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .baggage-specs {
            font-size: 13px;
            color: var(--text-gray);
            margin-left: 28px;
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 2rem 0;
            }

            .search-card {
                margin: -2rem 0 1rem 0;
                padding: 1.5rem;
            }

            .swap-container {
                order: 3;
                margin-top: 1rem;
                margin-bottom: 0;
            }

            .flight-route {
                flex-direction: column;
                gap: 0.8rem;
            }

            .route-line {
                width: 2px;
                height: 40px;
                margin: 0;
                background: linear-gradient(to bottom, var(--border-color) 0%, var(--secondary-color) 50%, var(--border-color) 100%);
            }

            .route-line .airplane-icon {
                top: 50%;
                left: -8px;
                transform: translateY(-50%) rotate(90deg);
            }

            .duration {
                top: 50%;
                left: -40px;
                transform: translateY(-50%);
            }

            .price-section {
                border-left: none;
                border-top: 1px solid var(--border-color);
                padding-left: 0;
                padding-top: 1rem;
                text-align: center;
                margin-top: 1rem;
            }

            .airline-info {
                justify-content: center;
            }

            .baggage-info {
                justify-content: center;
            }
        }
    </style>

    <div class="flight-hero">
        <div class="floating-elements">
            <div class="floating-circle"></div>
            <div class="floating-circle"></div>
            <div class="floating-circle"></div>

        </div>

        <!-- Search Card positioned absolutely inside hero -->
        <div class="search-card">
            <form method="GET" action="{{ route('flights.index') }}">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-floating">
                            <select id="origin" name="origin" class="form-select" required>
                                @foreach ($airports as $code => $airport)
                                    <option value="{{ $code }}" {{ $origin == $code ? 'selected' : '' }}>
                                        {{ $code }} - {{ $airport }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="origin"><i class="bi bi-airplane-fill me-2"></i>Dari</label>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="swap-container">
                            <button type="button" class="swap-button" onclick="swapAirports()">
                                <i class="bi bi-arrow-left-right"></i>
                            </button>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-floating">
                            <select id="destination" name="destination" class="form-select" required>
                                @foreach ($airports as $code => $airport)
                                    <option value="{{ $code }}" {{ $destination == $code ? 'selected' : '' }}>
                                        {{ $code }} - {{ $airport }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="destination"><i class="bi bi-geo-alt-fill me-2"></i>Ke</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="search-btn">
                            <i class="bi bi-search me-2"></i>Cari Penerbangan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="container main-container">
        <!-- Removed duplicate search card from here -->

        <div class="section-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h3 class="fw-bold text-dark mb-0">
                        <i class="bi bi-list-ul me-2"></i>Penerbangan {{ $origin }} → {{ $destination }}
                    </h3>
                </div>
                <div class="col-md-4 text-md-end">
                    <small class="text-muted">
                        <i class="bi bi-clock me-1"></i>
                        Diperbarui: {{ now()->format('d M Y, H:i') }}
                    </small>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                @forelse ($flights as $index => $flight)
                    <div class="flight-card">
                        @if ($loop->first)
                            <div class="badge-direct">Terbaik</div>
                        @endif

                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <div class="airline-info">
                                    <img src="{{ $flight['logo'] }}" alt="{{ $flight['airline'] }}" class="airline-logo"
                                        onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjQwIiBoZWlnaHQ9IjQwIiBmaWxsPSIjZjhmOWZhIi8+CjxwYXRoIGQ9Im0yMCAzIDEyIDEyLTEyIDEyLTEyLTEyIDEyLTEyeiIgZmlsbD0iIzY0NzQ4YiIvPgo8L3N2Zz4K'">
                                    <div class="airline-details">
                                        <h6>{{ $flight['airline'] }}</h6>
                                        <p class="flight-number">{{ $flight['flightNumber'] }}</p>
                                        <div class="baggage-info">
                                            @if (isset($flight['carryOnBaggage']) && $flight['carryOnBaggage']['included'])
                                                <div class="baggage-item included">
                                                    <i class="bi bi-briefcase"></i>
                                                    <span>{{ $flight['carryOnBaggage']['weight'] ?? '7kg' }}</span>
                                                </div>
                                            @endif
                                            @if (isset($flight['checkedBaggage']) && $flight['checkedBaggage']['included'])
                                                <div class="baggage-item included">
                                                    <i class="bi bi-suitcase2"></i>
                                                    <span>{{ $flight['checkedBaggage']['weight'] ?? '20kg' }}</span>
                                                </div>
                                            @else
                                                <div class="baggage-item">
                                                    <i class="bi bi-suitcase2"></i>
                                                    <span>Tidak termasuk</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="flight-route">
                                    <div class="time-info">
                                        <p class="time">{{ \Carbon\Carbon::parse($flight['departTime'])->format('H:i') }}
                                        </p>
                                        <p class="date">{{ \Carbon\Carbon::parse($flight['departTime'])->format('d M') }}
                                        </p>
                                        <small class="text-muted">{{ $origin }}</small>
                                    </div>

                                    <div class="route-line">
                                        <i class="bi bi-airplane airplane-icon"></i>
                                        <div class="duration">
                                            @php
                                                $depart = \Carbon\Carbon::parse($flight['departTime']);
                                                $arrive = \Carbon\Carbon::parse($flight['arrivalTime']);
                                                $hours = $depart->diffInHours($arrive);
                                                $minutes = $depart->diffInMinutes($arrive) % 60;
                                            @endphp
                                            {{ $hours }}j {{ $minutes }}m
                                        </div>
                                    </div>

                                    <div class="time-info">
                                        <p class="time">
                                            {{ \Carbon\Carbon::parse($flight['arrivalTime'])->format('H:i') }}</p>
                                        <p class="date">
                                            {{ \Carbon\Carbon::parse($flight['arrivalTime'])->format('d M') }}</p>
                                        <small class="text-muted">{{ $destination }}</small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="price-section">
                                    <p class="price" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Harga dapat berubah sewaktu-waktu dan berbeda di Agoda tergantung promo yang sedang berlangsung">
                                        Rp {{ number_format($flight['total'], 0, ',', '.') }}
                                        <i class="bi bi-info-circle ms-2 text-muted" style="font-size: 0.8em;"></i>
                                    </p>
                                    <p class="price-label">per orang</p>
                                    @if (isset($flight['usdPrice']))
                                        <small class="text-muted d-block">≈
                                            ${{ number_format($flight['usdPrice'], 2) }}</small>
                                    @endif
                                    <button type="button" class="btn select-btn"
                                        onclick="window.open('{{ $flight['bookingUrl'] ?? '#' }}', '_blank')">
                                        <i class="bi bi-box-arrow-up-right me-1"></i>Booking via Agoda
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Collapse Details Button -->
                        <div class="row mt-3">
                            <div class="col-12">
                                <button class="btn btn-link text-decoration-none p-0 flight-details-toggle" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#flightDetails{{ $index }}"
                                    aria-expanded="false">
                                    <div class="btn">

                                        <span class="toggle-text">Lihat detail penerbangan</span>
                                        <i class="bi bi-chevron-down ms-1 toggle-icon"></i>
                                    </div>
                                </button>
                            </div>
                        </div>

                        <!-- Collapsible Flight Details -->
                        <div class="collapse" id="flightDetails{{ $index }}">
                            <div class="flight-details-content mt-3 pt-3 border-top">
                                <div class="flight-timeline">
                                    <!-- Departure -->
                                    <div class="timeline-item">
                                        <div class="timeline-time">
                                            <strong>{{ \Carbon\Carbon::parse($flight['departTime'])->format('H:i') }}</strong>
                                            <div class="text-muted small">
                                                {{ \Carbon\Carbon::parse($flight['departTime'])->format('d M') }}</div>
                                        </div>
                                        <div class="timeline-dot"></div>
                                        <div class="timeline-content">
                                            <div class="fw-semibold">{{ $origin }} • Bandara Sultan Babullah</div>
                                            <div class="text-muted small">
                                                <i class="bi bi-airplane-fill me-1"></i>
                                                {{ $flight['airline'] }} • Economy • {{ $flight['flightNumber'] }}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Transit (if any) -->
                                    @if (isset($flight['transit']) && $flight['transit'])
                                        <div class="timeline-item">
                                            <div class="timeline-time">
                                                <div class="text-muted small">Transit 6j 20m</div>
                                            </div>
                                            <div class="timeline-dot transit"></div>
                                            <div class="timeline-content">
                                                <div class="text-muted">Makassar (UPG) • Bandara Internasional Sultan
                                                    Hasanuddin</div>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Arrival -->
                                    <div class="timeline-item">
                                        <div class="timeline-time">
                                            <strong>{{ \Carbon\Carbon::parse($flight['arrivalTime'])->format('H:i') }}</strong>
                                            <div class="text-muted small">
                                                {{ \Carbon\Carbon::parse($flight['arrivalTime'])->format('d M') }}</div>
                                        </div>
                                        <div class="timeline-dot"></div>
                                        <div class="timeline-content">
                                            <div class="fw-semibold">{{ $destination }} • Bandara Internasional
                                                Soekarno-Hatta</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Baggage Details -->
                                <div class="baggage-details mt-4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="baggage-section">
                                                <div class="baggage-title">
                                                    <i class="bi bi-briefcase"></i>
                                                    Bagasi kabin
                                                </div>
                                                <div class="baggage-specs">
                                                    @if (isset($flight['carryOnBaggage']) && $flight['carryOnBaggage']['included'])
                                                        <i class="bi bi-check-circle text-success me-1"></i>
                                                        {{ $flight['carryOnBaggage']['weight'] ?? '7kg' }} •
                                                        {{ $flight['carryOnBaggage']['dimensions'] ?? '35×30×20 cm' }}
                                                    @else
                                                        <i class="bi bi-x-circle text-danger me-1"></i>
                                                        Tidak termasuk
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="baggage-section">
                                                <div class="baggage-title">
                                                    <i class="bi bi-suitcase2"></i>
                                                    Bagasi check-in
                                                </div>
                                                <div class="baggage-specs">
                                                    @if (isset($flight['checkedBaggage']) && $flight['checkedBaggage']['included'])
                                                        <i class="bi bi-check-circle text-success me-1"></i>
                                                        {{ $flight['checkedBaggage']['weight'] ?? '20kg' }} gratis
                                                    @else
                                                        <i class="bi bi-x-circle text-danger me-1"></i>
                                                        Tidak termasuk • Beli terpisah
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="flight-card">
                        <div class="no-results">
                            <i class="bi bi-airplane-engines"></i>
                            <h4>Tidak ada penerbangan ditemukan</h4>
                            <p>Coba ubah rute penerbangan atau periksa koneksi internet Anda</p>
                            <button type="button" class="btn search-btn" style="width: auto; padding: 10px 30px;"
                                onclick="location.reload()">
                                <i class="bi bi-arrow-clockwise me-2"></i>Coba Lagi
                            </button>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        function swapAirports() {
            const origin = document.getElementById('origin');
            const destination = document.getElementById('destination');

            const tempValue = origin.value;
            origin.value = destination.value;
            destination.value = tempValue;
        }

        // Add loading state to search button
        document.querySelector('form').addEventListener('submit', function() {
            const btn = document.querySelector('.search-btn');
            btn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Mencari...';
            btn.disabled = true;
        });

        // Initialize Bootstrap tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
@endsection
