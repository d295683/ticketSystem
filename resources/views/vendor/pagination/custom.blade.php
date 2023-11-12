@if ($paginator->hasPages())
    <div class="flex justify-between">
        <!-- Previous Page Link -->
        @if ($paginator->onFirstPage())
            <span
                class="hover:cursor-not-allowed bg-gray-700 hover:bg-gray-500 text-white px-4 py-2 rounded">Previous</span>
        @else
            <a class="bg-gray-700 hover:bg-gray-500 text-white px-4 py-2 rounded"
                href="{{ $paginator->previousPageUrl() }}" rel="prev">Previous</a>
        @endif

        <div class="flex">
            <!-- First Page Link -->
            @if ($paginator->currentPage() > 6)
                <a class="w-8 h-8 flex items-center justify-center hover:bg-gray-700 text-blue-500 hover:text-white rounded" href="{{ $paginator->url(1) }}">1</a>
                <span class="w-8 h-8 flex items-center justify-center">...</span>
            @endif

            <!-- Pages around current page -->
            @foreach (range(max($paginator->currentPage() - 5, 1), min($paginator->currentPage() + 5, $paginator->lastPage())) as $page)
                @if ($page == $paginator->currentPage())
                    <span class="w-8 h-8 flex items-center justify-center bg-blue-500 text-white rounded">{{ $page }}</span>
                @else
                    <a class="w-8 h-8 flex items-center justify-center hover:bg-gray-700 text-blue-500 hover:text-white rounded" href="{{ $paginator->url($page) }}">{{ $page }}</a>
                @endif
            @endforeach

            <!-- Dots -->
            @if ($paginator->currentPage() < $paginator->lastPage() - 5)
                <span class="w-8 h-8 flex items-center justify-center">...</span>
            @endif

            <!-- Last Page Link -->
            @if ($paginator->currentPage() < $paginator->lastPage() - 5)
                <a class="w-8 h-8 flex items-center justify-center hover:bg-gray-700 text-blue-500 hover:text-white rounded" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a>
            @endif
        </div>

        <!-- Next Page Link -->
        @if ($paginator->hasMorePages())
            <a class="bg-gray-700 hover:bg-gray-500 text-white px-4 py-2 rounded" href="{{ $paginator->nextPageUrl() }}"
                rel="next">Next</a>
        @else
            <span
                class="hover:cursor-not-allowed bg-gray-700 hover:bg-gray-500 text-white px-4 py-2 rounded">Next</span>
        @endif
    </div>
@endif
