@props(['label', 'href', 'name' => null, 'src' => null])

<a href="{{ $href }}" data-tilt class="photo-card group block aspect-[3/4] bg-gradient-to-br from-navy to-primary">
    @if ($name || $src)
        <x-front.picture :name="$name" :src="$src" :alt="$label" sizes="(min-width: 1024px) 25vw, 50vw"
            class="absolute inset-0 h-full w-full object-cover transition duration-700 group-hover:scale-105" />
    @endif
    <div class="absolute inset-0 bg-gradient-to-t from-volcanic/80 via-volcanic/5 to-transparent"></div>
    <span class="absolute inset-x-4 bottom-4 flex items-end justify-between font-display text-xl text-white sm:text-2xl">
        {{ $label }}
        <span class="text-base transition group-hover:translate-x-1" aria-hidden="true">&rarr;</span>
    </span>
</a>
