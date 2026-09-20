@extends('frontend.layouts.app')

@php
    $current = request()->route('kategori') ?? 'all';
    $tabs = ['all' => __('wt.pg_all'), 'hotel' => __('pesan.hotel'), 'travel' => __('pesan.travel'), 'cafe-restorant' => __('pesan.restaurant'), 'umkm' => __('pesan.umkm'), 'guide' => __('pesan.guide'), 'rent-car' => __('pesan.rent_car')];
@endphp

@section('title', __('pesan.facilities_title') . ' — ' . __('wt.brand'))
@section('description', __('pesan.facilities_subtitle'))

@section('body')
    <x-front.page-header :eyebrow="__('wt.pg_category') . ': ' . ($tabs[$current] ?? $current)" :title="__('pesan.facilities_title')" :subtitle="__('pesan.facilities_subtitle')" />

    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-24">
        <nav class="scroll-row -mx-4 px-4 sm:mx-0 sm:flex-wrap sm:overflow-visible sm:px-0" aria-label="{{ __('wt.pg_category') }}">
            @foreach ($tabs as $key => $label)
                <a href="{{ route('fasilitas.front', $key) }}" @if ($current === $key) aria-current="page" @endif
                    @class(['shrink-0 rounded-full px-5 py-2 text-sm font-semibold transition', 'bg-primary text-white' => $current === $key, 'bg-white text-volcanic ring-1 ring-black/10 hover:bg-black/5' => $current !== $key])>{{ $label }}</a>
            @endforeach
        </nav>

        @if ($facilities->isEmpty())
            <p class="card mt-10 p-6 text-volcanic/70">{{ __('wt.pg_empty') }}</p>
        @else
            <div class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($facilities as $i => $facility)
                    <x-front.reveal :delay="($i % 3) * 80" class="flex">
                        <x-front.culinary-card :facility="$facility" class="aspect-[4/5] w-full" />
                    </x-front.reveal>
                @endforeach
            </div>
        @endif
    </section>
@endsection
