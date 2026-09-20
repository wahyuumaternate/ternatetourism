@extends('frontend.layouts.app')

@php
    $plainBody = trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags((string) $news->content))));
    $plain = Str::limit(trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags((string) ($news->excerpt ?: $news->content))))), 155);
    $readMinutes = max(1, (int) ceil(str_word_count($plainBody) / 200));
    $shareUrl = urlencode(url()->current());
    $shareText = urlencode($news->title);
@endphp

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
            'description' => $plain,
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
@endpush

@section('body')
    <div class="mx-auto max-w-7xl px-4 pb-16 pt-28 sm:px-6 sm:pt-32 lg:px-8 lg:pb-24">
        <nav aria-label="Breadcrumb" class="text-sm text-volcanic/60">
            <ol class="flex flex-wrap items-center gap-2">
                <li><a href="{{ url('/') }}" class="hover:text-primary">{{ __('pesan.home') }}</a></li>
                <li aria-hidden="true">/</li>
                <li><a href="{{ route('berita.all') }}" class="hover:text-primary">{{ __('pesan.news') }}</a></li>
                <li aria-hidden="true">/</li>
                <li class="max-w-[16rem] truncate text-volcanic" aria-current="page">{{ $news->title }}</li>
            </ol>
        </nav>

        <div class="mt-8 grid grid-cols-1 gap-12 lg:grid-cols-12">
            <article class="min-w-0 lg:col-span-8">
                <p class="eyebrow">{{ __('wt.news_eyebrow') }}</p>
                <h1 class="mt-4 font-display text-3xl font-bold leading-tight text-volcanic sm:text-4xl lg:text-5xl">{{ $news->title }}</h1>

                <div class="mt-6 flex flex-wrap items-center justify-between gap-4 border-y border-black/10 py-4 text-sm text-volcanic/65">
                    <p class="flex flex-wrap items-center gap-x-3">
                        <time datetime="{{ $news->created_at->toDateString() }}">{{ $news->created_at->translatedFormat('l, d F Y') }}</time>
                        <span aria-hidden="true">·</span>
                        <span>{{ __('wt.nw_read', ['n' => $readMinutes]) }}</span>
                    </p>

                    <div class="flex flex-wrap items-center gap-2" x-data="{ copied: false }">
                        <span class="sr-only">{{ __('wt.pg_share') }}</span>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" rel="noopener noreferrer" class="rounded-full px-3 py-1.5 font-semibold text-volcanic ring-1 ring-black/10 transition hover:bg-black/5">Facebook</a>
                        <a href="https://api.whatsapp.com/send?text={{ $shareText }}%20{{ $shareUrl }}" target="_blank" rel="noopener noreferrer" class="rounded-full px-3 py-1.5 font-semibold text-volcanic ring-1 ring-black/10 transition hover:bg-black/5">WhatsApp</a>
                        <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareText }}" target="_blank" rel="noopener noreferrer" class="rounded-full px-3 py-1.5 font-semibold text-volcanic ring-1 ring-black/10 transition hover:bg-black/5">X</a>
                        <button type="button" @click="navigator.clipboard.writeText(@js(url()->current())).then(() => { copied = true; setTimeout(() => copied = false, 2000) })"
                            class="rounded-full px-3 py-1.5 font-semibold text-volcanic ring-1 ring-black/10 transition hover:bg-black/5">
                            <span x-show="!copied">{{ __('wt.nw_copy') }}</span>
                            <span x-show="copied" x-cloak>{{ __('wt.nw_copied') }}</span>
                        </button>
                    </div>
                </div>

                @if ($news->image)
                    <figure class="relative mt-8 aspect-video overflow-hidden rounded-2xl bg-navy">
                        <x-front.picture :src="$news->image" alt="" sizes="(min-width: 1024px) 66vw, 100vw" class="absolute inset-0 h-full w-full scale-110 object-cover opacity-50 blur-2xl" aria-hidden="true" />
                        <x-front.picture :src="$news->image" :alt="$news->title" sizes="(min-width: 1024px) 66vw, 100vw" :eager="true" class="relative h-full w-full object-contain" />
                    </figure>
                @endif

                <div class="rich mt-10">{!! \App\Helpers\RichText::clean($news->content) !!}</div>

                <div class="mt-12 border-t border-black/10 pt-6">
                    <a href="{{ route('berita.all') }}" class="btn-outline">&larr; {{ __('wt.pg_back_list') }}</a>
                </div>
            </article>

            @if ($latest->isNotEmpty())
                <aside class="min-w-0 lg:col-span-4" aria-labelledby="latest-title">
                    <div class="lg:sticky lg:top-28">
                        <h2 id="latest-title" class="border-b-2 border-primary pb-3 font-display text-2xl text-volcanic">{{ __('wt.nw_latest') }}</h2>
                        <ul class="divide-y divide-black/10">
                            @foreach ($latest as $item)
                                <li>
                                    <a href="{{ route('berita.detail', $item->slug) }}" class="group flex gap-4 py-4">
                                        <x-front.picture :src="$item->image" alt="" sizes="96px" class="h-20 w-24 shrink-0 rounded-lg bg-navy object-cover" />
                                        <div class="min-w-0">
                                            <h3 class="line-clamp-3 text-sm font-semibold leading-snug text-volcanic transition group-hover:text-primary">{{ $item->title }}</h3>
                                            <time class="mt-1 block text-xs text-volcanic/55" datetime="{{ $item->created_at->toDateString() }}">{{ $item->created_at->translatedFormat('d M Y') }}</time>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </aside>
            @endif
        </div>
    </div>
@endsection
