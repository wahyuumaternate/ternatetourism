<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @stack('meta')

    {{-- favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('favicon-32x32.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ asset('favicon-16x16.png') }}" sizes="16x16" />
    <link href="{{ asset('favicon.ico') }}" rel="icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Fancyapps CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <link rel="stylesheet" href="{{ asset('assets/styles.css') }}" />
    <!-- Custom CSS -->

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />

    <link rel="stylesheet" href="{{ asset('dataaos/aos.css') }}">
    <!-- CSS untuk Leaflet -->
    <link rel="stylesheet" href="{{ asset('leaflet/leaflet.css') }}" />
    @stack('css')
    <link href="{{ asset('admin/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

    <!-- Tambahkan di bagian head -->
    <link rel="preload" as="image" href="{{ asset('assets/LOGOWHITE.png') }}">
    <link rel="preload" href="{{ asset('assets/id.png') }}" as="image">
    <link rel="preload" href="{{ asset('assets/en.png') }}" as="image">
    <link rel="preload" href="{{ asset('assets/ar.png') }}" as="image">

    <style>
        /* Style untuk dropdown items dengan icon */
        .dropdown-item {
            display: flex;
            align-items: center;
            padding: 8px 16px;
        }

        .dropdown-item i {
            margin-right: 8px;
            width: 16px;
            text-align: center;
        }

        /* Hapus default arrow Bootstrap dan style untuk custom icon */
        .dropdown-toggle::after {
            display: none !important;
        }

        .dropdown-icon {
            margin-left: 0.3rem;
            transition: all 0.2s ease;
            font-size: 0.9rem;
        }



        /* Style untuk navbar yang lebih clean */
        .nav-link {
            font-weight: 500;
            transition: color 0.15s ease-in-out;
        }
    </style>
</head>

<body>
    <button id="backToTopBtn" onclick="scrollToTop()"> <i class="bi bi-arrow-up arrow-icon"></i></button>

    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top py-3">
        <div class="container">
            <a href="/" aria-label="Tourism Homepage">
                <img class="navbar-brand" src="{{ asset('assets/logo.png') }}" alt="Tourism Logo" width="80"
                    height="auto" loading="eager">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">{{ __('pesan.home') }}</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profilDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                            {{ __('pesan.profile') }}
                            <i class="bi bi-arrow-down-circle dropdown-icon"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="profilDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('profil', 'visi-misi') }}">
                                    <i class="bi bi-bullseye"></i>
                                    {{ __('pesan.vision_mission') }}
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('profil', 'struktur') }}">
                                    <i class="bi bi-diagram-3"></i>
                                    {{ __('pesan.organization') }}
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('destinasi.all') }}">{{ __('pesan.destination') }}</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/ekraf">{{ __('pesan.creative') }}</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('events.all') }}">{{ __('pesan.events') }}</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('berita.all') }}">{{ __('pesan.news') }}</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="mediaDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                            {{ __('pesan.media') }}
                            <i class="bi bi-arrow-down-circle dropdown-icon"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="mediaDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('frontFoto') }}">
                                    <i class="bi bi-images"></i>
                                    {{ __('pesan.gallery') }}
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('frontVideo') }}">
                                    <i class="bi bi-play-circle"></i>
                                    {{ __('pesan.video') }}
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="fasilitasDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                            {{ __('pesan.facilities') }}
                            <i class="bi bi-arrow-down-circle dropdown-icon"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="fasilitasDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('fasilitas.front', 'hotel') }}">
                                    <i class="bi bi-building"></i>
                                    {{ __('pesan.hotel') }}
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('fasilitas.front', 'travel') }}">
                                    <i class="bi bi-airplane"></i>
                                    {{ __('pesan.travel') }}
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('fasilitas.front', 'cafe-restorant') }}">
                                    <i class="bi bi-cup-hot"></i>
                                    {{ __('pesan.restaurant') }}
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('fasilitas.front', 'guide') }}">
                                    <i class="bi bi-person-badge"></i>
                                    {{ __('pesan.guide') }}
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('fasilitas.front', 'rent-car') }}">
                                    <i class="bi bi-car-front"></i>
                                    {{ __('pesan.rent_car') }}
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Language Switcher -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true"
                            aria-label="Select Language">
                            <img src="{{ asset('assets/' . (app()->getLocale() == 'id' ? 'id.png' : (app()->getLocale() == 'en' ? 'en.png' : 'ar.png'))) }}"
                                alt="Current Language" width="20" class="me-2">
                            <span class="d-none d-md-inline">
                                {{ app()->getLocale() == 'id' ? 'ID' : (app()->getLocale() == 'en' ? 'EN' : 'AR') }}
                            </span>
                            <i class="bi bi-arrow-down-circle dropdown-icon"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                            <li>
                                <a class="dropdown-item {{ app()->getLocale() == 'id' ? 'active-nav' : '' }}"
                                    href="{{ route('lang.switch', 'id') }}">
                                    <img src="{{ asset('assets/id.png') }}" alt="Indonesian Flag" class="me-2"
                                        width="20">
                                    Indonesia
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ app()->getLocale() == 'en' ? 'active-nav' : '' }}"
                                    href="{{ route('lang.switch', 'en') }}">
                                    <img src="{{ asset('assets/en.png') }}" alt="English Flag" class="me-2"
                                        width="20">
                                    English
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ app()->getLocale() == 'ar' ? 'active-nav' : '' }}"
                                    href="{{ route('lang.switch', 'ar') }}">
                                    <img src="{{ asset('assets/ar.png') }}" alt="Arabic Flag" class="me-2"
                                        width="20">
                                    العربية
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- hero --}}

    @yield('body')


    <!-- Footer -->
    @include('frontend.layouts.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Fancyapps JS -->
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
        Fancybox.bind("[data-fancybox]", {
            // Your custom options
        });

        window.onscroll = function() {
            showBackToTopBtn();
        };

        function showBackToTopBtn() {
            if (
                document.body.scrollTop > 20 ||
                document.documentElement.scrollTop > 20
            ) {
                document.getElementById("backToTopBtn").style.display =
                    "block";
            } else {
                document.getElementById("backToTopBtn").style.display =
                    "none";
            }
        }

        function scrollToTop() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
    <!-- OWL Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{ asset('dataaos/aos.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init();

            // Handle dropdown icon changes
            const dropdowns = document.querySelectorAll('.dropdown-toggle');
            dropdowns.forEach(dropdown => {
                dropdown.addEventListener('show.bs.dropdown', function() {
                    const icon = this.querySelector('.dropdown-icon');
                    if (icon) {
                        icon.classList.remove('bi-arrow-down-circle');
                        icon.classList.add('bi-arrow-up-circle');
                    }
                });

                dropdown.addEventListener('hide.bs.dropdown', function() {
                    const icon = this.querySelector('.dropdown-icon');
                    if (icon) {
                        icon.classList.remove('bi-arrow-up-circle');
                        icon.classList.add('bi-arrow-down-circle');
                    }
                });
            });
        });
    </script>

    <!-- JS untuk Leaflet -->
    <script src="{{ asset('leaflet/leaflet.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".owl-carousel").owlCarousel({
                loop: true,
                margin: 20,
                nav: false,
                autoplay: true,
                autoplayTimeout: 3000,
                responsive: {
                    0: {
                        items: 2, // Jumlah item untuk layar kecil
                    },
                    768: {
                        items: 4, // Jumlah item untuk tablet
                    },
                    1024: {
                        items: 5, // Jumlah item untuk desktop
                    },
                },
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const navbar = document.querySelector('.navbar');
            navbar.classList.add('navbar-loaded');

            // Preload gambar bendera
            const flagImages = ['id.png', 'en.png', 'ar.png'];
            flagImages.forEach(img => {
                const image = new Image();
                image.src = `/assets/${img}`;
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
