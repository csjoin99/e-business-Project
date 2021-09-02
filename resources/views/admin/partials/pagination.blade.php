@if ($paginator->hasPages())
    <div class="row">
        <ul class="pagination mt-2 px-2">
            @if (!$paginator->onFirstPage())
                <li class="paginate_button page-item previous" id="example1_previous"><a
                        href="{{ $paginator->previousPageUrl() }}" aria-controls="example1" data-dt-idx="0"
                        tabindex="0" class="page-link">Previous</a></li>
            @endif
            @foreach ($elements as $element)
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="paginate_button page-item active"><a role="button" aria-controls="example1"
                                    data-dt-idx="1" tabindex="0" class="page-link">{{ $page }}</a></li>
                            </span>
                        @else
                            <li class="paginate_button page-item "><a href="{{ $paginator->url($page) }}"
                                    aria-controls="example1" data-dt-idx="2" tabindex="0"
                                    class="page-link">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            @if ($paginator->hasMorePages())
                <li class="paginate_button page-item next" id="example1_next"><a
                        href="{{ $paginator->nextPageUrl() }}" aria-controls="example1" data-dt-idx="2" tabindex="0"
                        class="page-link">Next</a></li>
            @endif
        </ul>
    </div>
@endif
