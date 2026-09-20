@extends('frontend.layouts.app')

@section('title', __('pesan.berita') . ' — ' . __('wt.brand'))
@section('description', __('pesan.berita_desc'))

@section('body')
    <x-front.page-header :eyebrow="__('wt.nav_culture')" :title="__('pesan.berita')" :subtitle="__('pesan.berita_desc')" />

    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-24">
        @if ($berita->isEmpty())
            <p class="card p-6 text-volcanic/70">{{ __('wt.pg_empty') }}</p>
        @else
            <div class="grid gap-x-6 gap-y-12 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($berita as $i => $story)
                    <x-front.reveal :delay="($i % 3) * 80"><x-front.culture-card :story="$story" /></x-front.reveal>
                @endforeach
            </div>
            <div class="mt-12">{{ $berita->links('pagination.front') }}</div>
        @endif
    </section>
@endsection
