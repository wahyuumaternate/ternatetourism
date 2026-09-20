@extends('frontend.layouts.app')

@section('title', __('pesan.video') . ' — ' . __('wt.brand'))
@section('description', __('pesan.video_desc'))

@section('body')
    <x-front.page-header :eyebrow="__('wt.brand')" :title="__('pesan.video')" :subtitle="__('pesan.video_desc')" />

    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-24">
        @if ($video->isEmpty())
            <p class="card p-6 text-volcanic/70">{{ __('wt.pg_empty') }}</p>
        @else
            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($video as $i => $item)
                    @php($youtubeId = Str::before(Str::afterLast(Str::before($item->file, '&'), preg_match('/v=/', $item->file) ? 'v=' : '/'), '?'))
                    <x-front.reveal :delay="($i % 3) * 80">
                        <div class="photo-card aspect-video">
                            <iframe src="https://www.youtube-nocookie.com/embed/{{ $youtubeId }}" title="{{ $item->title }}" loading="lazy"
                                class="absolute inset-0 h-full w-full" allow="accelerometer; encrypted-media; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </x-front.reveal>
                @endforeach
            </div>
            <div class="mt-12">{{ $video->links('pagination.front') }}</div>
        @endif
    </section>
@endsection
