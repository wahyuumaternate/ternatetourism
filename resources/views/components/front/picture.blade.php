@props(['name' => null, 'src' => null, 'alt' => '', 'sizes' => '100vw', 'eager' => false])

{{-- Gambar lokal teroptimasi (public/assets/front/{name}-{800,1600}.webp) atau URL/path apa adanya --}}
@if ($name)
    <img src="{{ asset("assets/front/{$name}-800.webp") }}"
        srcset="{{ asset("assets/front/{$name}-800.webp") }} 800w, {{ asset("assets/front/{$name}-1600.webp") }} 1600w"
        sizes="{{ $sizes }}" alt="{{ $alt }}" @if ($eager) fetchpriority="high" @else loading="lazy" @endif
        decoding="async" {{ $attributes }}>
@elseif ($src)
    <img src="{{ asset($src) }}" alt="{{ $alt }}" @if ($eager) fetchpriority="high" @else loading="lazy" @endif
        decoding="async" {{ $attributes }}>
@endif
