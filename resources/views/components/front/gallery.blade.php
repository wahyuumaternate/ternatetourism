@props(['items'])

<div x-data="{ current: null }" @keydown.escape.window="current = null">
    <ul class="columns-2 gap-3 sm:columns-3 sm:gap-4">
        @foreach ($items as $item)
            <li class="mb-3 break-inside-avoid sm:mb-4" data-reveal>
                <button type="button" @click="current = @js(asset($item->file))"
                    class="group block w-full overflow-hidden rounded-2xl bg-navy" aria-label="{{ $item->title }}">
                    <x-front.picture :src="$item->file" :alt="$item->title" sizes="(min-width: 640px) 33vw, 50vw"
                        class="w-full object-cover transition duration-700 group-hover:scale-105" />
                </button>
            </li>
        @endforeach
    </ul>

    <div x-show="current" x-cloak x-transition.opacity class="fixed inset-0 z-[70] flex items-center justify-center bg-volcanic/95 p-4"
        role="dialog" aria-modal="true" @click="current = null">
        <img :src="current" alt="" class="max-h-full max-w-full rounded-xl object-contain">
        <button type="button" class="absolute right-4 top-4 rounded-full bg-white/10 p-3 text-white" aria-label="{{ __('wt.close') }}">&times;</button>
    </div>
</div>
