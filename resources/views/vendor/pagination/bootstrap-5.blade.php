@if ($paginator->hasPages())
    <nav class="custom-pagination-wrapper">
        <ul class="custom-pagination">
            @if (!$paginator->onFirstPage())
                <li><a href="{{ $paginator->previousPageUrl() }}"><i class="bi bi-chevron-left"></i></a></li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="dots">{{ $element }}</li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li><a href="#" class="active" style="background-color: #083386; border: 1px solid #ddd; color: #fff;">{{ $page }}</a></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}"><i class="bi bi-chevron-right"></i></a></li>
            @endif
        </ul>
    </nav>
@endif
