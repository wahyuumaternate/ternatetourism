@props(['destination'])

<a href="{{ route('destinasi.show', $destination->slug) }}"
    data-tilt {{ $attributes->class(['photo-card group block']) }}>
    <x-front.picture :src="$destination->image" :alt="Str::before($destination->name, ':')"
        sizes="(min-width: 1024px) 33vw, 100vw" data-parallax="0.1"
        class="absolute inset-x-0 -top-[10%] h-[120%] w-full object-cover transition duration-700 group-hover:scale-105" />
    <div class="absolute inset-0 bg-gradient-to-t from-volcanic/85 via-volcanic/5 to-transparent"></div>
    <div class="absolute inset-x-0 bottom-0 flex items-end justify-between gap-3 p-5">
        <div>
            <h3 class="font-display text-xl leading-snug text-white transition duration-500 group-hover:-translate-y-1 sm:text-2xl">{{ Str::before($destination->name, ':') }}</h3>
            @if (Str::contains($destination->name, ':'))
                <p class="mt-1 line-clamp-1 text-sm text-white/75">{{ trim(Str::after($destination->name, ':')) }}</p>
            @endif
        </div>
        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-white text-volcanic transition group-hover:bg-primary group-hover:text-white" aria-hidden="true">&rarr;</span>
    </div>
</a>
