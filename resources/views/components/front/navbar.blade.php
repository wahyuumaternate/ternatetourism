@props(['transparent' => false])

@php
    $locale = app()->getLocale();
    $links = [
        ['label' => __('pesan.home'), 'href' => url('/')],
        ['label' => __('wt.nav_experience'), 'href' => url('/') . '#experience'],
        ['label' => __('wt.nav_culture'), 'href' => route('berita.all')],
        ['label' => __('wt.nav_culinary'), 'href' => route('fasilitas.front', 'cafe-restorant')],
        ['label' => __('wt.nav_events'), 'href' => route('events.all')],
    ];
    $explore = [
        ['label' => __('pesan.vision_mission'), 'href' => route('profil', 'visi-misi')],
        ['label' => __('pesan.organization'), 'href' => route('profil', 'struktur')],
        ['label' => __('pesan.creative'), 'href' => route('ekraf.index')],
        ['label' => __('pesan.gallery'), 'href' => route('frontFoto')],
        ['label' => __('pesan.video'), 'href' => route('frontVideo')],
        ['label' => __('wt.footer_contact'), 'href' => route('kontak.create')],
    ];
    $languages = ['id' => 'ID', 'en' => 'EN', 'ar' => 'AR'];
@endphp

<header x-data="{ scrolled: false, open: false, more: false, lang: false }"
    x-init="scrolled = window.scrollY > 24"
    @scroll.window.passive="scrolled = window.scrollY > 24"
    @keydown.escape.window="open = false; more = false; lang = false"
    :class="(scrolled || open || !{{ $transparent ? 'true' : 'false' }}) ? 'bg-white/90 text-volcanic backdrop-blur-md border-b border-black/5' : 'bg-transparent text-white border-b border-transparent'"
    class="fixed inset-x-0 top-0 z-50 transition-colors duration-300">
    <nav class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:h-20 lg:px-8" aria-label="{{ __('wt.brand') }}">
        <a href="{{ url('/') }}" class="text-lg font-bold sm:text-xl">
            Wonderful <span class="text-accent">Ternate</span>
        </a>

        <ul class="hidden items-center gap-7 text-sm font-medium lg:flex">
            @foreach ($links as $link)
                <li><a href="{{ $link['href'] }}" class="transition hover:text-primary">{{ $link['label'] }}</a></li>
            @endforeach
            <li class="relative" @click.outside="more = false">
                <button type="button" @click="more = !more" :aria-expanded="more" aria-haspopup="true"
                    class="inline-flex items-center gap-1 transition hover:text-primary">
                    {{ __('wt.nav_explore') }}
                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M5.5 7.5 10 12l4.5-4.5-1-1L10 10 6.5 6.5z"/></svg>
                </button>
                <ul x-show="more" x-cloak x-transition.opacity.duration.200ms
                    class="absolute end-0 mt-4 w-56 rounded-2xl bg-white p-2 text-volcanic shadow-xl ring-1 ring-black/5">
                    @foreach ($explore as $item)
                        <li><a href="{{ $item['href'] }}" class="block rounded-xl px-3 py-2 text-sm hover:bg-surface">{{ $item['label'] }}</a></li>
                    @endforeach
                </ul>
            </li>
        </ul>

        <div class="flex items-center gap-2 sm:gap-3">
            <div class="relative" @click.outside="lang = false">
                <button type="button" @click="lang = !lang" :aria-expanded="lang" aria-haspopup="true"
                    aria-label="{{ __('wt.language') }}"
                    class="rounded-full px-3 py-2 text-xs font-semibold tracking-wider transition hover:text-primary">
                    {{ $languages[$locale] ?? 'ID' }}
                </button>
                <ul x-show="lang" x-cloak x-transition.opacity.duration.200ms
                    class="absolute end-0 mt-2 w-36 rounded-2xl bg-white p-2 text-volcanic shadow-xl ring-1 ring-black/5">
                    @foreach (config('languages') as $code => $name)
                        <li>
                            <a href="{{ route('lang.switch', $code) }}" hreflang="{{ $code }}"
                                @class(['block rounded-xl px-3 py-2 text-sm hover:bg-surface', 'font-semibold text-primary' => $locale === $code])>{{ $name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <a href="{{ route('destinasi.all') }}" class="btn-primary hidden !py-2.5 sm:inline-flex">{{ __('wt.plan_trip') }}</a>

            <button type="button" @click="open = !open" :aria-expanded="open" aria-controls="mobile-menu"
                aria-label="{{ __('wt.menu') }}" class="rounded-full p-2 lg:hidden">
                <svg x-show="!open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16"/></svg>
                <svg x-show="open" x-cloak class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" d="M6 6l12 12M18 6 6 18"/></svg>
            </button>
        </div>
    </nav>

    <div id="mobile-menu" x-show="open" x-cloak x-transition.opacity.duration.300ms
        class="fixed inset-x-0 bottom-0 top-16 overflow-y-auto bg-volcanic px-6 py-8 text-white lg:hidden">
        <ul class="space-y-1 font-display text-3xl">
            @foreach ($links as $link)
                <li><a href="{{ $link['href'] }}" @click="open = false" class="block py-3">{{ $link['label'] }}</a></li>
            @endforeach
        </ul>
        <p class="eyebrow mt-8">{{ __('wt.nav_explore') }}</p>
        <ul class="mt-3 grid grid-cols-2 gap-2 text-sm">
            @foreach ($explore as $item)
                <li><a href="{{ $item['href'] }}" class="block rounded-xl bg-white/10 px-4 py-3">{{ $item['label'] }}</a></li>
            @endforeach
        </ul>
        <a href="{{ route('destinasi.all') }}" class="btn-primary mt-8 w-full">{{ __('wt.plan_trip') }}</a>
    </div>
</header>
