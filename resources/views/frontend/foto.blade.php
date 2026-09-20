@extends('frontend.layouts.app')

@section('title', __('pesan.galeri') . ' — ' . __('wt.brand'))
@section('description', __('pesan.galeri_desc'))

@section('body')
    <x-front.page-header :eyebrow="__('wt.brand')" :title="__('pesan.galeri')" :subtitle="__('pesan.galeri_desc')" />

    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-24">
        @if ($media->isEmpty())
            <p class="card p-6 text-volcanic/70">{{ __('wt.pg_empty') }}</p>
        @else
            <x-front.gallery :items="$media" />
            <div class="mt-12">{{ $media->links('pagination.front') }}</div>
        @endif
    </section>
@endsection
