@extends('frontend.layouts.app')

@section('title', __('pesan.events_title') . ' — ' . __('wt.brand'))
@section('description', __('pesan.events_subtitle'))

@section('body')
    <x-front.page-header :eyebrow="__('wt.nav_events')" :title="__('pesan.events_title')" :subtitle="__('pesan.events_subtitle')" />

    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-24">
        @if ($events->isEmpty())
            <p class="card p-6 text-volcanic/70">{{ __('wt.happening_empty') }}</p>
        @else
            <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($events as $i => $event)
                    <x-front.reveal :delay="($i % 3) * 80" class="flex">
                        <x-front.event-card :event="$event" :featured="true" class="w-full" />
                    </x-front.reveal>
                @endforeach
            </div>
            <div class="mt-12">{{ $events->links('pagination.front') }}</div>
        @endif
    </section>
@endsection
