<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @if (request() == '/')
        <title>Ternate Tourism</title>
    @endif
    @stack('meta')

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

</head>

<body>
    <button id="backToTopBtn" onclick="scrollToTop()">Up</button>

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
