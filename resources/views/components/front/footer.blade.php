@php
    $social = [
        'Instagram' => 'https://www.instagram.com/wonderfulternate',
        'Facebook' => 'https://www.facebook.com/61550834804227',
        'YouTube' => 'https://www.youtube.com/@wonderfulternate',
        'TikTok' => 'https://www.tiktok.com/@wonderfulternate',
    ];
@endphp

<footer class="bg-volcanic text-white/75">
    <div class="mx-auto grid max-w-7xl gap-12 px-4 py-16 sm:px-6 lg:grid-cols-4 lg:px-8">
        <div class="lg:col-span-2">
            <p class="font-display text-3xl text-white">Wonderful <span class="text-accent">Ternate</span></p>
            <p class="mt-3 max-w-md">{{ __('wt.footer_text') }}</p>
            <div class="mt-8 flex flex-wrap items-center gap-6">
                <img src="{{ asset('assets/logo_pemkot.png') }}" alt="{{ __('wt.footer_gov') }}" class="h-14 w-auto" loading="lazy" decoding="async">
                <img src="{{ asset('assets/Pesona-Indonesia-Logo-Single-Color-Version-White.png') }}" alt="Pesona Indonesia" class="h-10 w-auto" loading="lazy" decoding="async">
            </div>
        </div>

        <nav aria-label="{{ __('wt.footer_explore') }}">
            <p class="eyebrow">{{ __('wt.footer_explore') }}</p>
            <ul class="mt-4 space-y-2 text-sm">
                <li><a class="hover:text-accent" href="{{ route('destinasi.all') }}">{{ __('wt.nav_destinations') }}</a></li>
                <li><a class="hover:text-accent" href="{{ route('berita.all') }}">{{ __('wt.nav_culture') }}</a></li>
                <li><a class="hover:text-accent" href="{{ route('fasilitas.front', 'cafe-restorant') }}">{{ __('wt.nav_culinary') }}</a></li>
                <li><a class="hover:text-accent" href="{{ route('events.all') }}">{{ __('wt.nav_events') }}</a></li>
                <li><a class="hover:text-accent" href="{{ route('frontFoto') }}">{{ __('pesan.gallery') }}</a></li>
            </ul>
        </nav>

        <div>
            <p class="eyebrow">{{ __('wt.footer_info') }}</p>
            <ul class="mt-4 space-y-2 text-sm">
                <li><a class="hover:text-accent" href="{{ route('kontak.create') }}">{{ __('wt.footer_contact') }}</a></li>
                <li><a class="hover:text-accent" href="{{ route('profil', 'visi-misi') }}">{{ __('pesan.vision_mission') }}</a></li>
            </ul>
            <p class="eyebrow mt-8">{{ __('wt.footer_social') }}</p>
            <ul class="mt-4 flex flex-wrap gap-x-4 gap-y-2 text-sm">
                @foreach ($social as $name => $url)
                    <li><a class="hover:text-accent" href="{{ $url }}" target="_blank" rel="noopener noreferrer">{{ $name }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="border-t border-white/10 py-6 text-center text-xs text-white/60">
        &copy; {{ __('pesan.copyright') }}
    </div>
</footer>
