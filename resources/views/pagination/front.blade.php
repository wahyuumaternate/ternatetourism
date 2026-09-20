@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('pagination.previous') }} / {{ __('pagination.next') }}" class="flex flex-col items-center justify-between gap-4 sm:flex-row">
        <p class="text-sm text-volcanic/60">
            {{ __('wt.pg_showing', ['from' => $paginator->firstItem(), 'to' => $paginator->lastItem(), 'total' => $paginator->total()]) }}
        </p>

        <ul class="flex flex-wrap items-center justify-center gap-1.5">
            @if ($paginator->onFirstPage())
                <li aria-disabled="true"><span class="grid h-10 min-w-10 place-items-center rounded-full px-3 text-sm text-volcanic/30">&larr;<span class="sr-only">{{ __('pagination.previous') }}</span></span></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="grid h-10 min-w-10 place-items-center rounded-full bg-white px-3 text-sm font-semibold text-volcanic ring-1 ring-black/10 transition hover:bg-black/5">&larr;<span class="sr-only">{{ __('pagination.previous') }}</span></a></li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li aria-hidden="true" class="hidden px-1 text-volcanic/40 sm:block">{{ $element }}</li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li aria-current="page"><span class="grid h-10 min-w-10 place-items-center rounded-full bg-primary px-3 text-sm font-semibold text-white">{{ $page }}</span></li>
                        @else
                            <li class="hidden sm:block"><a href="{{ $url }}" aria-label="{{ __('Go to page :page', ['page' => $page]) }}" class="grid h-10 min-w-10 place-items-center rounded-full bg-white px-3 text-sm font-semibold text-volcanic ring-1 ring-black/10 transition hover:bg-black/5">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" rel="next" class="grid h-10 min-w-10 place-items-center rounded-full bg-white px-3 text-sm font-semibold text-volcanic ring-1 ring-black/10 transition hover:bg-black/5">&rarr;<span class="sr-only">{{ __('pagination.next') }}</span></a></li>
            @else
                <li aria-disabled="true"><span class="grid h-10 min-w-10 place-items-center rounded-full px-3 text-sm text-volcanic/30">&rarr;<span class="sr-only">{{ __('pagination.next') }}</span></span></li>
            @endif
        </ul>
    </nav>
@endif
