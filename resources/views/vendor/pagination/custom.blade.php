@if ($paginator->hasPages())
    <div class="flex justify-between flex-wrap">
        <!-- Previous Page Link -->
        @if ($paginator->onFirstPage())
            <span
                class="order-2 sm:order-1 hover:cursor-not-allowed bg-gray-700 hover:bg-gray-500 text-white px-4 py-2 rounded">Previous</span>
        @else
            <a class="order-2 sm:order-1 bg-gray-700 hover:bg-gray-500 text-white px-4 py-2 rounded"
                href="{{ $paginator->previousPageUrl() }}" rel="prev">Previous</a>
        @endif

        <!-- Pagination Elements -->
        <div class="flex overflow-hidden sm:order-2">
            <!-- First Page Link -->
            @if ($paginator->currentPage() > 4)
                <a class="w-8 h-8 flex items-center justify-center hover:bg-gray-700 text-blue-500 hover:text-white rounded"
                    href="{{ $paginator->url(1) }}">1</a>
                <span class="w-8 h-8 flex items-center justify-center">...</span>
            @endif

            <!-- Pages around current page -->
            @foreach (range(max($paginator->currentPage() - 3, 1), min($paginator->currentPage() + 3, $paginator->lastPage())) as $page)
                @if ($page == $paginator->currentPage())
                    <span
                        class="w-8 h-8 flex items-center justify-center bg-blue-500 text-white rounded">{{ $page }}</span>
                @else
                    <a class="w-8 h-8 flex items-center justify-center hover:bg-gray-700 text-blue-500 hover:text-white rounded"
                        href="{{ $paginator->url($page) }}">{{ $page }}</a>
                @endif
            @endforeach

            <!-- Dots -->
            @if ($paginator->currentPage() < $paginator->lastPage() - 3)
                <span class="w-8 h-8 flex items-center justify-center">...</span>
            @endif

            <!-- Last Page Link -->
            @if ($paginator->currentPage() < $paginator->lastPage() - 3)
                <a class="w-8 h-8 flex items-center justify-center hover:bg-gray-700 text-blue-500 hover:text-white rounded"
                    href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a>
            @endif
        </div>

        <!-- Next Page Link -->
        @if ($paginator->hasMorePages())
            <a class="order-3 sm:order-3 bg-gray-700 hover:bg-gray-500 text-white px-4 py-2 rounded"
                href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a>
        @else
            <span
                class="order-3 sm:order-3 hover:cursor-not-allowed bg-gray-700 hover:bg-gray-500 text-white px-4 py-2 rounded">Next</span>
        @endif
    </div>
@endif
