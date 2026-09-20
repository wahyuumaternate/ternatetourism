@props(['delay' => 0])

<div {{ $attributes }} data-reveal style="--reveal-delay: {{ $delay }}ms">{{ $slot }}</div>
