@extends('frontend.layouts.app')

@section('title', __('pesan.destination') . ' — ' . __('wt.brand'))
@section('description', __('pesan.destinasi_desc'))

@section('body')
    <x-front.page-header :eyebrow="__('wt.brand')" :title="__('pesan.destination')" :subtitle="__('pesan.destinasi_desc')" />

    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-24">
        @if ($destination->isEmpty())
            <p class="card p-6 text-volcanic/70">{{ __('wt.pg_empty') }}</p>
        @else
            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($destination as $i => $item)
                    <x-front.reveal :delay="($i % 3) * 80" class="flex">
                        <x-front.destination-card :destination="$item" class="aspect-[4/5] w-full" />
                    </x-front.reveal>
                @endforeach
            </div>
            <div class="mt-12">{{ $destination->links('pagination.front') }}</div>
        @endif
    </section>
@endsection
