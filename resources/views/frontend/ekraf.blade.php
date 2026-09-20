@extends('frontend.layouts.app')

@php
    $activeCategory = $category ?? null;
    $pageTitle = $activeCategory ? $activeCategory->name : __('wt.ek_title');
@endphp

@section('title', $pageTitle . ' — ' . __('wt.brand'))
@section('description', __('wt.ek_sub'))

@section('body')
    <x-front.page-header :eyebrow="__('pesan.creative')" :title="$pageTitle" :subtitle="__('wt.ek_sub')" />

    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-24" x-data="ekrafSearch(@js(route('ekraf.search')), @js(url('/ekraf')))">
        <nav class="scroll-row -mx-4 px-4 sm:mx-0 sm:flex-wrap sm:overflow-visible sm:px-0" aria-label="{{ __('wt.pg_category') }}">
            <a href="{{ route('ekraf.index') }}" @if (! $activeCategory) aria-current="page" @endif
                @class(['shrink-0 rounded-full px-5 py-2 text-sm font-semibold transition', 'bg-primary text-white' => ! $activeCategory, 'bg-white text-volcanic ring-1 ring-black/10 hover:bg-black/5' => $activeCategory])>
                {{ __('wt.ek_all') }} <span class="opacity-60">{{ $totalEkraf ?? $allCategories->sum('ekraf_count') }}</span>
            </a>
            @foreach ($allCategories->where('ekraf_count', '>', 0) as $item)
                <a href="{{ route('ekraf.category', $item->slug) }}" @if ($activeCategory?->id === $item->id) aria-current="page" @endif
                    @class(['shrink-0 rounded-full px-5 py-2 text-sm font-semibold transition', 'bg-primary text-white' => $activeCategory?->id === $item->id, 'bg-white text-volcanic ring-1 ring-black/10 hover:bg-black/5' => $activeCategory?->id !== $item->id])>
                    {{ $item->name }} <span class="opacity-60">{{ $item->ekraf_count }}</span>
                </a>
            @endforeach
        </nav>

        <div class="relative mt-8 max-w-xl">
            <label for="ekraf-search" class="sr-only">{{ __('wt.ek_search_ph') }}</label>
            <input id="ekraf-search" type="search" x-model="query" @input.debounce.250ms="search()" autocomplete="off"
                placeholder="{{ __('wt.ek_search_ph') }}"
                class="w-full rounded-full border-black/15 bg-white px-6 py-3.5 text-volcanic placeholder:text-volcanic/40 focus:border-primary focus:ring-primary">
        </div>

        {{-- Live search results --}}
        <div x-show="results !== null" x-cloak class="mt-10" aria-live="polite">
            <p class="eyebrow">{{ __('wt.ek_results') }} <span x-text="results ? '(' + results.length + ')' : ''"></span></p>
            <p x-show="results && results.length === 0" class="card mt-4 p-6 text-volcanic/70">{{ __('wt.ek_none') }}</p>
            <div class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <template x-for="item in results ?? []" :key="item.id">
                    <a :href="baseUrl + '/' + item.slug" class="card group flex items-center gap-4 p-4 transition hover:-translate-y-0.5">
                        <template x-if="item.logo"><img :src="item.logo" :alt="item.name" loading="lazy" class="h-16 w-16 shrink-0 rounded-full object-cover ring-1 ring-black/10"></template>
                        <div class="min-w-0">
                            <h3 class="line-clamp-2 font-semibold leading-snug text-volcanic group-hover:text-primary" x-text="item.name"></h3>
                            <p class="mt-1 truncate text-sm text-volcanic/60" x-text="item.category ? item.category.name : ''"></p>
                        </div>
                    </a>
                </template>
            </div>
        </div>

        {{-- Paginated list --}}
        <div x-show="results === null">
            @if ($ekrafs->isEmpty())
                <p class="card mt-10 p-6 text-volcanic/70">{{ __('wt.pg_empty') }}</p>
            @else
                <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($ekrafs as $i => $ekraf)
                        <x-front.reveal :delay="($i % 3) * 60" class="flex">
                            <x-front.ekraf-card :ekraf="$ekraf" class="w-full" />
                        </x-front.reveal>
                    @endforeach
                </div>
                <div class="mt-12">{{ $ekrafs->links('pagination.front') }}</div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('ekrafSearch', (searchUrl, baseUrl) => ({
                query: '',
                results: null,
                baseUrl,
                controller: null,
                async search() {
                    const term = this.query.trim();

                    if (term.length < 2) {
                        this.results = null;
                        return;
                    }

                    this.controller?.abort();
                    this.controller = new AbortController();

                    try {
                        const response = await fetch(`${searchUrl}?query=${encodeURIComponent(term)}`, {
                            headers: { Accept: 'application/json' },
                            signal: this.controller.signal,
                        });

                        this.results = (await response.json()).data;
                    } catch (error) {
                        if (error.name !== 'AbortError') {
                            this.results = [];
                        }
                    }
                },
            }));
        });
    </script>
@endpush
