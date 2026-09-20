@extends('frontend.layouts.app')

@php
    $clean = fn ($value) => filled($value) && ! in_array(Str::lower(trim($value)), ['-', 'tidak tersedia', 'n/a'], true) ? trim($value) : null;
    $asLink = fn ($value) => Str::startsWith($value, ['http://', 'https://']) ? $value : null;
    $phone = $clean($ekraf->phone);
    $email = $clean($ekraf->email);
    $website = $clean($ekraf->website);
    $social = $clean($ekraf->social_media);
    $address = $clean($ekraf->address);
    $plain = Str::limit(trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags((string) $ekraf->description)))), 155);
    $rows = array_filter([
        __('wt.ek_phone') => ['text' => $phone, 'href' => $phone ? 'tel:' . preg_replace('/[^\d+]/', '', $phone) : null],
        'Email' => ['text' => $email, 'href' => $email ? 'mailto:' . $email : null],
        __('wt.ek_social') => ['text' => $social, 'href' => $social ? $asLink($social) : null],
        __('wt.ek_website') => ['text' => $website, 'href' => $website ? $asLink($website) : null],
        __('wt.ek_address') => ['text' => $address, 'href' => null],
    ], fn ($row) => $row['text']);
@endphp

@section('title', $ekraf->name . ' — ' . __('wt.brand'))
@section('description', $plain)
@if ($ekraf->logo)
    @section('og_image', asset($ekraf->logo))
@endif

@push('head')
    <script type="application/ld+json">
        {!! json_encode(array_filter([
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => $ekraf->name,
            'description' => $plain,
            'logo' => $ekraf->logo ? asset($ekraf->logo) : null,
            'telephone' => $phone,
            'email' => $email,
            'url' => $website ? $asLink($website) : null,
        ]), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
@endpush

@section('body')
    <x-front.page-header :eyebrow="$ekraf->category?->name ?? __('pesan.creative')" :title="$ekraf->name" />

    <div class="mx-auto grid max-w-7xl gap-10 px-4 py-16 sm:px-6 lg:grid-cols-3 lg:px-8 lg:py-24">
        <aside class="space-y-6 lg:order-2">
            <div class="card p-6">
                @if ($ekraf->logo)
                    <x-front.picture :src="$ekraf->logo" :alt="$ekraf->name" sizes="160px" :eager="true" class="mx-auto h-32 w-32 rounded-full object-cover ring-1 ring-black/10" />
                @endif
                <p class="eyebrow mt-6">{{ __('wt.ek_info') }}</p>
                <dl class="mt-4 space-y-4 text-sm">
                    @foreach ($rows as $label => $row)
                        <div>
                            <dt class="text-volcanic/55">{{ $label }}</dt>
                            <dd class="mt-0.5 break-words font-semibold text-volcanic">
                                @if ($row['href'])
                                    <a href="{{ $row['href'] }}" @if (Str::startsWith($row['href'], 'http')) target="_blank" rel="noopener noreferrer" @endif class="text-primary hover:underline">{{ $row['text'] }}</a>
                                @else
                                    {{ $row['text'] }}
                                @endif
                            </dd>
                        </div>
                    @endforeach
                    <div>
                        <dt class="text-volcanic/55">{{ __('wt.ek_products') }}</dt>
                        <dd class="mt-0.5 font-semibold text-volcanic">{{ $ekraf->jumlah_produk }}</dd>
                    </div>
                </dl>
            </div>
            <a href="{{ route('ekraf.index') }}" class="btn-outline w-full">&larr; {{ __('wt.ek_back') }}</a>
        </aside>

        <article class="lg:col-span-2 lg:order-1">
            <p class="eyebrow">{{ __('wt.ek_about') }}</p>
            <div class="rich mt-4">{!! $ekraf->description !!}</div>
        </article>
    </div>

    @if ($related->isNotEmpty())
        <section class="mx-auto max-w-7xl px-4 pb-20 sm:px-6 lg:px-8 lg:pb-28" aria-labelledby="related-title">
            <h2 id="related-title" class="font-display text-3xl text-volcanic">{{ __('wt.ek_related') }}</h2>
            <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($related as $item)
                    <x-front.ekraf-card :ekraf="$item->setRelation('category', $ekraf->category)" />
                @endforeach
            </div>
        </section>
    @endif
@endsection
