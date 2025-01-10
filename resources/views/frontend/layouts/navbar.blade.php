<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
        <a href="/"><img class="navbar-brand" src="{{ asset('assets/TTE_TOURISM_LOGO.png') }}" alt=""
                width="80" /></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">{{ __('pesan.home') }}</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profilDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('pesan.profile') }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="profilDropdown">
                        <li>
                            <a class="dropdown-item"
                                href="{{ route('profil', 'visi-misi') }}">{{ __('pesan.vision_mission') }}</a>
                        </li>
                        <li>
                            <a class="dropdown-item"
                                href="{{ route('profil', 'struktur') }}">{{ __('pesan.organization') }}</a>
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
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('pesan.media') }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="mediaDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('frontFoto') }}">{{ __('pesan.gallery') }}</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('frontVideo') }}">{{ __('pesan.video') }}</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="fasilitasDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('pesan.facilities') }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="fasilitasDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('frontFoto') }}">{{ __('pesan.hotel') }}</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('frontFoto') }}">{{ __('pesan.travel') }}</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('frontFoto') }}">{{ __('pesan.restaurant') }}</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('frontFoto') }}">{{ __('pesan.umkm') }}</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('frontFoto') }}">{{ __('pesan.guide') }}</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('frontFoto') }}">{{ __('pesan.rent_car') }}</a>
                        </li>
                    </ul>
                </li>
                <!-- Language Switcher -->
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img src="{{ asset('assets/' . (app()->getLocale() == 'id' ? 'id.png' : 'en.png')) }}"
                            alt="Language" width="20" class="me-2">
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                        <li>
                            <a class="dropdown-item {{ app()->getLocale() == 'id' ? 'active' : '' }}"
                                href="{{ route('lang.switch', 'id') }}">
                                <img src="{{ asset('assets/id.png') }}" alt="Indonesian" class="me-2"
                                    width="20">Indonesia
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ app()->getLocale() == 'en' ? 'active' : '' }}"
                                href="{{ route('lang.switch', 'en') }}">
                                <img src="{{ asset('assets/en.png') }}" alt="English" class="me-2"
                                    width="20">English
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
