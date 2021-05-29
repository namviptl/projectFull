@if ($paginator->hasPages())
    <!-- Pagination -->
    <div class="pull-right pagination">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" style="margin-right: 5px;">
                    <span >&lt;</span>
                </li>
            @else
                <li style="margin-right: 5px;">
                    <a href="{{ $paginator->previousPageUrl() }}">
                       &lt;
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li style="margin-right: 5px" class="active"><span>{{ $page }}</span></li>
                        @elseif (($page == $paginator->currentPage() + 1 || $page == $paginator->currentPage() + 1) || $page == $paginator->lastPage())
                            <li style="margin-right: 5px"><a href="{{ $url }}">{{ $page }}</a></li>
                        @elseif ($page == $paginator->lastPage() - 1)
                            <li style="margin-right: 5px"><span>. . .</span></li><li style="margin-right: 5px" class="disabled"><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}">
                        &gt;
                    </a>
                </li>
            @else
                <li class="disabled">
                    <span>&gt;</i></span>
                </li>
            @endif
        </ul>
    </div>
    <!-- Pagination -->
@endif