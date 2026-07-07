@if ($paginator->hasPages())
    <nav class="custom-pagination-nav" aria-label="Navigazione pagine">
        <ul class="pagination" style="display: flex; gap: 10px; list-style: none; padding-left: 0; justify-content: center; margin-top: 40px;">

            {{-- Link alla pagina precedente --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" style="opacity: 0.5;"><span>&laquo; Precedente</span></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo; Precedente</a></li>
            @endif

            {{-- Numeri di pagina --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="disabled"><span>{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active" style="font-weight: bold; background:#d9d9d9; padding:2px 5px;"><span>{{ $page }}</span></li>
                        @else
                            <li style="padding:2px 2px;"><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Link alla pagina successiva --}}
            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">Successiva &raquo;</a></li>
            @else
                <li class="disabled" style="opacity: 0.5;"><span>Successiva &raquo;</span></li>
            @endif

        </ul>
    </nav>
@endif
