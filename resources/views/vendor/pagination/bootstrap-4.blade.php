@php
	$linkParameters = url()->full();
	$linkParameters = str_replace(url()->current(),"",$linkParameters);
	$linkParameters = str_replace("&page=".$paginator->currentPage(),"",$linkParameters);
	$linkParameters = str_replace("page=".$paginator->currentPage()."&","",$linkParameters);
	$linkParameters = str_replace("page=".$paginator->currentPage(),"",$linkParameters);
	
	$addPage="&page";
	if($linkParameters=="") $addPage="?page";
	if($linkParameters=="?") $addPage="page";
@endphp
@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
        @else
            <li class="page-item"><a class="page-link" href="{{ url()->current() }}{{ $linkParameters }}{{ $addPage }}={{ $paginator->currentPage()-1 }}" rel="prev">&laquo;</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ url()->current() }}{{ $linkParameters }}{{ $addPage }}={{ $page }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ url()->current() }}{{ $linkParameters }}{{ $addPage }}={{ $paginator->currentPage()+1 }}" rel="next">&raquo;</a></li>
        @else
            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
        @endif
    </ul>
@endif
