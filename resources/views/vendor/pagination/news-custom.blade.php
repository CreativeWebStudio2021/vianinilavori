@if ($paginator->hasPages())
    {{-- Stili isolati: il CSS globale decora ogni "ul li" con una freccetta ::before e un
         padding-left, che si riversava sui numeri/frecce della paginazione. Qui neutralizziamo
         quelle regole e diamo uno stile pulito e coerente col design del sito. --}}
    <style>
        .custom-pagination-nav .pagination {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            list-style: none;
            padding-left: 0;
            margin: 40px 0 0;
            justify-content: center;
        }
        .custom-pagination-nav .pagination li {
            position: static;
            margin: 0;
            padding: 0;
        }
        .custom-pagination-nav .pagination li::before {
            content: none !important;
            display: none !important;
        }
        .custom-pagination-nav .pagination li a,
        .custom-pagination-nav .pagination li span {
            display: flex;
            align-items: center;
            justify-content: center;
            box-sizing: border-box;
            min-width: 44px;
            height: 44px;
            padding: 0 14px;
            border: 1px solid #000;
            background: #fff;
            color: #000;
            font-family: Arial, sans-serif;
            font-size: 18px;
            font-weight: 400;
            line-height: 1;
            text-decoration: none;
            transition: background-color .2s ease, color .2s ease;
        }
        .custom-pagination-nav .pagination li a:hover {
            background: #000;
            color: #fff;
        }
        .custom-pagination-nav .pagination li.active span {
            background: #000;
            border-color: #000;
            color: #fff;
            font-weight: 700;
        }
        .custom-pagination-nav .pagination li.disabled span {
            border-color: #999;
            color: #777;
            opacity: .5;
            cursor: not-allowed;
        }
    </style>

    <nav class="custom-pagination-nav" aria-label="Navigazione pagine">
        <ul class="pagination">

            {{-- Pagina precedente --}}
            @if ($paginator->onFirstPage())
                <li class="disabled"><span aria-hidden="true">&laquo; Precedente</span></li>
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
                            <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Pagina successiva --}}
            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">Successiva &raquo;</a></li>
            @else
                <li class="disabled"><span aria-hidden="true">Successiva &raquo;</span></li>
            @endif

        </ul>
    </nav>
@endif
