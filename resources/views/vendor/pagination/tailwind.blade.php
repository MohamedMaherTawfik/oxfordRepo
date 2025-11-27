@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-center my-10">
        <div class="flex items-center justify-center">
            <span class="relative z-0 inline-flex rounded-full space-x-2">

                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                        <span
                            class="relative inline-flex items-center justify-center w-10 h-10 text-sm font-medium
                            bg-white text-[#79131d] opacity-40 cursor-not-allowed rounded-full border border-[#e4ce96]">
                            ‹
                        </span>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        class="ajax-pagination relative inline-flex items-center justify-center w-10 h-10
                        text-sm font-medium bg-white text-[#79131d] hover:bg-[#e4ce96] rounded-full border border-[#e4ce96] transition">
                        ‹
                    </a>
                @endif

                {{-- Pagination Elements --}}
                @php
                    $start = max($paginator->currentPage() - 2, 1);
                    $end = min($paginator->currentPage() + 2, $paginator->lastPage());
                @endphp

                @for ($page = $start; $page <= $end; $page++)
                    @if ($page == $paginator->currentPage())
                        <span aria-current="page">
                            <span
                                class="relative inline-flex items-center justify-center w-10 h-10
                                text-sm font-bold bg-[#e4ce96] text-[#79131d] rounded-full border border-[#79131d]">
                                {{ $page }}
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->url($page) }}"
                            class="ajax-pagination relative inline-flex items-center justify-center w-10 h-10
                            text-sm font-medium bg-[#79131d]/70 text-[#e4ce96] hover:bg-[#79131d] rounded-full transition">
                            {{ $page }}
                        </a>
                    @endif
                @endfor

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                        class="ajax-pagination relative inline-flex items-center justify-center w-10 h-10
                        text-sm font-medium bg-white text-[#79131d] hover:bg-[#e4ce96] rounded-full border border-[#e4ce96] transition">
                        ›
                    </a>
                @else
                    <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                        <span
                            class="relative inline-flex items-center justify-center w-10 h-10 text-sm font-medium
                            bg-white text-[#79131d] opacity-40 cursor-not-allowed rounded-full border border-[#e4ce96]">
                            ›
                        </span>
                    </span>
                @endif

            </span>
        </div>
    </nav>
@endif
