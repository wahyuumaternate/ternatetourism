@props(['ekraf'])

<a href="{{ route('ekraf.show', $ekraf->slug) }}" {{ $attributes->class(['card group flex items-center gap-4 p-4 transition hover:-translate-y-0.5']) }}>
    @if ($ekraf->logo)
        <x-front.picture :src="$ekraf->logo" :alt="$ekraf->name" sizes="64px" class="h-16 w-16 shrink-0 rounded-full object-cover ring-1 ring-black/10" />
    @else
        <span class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-primary/10 font-display text-2xl text-primary" aria-hidden="true">{{ Str::upper(Str::substr($ekraf->name, 0, 1)) }}</span>
    @endif
    <div class="min-w-0">
        <h3 class="line-clamp-2 font-semibold leading-snug text-volcanic transition group-hover:text-primary">{{ $ekraf->name }}</h3>
        @if ($ekraf->category)
            <p class="mt-1 truncate text-sm text-volcanic/60">{{ $ekraf->category->name }}</p>
        @endif
    </div>
</a>
