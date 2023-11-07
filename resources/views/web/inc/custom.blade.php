@if ($paginator->hasPages())
    <div class="paginate">
        @if (!$paginator->onFirstPage())
            <a class="item" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                <svg viewBox="0 0 24 24">
                    <path d="M15.41,16.58L10.83,12L15.41,7.41L14,6L8,12L14,18L15.41,16.58Z"></path>
                </svg>
            </a>
        @endif
        <a class="item active">{{ $paginator->currentPage() }}</a>
        @if ($paginator->hasMorePages())
            <a class="item" href="{{ $paginator->nextPageUrl() }}" rel="next">
                <svg viewBox="0 0 24 24">
                    <path d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z"></path>
                </svg>
            </a>
        @endif
    </div>
@endif
