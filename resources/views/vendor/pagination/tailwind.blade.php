@if ($paginator->hasPages())
<nav class="flex justify-center mt-8" aria-label="Pagination">
    <ul class="inline-flex items-center space-x-2">

        {{-- Previous Page --}}
        @if ($paginator->onFirstPage())
            <li>
                <span class="px-4 py-2 rounded-lg bg-gray-200 text-gray-400 cursor-not-allowed">Prev</span>
            </li>
        @else
            <li>
                <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-2 rounded-lg bg-white border border-gray-300 hover:bg-blue-50 hover:text-blue-600 transition">
                    Prev
                </a>
            </li>
        @endif

        {{-- Page Numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <li>
                    <span class="px-4 py-2 rounded-lg text-gray-500">{{ $element }}</span>
                </li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li>
                            <span class="px-4 py-2 rounded-lg bg-blue-600 text-white font-semibold">{{ $page }}</span>
                        </li>
                    @else
                        <li>
                            <a href="{{ $url }}" class="px-4 py-2 rounded-lg bg-white border border-gray-300 hover:bg-blue-50 hover:text-blue-600 transition">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page --}}
        @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-2 rounded-lg bg-white border border-gray-300 hover:bg-blue-50 hover:text-blue-600 transition">Next</a>
            </li>
        @else
            <li>
                <span class="px-4 py-2 rounded-lg bg-gray-200 text-gray-400 cursor-not-allowed">Next</span>
            </li>
        @endif

    </ul>
</nav>
@endif
