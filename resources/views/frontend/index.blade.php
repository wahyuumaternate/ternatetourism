@extends('frontend.layouts.app')

@section('transparent_nav', '1')
@section('title', __('wt.brand') . ' — ' . __('wt.tagline'))
@section('description', __('wt.hero_sub'))

@push('head')
    <link rel="preload" as="image" href="{{ asset('assets/front/gamalama-1600.webp') }}"
        imagesrcset="{{ asset('assets/front/gamalama-800.webp') }} 800w, {{ asset('assets/front/gamalama-1600.webp') }} 1600w" imagesizes="100vw">
@endpush

@php
    $discovery = collect(config('tourism_placeholders.discovery'))->map(function (array $card) use ($culinaryImage, $spiceImage) {
        $card['src'] = match ($card['label']) {
            'wt.disc_culinary' => $culinaryImage,
            'wt.disc_shopping' => $spiceImage,
            default => null,
        };

        return $card;
    });
    $firstEvent = $upcomingEvents->first() ?? $pastEvents->first();
    $otherEvents = ($upcomingEvents->isNotEmpty() ? $upcomingEvents : $pastEvents)->skip(1);
    $masonry = ['lg:col-span-2 lg:row-span-2 min-h-[26rem]', 'min-h-[16rem]', 'min-h-[16rem]', 'min-h-[16rem]', 'min-h-[16rem]', 'lg:col-span-2 min-h-[16rem]', 'min-h-[16rem]'];
@endphp

