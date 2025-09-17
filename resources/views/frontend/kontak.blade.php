@extends('frontend.layouts.main')
@push('meta')
    <!-- SEO Meta Tags -->
    <title>Hubungi Kami - Wonderful Ternate</title>
    <meta name="description"
        content="Hubungi Tim Wonderful Ternate untuk informasi wisata, saran, atau bantuan perjalanan Anda di Kota Ternate. Kami siap membantu 24/7.">
    <meta name="keywords"
        content="kontak wonderful ternate, hubungi kami,  ternate, informasi wisata ternate, bantuan wisata">
    <meta name="author" content="Wonderful Ternate">
    <meta name="robots" content="index, follow">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Hubungi Kami - Wonderful Ternate">
    <meta property="og:description"
        content="Hubungi Tim Wonderful Ternate untuk informasi wisata, saran, atau bantuan perjalanan Anda di Kota Ternate.">
    <meta property="og:image" content="{{ asset('assets/kora_kora.jpg') }}">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:site_name" content="Wonderful Ternate">
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Hubungi Kami - Wonderful Ternate">
    <meta name="twitter:description"
        content="Hubungi Tim Wonderful Ternate untuk informasi wisata, saran, atau bantuan perjalanan Anda di Kota Ternate.">
    <meta name="twitter:image" content="{{ asset('assets/kora_kora.jpg') }}">
    <!-- Additional Meta Tags for Location -->
    <meta name="geo.region" content="ID-MU">
    <meta name="geo.placename" content="Ternate">
    <meta name="geo.position" content="0.7833;127.3667">
    <meta name="ICBM" content="0.7833, 127.3667">
    <script src="https://hcaptcha.com/1/api.js" async defer></script>
@endpush

