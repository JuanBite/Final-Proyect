@if ($paginator->hasPages())
<nav class="flex items-center justify-between mt-6">

    {{-- Info --}}
    <span class="text-xs text-[#8AAABB]">
        Mostrando <span class="text-[#E8F4FF] font-medium">{{ $paginator->firstItem() }}</span>
        a <span class="text-[#E8F4FF] font-medium">{{ $paginator->lastItem() }}</span>
        de <span class="text-[#E8F4FF] font-medium">{{ $paginator->total() }}</span> resultados
    </span>

    {{-- Botones --}}
    <div class="flex items-center gap-1">

        {{-- Anterior --}}
        @if ($paginator->onFirstPage())
            <span class="w-9 h-9 flex items-center justify-center rounded-lg border border-[#00C853]/10 text-[#8AAABB]/30 cursor-not-allowed">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="w-9 h-9 flex items-center justify-center rounded-lg border border-[#00C853]/20 text-[#8AAABB] hover:bg-[#00C853]/10 hover:text-[#00C853] hover:border-[#00C853]/40 transition-all">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
        @endif

        {{-- Páginas --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="w-9 h-9 flex items-center justify-center text-[#8AAABB] text-sm">
                    {{ $element }}
                </span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="w-9 h-9 flex items-center justify-center rounded-lg bg-[#00C853] text-[#0A1628] font-bold text-sm border border-[#00C853]">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}"
                            class="w-9 h-9 flex items-center justify-center rounded-lg border border-[#00C853]/20 text-[#8AAABB] text-sm hover:bg-[#00C853]/10 hover:text-[#00C853] hover:border-[#00C853]/40 transition-all">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Siguiente --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                class="w-9 h-9 flex items-center justify-center rounded-lg border border-[#00C853]/20 text-[#8AAABB] hover:bg-[#00C853]/10 hover:text-[#00C853] hover:border-[#00C853]/40 transition-all">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        @else
            <span class="w-9 h-9 flex items-center justify-center rounded-lg border border-[#00C853]/10 text-[#8AAABB]/30 cursor-not-allowed">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </span>
        @endif

    </div>
</nav>
@endif