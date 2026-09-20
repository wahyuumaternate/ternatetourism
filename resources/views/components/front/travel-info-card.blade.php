@props(['icon', 'title', 'href' => null])

@php
    $paths = [
        'plane' => 'M3 13l18-9-7 17-3-7-8-1z',
        'bed' => 'M3 18V7m0 8h18v3M3 12h13a5 5 0 015 5M7 10h.01',
        'car' => 'M5 16l1.5-5h11L19 16M5 16h14M5 16v3m14-3v3M8 16h.01M16 16h.01',
        'sun' => 'M12 4v2m0 12v2M4 12h2m12 0h2M6.3 6.3l1.4 1.4m8.6 8.6 1.4 1.4m0-11.4-1.4 1.4M7.7 16.3l-1.4 1.4M12 8a4 4 0 100 8 4 4 0 000-8z',
        'wallet' => 'M3 7h16a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V7zm0 0l2-3h12M16 13h.01',
        'pin' => 'M12 21s7-6.2 7-11a7 7 0 10-14 0c0 4.8 7 11 7 11zm0-8a3 3 0 100-6 3 3 0 000 6z',
    ];
    $tag = $href ? 'a' : 'div';
@endphp

<{{ $tag }} @if ($href) href="{{ $href }}" @endif
    {{ $attributes->class(['card group block p-6 transition', 'hover:-translate-y-1' => $href]) }}>
    <span class="flex h-11 w-11 items-center justify-center rounded-full bg-primary/10 text-primary">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="{{ $paths[$icon] ?? $paths['pin'] }}"/></svg>
    </span>
    <h3 class="mt-4 font-semibold text-volcanic">{{ $title }}</h3>
    <p class="mt-1 text-sm text-volcanic/60">{{ $href ? __('wt.view_detail') . ' →' : __('wt.before_soon') }}</p>
</{{ $tag }}>
