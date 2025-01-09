<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @if (Request::is('/'))
        <title>Ternate Tourism</title>
    @endif
    @stack('meta')

    {{-- favicon --}}
    <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16" />

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
    <style>
        .pagination .page-link {
            color: #ff6500;
            /* Text color */
            border-color: #ff6500;
            /* Border color */
        }

        .pagination .page-item.active .page-link {
            background-color: #ff6500;
            /* Background color for active page */
            border-color: #ff6500;
            color: white;
            /* Text color for active page */
        }

        .pagination .page-link:hover {
            color: white;
            background-color: #ff660080;
            /* border-color: #ff6500; */
        }

        .social-icon {
            font-size: 2rem;
            /* Mengubah ukuran ikon */
            transition: color 0.3s;
            /* Efek transisi saat hover */
        }

        /* Warna untuk masing-masing ikon sosial media */
        .facebook {
            color: #3b5998;
            /* Warna Facebook */
        }

        .twitter {
            color: #1da1f2;
            /* Warna Twitter */
        }

        .instagram {
            color: #c32aa3;
            /* Warna Instagram */
        }

        .youtube {
            color: #ff0000;
            /* Warna YouTube */
        }

        .tiktok {
            color: #69c9d0;
            /* Warna TikTok */
        }

        /* Efek hover */
        .social-link:hover .social-icon {
            opacity: 0.8;
            /* Mengurangi ketebalan saat hover */
        }

        .hero {
            overflow: hidden;
        }

        /* You might also want to add this to ensure the carousel container itself handles overflow properly */
        #heroCarousel {
            overflow: hidden;
        }
    </style>
</head>

<body>
    <button id="backToTopBtn" onclick="scrollToTop()"> <i class="bi bi-arrow-up arrow-icon"></i></button>

    {{-- navbar --}}
    @include('frontend.layouts.navbar')
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
    @stack('scripts')
</body>

</html>
