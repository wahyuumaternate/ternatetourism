@props(['event', 'featured' => false])

@php
    $date = \Illuminate\Support\Carbon::parse($event->date);
@endphp

<a href="{{ route('event.detail', $event->slug) }}"
    {{ $attributes->class(['group block', 'photo-card text-white' => $featured, 'card flex items-center gap-4 p-4 transition hover:-translate-y-0.5' => ! $featured]) }}>
    @if ($featured)
        <x-front.picture :src="$event->poster" :alt="$event->name" sizes="(min-width: 1024px) 50vw, 100vw"
            class="absolute inset-0 h-full w-full object-cover transition duration-700 group-hover:scale-105" />
        <div class="absolute inset-0 bg-gradient-to-t from-volcanic/90 via-volcanic/30 to-transparent"></div>
        <div class="relative flex min-h-[26rem] flex-col justify-end p-6 sm:p-8">
            <div class="mb-4 w-16 rounded-xl bg-white py-2 text-center text-volcanic">
                <span class="block font-display text-2xl font-bold leading-none">{{ $date->format('d') }}</span>
                <span class="block text-xs font-semibold uppercase">{{ $date->translatedFormat('M') }}</span>
            </div>
            <h3 class="font-display text-3xl leading-tight sm:text-4xl">{{ $event->name }}</h3>
            <p class="mt-2 text-sm text-white/80">{{ $event->location }}</p>
            <span class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-white">{{ __('wt.view_event') }} &rarr;</span>
        </div>
    @else
        <div class="w-14 shrink-0 rounded-xl bg-white py-2 text-center text-volcanic">
            <span class="block font-display text-xl font-bold leading-none">{{ $date->format('d') }}</span>
            <span class="block text-[10px] font-semibold uppercase">{{ $date->translatedFormat('M') }}</span>
        </div>
        <div class="min-w-0">
            <h3 class="truncate font-semibold text-volcanic group-hover:text-primary">{{ $event->name }}</h3>
            <p class="truncate text-sm text-volcanic/60">{{ $event->location }}</p>
        </div>
    @endif
</a>