@push('css')
    <style>
        body {
            padding-top: 100px;
            min-height: 100vh;
        }

        .contact-hero {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.3)),
                url('{{ asset('assets/kora_kora.jpg') }}') center/cover;
            height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            position: relative;
            margin-bottom: -100px;
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
        }

        .contact-container {
            position: relative;
            z-index: 10;
            margin-top: 100px;
            padding: 100px 0px;
        }

        .contact-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
        }

        .contact-form-section {
            padding: 50px;
        }

        .contact-info-section {
            background: linear-gradient(135deg, #ff6500 0%, #ff8500 100%);
            color: white;
            padding: 50px;
            position: relative;
        }

        .contact-info-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><polygon fill="rgba(255,255,255,0.1)" points="0,0 1000,300 1000,1000 0,700"/></svg>');
            pointer-events: none;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 15px 20px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
        }

        .form-control:focus {
            border-color: #ff6500;
            box-shadow: 0 0 0 0.2rem rgba(255, 101, 0, 0.25);
            background: white;
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-submit {
            background: linear-gradient(135deg, #ff6500 0%, #ff8500 100%);
            border: none;
            border-radius: 12px;
            padding: 15px 40px;
            font-weight: 600;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(255, 101, 0, 0.3);
            width: 100%;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(255, 101, 0, 0.4);
        }

        .contact-info-item {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            backdrop-filter: blur(5px);
        }

        .contact-info-icon {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            font-size: 24px;
        }

        .contact-info-text h5 {
            margin: 0 0 5px 0;
            font-weight: 600;
        }

        .contact-info-text p {
            margin: 0;
            opacity: 0.9;
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

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .success-alert {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border: none;
            border-radius: 12px;
            color: white;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.3);
        }

        .error-alert {
            background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
            border: none;
            border-radius: 12px;
            color: white;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 8px 25px rgba(220, 53, 69, 0.3);
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 15px;
            background: linear-gradient(135deg, #333 0%, #666 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .form-text {
            color: #6c757d;
            font-size: 14px;
            margin-top: 8px;
        }

        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.5rem;
            }

            .contact-form-section,
            .contact-info-section {
                padding: 30px;
            }

            .contact-hero {
                height: 50vh;
                margin-bottom: -80px;
            }
        }

        .input-group-text {
            background: rgba(255, 101, 0, 0.1);
            border: 2px solid #e9ecef;
            border-right: none;
            border-radius: 12px 0 0 12px;
            color: #ff6500;
        }

        .input-group .form-control {
            border-left: none;
            border-radius: 0 12px 12px 0;
        }

        .character-count {
            font-size: 12px;
            color: #6c757d;
            text-align: right;
            margin-top: 5px;
        }

        /* Minimal hCaptcha styling - hanya untuk memastikan terlihat */
        .hcaptcha-container {
            margin: 20px 0;
            text-align: center;
        }
    </style>
@endpush

@section('body')
    <!-- Hero Section -->
    <div class="contact-hero">
        <div class="floating-elements">
            <div class="floating-circle"></div>
            <div class="floating-circle"></div>
            <div class="floating-circle"></div>
        </div>
        <div class="hero-content">
            <h1 data-aos="fade-up">Hubungi Kami</h1>
            {{-- <p data-aos="fade-up" data-aos-delay="100">
                Kami siap membantu perjalanan wisata Anda di Kota Ternate
            </p> --}}
        </div>
    </div>

    <!-- Contact Form Section -->
    <div class="contact-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="contact-card" data-aos="fade-up">
                        <div class="row g-0">
                            <!-- Contact Form -->
                            <div class="col-lg-7">
                                <div class="contact-form-section">
                                    <h2 class="section-title mb-4">Kirim Pesan</h2>
                                    <p class="text-muted mb-4">
                                        Sampaikan pertanyaan, saran, atau masukan Anda kepada kami.
                                    </p>

                                    <!-- Success Message -->
                                    @if (session('success'))
                                        <div class="alert success-alert" data-aos="fade-in">
                                            <i class="bi bi-check-circle-fill me-2"></i>
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    <!-- Error Message -->
                                    @if (session('error'))
                                        <div class="alert error-alert" data-aos="fade-in">
                                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    <form action="{{ route('kontak.store') }}" method="POST" id="contactForm">
                                        @csrf

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nama" class="form-label">
                                                        <i class="bi bi-person-fill me-1"></i> Nama Lengkap *
                                                    </label>
                                                    <input type="text"
                                                        class="form-control @error('nama') is-invalid @enderror"
                                                        id="nama" name="nama" value="{{ old('nama') }}"
                                                        placeholder="Masukkan nama lengkap Anda" required>
                                                    @error('nama')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email" class="form-label">
                                                        <i class="bi bi-envelope-fill me-1"></i> Email *
                                                    </label>
                                                    <input type="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        id="email" name="email" value="{{ old('email') }}"
                                                        placeholder="nama@example.com" required>
                                                    @error('email')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="telepon" class="form-label">
                                                <i class="bi bi-telephone-fill me-1"></i> Nomor Telepon
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text">+62</span>
                                                <input type="tel"
                                                    class="form-control @error('telepon') is-invalid @enderror"
                                                    id="telepon" name="telepon" value="{{ old('telepon') }}"
                                                    placeholder="812-3456-7890">
                                            </div>
                                            @error('telepon')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">Opsional - untuk kontak lebih cepat</div>
                                        </div>

                                        <div class="form-group">
                                            <label for="subjek" class="form-label">
                                                <i class="bi bi-tag-fill me-1"></i> Subjek *
                                            </label>
                                            <select class="form-control @error('subjek') is-invalid @enderror"
                                                id="subjek" name="subjek" required>
                                                <option value="">Pilih kategori pesan</option>
                                                <option value="Informasi Wisata"
                                                    {{ old('subjek') == 'Informasi Wisata' ? 'selected' : '' }}>
                                                    Informasi Wisata
                                                </option>
                                                <option value="Bantuan Perjalanan"
                                                    {{ old('subjek') == 'Bantuan Perjalanan' ? 'selected' : '' }}>
                                                    Bantuan Perjalanan
                                                </option>
                                                <option value="Saran & Masukan"
                                                    {{ old('subjek') == 'Saran & Masukan' ? 'selected' : '' }}>
                                                    Saran & Masukan
                                                </option>
                                                <option value="Kerjasama"
                                                    {{ old('subjek') == 'Kerjasama' ? 'selected' : '' }}>
                                                    Kerjasama
                                                </option>
                                                <option value="Keluhan"
                                                    {{ old('subjek') == 'Keluhan' ? 'selected' : '' }}>
                                                    Keluhan
                                                </option>
                                                <option value="Lainnya"
                                                    {{ old('subjek') == 'Lainnya' ? 'selected' : '' }}>
                                                    Lainnya
                                                </option>
                                            </select>
                                            @error('subjek')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="pesan" class="form-label">
                                                <i class="bi bi-chat-text-fill me-1"></i> Pesan *
                                            </label>
                                            <textarea class="form-control @error('pesan') is-invalid @enderror" id="pesan" name="pesan" rows="6"
                                                placeholder="Tulis pesan Anda di sini... (minimal 10 karakter)" required maxlength="1000">{{ old('pesan') }}</textarea>
                                            <div class="character-count">
                                                <span id="charCount">0</span>/1000 karakter
                                            </div>
                                            @error('pesan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- hCaptcha Widget -->
                                        <div class="hcaptcha-container">
                                            <div class="flex justify-center md:justify-start">
                                                <div class="h-captcha"
                                                    data-sitekey="{{ config('services.hcaptcha.sitekey_test') }}"></div>
                                            </div>
                                            @error('h-captcha-response')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-submit" id="submitBtn">
                                            <i class="bi bi-send-fill me-2"></i>
                                            <span class="btn-text">Kirim Pesan</span>
                                            <div class="spinner-border spinner-border-sm d-none" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Contact Info -->
                            <div class="col-lg-5">
                                <div class="contact-info-section">
                                    <h3 class="mb-4">Informasi Kontak</h3>
                                    <p class="mb-4 opacity-75">
                                        Hubungi kami melalui berbagai channel yang tersedia.
                                    </p>

                                    <div class="contact-info-item" data-aos="fade-left" data-aos-delay="100">
                                        <div class="contact-info-icon">
                                            <i class="bi bi-geo-alt-fill"></i>
                                        </div>
                                        <div class="contact-info-text">
                                            <h5>Alamat</h5>
                                            <p>Kalumpang, Kec. Ternate Tengah,<br> Kota Ternate, Maluku Utara</p>
                                        </div>
                                    </div>

                                    <div class="contact-info-item" data-aos="fade-left" data-aos-delay="200">
                                        <div class="contact-info-icon">
                                            <i class="bi bi-telephone-fill"></i>
                                        </div>
                                        <div class="contact-info-text">
                                            <h5>Telepon</h5>
                                            <p>+62 812-6118-0672 </p>
                                        </div>
                                    </div>

                                    <div class="contact-info-item" data-aos="fade-left" data-aos-delay="300">
                                        <div class="contact-info-icon">
                                            <i class="bi bi-envelope-fill"></i>
                                        </div>
                                        <div class="contact-info-text">
                                            <h5>Email</h5>
                                            <p>mediacenterdisparkotaternate@gmail.com<br>disparternatekota@gmail.com</p>
                                        </div>
                                    </div>

                                    <div class="contact-info-item" data-aos="fade-left" data-aos-delay="400">
                                        <div class="contact-info-icon">
                                            <i class="bi bi-clock-fill"></i>
                                        </div>
                                        <div class="contact-info-text">
                                            <h5>Jam Operasional</h5>
                                            <p>Senin - Jum'at: 08:00 - 17:00</p>
                                        </div>
                                    </div>

                                    <div class="contact-info-item" data-aos="fade-left" data-aos-delay="500">
                                        <div class="contact-info-icon">
                                            <i class="bi bi-whatsapp"></i>
                                        </div>
                                        <div class="contact-info-text">
                                            <h5>WhatsApp</h5>
                                            <p>
                                                <a href="https://wa.me/6281234567890"
                                                    class="text-white text-decoration-none" target="_blank">
                                                    +62 812-6118-0672
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('contactForm');
            const submitBtn = document.getElementById('submitBtn');
            const btnText = submitBtn.querySelector('.btn-text');
            const spinner = submitBtn.querySelector('.spinner-border');
            const pesanTextarea = document.getElementById('pesan');
            const charCount = document.getElementById('charCount');

            // Character counter
            pesanTextarea.addEventListener('input', function() {
                const currentLength = this.value.length;
                charCount.textContent = currentLength;

                if (currentLength > 900) {
                    charCount.style.color = '#ff6500';
                } else {
                    charCount.style.color = '#6c757d';
                }
            });

            // Form submission dengan validasi hCaptcha
            form.addEventListener('submit', function(e) {
                const hcaptchaResponse = document.querySelector('[name="h-captcha-response"]');

                if (!hcaptchaResponse || !hcaptchaResponse.value) {
                    e.preventDefault();
                    alert('Silakan verifikasi bahwa Anda bukan robot.');
                    return false;
                }

                submitBtn.disabled = true;
                btnText.classList.add('d-none');
                spinner.classList.remove('d-none');
            });

            // Auto-hide alerts
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => {
                        alert.remove();
                    }, 500);
                }, 5000);
            });

            // Phone number formatting
            const phoneInput = document.getElementById('telepon');
            phoneInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 0) {
                    value = value.replace(/(\d{3})(\d{4})(\d{4})/, '$1-$2-$3');
                }
                e.target.value = value;
            });
        });

        // hCaptcha callback functions
        function onHCaptchaSuccess(token) {
            console.log('hCaptcha berhasil diverifikasi');
        }

        function onHCaptchaExpired() {
            console.log('hCaptcha kedaluwarsa');
        }

        function onHCaptchaError(error) {
            console.error('hCaptcha error:', error);
        }
    </script>
@endpush
