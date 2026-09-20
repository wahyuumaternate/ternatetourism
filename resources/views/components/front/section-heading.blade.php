@props(['eyebrow' => null, 'title', 'subtitle' => null, 'light' => false])

<div {{ $attributes->class(['max-w-3xl']) }} data-reveal>
    @if ($eyebrow)
        <p class="eyebrow">{{ $eyebrow }}</p>
    @endif
    <h2 @class(['mt-3 font-display text-4xl leading-[1.05] sm:text-5xl lg:text-6xl', 'text-white' => $light, 'text-volcanic' => ! $light])>{{ $title }}</h2>
    @if ($subtitle)
        <p @class(['mt-5 text-base sm:text-lg', 'text-white/70' => $light, 'text-volcanic/65' => ! $light])>{{ $subtitle }}</p>
    @endif
</div>