@section('body')
    <x-front.hero />

    {{-- Quick discovery --}}
    <section id="discover" class="relative mx-auto max-w-7xl px-4 py-24 sm:px-6 lg:px-8 lg:py-36" aria-labelledby="discover-title">
        <x-front.section-heading id="discover-title" :title="__('wt.discover_title')" />
        <div class="scroll-row mt-12 sm:grid sm:grid-cols-4 sm:gap-5 sm:overflow-visible">
            @foreach ($discovery as $i => $card)
                <x-front.reveal :delay="$i * 60" class="w-44 shrink-0 snap-start sm:w-auto {{ $i % 2 ? 'sm:mt-10' : '' }}">
                    <x-front.discovery-card :label="__($card['label'])" :href="route(...$card['route'])"
                        :name="$card['image']" :src="$card['src']" />
                </x-front.reveal>
            @endforeach
        </div>
    </section>

    {{-- Introduction: layered parallax --}}
    <section class="relative py-24 lg:py-36" aria-labelledby="intro-title">
        <div class="relative mx-auto grid max-w-7xl items-center gap-16 px-4 sm:px-6 lg:grid-cols-12 lg:px-8">
            <div class="relative lg:col-span-7">
                <div class="photo-card aspect-[4/3]">
                    <x-front.picture name="sunset" :alt="__('wt.brand')" sizes="(min-width: 1024px) 58vw, 100vw"
                        data-parallax="0.12" class="relative -top-[12%] h-[124%] w-full object-cover" />
                </div>
                <div data-speed="-0.08" class="absolute -bottom-10 right-4 hidden sm:block lg:-right-10">
                    <div class="photo-card aspect-square w-40 border-4 border-surface shadow-2xl lg:w-56">
                        <x-front.picture name="tolire" alt="" sizes="30vw" data-parallax="0.15" class="relative -top-[15%] h-[130%] w-full object-cover" />
                    </div>
                </div>
            </div>
            <div class="lg:col-span-5">
                <p class="eyebrow">{{ __('wt.brand') }}</p>
                <h2 id="intro-title" data-words class="mt-3 font-display text-4xl leading-[1.05] text-volcanic sm:text-5xl lg:text-6xl">{{ __('wt.intro_title') }}</h2>
                <x-front.reveal :delay="150">
                    <p class="mt-6 text-lg text-volcanic/70">{{ __('wt.intro_text') }}</p>
                    <a href="{{ route('profil', 'visi-misi') }}" class="btn-outline mt-8">{{ __('wt.intro_cta') }} &rarr;</a>
                </x-front.reveal>
            </div>
        </div>
    </section>

    {{-- Featured destinations --}}
    @if ($featuredDestinations->isNotEmpty())
        <section class="mx-auto max-w-7xl px-4 py-24 sm:px-6 lg:px-8 lg:py-36" aria-labelledby="featured-title">
            <div class="flex flex-wrap items-end justify-between gap-4">
                <x-front.section-heading id="featured-title" :eyebrow="__('wt.nav_destinations')" :title="__('wt.featured_title')" :subtitle="__('wt.featured_sub')" />
                <a href="{{ route('destinasi.all') }}" class="btn-outline">{{ __('wt.view_all') }} &rarr;</a>
            </div>
            <div class="mt-12 grid gap-4 sm:grid-cols-2 lg:auto-rows-[16rem] lg:grid-cols-4">
                @foreach ($featuredDestinations as $i => $destination)
                    <x-front.reveal :delay="$i * 70" class="{{ $masonry[$i] ?? 'min-h-[16rem]' }} flex">
                        <x-front.destination-card :destination="$destination" class="w-full" />
                    </x-front.reveal>
                @endforeach
            </div>
        </section>
    @endif

    {{-- Experience: vertical scroll drives horizontal track on md+ --}}
    <section id="experience" data-hscroll class="dark-surface relative bg-volcanic" aria-labelledby="exp-title">
        <div class="py-24 md:sticky md:top-0 md:flex md:h-screen md:flex-col md:justify-center md:overflow-hidden md:py-0">
            <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8">
                <x-front.section-heading id="exp-title" :eyebrow="__('wt.nav_experience')" :title="__('wt.exp_title')" :subtitle="__('wt.exp_sub')" :light="true" />
            </div>
            <div data-hscroll-track class="scroll-row mt-12 px-4 will-change-transform sm:px-6 md:w-max md:overflow-visible md:px-8 lg:ps-[max(2rem,calc((100vw-80rem)/2+2rem))]">
                @foreach (config('tourism_placeholders.experiences') as $i => $exp)
                    <x-front.experience-card :title="__($exp['title'])" :text="__($exp['text'])" :name="$exp['image']" />
                @endforeach
            </div>
        </div>
    </section>

    {{-- Gamalama: pinned storytelling --}}
    <section data-scrub class="dark-surface scrub-tall relative h-[320vh] bg-volcanic" aria-labelledby="gamalama-title">
        <div class="scrub-pin sticky top-0 flex h-screen items-center overflow-hidden text-white">
            <x-front.picture name="gamalama" alt="" sizes="100vw" class="story-media absolute inset-0 -z-20 h-full w-full object-cover" />
            <div class="story-shade absolute inset-0 -z-10 bg-gradient-to-r from-volcanic via-volcanic/70 to-volcanic/10"></div>
            <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8">
                <p class="eyebrow step is-on" data-step="0">{{ __('wt.gamalama_label') }}</p>
                <h2 id="gamalama-title" class="step mt-4 max-w-3xl font-display text-5xl leading-[1.02] sm:text-7xl lg:text-8xl" data-step="0.12">{{ __('wt.gamalama_title') }}</h2>
                <p class="step mt-6 max-w-lg text-lg text-white/80 sm:text-xl" data-step="0.4">{{ __('wt.gamalama_text') }}</p>
                <a href="{{ route('destinasi.all') }}" class="btn-primary step mt-8" data-step="0.65">{{ __('wt.gamalama_cta') }} &rarr;</a>
            </div>
        </div>
    </section>

    {{-- 3D ring: scroll or drag rotates the ring --}}
    <section data-scrub data-mouse-tilt class="dark-surface scrub-tall relative h-[320vh] bg-volcanic" aria-labelledby="ring-title">
        <div class="scrub-pin sticky top-0 flex h-screen flex-col items-center justify-center overflow-hidden">
            <div class="px-4 text-center">
                <p class="eyebrow">{{ __('wt.ring_eyebrow') }}</p>
                <h2 id="ring-title" class="mt-3 font-display text-4xl leading-tight text-white sm:text-6xl">{{ __('wt.ring_title') }}</h2>
            </div>
            <div class="ring-scene mt-10 flex h-[24rem] w-full items-center justify-center sm:h-[30rem]" aria-hidden="true">
                <div class="ring">
                    @foreach (range(0, 11) as $i)
                        <div class="ring-item overflow-hidden rounded-2xl bg-navy shadow-2xl" style="--i: {{ $i }}">
                            <x-front.picture :name="['tolire', 'sulamadaha', 'batu-angus', 'fora', 'kora-kora', 'hiri', 'jikomalamo', 'ikan-nimo'][($i * 5) % 8]" :alt="__('wt.ring_alt')" sizes="240px" class="pointer-events-none h-full w-full object-cover" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Stories --}}
    @if ($stories->isNotEmpty())
        <section class="relative mx-auto max-w-7xl px-4 py-24 sm:px-6 lg:px-8 lg:py-36" aria-labelledby="stories-title">
            <x-front.section-heading id="stories-title" :eyebrow="__('wt.news_eyebrow')" :title="__('wt.news_title')" :subtitle="__('wt.news_sub')" />
            <div class="relative mt-12 grid gap-8 md:grid-cols-3">
                @foreach ($stories as $i => $story)
                    <x-front.reveal :delay="$i * 100" class="{{ $i === 1 ? 'md:mt-16' : '' }}"><x-front.culture-card :story="$story" /></x-front.reveal>
                @endforeach
            </div>
            <a href="{{ route('berita.all') }}" class="btn-outline mt-12">{{ __('wt.news_cta') }} &rarr;</a>
        </section>
    @endif

    {{-- Culinary --}}
    @if ($facilities->isNotEmpty())
        <section class="mx-auto max-w-7xl px-4 py-24 sm:px-6 lg:px-8 lg:py-36" aria-labelledby="taste-title">
            <x-front.section-heading id="taste-title" :eyebrow="__('wt.nav_culinary')" :title="__('wt.taste_title')" :subtitle="__('wt.taste_sub')" />
            <div class="mt-12 grid gap-4 md:grid-cols-3">
                @foreach ($facilities as $i => $facility)
                    <x-front.reveal :delay="$i * 100" class="flex"><x-front.culinary-card :facility="$facility" class="min-h-[22rem] w-full" /></x-front.reveal>
                @endforeach
            </div>
            <a href="{{ route('fasilitas.front', 'cafe-restorant') }}" class="btn-primary mt-12">{{ __('wt.taste_cta') }}</a>
        </section>
    @endif

    {{-- Events --}}
    <section class="mx-auto max-w-7xl px-4 py-24 sm:px-6 lg:px-8 lg:py-36" aria-labelledby="events-title">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <x-front.section-heading id="events-title" :eyebrow="__('wt.nav_events')" :title="__('wt.happening_title')" />
            <a href="{{ route('events.all') }}" class="btn-outline">{{ __('wt.all_events') }} &rarr;</a>
        </div>
        @if ($firstEvent)
            @if ($upcomingEvents->isEmpty())
                <p class="card mt-8 p-4 text-sm text-volcanic/70">{{ __('wt.happening_empty') }} <strong class="text-primary">{{ __('wt.happening_past') }}</strong></p>
            @endif
            <div class="mt-10 grid gap-6 lg:grid-cols-5">
                <x-front.reveal class="lg:col-span-3"><x-front.event-card :event="$firstEvent" :featured="true" /></x-front.reveal>
                <div class="space-y-3 lg:col-span-2">
                    @foreach ($otherEvents as $event)
                        <x-front.reveal :delay="$loop->index * 80"><x-front.event-card :event="$event" /></x-front.reveal>
                    @endforeach
                </div>
            </div>
        @else
            <p class="card mt-10 p-6 text-volcanic/70">{{ __('wt.happening_empty') }}</p>
        @endif
    </section>

    {{-- Map --}}
    @if (count($mapPoints))
        <section class="mx-auto max-w-7xl px-4 pb-24 sm:px-6 lg:px-8 lg:pb-36" aria-labelledby="map-title">
            <x-front.section-heading id="map-title" :title="__('wt.map_title')" />
            <div class="mt-12"><x-front.map-explorer :points="$mapPoints" /></div>
        </section>
    @endif

    {{-- Itinerary --}}
    <section class="relative bg-white py-24 lg:py-36" aria-labelledby="plan-title">
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-front.section-heading id="plan-title" :eyebrow="__('wt.plan_trip')" :title="__('wt.plan_title')" :subtitle="__('wt.plan_sub')" />
            <div class="mt-12 grid gap-6 md:grid-cols-3">
                @foreach (config('tourism_placeholders.itineraries') as $i => $plan)
                    <x-front.reveal :delay="$i * 100" class="flex {{ $i === 1 ? 'md:mt-12' : '' }}">
                        <x-front.itinerary-card :duration="__($plan['duration'])" :title="$plan['title']" :places="$plan['places']" :name="$plan['image']" />
                    </x-front.reveal>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Gallery --}}
    @if ($gallery->isNotEmpty())
        <section class="mx-auto max-w-7xl px-4 py-24 sm:px-6 lg:px-8 lg:py-36" aria-labelledby="gallery-title">
            <div class="flex flex-wrap items-end justify-between gap-4">
                <x-front.section-heading id="gallery-title" :title="__('wt.gallery_title')" />
                <a href="https://www.instagram.com/wonderfulternate" target="_blank" rel="noopener noreferrer" class="btn-primary">{{ __('wt.gallery_follow') }}</a>
            </div>
            <div class="mt-12"><x-front.gallery :items="$gallery" /></div>
        </section>
    @endif

    {{-- Partners --}}
    @if ($partners->isNotEmpty())
        <section class="mx-auto max-w-7xl px-4 pb-24 sm:px-6 lg:px-8" aria-label="{{ __('pesan.partner') }}">
            <div class="card px-6 py-10">
                <p class="eyebrow text-center">{{ __('pesan.partner') }}</p>
                <ul class="mt-8 flex flex-wrap items-center justify-center gap-x-10 gap-y-6">
                    @foreach ($partners as $partner)
                        <li><x-front.picture :src="$partner->logo" :alt="$partner->name" sizes="120px" class="h-12 w-auto object-contain" /></li>
                    @endforeach
                </ul>
            </div>
        </section>
    @endif

    {{-- CTA --}}
    <section class="dark-surface relative isolate flex min-h-[34rem] items-center justify-center overflow-hidden px-4 py-28 text-center text-white">
        <div class="absolute inset-0 -z-20 bg-navy">
            <x-front.picture name="sunset" alt="" sizes="100vw" data-parallax="0.15" class="relative -top-[15%] h-[130%] w-full object-cover" />
        </div>
        <div class="absolute inset-0 -z-10 bg-volcanic/55"></div>
        <x-front.reveal>
            <p class="eyebrow">{{ __('wt.tagline') }}</p>
            <h2 class="mx-auto mt-4 max-w-4xl font-display text-5xl leading-[1.02] sm:text-7xl lg:text-8xl">{{ __('wt.cta_title') }}</h2>
            <a href="{{ route('destinasi.all') }}" class="btn-primary mt-10">{{ __('wt.cta_button') }} &rarr;</a>
        </x-front.reveal>
    </section>
@endsection
