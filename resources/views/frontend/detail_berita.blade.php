@extends('frontend.layouts.app')

@php($plain = Str::limit(trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags((string) ($news->excerpt ?: $news->content))))), 155))

@section('title', $news->title . ' — ' . __('wt.brand'))
@section('description', $plain)
@section('og_image', asset($news->image))

@push('head')
    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'NewsArticle',
            'headline' => $news->title,
            'image' => asset($news->image),
            'datePublished' => $news->created_at->toIso8601String(),
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
@endpush

@section('body')
    <x-front.page-header :eyebrow="$news->created_at->translatedFormat('d F Y')" :title="$news->title" :image="$news->image" />

    <article class="mx-auto max-w-3xl px-4 py-16 sm:px-6 lg:py-24">
        <div class="rich">{!! $news->content !!}</div>
        <a href="{{ route('berita.all') }}" class="btn-outline mt-12">&larr; {{ __('wt.pg_back_list') }}</a>
    </article>
@endsection
