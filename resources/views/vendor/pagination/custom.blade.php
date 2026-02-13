@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-center space-x-2 font-satoshi">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 text-sm font-semibold text-gray-400 bg-gray-100 rounded-full cursor-not-allowed">
                {!! __('pagination.previous') !!}
            </span>
        @else
            <button wire:click="previousPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" rel="prev" class="px-4 py-2 text-sm font-semibold text-brand-dark bg-white border border-gray-200 rounded-full hover:bg-brand-orange hover:text-white hover:border-brand-orange transition-all duration-300 shadow-sm">
                {!! __('pagination.previous') !!}
            </button>
        @endif

        {{-- Pagination Elements --}}
        <div class="hidden md:flex items-center space-x-2">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="px-4 py-2 text-sm font-semibold text-gray-400">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-4 py-2 text-sm font-bold text-white bg-brand-orange rounded-full shadow-md shadow-brand-orange/20">
                                {{ $page }}
                            </span>
                        @else
                            <button wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" class="px-4 py-2 text-sm font-semibold text-brand-dark bg-white border border-gray-200 rounded-full hover:bg-brand-orange/10 hover:text-brand-orange hover:border-brand-orange transition-all duration-300">
                                {{ $page }}
                            </button>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <button wire:click="nextPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" rel="next" class="px-4 py-2 text-sm font-semibold text-brand-dark bg-white border border-gray-200 rounded-full hover:bg-brand-orange hover:text-white hover:border-brand-orange transition-all duration-300 shadow-sm">
                {!! __('pagination.next') !!}
            </button>
        @else
            <span class="px-4 py-2 text-sm font-semibold text-gray-400 bg-gray-100 rounded-full cursor-not-allowed">
                {!! __('pagination.next') !!}
            </span>
        @endif
    </nav>
@endif
