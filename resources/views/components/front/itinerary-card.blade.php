@props(['duration', 'title', 'places', 'name'])

<article class="card group flex w-full flex-col">
    <div class="relative aspect-[16/10] overflow-hidden bg-navy">
        <x-front.picture :name="$name" :alt="$title" sizes="(min-width: 1024px) 33vw, 100vw"
            class="h-full w-full object-cover transition duration-700 group-hover:scale-105" />
        <span class="absolute left-4 top-4 rounded-full bg-primary px-3 py-1 text-xs font-bold text-white">{{ $duration }}</span>
        <span class="absolute right-4 top-4 rounded-full bg-white/90 px-3 py-1 text-[11px] font-semibold text-volcanic">{{ __('wt.placeholder') }}</span>
    </div>
    <div class="flex flex-1 flex-col p-6">
        <h3 class="font-display text-2xl text-volcanic">{{ $title }}</h3>
        <ul class="mt-4 space-y-2 text-sm text-volcanic/70">
            @foreach ($places as $place)
                <li class="flex gap-2"><span class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-primary"></span>{{ $place }}</li>
            @endforeach
        </ul>
    </div>
</article>
