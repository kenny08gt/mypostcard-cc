@if ($per_page < $total)
    <ul class="pagination" role="navigation">
        {{-- Previous Page Link --}}
        @if ($page == 0)
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">&lsaquo;</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="?page={{$page - 1}}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
            </li>
        @endif

        @php
            $pages = round($total / $per_page);
        @endphp
        {{-- Pagination Elements --}}
        @foreach (range(0, $pages - 1) as $page_i)
            @if ($page == $page_i)
                <li class="page-item active" aria-current="page"><span class="page-link">{{ $page + 1}}</span></li>
            @else
                <li class="page-item"><a class="page-link" href="?page={{$page_i}}">{{ $page_i + 1}}</a></li>
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($page + 1 < $pages)
            <li class="page-item">
                <a class="page-link" href="?page={{$page + 1}}" rel="next"
                   aria-label="@lang('pagination.next')">&rsaquo;</a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">&rsaquo;</span>
            </li>
        @endif
    </ul>
@endif
